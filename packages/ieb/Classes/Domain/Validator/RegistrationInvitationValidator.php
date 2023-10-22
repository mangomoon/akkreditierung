<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Validator;

use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationForm;
use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationInvitation;
use GeorgRinger\Ieb\Domain\Repository\RegistrationRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class RegistrationInvitationValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{

    /**
     * @param RegistrationInvitation $registrationForm
     */
    public function isValid($registrationForm)
    {
        if ($registrationForm->password !== $registrationForm->passwordRepeat) {
            $this->addErrorForProperty('passwordRepeat', 'Die Passwörter stimmen nicht überein', 1620000001);
        }
        if (!$this->usernameIsUnique($registrationForm->username)) {
            $this->addErrorForProperty('username', 'Der Benutzername existiert bereits, bitte wählen Sie einen anderen.', 1620000002);
        }
    }

    protected function usernameIsUnique(string $username): bool
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $count = $queryBuilder
            ->select('uid')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->eq('username', $queryBuilder->createNamedParameter($username))
            )->execute()->fetchAllAssociative();

        return count($count) === 0;
    }

}