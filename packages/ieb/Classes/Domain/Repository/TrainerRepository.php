<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use GeorgRinger\Ieb\Domain\Model\Dto\TrainerSearch;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class TrainerRepository extends BaseRepository
{

    public function findBySearch(?TrainerSearch $search)
    {
        $query = $this->getQuery();
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_trainer');

        $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($search->searchword) . '%';

        $where = [
            $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.deleted', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.hidden', 0),
            // $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.version_active', 1),
        ];

        if ($search->respectStatus) {
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c21_babi_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c22_babi_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c21_psa_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c22_psa_status', 0)
            );
        }

        if ($search->searchword) {
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('tx_ieb_domain_model_trainer.vorname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
                $queryBuilder->expr()->like('tx_ieb_domain_model_trainer.nachname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
            );
        }
        if ($search->trPid > 0) {
            $where[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->createNamedParameter($search->trPid, \PDO::PARAM_INT));
        }

        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_trainer.*')
            ->addSelectLiteral('CONCAT(tx_ieb_domain_model_trainer.vorname, \' \', tx_ieb_domain_model_trainer.nachname) as trainerName')
            ->addSelect('tx_ieb_domain_model_trainer.uid as trainerUid')
            ->addSelect('tx_ieb_domain_model_trainer.review_c21_babi_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c22_babi_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c21_psa_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c22_psa_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_frist')
            ->addSelect('tx_ieb_domain_model_trainer.review_psa_frist')
            ->addSelect('tx_ieb_domain_model_ansuchen.nummer as ansuchenNummer')
            ->addSelect('tx_ieb_domain_model_ansuchen.uid as ansuchenUid')
            ->addSelect('tx_ieb_domain_model_ansuchen.version_based_on as ansuchenVersionBasedOn')
            ->addSelect('tx_ieb_domain_model_ansuchen.name as ansuchenName')
            ->addSelect('tx_ieb_domain_model_ansuchen.typ as ansuchenTyp')
            ->addSelect('stammdaten.name as stammdatenName')
            ->addSelect('stammdaten.markenname as stammdatenMarkenname')
            ->from('tx_ieb_domain_model_trainer')
            ->leftJoin(
                'tx_ieb_domain_model_trainer',
                'tx_ieb_ansuchen_trainer_mm',
                'tx_ieb_ansuchen_trainer_mm',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_trainer_mm.uid_foreign'))
            )
            ->leftJoin(
                'tx_ieb_ansuchen_trainer_mm',
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_ansuchen',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_trainer_mm.uid_local'))
            )
            ->rightJoin(
                'tx_ieb_domain_model_trainer',
                'tx_ieb_domain_model_stammdaten',
                'stammdaten',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.pid', $queryBuilder->quoteIdentifier('stammdaten.pid'))
            )
            ->where(...$where)
            ->groupBy('tx_ieb_domain_model_trainer.uid', 'tx_ieb_domain_model_ansuchen.nummer')
            ->execute()
            ->fetchAllAssociative();
        return $rows;
    }

    public function findInPersonSearchActive(PersonSearch $search)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_trainer');

        $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($search->searchword) . '%';

        $where = [
            $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.deleted', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.hidden', 0),
            $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.version_active', 1),
        ];

        if ($search->respectStatus) {
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c21_babi_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c22_babi_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c21_psa_status', 0),
                $queryBuilder->expr()->gt('tx_ieb_domain_model_trainer.review_c22_psa_status', 0)
            );
        }

        if ($search->searchword) {
            $where[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('tx_ieb_domain_model_trainer.vorname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
                $queryBuilder->expr()->like('tx_ieb_domain_model_trainer.nachname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
            );
        }
        if ($search->trPid > 0) {
            $where[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->createNamedParameter($search->trPid, \PDO::PARAM_INT));
        }

        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_trainer.*')
            ->addSelectLiteral('CONCAT(tx_ieb_domain_model_trainer.vorname, \' \', tx_ieb_domain_model_trainer.nachname) as trainerName')
            ->addSelect('tx_ieb_domain_model_trainer.review_c21_babi_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c22_babi_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c21_psa_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_c22_psa_status')
            ->addSelect('tx_ieb_domain_model_trainer.review_frist')
            ->addSelect('tx_ieb_domain_model_trainer.review_psa_frist')
            ->addSelect('tx_ieb_domain_model_ansuchen.nummer as ansuchenNummer')
            ->addSelect('tx_ieb_domain_model_ansuchen.uid as ansuchenUid')
            ->addSelect('tx_ieb_domain_model_ansuchen.version_based_on as ansuchenVersionBasedOn')
            ->addSelect('tx_ieb_domain_model_ansuchen.name as ansuchenName')
            ->addSelect('tx_ieb_domain_model_ansuchen.typ as ansuchenTyp')
            ->addSelect('stammdaten.name as stammdatenName')
            ->addSelect('stammdaten.markenname as stammdatenMarkenname')
            ->from('tx_ieb_domain_model_trainer')
            ->leftJoin(
                'tx_ieb_domain_model_trainer',
                'tx_ieb_ansuchen_trainer_mm',
                'tx_ieb_ansuchen_trainer_mm',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_trainer_mm.uid_foreign'))
            )
            ->leftJoin(
                'tx_ieb_ansuchen_trainer_mm',
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_ansuchen',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->quoteIdentifier('tx_ieb_ansuchen_trainer_mm.uid_local'))
            )
            ->rightJoin(
                'tx_ieb_domain_model_trainer',
                'tx_ieb_domain_model_stammdaten',
                'stammdaten',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_trainer.pid', $queryBuilder->quoteIdentifier('stammdaten.pid'))
            )
            ->where(...$where)
            ->groupBy('tx_ieb_domain_model_trainer.uid', 'tx_ieb_domain_model_ansuchen.nummer')
            ->execute()
            ->fetchAllAssociative();
        return $rows;
    }

    public function getActiveBabi()
    {
        $query = $this->getQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('archiviert', false),
                $query->equals('okbabi', true),
                $query->equals('verwendungBabi', true)
            )
        );
        return $query->execute();
    }

    public function getActivePSA()
    {
        $query = $this->getQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('archiviert', false),
                $query->equals('verwendungPsa', true)
            )
        );
        return $query->execute();
    }

    protected function getQuery($forcedPid = 0): QueryInterface
    {
        $query = parent::getQuery($forcedPid);
        $query->setOrderings(['nachname' => QueryInterface::ORDER_ASCENDING]);

        return $query;
    }

    public function getAllForCsv()
    {
        $query = $this->getQuery();
        return $query->execute();

        // ...
    }

}
