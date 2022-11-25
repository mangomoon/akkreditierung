<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * TrainerController
 */
class TrainerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * trainerRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\TrainerRepository
     */
    protected $trainerRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\TrainerRepository $trainerRepository
     */
    public function injectTrainerRepository(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $trainers = $this->trainerRepository->findAll();
        $this->view->assign('trainers', $trainers);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainer
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Trainer $trainer): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $newTrainer
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Trainer $newTrainer)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->trainerRepository->add($newTrainer);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainer
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("trainer")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Trainer $trainer): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainer
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Trainer $trainer)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->trainerRepository->update($trainer);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainer
     */
    public function deleteAction(\GeorgRinger\Ieb\Domain\Model\Trainer $trainer)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->trainerRepository->remove($trainer);
        $this->redirect('list');
    }
}
