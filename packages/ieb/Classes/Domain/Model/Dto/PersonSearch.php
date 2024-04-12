<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class PersonSearch extends AbstractDomainObject
{

    public string $searchword = '';
    public bool $respectStatus = true;
    public int $trPid = 0;

    public function isUsed(): bool
    {
        return $this->searchword !== '' || $this->trPid > 0;
    }
}