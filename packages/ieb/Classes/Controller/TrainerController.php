<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Dto\TrainerSearch;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use Psr\Http\Message\ResponseInterface;

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
        $this->view->assignMultiple([
            'trainer' => $trainer,
            'relationUsages' => $this->relationLockService->usedByAnsuchenInReview($trainer),
        ]);
        return $this->htmlResponse();
    }

    public function updateAction(Trainer $trainer)
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $this->trainerRepository->update($trainer);
        }
        $this->redirect('index');
    }

    public function deleteAction(Trainer $trainer)
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $this->trainerRepository->remove($trainer);
        }
        $this->redirect('index');
    }

    public function archiveAction(Trainer $trainer): ResponseInterface
    {
        $this->check($trainer);
        if (!$this->relationLockService->usedByAnsuchenInReview($trainer)) {
            $trainer->setArchiviert(true);
            $this->trainerRepository->update($trainer);
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

}
