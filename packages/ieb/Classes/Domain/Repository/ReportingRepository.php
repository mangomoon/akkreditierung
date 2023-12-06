<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\ReportingFilter;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ReportingRepository
{

    private array $dateLogFields = ['einreich_datum', 'zuteilung_datum', 'akkreditierung_entscheidung_datum'];

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

    public function getByFilter(ReportingFilter $filter): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');

        $select = $queryBuilder->select('tx_ieb_domain_model_ansuchen.*')
            ->from('tx_ieb_domain_model_ansuchen');

        $constraints = [
            $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
        ];

        if ($filter->bundesland > 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.bundesland', $queryBuilder->createNamedParameter($filter->bundesland, \PDO::PARAM_INT));
        }
        if ($filter->status >= 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->status, \PDO::PARAM_INT));
        }
        if ($filter->trPid > 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->createNamedParameter($filter->trPid, \PDO::PARAM_INT));
        }

        if (!empty($constraints)) {
            $select->where(...$constraints);
        }

        return $select->execute()->fetchAllAssociative();
    }

    public function getAllTraegerNames(): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_stammdaten');
        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_stammdaten.*')
            ->from('tx_ieb_domain_model_stammdaten')
            ->join(
                'tx_ieb_domain_model_stammdaten',
                'pages',
                'pages',
                $queryBuilder->expr()->eq('tx_ieb_domain_model_stammdaten.pid', $queryBuilder->quoteIdentifier('pages.uid')))
            ->where(
                $queryBuilder->expr()->eq('pages.deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('pages.hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            )
            ->orderBy('tx_ieb_domain_model_stammdaten.name', 'ASC')
            ->execute()
            ->fetchAllAssociative();

        $items = [];
        foreach ($rows as $item) {
            $items[$item['pid']] = sprintf('%s [%s]', $item['name'], $item['ort']);
        }
        return $items;
    }

    public function getDateLog(int $year, int $quarter): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');

        $dateConstraints = [];
        foreach ($this->dateLogFields as $field) {
            $dateConstraints[] = $queryBuilder->expr()->andX(
                sprintf('year(%s)=%s', $field, $year),
                sprintf('quarter(%s)=%s', $field, $quarter),
            );
        }

        $rows = $queryBuilder
            ->select('*')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->orX(...$dateConstraints),
            )
            ->orderBy('tstamp', 'DESC')
            ->executeQuery()
            ->fetchAllAssociative();

        //DebuggerUtility::var_dump([$year, $quarter, $rows]);
        return $rows;
    }


    public function getDateLogUsage(): array
    {
        $items = [];
        foreach ($this->dateLogFields as $field) {
            $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');

            $rows = $queryBuilder
                ->addSelectLiteral('count(*) as count')
                ->addSelectLiteral(sprintf('year(%s) as year', $field))
                ->addSelectLiteral(sprintf('quarter(%s) as quarter', $field))
                ->from('tx_ieb_domain_model_ansuchen')
                ->where(
                    $queryBuilder->expr()->isNotNull($field)
                )
                ->groupBy('year', 'quarter')
                ->execute()
                ->fetchAllAssociative();

            foreach ($rows as $row) {
                if (!$row['year'] || !$row['quarter']) {
                    continue;
                }
                $items[sprintf('%s-%s', $row['year'], $row['quarter'])] = sprintf('%s - %s', $row['year'], $row['quarter']);
            }
        }
        ksort($items);
        return $items;
    }


    private function getQueryBuilder(string $tableName): QueryBuilder
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
    }
}