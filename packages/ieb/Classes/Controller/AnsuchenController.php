<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository;
use GeorgRinger\Ieb\Event;
use GeorgRinger\Ieb\EventListener\AnsuchenPdfGenerationListener;
use GeorgRinger\Ieb\Service\DiffService;
use Psr\Http\Message\ResponseInterface;

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
        $ansuchen = $this->ansuchenRepository->getAll();
        $this->view->assign('ansuchen', $ansuchen);
        
        $stammdaten = $this->stammdatenRepository->getLatest();
        $stammdaten->setLockedBy(0);
        $this->stammdatenRepository->update($stammdaten);
        $pid = $stammdaten->getPid();
        $this->view->assignMultiple([
            'stammdaten' => $stammdaten,
            'usedInAnsuchen' => $this->ansuchenRepository->getAllUsedByGs($pid),
        ]);
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
        $newAnsuchen->setStatus(AnsuchenStatus::NEU_IN_ARBEIT->value);
        $newAnsuchen->setVersionActive(true);

        $this->ansuchenRepository->add($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        $newAnsuchen->setNummer($this->ansuchenRepository->createAnsuchenNummer($newAnsuchen->getUid(), $newAnsuchen->getTyp()));
        $this->ansuchenRepository->update($newAnsuchen);
        $this->ansuchenRepository->forcePersist();
        //$this->redirect('list');
        return $this->redirectToDirectly();
        //return $this->redirectTo($ansuchen->getUid());
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
            'diff' => $diffResult,
        ]);
        $this->addRelationDataToView();
        return $this->htmlResponse();
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function trotzdemAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function einreichenAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $ansuchennummer = $ansuchen->getNummer();
        $this->addFlashMessage('Das Ansuchen ' . $ansuchennummer . ' wurde eingereicht');
        $newSnapShotIfVersionChangedByTr = false;
        if ($newSnapShotIfVersionChangedByTr) {
            $newAnsuchenId = $this->ansuchenRepository->createNewSnapshot($ansuchen, $this->stammdatenRepository->getLatest());
            $newAnsuchen = $this->ansuchenRepository->findByIdentifier($newAnsuchenId);
            $newAnsuchen->setEinreichDatum(new \DateTime());
            switch ($ansuchen->getStatus()) {
                case 0:
                case 10:
                    $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 20:
                    $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 80:
                    $newAnsuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value);
                    break;
                case 100:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value);
                    break;
                case 140:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value);
                    break;
                case 200:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_ZURUECK_AN_TR_AKKREDITIERT->value);
                    break;
                case 220:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_ZURUECK_AN_TR_AUFLAGE->value);
                    break;
            }
            $this->ansuchenRepository->update($newAnsuchen);
        } else {
            $ansuchen->setEinreichDatum(new \DateTime());
            
            $ansuchen->setStatusAfterReview(0);
            $ansuchen->setLockedBy(0);

            $ansuchen->setUpcomingStatus(0);
            $ansuchen->setNotitzzettel('');

            $previousStatus = AnsuchenStatus::tryFrom($ansuchen->getStatus());
            switch ($ansuchen->getStatus()) {
                case 0:
                case 10:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 20:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
                    break;
                case 80:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value);
                    break;
                case 100:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value);
                    break;
                case 140:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value);
                    break;
                case 200:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_ZURUECK_AN_TR_AKKREDITIERT->value);
                    break;
                case 220:
                    $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_NACH_ZURUECK_AN_TR_AUFLAGE->value);
                    break;
            }
            
            

            $stammdaten = $this->stammdatenRepository->getLatest();
            $this->ansuchenRepository->updateJsonRelations($ansuchen, $stammdaten);
            $this->ansuchenRepository->update($ansuchen);
            $this->ansuchenRepository->forcePersist();
            $this->eventDispatcher->dispatch(new Event\AnsuchenEinreichenEvent($previousStatus, $ansuchen, $stammdaten, self::getCurrentUser()));
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
        if (isset($arguments['saveAndStammdaten'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToPageId(10);
        }
        if (isset($arguments['saveAndTrainer'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToPageId(12);
        }
        if (isset($arguments['saveAndStandorte'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToPageId(11);
        }
        if (isset($arguments['saveAndStandorteOhne'])) {
            $this->redirectToPageId(11);
        }
        if (isset($arguments['saveAndBerater'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToPageId(13);
        }
        if (isset($arguments['saveAndVerantwortliche'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirectToPageId(18);
        }
        if (isset($arguments['saveAndEinreichen'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);
            $this->redirect('einreichen', null, null, ['ansuchen' => $recordId]);
        }
        $this->redirect('list');
    }

    protected function redirectToDirectly(): void
    {
        $arguments = $this->request->getArguments();

        if (isset($arguments['saveAndTrainer'])) {
            $this->redirectToPageId(12);
        }
        if (isset($arguments['saveAndStandorte'])) {
            $this->redirectToPageId(11);
        }
        if (isset($arguments['saveAndBerater'])) {
            $this->redirectToPageId(13);
        }
        if (isset($arguments['saveAndStammdaten'])) {
            $this->redirectToPageId(10);
        }
        if (isset($arguments['saveAndVerantwortliche'])) {
            $this->redirectToPageId(18);
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

    /**
     * @see AnsuchenPdfGenerationListener
     */
    public function certificateDownloadAction(Ansuchen $ansuchen)
    {
        $this->check($ansuchen);
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'stammdaten' => $this->stammdatenRepository->getLatest(),
            'extensionConfiguration' => $this->extensionConfiguration,
            'outputDestination' => 'inline',
        ]);
        $this->addRelationDataToView();
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
