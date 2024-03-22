<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class ReportingFilter extends AbstractDomainObject
{

    public bool $submitted = false;
    public bool $csv = false;
    public int $bundesland = 0;
    public int $status = -99;
    public int $aboveStatus = 0;
    /** @var int[] */
    public array $statusList = [];
    public int $trPid = 0;

}