<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ReportingRepository
{

    public function getTrWithNoAnsuchen(): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_stammdaten');
        return $queryBuilder
            ->select('tx_ieb_domain_model_stammdaten.*')
            ->from('tx_ieb_domain_model_stammdaten')
            ->leftJoin(
                'tx_ieb_domain_model_stammdaten',
                'tx_ieb_domain_model_ansuchen',
                'ansuchen',
                $queryBuilder->expr()->eq('ansuchen.pid', $queryBuilder->quoteIdentifier('tx_ieb_domain_model_stammdaten.pid'))
            )
            ->where(
                $queryBuilder->expr()->isNull('ansuchen.uid'),
            )
            ->execute()
            ->fetchAllAssociative();
    }

    private function getQueryBuilder(string $tableName): QueryBuilder
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
    }
}