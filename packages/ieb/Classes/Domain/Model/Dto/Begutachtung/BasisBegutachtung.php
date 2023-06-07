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
    public string $reviewB1CommentTr = '';
    public int $reviewB1Status = 0;
    public string $reviewB14CommentInternal = '';
    public string $reviewB14CommentTr = '';
    public int $reviewB14Status = 0;
    public string $reviewB15CommentInternal = '';
    public string $reviewB15CommentTr = '';
    public int $reviewB15Status = 0;
    public string $reviewB22CommentInternal = '';
    public string $reviewB22CommentTr = '';
    public int $reviewB22Status = 0;
    public string $reviewB23CommentInternal = '';
    public string $reviewB23CommentTr = '';
    public int $reviewB23Status = 0;
    public string $reviewB2CommentInternal = '';
    public string $reviewB2CommentTr = '';
    public int $reviewB2Status = 0;
    public string $reviewC1CommentInternal = '';
    public string $reviewC1CommentTr = '';
    public int $reviewC1Status = 0;
    public string $reviewC2CommentInternal = '';
    public string $reviewC2CommentTr = '';
    public int $reviewC2Status = 0;
    public string $reviewC3CommentInternal = '';
    public string $reviewC3CommentTr = '';
    public int $reviewC3Status = 0;
    public int $status = 0;

    private const FIELDS = [
        'reviewTotalCommentInternal', 'reviewTotalCommentTr',
        'reviewB1CommentInternal', 'reviewB1CommentTr', 'reviewB1Status',
        'reviewB14CommentInternal', 'reviewB14CommentTr', 'reviewB14Status',
        'reviewB15CommentInternal', 'reviewB15CommentTr', 'reviewB15Status',
        'reviewB22CommentInternal', 'reviewB22CommentTr', 'reviewB22Status',
        'reviewB23CommentInternal', 'reviewB23CommentTr', 'reviewB23Status',
        'reviewB2CommentInternal', 'reviewB2CommentTr', 'reviewB2Status',
        'reviewC1CommentInternal', 'reviewC1CommentTr', 'reviewC1Status',
        'reviewC2CommentInternal', 'reviewC2CommentTr', 'reviewC2Status',
        'reviewC3CommentInternal', 'reviewC3CommentTr', 'reviewC3Status',
    ];

    public function setByAnsuchen(Ansuchen $ansuchen): void
    {
        foreach (self::FIELDS as $field) {
            if (!str_ends_with($field, 'Internal')) {
                $getter = 'get' . ucfirst($field);
                $this->$field = $ansuchen->$getter();
            }
        }
        $this->status = $ansuchen->getStatus();
    }

    public function copyToAnsuchen(Ansuchen $ansuchen): void
    {
        if ($this->status > 0) {
            $ansuchen->setStatus($this->status);
        }

        foreach (self::FIELDS as $field) {
            if (!str_ends_with($field, 'Internal')) {
                $setter = 'set' . ucfirst($field);
                $ansuchen->$setter($this->$field);
            }
        }

        // json fields
        try {
            $this->addNewComment($ansuchen, 'reviewB1CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB14CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB15CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB22CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB23CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB2CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC1CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC2CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC3CommentInternal');
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