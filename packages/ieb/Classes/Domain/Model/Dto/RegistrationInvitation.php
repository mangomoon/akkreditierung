<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class RegistrationInvitation extends AbstractDomainObject
{

    public int $userId = 0;
    public string $userHash = '';
    public string $password = '';
    public string $username = '';
    public string $passwordRepeat = '';
    public bool $dsgvo = false;

}