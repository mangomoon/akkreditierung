<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Repository\RegistrationRepository;
use GeorgRinger\Ieb\Domain\Repository\UserRepository;
use GeorgRinger\Ieb\Service\HashService;
use GeorgRinger\Ieb\Service\MailService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class RegistrationController extends ActionController
{

    protected RegistrationRepository $registrationRepository;
    protected UserRepository $userRepository;

    public function initializeAction()
    {
        $this->registrationRepository = GeneralUtility::makeInstance(RegistrationRepository::class);
    }

    public function indexAction(): ResponseInterface
    {

        return $this->htmlResponse();
    }

    /**
     * @Extbase\IgnoreValidation("newBlog")
     */
    public function registrationFormAction(Dto\RegistrationForm $registrationForm = null)
    {
        $this->view->assignMultiple([
            'registrationForm' => $registrationForm,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @Extbase\Validate("GeorgRinger\Ieb\Domain\Validator\RegistrationFormValidator", param="registrationForm")
     */
    public function registrationSuccessAction(Dto\RegistrationForm $registrationForm)
    {
        $newPageId = $this->registrationRepository->createFromRegistrationForm($registrationForm);
        $this->sendMailToUser($registrationForm, $newPageId);

        $this->view->assign('registrationForm', $registrationForm);
        return $this->htmlResponse();
    }

    public function doubleOptInAction(int $pageId, string $pageHash): ResponseInterface
    {
        if (!HashService::validate((string)$pageId, $pageHash)) {
            $this->addFlashMessage('Hash ist ungültig', '', AbstractMessage::ERROR);
            return $this->htmlResponse();
        }
        $row = $this->registrationRepository->getPageRowById($pageId);
        if (!$row) {
            $this->addFlashMessage('Bildungsträger nicht gefunden', '', AbstractMessage::ERROR);
            return $this->htmlResponse();
        }
        if ($row['hidden'] === 0) {
            $this->addFlashMessage('Bildungsträger bereits aktiv', '', AbstractMessage::INFO);
            return $this->htmlResponse();
        }
        $this->registrationRepository->activatePage($pageId);

        $this->addFlashMessage('Die Registrierung war erfolgreich', '', AbstractMessage::OK);
        return $this->htmlResponse();
    }

    public function acceptInvitationAction(int $userId, string $userHash): ResponseInterface
    {
        if (!HashService::validate((string)$userId, $userHash)) {
            $this->addFlashMessage('Hash ist ungültig', '', AbstractMessage::ERROR);
            return $this->htmlResponse();
        }

        $registrationInvitation = new Dto\RegistrationInvitation();
        $registrationInvitation->userId = $userId;
        $registrationInvitation->userHash = $userHash;
        $this->view->assignMultiple([
            'potentialUser' => $this->userRepository->findByIdentifier($userId),
            'registrationInvitation' => $registrationInvitation,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @Extbase\Validate("GeorgRinger\Ieb\Domain\Validator\RegistrationInvitationValidator", param="registrationInvitation")
     */
    public function acceptInvitationSuccessAction(Dto\RegistrationInvitation $registrationInvitation): ResponseInterface
    {
        if (!HashService::validate((string)$registrationInvitation->userId, $registrationInvitation->userHash)) {
            $this->addFlashMessage('Hash ist ungültig', '', AbstractMessage::ERROR);
            return $this->htmlResponse();
        }

        $this->registrationRepository->updateUserFromInvitation($registrationInvitation);
        $this->addFlashMessage('Die Registrierung war erfolgreich', '', AbstractMessage::OK);
        return $this->htmlResponse();
    }

    protected function sendMailToUser(Dto\RegistrationForm $registrationForm, int $newPageId): void
    {
        $assignedMailValues = [
            'registration' => $registrationForm,
            'url' => $this->uriBuilder
                ->reset()
                ->setCreateAbsoluteUri(true)
                ->uriFor(
                    'doubleOptIn',
                    [
                        'pageId' => $newPageId,
                        'pageHash' => HashService::generate((string)$newPageId),
                    ]
                ),

            'page' => $this->configurationManager->getContentObject()->data,
        ];
        $mailService = GeneralUtility::makeInstance(MailService::class);
        $mailService->send(
            $assignedMailValues,
            'Registration/ConfirmMail',
            $registrationForm->email,
            $registrationForm->getFullName()
        );
    }

    public function injectUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

}
