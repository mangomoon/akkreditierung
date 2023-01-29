<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Validator;

use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationForm;
use GeorgRinger\Ieb\Domain\Repository\RegistrationRepository;
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
        if ($registrationForm->password !== $registrationForm->passwordRepeat) {
            $this->addErrorForProperty('passwordRepeat', 'Die Passwörter stimmen nicht überein', 1620000001);
        }

        $this->validateIfTrExists($registrationForm->trName);
    }

    protected function validateIfTrExists(string $name): void
    {
        $registrationRepository = GeneralUtility::makeInstance(RegistrationRepository::class);

        if ($registrationRepository->checkIfExists($name) > 0) {
            $this->addErrorForProperty('trName', 'Ein Bildungsträger mit diesem Namen existiert bereits', 1620000002);
        }
    }

}