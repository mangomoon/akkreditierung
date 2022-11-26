<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


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

    public function indexAction(): ResponseInterface
    {
        $trainers = $this->trainerRepository->getAll();
        $this->view->assign('trainers', $trainers);
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

    public function createAction(Trainer $newTrainer)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->trainerRepository->add($newTrainer);
        $this->redirect('index');
    }

    public function editAction(Trainer $trainer): ResponseInterface
    {
        $this->check($trainer);
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    public function updateAction(Trainer $trainer)
    {
        $this->check($trainer);
        $this->trainerRepository->update($trainer);
        $this->redirect('index');
    }

    public function deleteAction(Trainer $trainer)
    {
        $this->check($trainer);
        $this->trainerRepository->remove($trainer);
        $this->redirect('index');
    }
}
