<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

trait CurrentUserTrait
{

    public function getCurrentUser(): array
    {
        /** @var  $userAspect */
        $userAspect = GeneralUtility::makeInstance(Context::class)->getAspect('frontend.user');
        $userId = (int)$userAspect->get('id');
        if ($userId === 0) {
            throw new \UnexpectedValueException('No user logged in');
        }
        return BackendUtility::getRecord('fe_users', $userId);
    }

    public function getCurrentUserPid(): int
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            throw new \UnexpectedValueException('No user logged in');
        }
        return $user['pid'];
    }
}