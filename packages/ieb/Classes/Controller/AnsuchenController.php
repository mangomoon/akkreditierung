<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\StaticStammdaten;
use GeorgRinger\Ieb\Domain\Repository;
use GeorgRinger\Ieb\Service\DiffService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
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
        //$ansuchen = $this->ansuchenRepository->getAllEditableForTr();
        $ansuchen = $this->ansuchenRepository->getAll();
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->setTitleTag($ansuchen->getTitleTag());
        $this->view->assign('ansuchen', $ansuchen);
        $this->addRelationDataToView();
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        $this->addRelationDataToView();
        $this->view->assign('newAnsuchen', new Ansuchen());
        return $this->htmlResponse();
    }

    public function createAction(Ansuchen $newAnsuchen): ResponseInterface
    {
        $stammDaten = $this->stammdatenRepository->getLatest();
        /** @var StaticStammdaten $staticStammDaten */
        //$staticStammDaten = $this->stammdatenRepository->duplicateToStaticVersion($stammDaten);
        $newAnsuchen->setStatus(AnsuchenStatus::NEU_IN_ARBEIT->value);
        //$newAnsuchen->setStammdatenStatic($staticStammDaten);
        $newAnsuchen->setVersionActive(true);

        $this->ansuchenRepository->add($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        $newAnsuchen->setNummer($this->ansuchenRepository->createAnsuchenNummer($newAnsuchen->getUid(), $newAnsuchen->getTyp()));
        $this->ansuchenRepository->update($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        //$this->redirect('list');
        return $this->redirectToDirectly();
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function editAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->setLockedAndPersist($ansuchen);
        $this->setTitleTag($ansuchen->getTitleTag());

        $stammdaten = $this->stammdatenRepository->getLatest();
        $jsonsOfCurrentAnsuchen = $this->ansuchenRepository->getJsonFromRelations($ansuchen, $stammdaten);
        $diffResult = (new DiffService($jsonsOfCurrentAnsuchen))->generateDiff($ansuchen->getUid(), $ansuchen->getVersionBasedOn());

        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'stammdaten' => $stammdaten,
            'diff' => $diffResult
        ]);
        $this->addRelationDataToView();
        return $this->htmlResponse();
    }

    public function einreichenAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->addFlashMessage('Das Ansuchen wurde eingereicht');
        $newSnapShotIfVersionChangedByTr = false;
        if ($newSnapShotIfVersionChangedByTr) {
            $newAnsuchenId = $this->ansuchenRepository->createNewSnapshot($ansuchen, $this->stammdatenRepository->getLatest());
            $newAnsuchen = $this->ansuchenRepository->findByIdentifier($newAnsuchenId);
            $newAnsuchen->setEinreichDatum(new \DateTime());
            switch ($ansuchen->getStatus()) {
                case 10:
                    $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 80:
                    $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value);
                    break;
            }
            $this->ansuchenRepository->update($newAnsuchen);
        } else {
            $ansuchen->setEinreichDatum(new \DateTime());
            switch ($ansuchen->getStatus()) {
                case 10:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 80:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value);
                    break;
                case 140:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value);
                    break;
            }
            $this->ansuchenRepository->updateJsonRelations($ansuchen, $this->stammdatenRepository->getLatest());
            $this->ansuchenRepository->update($ansuchen);
        }
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
        $this->deleteFiles($fileDelete, $ansuchen);
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
        $this->ansuchenRepository->removeLockByUser($ansuchen->getUid());
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
                'trainerbabiinactive' => $this->trainerRepository->getInactiveBabi(),
                'trainerpsainactive' => $this->trainerRepository->getInactivePSA(),
                'angebotVerantwortliche' => $this->angebotVerantwortlichRepository->getActive(),
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
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirect('list');
        }
        if (isset($arguments['saveAndTrainer'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToUri("/uebersicht-tr/training");
        }
        if (isset($arguments['saveAndStandorte'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToUri("/uebersicht-tr/standorte");
        }if (isset($arguments['saveAndStandorteOhne'])) {
            $this->redirectToUri("/uebersicht-tr/standorte");
        }
        if (isset($arguments['saveAndBerater'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToUri("/uebersicht-tr/beratung");
        }
        if (isset($arguments['saveAndVerantwortliche'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToUri("/uebersicht-tr/projektleitung");
        }
        $this->redirect('list');
    }

    protected function redirectToDirectly(): void
    {
        $arguments = $this->request->getArguments();
        
        if (isset($arguments['saveAndTrainer'])) {
            $this->redirectToUri("/uebersicht-tr/training");
        }
        if (isset($arguments['saveAndStandorte'])) {
            $this->redirectToUri("/uebersicht-tr/standorte");
        }
        if (isset($arguments['saveAndBerater'])) {
            $this->redirectToUri("/uebersicht-tr/beratung");
        }
        if (isset($arguments['saveAndVerantwortliche'])) {
            $this->redirectToUri("/uebersicht-tr/projektleitung");
        }
        $this->redirect('list');
    }

    public function archiveAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $ansuchen->setArchiviert(true);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->redirect('list');
    }

    public function reviveAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $ansuchen->setArchiviert(false);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
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
