<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class TrainerSearch extends AbstractDomainObject
{

    public string $nachname = '';
    public string $vorname = '';

    public function isUsed(): bool
    {
        return $this->nachname !== '' || $this->vorname !== '';
    }
}