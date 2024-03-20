<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */

/**
 * The repository for AngebotVerantwortliches
 */
class AngebotVerantwortlichRepository extends BaseRepository
{
    public function getActive($pid = 0)
    {
        $query = $this->getQuery($pid);
        $query->setOrderings(['nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        $query->matching(
            $query->logicalAnd(
                $query->equals('archiviert', false),
                $query->equals('ok', true)
            )
        );
        return $query->execute();
    }


    public function findInPersonSearch(PersonSearch $search)
    {
        if (!$search->isUsed()) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_angebotverantwortlich');

        $where = [
            $queryBuilder->expr()->eq('tx_ieb_domain_model_angebotverantwortlich.deleted', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_angebotverantwortlich.hidden', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.version_active', 1),
        ];

        if ($search->searchword) {
            $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($search->searchword) . '%';
            $where[] = $queryBuilder->expr()->like('tx_ieb_domain_model_angebotverantwortlich.nachname', $queryBuilder->createNamedParameter('%' . $search->searchword . '%'));
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('tx_ieb_domain_model_angebotverantwortlich.vorname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
                $queryBuilder->expr()->like('tx_ieb_domain_model_angebotverantwortlich.nachname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
            );
        }

        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_angebotverantwortlich.*')
            ->addSelectLiteral('CONCAT(tx_ieb_domain_model_angebotverantwortlich.vorname, \' \', tx_ieb_domain_model_angebotverantwortlich.nachname) as angebotVerantwortlichName')
            ->addSelect('tx_ieb_domain_model_angebotverantwortlich.email  ')
            ->addSelect('tx_ieb_domain_model_angebotverantwortlich.telefon')
            ->addSelect('tx_ieb_domain_model_ansuchen.nummer as ansuchenNummer')
            ->addSelect('tx_ieb_domain_model_ansuchen.uid as ansuchenUid')
            ->addSelect('tx_ieb_domain_model_ansuchen.name as ansuchenName')
            ->addSelect('stammdaten.name as stammdatenName')
            ->addSelect('stammdaten.markenname as stammdatenMarkenname')
            ->from('tx_ieb_domain_model_angebotverantwortlich')
            ->leftJoin(
                'tx_ieb_domain_model_angebotverantwortlich',
                'tx_ieb_ansuchen_angebotverantwortlich_mm',
                'tx_ieb_ansuchen_angebotverantwortlich_mm',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_angebotverantwortlich.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_angebotverantwortlich_mm.uid_foreign'))
            )
            ->leftJoin(
                'tx_ieb_ansuchen_angebotverantwortlich_mm',
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_ansuchen',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_angebotverantwortlich_mm.uid_local'))
            )
            ->rightJoin(
                'tx_ieb_domain_model_angebotverantwortlich',
                'tx_ieb_domain_model_stammdaten',
                'stammdaten',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_angebotverantwortlich.pid', $queryBuilder->quoteIdentifier('stammdaten.pid'))
            )
            ->where(...$where)
            ->groupBy('tx_ieb_domain_model_angebotverantwortlich.uid', 'tx_ieb_domain_model_ansuchen.nummer')
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }
}
