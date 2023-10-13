<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\User;
use GeorgRinger\Ieb\Domain\Repository\StammdatenRepository;
use GeorgRinger\Ieb\Domain\Repository\UserRepository;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\HashService;
use GeorgRinger\Ieb\Service\MailService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class UserController extends BaseController
{

    protected StammdatenRepository $stammdatenRepository;
    protected UserRepository $userRepository;

    public function listAction(): ResponseInterface
    {
        $users = $this->userRepository->getAll();
        $this->view->assign('users', $users);
        return $this->htmlResponse();
    }

    public function showAction(User $user): ResponseInterface
    {
        $this->view->assign('user', $user);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(User $newUser): void
    {
        $newUser->setUsername($newUser->getUsername());
        $newUser->setUsergroup((string)$this->extensionConfiguration->getUsergroupEingeladenInaktiv());
        $this->addFlashMessage('User wurde eingeladen und Email zur Einladung verschickt', '', AbstractMessage::INFO);
        $this->userRepository->add($newUser);
        $this->userRepository->forcePersist();
        $this->sendMailToUserAfterInvitation($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param User $user
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("user")
     */
    public function editAction(User $user): ResponseInterface
    {
        $this->validateUserCrud($user);
        $this->view->assign('user', $user);
        return $this->htmlResponse();
    }

    public function updateAction(User $user): void
    {
        $this->validateUserCrud($user);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    protected function validateUserCrud(User $user): void
    {
        if ($this->isObjectAllowedForCurrentUser($user) === false || !self::currentUserIsTrAdmin()) {
            $this->addFlashMessage('Sie haben keine Berechtigung, diesen Benutzer zu bearbeiten!', '', AbstractMessage::ERROR);
            $this->redirect('list');
        }
    }

    public function archiveAction(User $user): ResponseInterface
    {
        $this->validateUserCrud($user);
        $user->setArchiviert(true);
        $this->userRepository->update($user);
        $this->userRepository->forcePersist();
        $this->redirect('list');
    }

    public function reviveAction(User $user): ResponseInterface
    {
        $this->validateUserCrud($user);
        $user->setArchiviert(false);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    protected function sendMailToUserAfterInvitation(User $user): void
    {
        $assignedMailValues = [
            'user' => $user,
            'stammdaten' => $this->stammdatenRepository->getLatest(),
            'url' => $this->uriBuilder
                ->reset()
                ->setCreateAbsoluteUri(true)
                ->setTargetPageUid($this->extensionConfiguration->getPageRegistration())
                ->uriFor(
                    'acceptInvitation',
                    [
                        'userId' => $user->getUid(),
                        'userHash' => HashService::generate((string)$user->getUid()),
                    ],
                    'Registration',
                    'Ieb',
                    'Registration'
                ),

            'page' => $this->configurationManager->getContentObject()->data,
        ];
        $mailService = GeneralUtility::makeInstance(MailService::class);
        $mailService->sendSingle(
            $assignedMailValues,
            'User/AcceptInvitation',
            $user->getEmail(),
            $user->getFullName()
        );
    }



    public function injectUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

    public function injectStammdatenRepository(StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }
}
