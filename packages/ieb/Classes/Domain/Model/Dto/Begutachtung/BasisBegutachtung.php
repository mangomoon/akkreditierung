<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class BasisBegutachtung extends AbstractDomainObject
{

    use CurrentUserTrait;

    public string $reviewTotalCommentInternal = '';
    public string $reviewTotalCommentTr = '';
    public string $reviewB1CommentInternal = '';
    public int $status = 0;

    public function setByAnsuchen(Ansuchen $ansuchen): void
    {
        $this->status = $ansuchen->getStatus();
        $this->reviewTotalCommentTr = $ansuchen->getReviewTotalCommentTr();
        $this->reviewTotalCommentInternal = $ansuchen->getReviewTotalCommentInternal();
    }

    public function copyToAnsuchen(Ansuchen $ansuchen): void
    {
        if ($this->status > 0) {
            $ansuchen->setStatus($this->status);
        }
        $ansuchen->setReviewTotalCommentTr($this->reviewTotalCommentTr);

        // json fields
        try {
            $this->addNewComment($ansuchen, 'reviewB1CommentInternal');
        } catch (\JsonException $e) {
        }
    }

    protected function addNewComment(Ansuchen $ansuchen, string $fieldName): void
    {
        $comment = $this->$fieldName;
        if (!$comment) {
            return;
        }
        $getterForData = 'get' . ucfirst($fieldName) . 'Data';
        $comments = $ansuchen->$getterForData();
        $comments[] = [
            'user' => self::getCurrentUserName(),
            'user_uid' => self::getCurrentUserId(),
            'comment' => $comment,
            'date' => time(),
        ];
        $setter = 'set' . ucfirst($fieldName);
        $ansuchen->$setter(json_encode($comments, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
    }

}