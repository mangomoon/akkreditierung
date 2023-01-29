<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

trait CurrentUserTrait
{

    public static function getCurrentUser(): array
    {
        /** @var  $userAspect */
        $userAspect = GeneralUtility::makeInstance(Context::class)->getAspect('frontend.user');
        $userId = (int)$userAspect->get('id');
        if ($userId === 0) {
            throw new \UnexpectedValueException('No user logged in');
        }
        if ($userId === PHP_INT_MAX) {
            throw new \UnexpectedValueException('No user logged in or maybe a simulated user?');
        }
        return BackendUtility::getRecord('fe_users', $userId);
    }

    public static function getCurrentUserPid(): int
    {
        return (int)self::getCurrentUserField('pid');
    }

    public static function getCurrentUserId(): int
    {
        return (int)self::getCurrentUserField('uid');
    }

    public static function currentUserIsTrAdmin(): bool
    {
        return self::getCurrentUserField('tr_admin') === 1;
    }

    private static function getCurrentUserField(string $field)
    {
        $user = self::getCurrentUser();
        if (!$user) {
            throw new \UnexpectedValueException('No user logged in');
        }
        return $user[$field] ?? null;
    }
}