<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class TrainerBegutachtung extends AbstractDomainObject
{

    public int $ansuchenId = 0;
    public int $trainerId = 0;


    public int $reviewC21BabiStatus = 0;
    public int $reviewC21PsaStatus = 0;
    public int $reviewC22BabiStatus = 0;
    public int $reviewC22PsaStatus = 0;

    public bool $reviewC22Quali1 = false;
    public bool $reviewC22Quali2 = false;
    public bool $reviewC22Quali3 = false;
    public bool $reviewC22Quali4 = false;
    public bool $reviewC22Quali5 = false;
    public bool $reviewC22Quali6 = false;
    public bool $reviewC22Quali7 = false;
    public bool $reviewC22Quali8 = false;

    public bool $okpsa = true;
    public bool $okbabi = true;

    public string $reviewC2BabiCommentInternal = '';
    public string $reviewC2BabiCommentInternalStep = '';
    public string $reviewC2BabiCommentTr = '';
    public string $reviewC2PsaCommentInternal = '';
    public string $reviewC2PsaCommentInternalStep = '';
    public string $reviewC2PsaCommentTr = '';
}