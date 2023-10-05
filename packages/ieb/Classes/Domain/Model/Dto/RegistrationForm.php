<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Annotation as Extbase;

class RegistrationForm extends AbstractDomainObject
{

    public string $nachname = '';
    public string $vorname = '';
    public string $username = '';
    public string $password = '';
    public string $passwordRepeat = '';
    public string $email = '';
    public string $trName = '';

    public string $ausschluss = '';

    /**
     * @var bool
     * @Extbase\Validate("TYPO3\CMS\Extbase\Validation\Validator\NotEmptyValidator")
     */
    protected bool $dsgvo = false;

    public function getFullName(): string
    {
        return $this->vorname . ' ' . $this->nachname;
    }

    public function isDsgvo(): bool
    {
        return $this->dsgvo;
    }

    public function setDsgvo(bool $dsgvo): void
    {
        $this->dsgvo = $dsgvo;
    }


}