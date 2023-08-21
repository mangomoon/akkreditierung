<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Service\RelationLockService;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class RelationUsedInReviewViewHelper extends AbstractViewHelper
{
    use CurrentUserTrait;

    public function initializeArguments()
    {
        $this->registerArgument('object', 'object', 'relation id', true);
        parent::initializeArguments();
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $relationLockService = GeneralUtility::makeInstance(RelationLockService::class);
        return $relationLockService->usedByAnsuchenInReview($arguments['object']);
    }
}
