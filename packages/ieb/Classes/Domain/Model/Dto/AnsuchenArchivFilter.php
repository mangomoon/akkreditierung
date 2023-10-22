<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class AnsuchenArchivFilter extends AbstractDomainObject
{

    public bool $submitted = false;
    public string $ansuchenNummer = '';
    public string $institution = '';
    public int $status = 0;
    public string $search = '';
    public int $trPid = 0;

}