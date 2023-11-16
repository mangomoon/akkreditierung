<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class BeraterBegutachtung extends AbstractDomainObject
{

    public int $ansuchenId = 0;
    public int $beraterId = 0;
    /** @var \DateTime */
    public $reviewFrist = null;
    public int $reviewC3Status = 0;
    public int $reviewC32Status = 0;
    public string $reviewC3CommentInternal = '';
    public string $reviewC3CommentInternalStep = '';
    public string $reviewC3CommentTr = '';
    public int $statusAfterReview = 0;
    public string $reviewC3GsCommentInternalStep = '';
    public string $reviewC3Ag1CommentInternalStep = '';
    public string $reviewC3Ag2CommentInternalStep = '';
}