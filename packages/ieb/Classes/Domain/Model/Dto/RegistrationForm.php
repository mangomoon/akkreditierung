<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class RegistrationForm extends AbstractDomainObject
{

    public string $nachname = '';
    public string $vorname = '';
    public string $password = '';
    public string $passwordRepeat = '';
    public string $email = '';

    public string $trName = '';
    public string $trStrasse = '';
    public string $trPlz = '';
    public string $trOrt = '';
    public string $trTel = '';
    public string $trEmail = '';
    public string $trWww = '';

    public bool $dsgvo = false;

}