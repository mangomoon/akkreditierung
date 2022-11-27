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
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * userRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\UserRepository
     */
    protected $userRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\UserRepository $userRepository
     */
    public function injectUserRepository(\GeorgRinger\Ieb\Domain\Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\User $user
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\User $user): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('user', $user);
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
     * @param \GeorgRinger\Ieb\Domain\Model\User $newUser
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\User $user
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("user")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\User $user): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('user', $user);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\User $user
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->update($user);
        $this->redirect('list');
    }
}
