<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\StaticStammdaten;
use GeorgRinger\Ieb\Domain\Repository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class AnsuchenController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;
    protected Repository\AngebotVerantwortlichRepository $angebotVerantwortlichRepository;
    protected Repository\StammdatenRepository $stammdatenRepository;
    protected Repository\BeraterRepository $beraterRepository;
    protected Repository\TrainerRepository $trainerRepository;
    protected Repository\StandortRepository $standortRepository;

    public function listAction(): ResponseInterface
    {
        $ansuchen = $this->ansuchenRepository->getAllEditableForTr();
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->setTitleTag($ansuchen->getTitleTag());
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        $this->addRelationDataToView();
        return $this->htmlResponse();
    }

    public function createAction(Ansuchen $newAnsuchen): ResponseInterface
    {
        $stammDaten = $this->stammdatenRepository->getLatest();
        /** @var StaticStammdaten $staticStammDaten */
        $staticStammDaten = $this->stammdatenRepository->duplicateToStaticVersion($stammDaten);
        $newAnsuchen->setStatus(AnsuchenStatus::NEU_IN_ARBEIT->value);
         $newAnsuchen->setStammdatenStatic($staticStammDaten);
        $newAnsuchen->setVersionActive(true);

        $this->ansuchenRepository->add($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        $newAnsuchen->setNummer(sprintf('4-%s-%s', str_pad((String)$newAnsuchen->getUid(), 4, '0', STR_PAD_LEFT), $newAnsuchen->getTyp()));
        $this->ansuchenRepository->update($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        $this->redirect('list');
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function editAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->setLockedAndPersist($ansuchen);
        $this->setTitleTag($ansuchen->getTitleTag());
        $this->view->assign('ansuchen', $ansuchen);
        $this->addRelationDataToView();
        return $this->htmlResponse();
    }

    public function einreichenAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $newAnsuchenId = $this->ansuchenRepository->createNewSnapshot($ansuchen, $this->stammdatenRepository->getLatest());
        $this->addFlashMessage('Das Ansuchen wurde eingereicht');
        $newAnsuchen = $this->ansuchenRepository->findByIdentifier($newAnsuchenId);
        $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
        $this->ansuchenRepository->update($newAnsuchen);
        $this->redirect('list');
        return $this->htmlResponse();
    }

    public function cloneAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->clone($ansuchen);
        $this->addFlashMessage('Wurde kopiert');
        $this->redirect('list');
        return $this->htmlResponse();
    }

    public function updateAction(Ansuchen $ansuchen, array $fileDelete = []): ResponseInterface
    {
        $this->check($ansuchen);
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_file_reference');
        foreach ($fileDelete as $propertyType => $deletes) {
            $split = explode('_', $propertyType);
            $property = $split[1];
            foreach ($deletes as $fileId => $action) {
                if ($action !== '1') {
                    continue;
                }
                $fileId = (int)$fileId;
                $getter = 'get' . ucfirst($property);
                $setter = 'set' . ucfirst($property);
                if ($split[0] === 's') {
                    $file = $ansuchen->$getter();
                    if ($file && $file->getUid() === $fileId) {
//                        $ansuchen->$setter(null);
                        $connection->update('sys_file_reference', ['deleted' => 1], ['uid' => $fileId]);
                    }
                } elseif ($split[0] === 'm') {
                    /** @var ObjectStorage $files */
                    $files = $ansuchen->$getter();
                    foreach ($files as $file) {
                        if ($file->getUid() === (int)$fileId) {
                            $connection->update('sys_file_reference', ['deleted' => 1], ['uid' => $fileId]);
//                            $files->detach($file);
                        }
                    }
//                    $ansuchen->$setter($files);
                }
            }
        }
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        return $this->redirectTo($ansuchen->getUid());
    }

    public function deleteAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->remove($ansuchen);
        $this->redirect('list');
    }

    public function unlockAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->setUnlockedAndPersist($ansuchen);
        $this->redirect('list');
    }

    protected function addRelationDataToView(): void
    {
        $this->view->assignMultiple([
            'relations' => [
                'standorte' => $this->standortRepository->getAll(),
                'standorteaktiv' => $this->standortRepository->getActive(),
                'berater' => $this->beraterRepository->getAll(),
                'berateraktivundok' => $this->beraterRepository->getActive(),
                'trainer' => $this->trainerRepository->getAll(),
                'trainerbabi' => $this->trainerRepository->getActiveBabi(),
                'trainerpsa' => $this->trainerRepository->getActivePSA(),
                'angebotVerantwortliche' => $this->angebotVerantwortlichRepository->getAll(),
                'stammdaten' => $this->stammdatenRepository->getLatest(),
            ],
        ]);
    }

    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['save']) && $recordId > 0) {
            $this->redirect('edit', null, null, ['ansuchen' => $recordId]);
        }
        if (isset($arguments['saveAndIndex'])) {
            $this->redirect('list');
        }
        $this->redirect('list');
    }


    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectStammdatanRepository(Repository\StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    public function injectBeraterRepository(Repository\BeraterRepository $repository): void
    {
        $this->beraterRepository = $repository;
    }

    public function injectTrainerRepository(Repository\TrainerRepository $repository): void
    {
        $this->trainerRepository = $repository;
    }

    public function injectStandortRepository(Repository\StandortRepository $repository): void
    {
        $this->standortRepository = $repository;
    }

    public function injectAngebotVerantwortlichRepository(Repository\AngebotVerantwortlichRepository $repository): void
    {
        $this->angebotVerantwortlichRepository = $repository;
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newAnsuchen');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('ansuchen');
    }

}
