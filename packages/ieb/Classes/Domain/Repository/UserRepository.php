<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Model\User;
use GeorgRinger\Ieb\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * The repository for Users
 */
class UserRepository extends BaseRepository
{

    public function getAll(): QueryResultInterface
    {
        $query = $this->getQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setEnableFieldsToBeIgnored(['hidden', 'disabled']);
        $query->setOrderings(['uid' => QueryInterface::ORDER_ASCENDING]);

        return $query->execute();
    }

    public function getAllGutachter(): QueryResultInterface
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        $query = $this->getEmptyQuery();
        $query->matching(
            $query->logicalAnd(
                $query->like('usergroup', $extensionConfiguration->getUsergroupAg()),
            )
        );
        return $query->execute();
    }

    public function getRawHiddenUserById(int $id): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $queryBuilder->getRestrictions()->removeByType(HiddenRestriction::class);
        return (array)$queryBuilder->select('*')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
            )->execute()->fetchAssociative();

    }
}

