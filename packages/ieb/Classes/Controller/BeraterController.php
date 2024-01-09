<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Dto\BeraterSearch;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use GeorgRinger\Ieb\Event\BeraterArchiveEvent;
use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BeraterController extends BaseController
{

    protected BeraterRepository $beraterRepository;

    public function injectBeraterRepository(BeraterRepository $BeraterRepository)
    {
        $this->beraterRepository = $BeraterRepository;
    }

    public function indexAction(BeraterSearch $beraterSearch = null): ResponseInterface
    {
        $this->view->assignMultiple([
            'beraters' => $this->beraterRepository->findBySearch($beraterSearch),
            'beraterSearch' => $beraterSearch,
        ]);
        return $this->htmlResponse();
    }

    public function showAction(Berater $berater): ResponseInterface
    {
        $this->view->assign('berater', $berater);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newBerater');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('berater');
    }


    public function createAction(Berater $newBerater)
    {
        $this->beraterRepository->add($newBerater);
        $this->redirect('index');
    }

    public function editAction(Berater $berater): ResponseInterface
    {
        $this->check($berater);
        $this->beraterRepository->setLockedAndPersist($berater);
        $this->view->assignMultiple([
            'berater' => $berater,
            'relationUsagesInReview' => $this->relationLockService->usedByAnsuchenInReview($berater),
            'relationUsages' => $this->relationLockService->usedByAnsuchen($berater),
        ]);
        return $this->htmlResponse();
    }

    public function updateAction(Berater $berater, array $fileDelete = [])
    {
        $this->check($berater);
        $arguments = $this->request->getArguments();
        if (isset($arguments['saveAndIndex'])) {
            $berater->setLockedBy(0);
        }
        if (!$this->relationLockService->usedByAnsuchenInReview($berater)) {
            $this->deleteFiles($fileDelete, $berater);
        }
        $this->beraterRepository->update($berater);
        return $this->redirectTo($berater->getUid());
        
    }

    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['save']) && $recordId > 0) {
            $this->redirect('edit', null, null, ['berater' => $recordId]);
        }
        if (isset($arguments['saveAndIndex'])) {
            $this->redirect('index');
        }
    }

    public function deleteAction(Berater $berater)
    {
        $this->check($berater);
        if (!$this->relationLockService->usedByAnsuchenInReview($berater)) {
            $this->beraterRepository->remove($berater);
        }
        $this->redirect('index');
    }

    public function archiveAction(Berater $berater)
    {
        $this->check($berater);
        if (!$this->relationLockService->usedByAnsuchenInReview($berater)) {
            $berater->setArchiviert(true);
            $this->beraterRepository->update($berater);
            $this->eventDispatcher->dispatch(new BeraterArchiveEvent($berater));
        }
        

        $this->redirect('index');
    }

    public function unlockAction(Berater $berater)
    {
        $this->check($berater);
        $berater->setLockedBy(0);
        $this->beraterRepository->update($berater);
        $this->redirect('index');
    }

    public function reviveAction(Berater $berater)
    {
        $this->check($berater);
        if (!$this->relationLockService->usedByAnsuchenInReview($berater)) {
            $berater->setArchiviert(false);
            $this->beraterRepository->update($berater);
        }
        

        $this->redirect('index');
    }

}
