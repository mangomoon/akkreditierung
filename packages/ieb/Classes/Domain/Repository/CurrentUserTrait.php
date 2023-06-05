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

    public static function getCurrentUserName(): string
    {
        $user = self::getCurrentUser();
        if (!$user) {
            throw new \UnexpectedValueException('No user logged in', 1685990939);
        }
        if ($user['first_name'] && $user['last_name']) {
            return $user['first_name'] . ' ' . $user['last_name'];
        }
        if ($user['name']) {
            return $user['name'];
        }
        return $user['username'];
    }

    public static function currentSysFolderPageName(): string
    {
        $pid = self::getCurrentUserPid();
        $page = BackendUtility::getRecord('pages', $pid);
        return $page['title'];
    }

    private static function getCurrentUserField(string $field)
    {
        $user = self::getCurrentUser();
        if (!$user) {
            throw new \UnexpectedValueException('No user logged in', 1685990940);
        }
        return $user[$field] ?? null;
    }
}