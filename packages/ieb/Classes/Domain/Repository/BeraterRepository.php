<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\BeraterSearch;
use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BeraterRepository extends BaseRepository
{


    public function findBySearch(?BeraterSearch $search)
    {
        $query = $this->getQuery();
        $query->setOrderings(['nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        if (!$search) {
            return $query->execute();
        }

        $constraints = [];
        if ($search->nachname) {
            $constraints[] = $query->like('nachname', '%' . $search->nachname . '%');
        }
        if ($search->vorname) {
            $constraints[] = $query->like('vorname', '%' . $search->vorname . '%');
        }
        if ($constraints) {
            $query->matching($query->logicalAnd($constraints));
        }
        return $query->execute();
    }


    public function findInPersonSearch(PersonSearch $search)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_berater');

        $where = [
            $queryBuilder->expr()->eq('tx_ieb_domain_model_berater.deleted', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_berater.hidden', 0),
            //$queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.version_active', 1),
        ];

        if ($search->respectStatus) {
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->gt('tx_ieb_domain_model_berater.review_c3_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_berater.review_c32_status', 0),
            );
        }

        if ($search->searchword) {
            $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($search->searchword) . '%';
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('tx_ieb_domain_model_berater.vorname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
                $queryBuilder->expr()->like('tx_ieb_domain_model_berater.nachname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
            );
        }
        if ($search->trPid > 0) {
            $where[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->createNamedParameter($search->trPid, \PDO::PARAM_INT));
        }

        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_berater.*')
            ->addSelectLiteral('CONCAT(tx_ieb_domain_model_berater.vorname, \' \', tx_ieb_domain_model_berater.nachname) as beraterName')
            ->addSelect('tx_ieb_domain_model_berater.review_frist')
            ->addSelect('tx_ieb_domain_model_ansuchen.nummer as ansuchenNummer')
            ->addSelect('tx_ieb_domain_model_ansuchen.uid as ansuchenUid')
            ->addSelect('tx_ieb_domain_model_ansuchen.version_based_on as ansuchenVersionBasedOn')
            ->addSelect('tx_ieb_domain_model_ansuchen.name as ansuchenName')
            ->addSelect('tx_ieb_domain_model_ansuchen.typ as ansuchenTyp')
            ->addSelect('stammdaten.name as stammdatenName')
            ->addSelect('stammdaten.markenname as stammdatenMarkenname')
            ->from('tx_ieb_domain_model_berater')
            ->leftJoin(
                'tx_ieb_domain_model_berater',
                'tx_ieb_ansuchen_berater_mm',
                'tx_ieb_ansuchen_berater_mm',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_berater.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_berater_mm.uid_foreign'))
            )
            ->leftJoin(
                'tx_ieb_ansuchen_berater_mm',
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_ansuchen',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_berater_mm.uid_local'))
            )
            ->rightJoin(
                'tx_ieb_domain_model_berater',
                'tx_ieb_domain_model_stammdaten',
                'stammdaten',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_berater.pid', $queryBuilder->quoteIdentifier('stammdaten.pid'))
            )
            ->where(...$where)
            ->groupBy('tx_ieb_domain_model_berater.uid', 'tx_ieb_domain_model_ansuchen.nummer')
            ->execute()
            ->fetchAllAssociative();
        return $rows;
    }

    public function getActive()
    {
        $query = $this->getQuery();
        $query->setOrderings(['nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        $query->matching(
            $query->logicalAnd(
                $query->equals('archiviert', false),
                $query->equals('ok', true)
            )
        );
        return $query->execute();
    }

}
