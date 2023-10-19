<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Validator;

use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationForm;
use GeorgRinger\Ieb\Domain\Repository\RegistrationRepository;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class RegistrationFormValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{

    /**
     * @param RegistrationForm $registrationForm
     */
    public function isValid($registrationForm)
    {
        if (strlen($registrationForm->password) < 6) {
            $this->addErrorForProperty('password', 'Das Passwort muss mindestens 6 Zeichen lang sein', 1620000003);
        }
        if ($registrationForm->password !== $registrationForm->passwordRepeat) {
            $this->addErrorForProperty('passwordRepeat', 'Die Passwörter stimmen nicht überein', 1620000001);
        }
        if (!$registrationForm->isDsgvo()) {
            $this->addErrorForProperty('dsgvo', 'Bitte stimmen Sie der Datenschutzerklärung zu', 1620000004);
        }
        if (!$this->usernameIsUnique($registrationForm->username)) {
            $this->addErrorForProperty('username', 'Der Benutzername ist bereits vergeben', 1620000005);
        }

        $this->validateIfTrExists($registrationForm->trName);
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

    protected function validateIfTrExists(string $name): void
    {
        $registrationRepository = GeneralUtility::makeInstance(RegistrationRepository::class);

        if ($registrationRepository->checkIfExists($name) > 0) {
            $this->addErrorForProperty('trName', 'Ein Bildungsträger mit diesem Namen existiert bereits', 1620000002);
        }
    }

}