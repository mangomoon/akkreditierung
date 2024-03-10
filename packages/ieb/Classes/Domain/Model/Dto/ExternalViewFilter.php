<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class ExternalViewFilter extends AbstractDomainObject
{

    public ?BundeslandEnum $bundesland = null;
    public string $ansuchenNummer = '';
    public string $institution = '';
    public int $status = -1;
    public string $search = '';
    public string $searchStammdaten = '';
    public int $trPid = 0;
}