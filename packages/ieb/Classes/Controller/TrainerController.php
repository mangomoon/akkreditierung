<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Dto\TrainerSearch;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use GeorgRinger\Ieb\Event\TrainerArchiveEvent;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use League\Csv;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class TrainerController extends BaseController
{

    protected TrainerRepository $trainerRepository;

    public function injectTrainerRepository(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function indexAction(TrainerSearch $trainerSearch = null): ResponseInterface
    {
        $this->view->assignMultiple([
            'trainers' => $this->trainerRepository->findBySearch($trainerSearch),
            'trainerSearch' => $trainerSearch,
        ]);
        return $this->htmlResponse();
    }

    public function showAction(Trainer $trainer): ResponseInterface
    {
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newTrainer');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('trainer');
    }

    public function createAction(Trainer $newTrainer)
    {
        $this->trainerRepository->add($newTrainer);
        $this->redirect('index');
    }

    public function editAction(Trainer $trainer): ResponseInterface
    {
        $this->check($trainer);
        $this->trainerRepository->setLockedAndPersist($trainer);
        $this->view->assignMultiple([
            'trainer' => $trainer,
            'relationUsagesInReview' => $this->relationLockService->usedByAnsuchenInReview($trainer),
            'relationUsages' => $this->relationLockService->usedByAnsuchen($trainer),
        ]);
        return $this->htmlResponse();
    }

    public function updateAction(Trainer $trainer, array $fileDelete = [])
    {
        $this->check($trainer);
        $arguments = $this->request->getArguments();
        if (isset($arguments['saveAndIndex'])) {
            $trainer->setLockedBy(0);
        }
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $this->deleteFiles($fileDelete, $trainer);
            $this->trainerRepository->update($trainer);
        }
        
        return $this->redirectTo($trainer->getUid());
    }

    public function deleteAction(Trainer $trainer)
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $this->trainerRepository->remove($trainer);
        }
        $this->redirect('index');
    }

    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['save']) && $recordId > 0) {
            $this->redirect('edit', null, null, ['trainer' => $recordId]);
        }
        if (isset($arguments['saveAndIndex'])) {
            $this->redirect('index');
        }
    }

    public function unlockAction(Trainer $trainer)
    {
        $this->check($trainer);
        $trainer->setLockedBy(0);
        $this->trainerRepository->update($trainer);
        $this->redirect('index');
    }

    public function archiveAction(Trainer $trainer): ResponseInterface
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $trainer->setArchiviert(true);
            $this->trainerRepository->update($trainer);
            $this->eventDispatcher->dispatch(new TrainerArchiveEvent($trainer));
        }
        $this->redirect('index');
    }

    public function reviveAction(Trainer $trainer): ResponseInterface
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $trainer->setArchiviert(false);
            $this->trainerRepository->update($trainer);
        }
        $this->redirect('index');
    }


    protected function csvdownloadAction()
    {
        $rows = null;
        $rows = $this->trainerRepository->getAllForCsv();

        $fieldlist = [
            'vorname' => 'Vorname',
            'nachname' => 'Nachname',
        ];
        $csv = Csv\Writer::createFromString();
        $csv->insertOne(array_values($fieldlist));
        $csv->setDelimiter(";");
        $allowedKeys = array_keys($fieldlist);
        foreach ($rows as $row) {
            $limitedSet = array_intersect_key($row, array_flip($allowedKeys));
            $csv->insertOne($limitedSet);
        }

        return $csv->toString();
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: text/csv');
        header('Content-Length: ' . strlen($result));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        echo $result;
        exit;
    }

}
