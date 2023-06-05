<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class BasisBegutachtung extends AbstractDomainObject
{

    public string $reviewTotalCommentInternal = '';
    public string $reviewTotalCommentTr = '';
    public string $reviewB1CommentInternal = '';
    public int $status = 0;

    public function setByAnsuchen(Ansuchen $ansuchen): void
    {
        $this->status = $ansuchen->getStatus();
        $this->reviewTotalCommentTr = $ansuchen->getReviewTotalCommentTr();
        $this->reviewTotalCommentInternal = $ansuchen->getReviewTotalCommentInternal();
        $this->reviewB1CommentInternal = $ansuchen->getReviewB1CommentInternal();
    }

    public function copyToAnsuchen(Ansuchen $ansuchen): void
    {
        if ($this->status > 0) {
            $ansuchen->setStatus($this->status);
        }
        $ansuchen->setReviewTotalCommentTr($this->reviewTotalCommentTr);
        $ansuchen->setReviewTotalCommentInternal($this->reviewTotalCommentInternal);
        $ansuchen->setReviewB1CommentInternal($this->reviewB1CommentInternal);
    }

}