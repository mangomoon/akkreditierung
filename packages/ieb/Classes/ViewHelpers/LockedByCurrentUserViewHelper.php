<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class LockedByCurrentUserViewHelper extends AbstractViewHelper
{
    use CurrentUserTrait;

    public function initializeArguments()
    {
        $this->registerArgument('lockedBy', 'int', 'Locked user', true);
        parent::initializeArguments();
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $lockUserId = (int)$arguments['lockedBy'];
        $currentUserId = self::getCurrentUserId();
        return [
            'isLocked' => $lockUserId,
            'isLockedByCurrentUser' => $lockUserId === $currentUserId,
            'editableByCurrentUser' => $lockUserId === $currentUserId || !$lockUserId,
            'lockedBy' => $lockUserId !== $currentUserId ? BackendUtility::getRecord('fe_users', $lockUserId) : null,
        ];
    }
}
