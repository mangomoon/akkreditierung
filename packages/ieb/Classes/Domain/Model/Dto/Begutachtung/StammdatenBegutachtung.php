<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class StammdatenBegutachtung extends AbstractDomainObject
{

    public int $reviewA1Status = 0;
    public string $reviewA1CommentInternal = '';
    public string $reviewA1CommentTr = '';
    public int $reviewA2Status = 0;
}