<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto\Begutachtung;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class BasisBegutachtung extends AbstractDomainObject
{

    use CurrentUserTrait;

    public string $reviewTotalCommentInternal = '';
    public string $reviewTotalCommentTr = '';
    /** @var \DateTime */
    public $reviewTotalFrist = null;
    public string $reviewB1CommentInternal = '';
    public string $reviewB1CommentInternalStep = '';
    public string $reviewB1CommentTr = '';
    public int $reviewB1Status = 0;
    public string $reviewB14CommentInternal = '';
    public string $reviewB14CommentInternalStep = '';
    public string $reviewB14CommentTr = '';
    public int $reviewB14Status = 0;
    public string $reviewB15CommentInternal = '';
    public string $reviewB15CommentInternalStep = '';
    public string $reviewB15CommentTr = '';
    public int $reviewB15Status = 0;
    public string $reviewB22CommentInternal = '';
    public string $reviewB22CommentInternalStep = '';
    public string $reviewB22CommentTr = '';
    public int $reviewB22Status = 0;
    public string $reviewB23CommentInternal = '';
    public string $reviewB23CommentInternalStep = '';
    public string $reviewB23CommentTr = '';
    public int $reviewB23Status = 0;
    public string $reviewB2CommentInternal = '';
    public string $reviewB2CommentInternalStep = '';
    public string $reviewB2CommentTr = '';
    public int $reviewB2Status = 0;
    public string $reviewC1CommentInternal = '';
    public string $reviewC1CommentInternalStep = '';
    public string $reviewC1CommentTr = '';
    public int $reviewC1Status = 0;
    public string $reviewC2CommentInternal = '';
    public string $reviewC2CommentInternalStep = '';
    public string $reviewC2CommentTr = '';
    public int $reviewC2Status = 0;
    public string $reviewC3CommentInternal = '';
    public string $reviewC3CommentInternalStep = '';
    public string $reviewC3CommentTr = '';
    public int $reviewC3Status = 0;
    public int $upcomingStatus = 0;
    public int $status = 0;
    public string $reviewTotalCommentInternalStep = '';
    public string $notitzzettel = '';

    public array $verantwortliche = [];

    public int $stammdatenReviewA1Status = 0;
    public string $stammdatenReviewA1CommentInternal = '';
    public string $stammdatenReviewA1CommentInternalStep = '';
    public string $stammdatenReviewA1CommentTr = '';
    public int $stammdatenReviewA2Status = 0;
    public string $stammdatenReviewA2CommentInternal = '';
    public string $stammdatenReviewA2CommentInternalStep = '';
    public string $stammdatenReviewA2CommentTr = '';
    public int $stammdatenStatusAfterReview = 0;

    public int $statusAfterReview = 0;
    public int $statusAgEins = 0;
    public int $statusAgZwei = 0;

    private const FIELDS = [
        'reviewTotalCommentInternalStep', 'reviewTotalCommentTr',
        'reviewB1CommentInternalStep', 'reviewB1CommentTr', 'reviewB1Status',
        'reviewB14CommentInternalStep', 'reviewB14CommentTr', 'reviewB14Status',
        'reviewB15CommentInternalStep', 'reviewB15CommentTr', 'reviewB15Status',
        'reviewB22CommentInternalStep', 'reviewB22CommentTr', 'reviewB22Status',
        'reviewB23CommentInternalStep', 'reviewB23CommentTr', 'reviewB23Status',
        'reviewB2CommentInternalStep', 'reviewB2CommentTr', 'reviewB2Status',
        'reviewC1CommentInternalStep', 'reviewC1CommentTr', 'reviewC1Status',
        'reviewC2CommentInternalStep', 'reviewC2CommentTr', 'reviewC2Status',
        'reviewC3CommentInternalStep', 'reviewC3CommentTr', 'upcomingStatus', 
        'reviewC3Status', 'notitzzettel', 'statusAgEins', 'statusAgZwei', 'reviewTotalFrist'
    ];

    private const FIELDS_STAMMDATEN = [
        'stammdatenReviewA1Status', 'stammdatenReviewA1CommentInternal', 'stammdatenReviewA1CommentInternalStep', 'stammdatenReviewA1CommentTr',
        'stammdatenReviewA2Status', 'stammdatenReviewA2CommentInternal', 'stammdatenReviewA2CommentInternalStep', 'stammdatenReviewA2CommentTr',
        'stammdatenStatusAfterReview',
    ];

    public function setByAnsuchen(Ansuchen $ansuchen, Stammdaten $stammdaten): void
    {
        foreach (self::FIELDS as $field) {
            $getter = 'get' . ucfirst($field);
            $this->$field = $ansuchen->$getter();
        }
        $this->status = $ansuchen->getStatus();

        foreach (self::FIELDS_STAMMDATEN as $field) {
            if($field == "stammdatenStatusAfterReview") {
                $realFieldName = "statusAfterReview";
            } else {
                $realFieldName = str_replace('stammdatenR', 'r', $field);
            }
            $getter = 'get' . ucfirst($realFieldName);
            $this->$field = $stammdaten->$getter();
        }
    }

    public function copyToAnsuchen(Ansuchen $ansuchen): void
    {
        foreach (self::FIELDS as $field) {
            $setter = 'set' . ucfirst($field);
            $ansuchen->$setter($this->$field);
        }
    }

    public function copyToStammdaten(Stammdaten $stammdaten, Ansuchen $ansuchen): void
    {
        foreach (self::FIELDS_STAMMDATEN as $field) {
            if($field == "stammdatenStatusAfterReview") {
                $realFieldName = "statusAfterReview";
            } else {
                $realFieldName = str_replace('stammdatenR', 'r', $field);
            }
            $setter = 'set' . ucfirst($realFieldName);
            $stammdaten->$setter($this->$field);
        }
    }


}