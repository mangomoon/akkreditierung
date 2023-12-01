<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\AnsuchenArchivFilter;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AnsuchenArchivRepository
{

    public function findByFilter(AnsuchenArchivFilter $filter): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');
        $query = $queryBuilder
            ->select('tx_ieb_domain_model_ansuchen.*', 'stammdaten.markenname as stammdatenMarkenname', 'stammdaten.name as stammdatenName')
            ->from('tx_ieb_domain_model_ansuchen')
            ->rightJoin(
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_stammdaten',
                'stammdaten',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->quoteIdentifier('stammdaten.pid'))
            )
            ->orderBy('uid', 'DESC');

        $constraints = [
            $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
        ];

        if ($filter->ansuchenNummer) {
            $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($filter->ansuchenNummer) . '%';
            $constraints[] = $queryBuilder->expr()->like('nummer', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR));
        }
        if ($filter->status >= 0) {
            $constraints[] = $queryBuilder->expr()->eq('status', $queryBuilder->createNamedParameter($filter->status, \PDO::PARAM_INT));
        }
        if ($filter->search) {
            $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($filter->search) . '%';
            $constraints[] = $queryBuilder->expr()->like('tx_ieb_domain_model_ansuchen.name', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR));
        }
        if ($filter->searchStammdaten) {
            $escapedLikeString = '%' . $queryBuilder->escapeLikeWildcards($filter->searchStammdaten) . '%';
            $constraints[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('stammdaten.name', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR)),
                $queryBuilder->expr()->like('stammdaten.markenname', $queryBuilder->createNamedParameter($escapedLikeString, \PDO::PARAM_STR))
            );
        }

        if (!empty($constraints)) {
            $query->where(...$constraints);
        }

        return $query->execute()->fetchAllAssociative();
    }

    public function getAllVersionsByNumber(string $ansuchenNummer, bool $excludeActive = true): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');
        $query = $queryBuilder->select('tx_ieb_domain_model_ansuchen.*')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('nummer', $queryBuilder->createNamedParameter($ansuchenNummer, \PDO::PARAM_STR)),
            )
            ->orderBy('uid', 'DESC');

        if ($excludeActive) {
            $query->andWhere(
                $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            );
        }

        return $query->execute()->fetchAllAssociative();
    }


    private function getQueryBuilder(string $tableName): QueryBuilder
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
    }
}