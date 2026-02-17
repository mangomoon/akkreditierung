<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;


class FeuserNameViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('uid', 'int', 'UID of the frontend user', true);
    }

    public function render(): string
    {
        $uid = (int)$this->arguments['uid'];

        $queryBuilder = GeneralUtility::makeInstance(
            ConnectionPool::class
        )->getQueryBuilderForTable('fe_users');

        $record = $queryBuilder
            ->select('first_name', 'last_name')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->eq(
                    'uid',
                    $queryBuilder->createNamedParameter($uid, \TYPO3\CMS\Core\Database\Connection::PARAM_INT)
                )
            )
            ->executeQuery()
            ->fetchAssociative();

        if (!$record) {
            return ' ';
        }

        return trim(($record['first_name'] ?? '') . ' ' . ($record['last_name'] ?? ''));
    }
}