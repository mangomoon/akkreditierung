<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class PersonSearch extends AbstractDomainObject
{

    public string $searchword = '';

    public function isUsed(): bool
    {
        return $this->searchword !== '';
    }
}