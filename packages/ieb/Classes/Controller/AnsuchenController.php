<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\StaticStammdaten;
use GeorgRinger\Ieb\Domain\Repository;
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

    public function createAction(Ansuchen $newAnsuchen)
    {
        $stammDaten = $this->stammdatenRepository->getLatest();
        /** @var StaticStammdaten $staticStammDaten */
        $staticStammDaten = $this->stammdatenRepository->duplicateToStaticVersion($stammDaten);
        $newAnsuchen->setStatus(AnsuchenStatus::NEU_IN_ARBEIT->value);
        $newAnsuchen->setStammdatenStatic($staticStammDaten);

        $this->ansuchenRepository->add($newAnsuchen);
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
        $this->addFlashMessage('Wurde eingereicht');
        $ansuchen->setStatus(AnsuchenStatus::EINGEREICHT_ERSTEINREICHUNG->value);
        $this->ansuchenRepository->update($ansuchen);
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


    public function updateAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->update($ansuchen);
        $this->redirect('list');
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
                'berater' => $this->beraterRepository->getAll(),
                'trainer' => $this->trainerRepository->getAll(),
                'angebotVerantwortliche' => $this->angebotVerantwortlichRepository->getAll(),
                'stammdaten' => $this->stammdatenRepository->getLatest(),
            ],
        ]);
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
