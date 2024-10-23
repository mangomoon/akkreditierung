<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\ReportingFilter;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ReportingRepository
{

    private array $dateLogFields = ['einreich_datum', 'zuteilung_datum', 'akkreditierung_entscheidung_datum'];
    private array $dateZuteilungLogFields = ['zuteilung_datum'];
    private array $enhancementCache = [];

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
            ->orderBy('tx_ieb_domain_model_stammdaten.name', 'ASC')
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
        if ($filter->statusList) {
            $constraints[] = $queryBuilder->expr()->in('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->statusList, Connection::PARAM_INT_ARRAY));
        }
        if ($filter->aboveStatus) {
            $constraints[] = $queryBuilder->expr()->gt('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->aboveStatus, \PDO::PARAM_INT));
        }
        if ($filter->trPid > 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.pid', $queryBuilder->createNamedParameter($filter->trPid, \PDO::PARAM_INT));
        }

        if (!empty($constraints)) {
            $select->where(...$constraints);
        }

        return $select->execute()->fetchAllAssociative();
    }

    public function getByFilterWoTest(ReportingFilter $filter): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');

        $select = $queryBuilder->select('tx_ieb_domain_model_ansuchen.*')
            ->from('tx_ieb_domain_model_ansuchen');

        $constraints = [
            $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
            $queryBuilder->expr()->neq('pid', $queryBuilder->createNamedParameter(218, \PDO::PARAM_INT)),
        ];

        if ($filter->bundesland > 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.bundesland', $queryBuilder->createNamedParameter($filter->bundesland, \PDO::PARAM_INT));
        }
        if ($filter->status >= 0) {
            $constraints[] = $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->status, \PDO::PARAM_INT));
        }
        if ($filter->statusList) {
            $constraints[] = $queryBuilder->expr()->in('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->statusList, Connection::PARAM_INT_ARRAY));
        }
        if ($filter->aboveStatus) {
            $constraints[] = $queryBuilder->expr()->gt('tx_ieb_domain_model_ansuchen.status', $queryBuilder->createNamedParameter($filter->aboveStatus, \PDO::PARAM_INT));
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
        foreach ($this->dateZuteilungLogFields as $field) {
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

        foreach ($rows as &$row) {
            $this->enhanceRow($row);
        }

        return $rows;
    }

    protected function enhanceRow(array &$ansuchen): void
    {
        // fetch gutachter records
        foreach (['gutachter1', 'gutachter2'] as $field) {
            if (!$ansuchen[$field]) {
                continue;
            }
            if (!isset($this->enhancementCache[$ansuchen[$field]])) {
                ;
                $this->enhancementCache[$ansuchen[$field]] = BackendUtility::getRecord('fe_users', $ansuchen[$field], '*');
            }
            $ansuchen[$field] = $this->enhancementCache[$ansuchen[$field]];
        }
        // convert json fields
        foreach (['stammdaten', 'trainer', 'berater', 'verantwortliche', 'verantwortliche_mail'] as $field) {
            $field = 'copy_' . $field;
            if (!$ansuchen[$field]) {
                continue;
            }
            $ansuchen[$field] = json_decode($ansuchen[$field], true, 512, JSON_THROW_ON_ERROR);
        }
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
        krsort($items);
        return $items;
    }

    public function getRecursiveAnsuchen(array &$collection, array $row, string $fields = '*')
    {
        $collection[] = $row;
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');

        if (!$row['version_based_on']) {
            return;
        }
        $parentRow = $queryBuilder
            ->select(...GeneralUtility::trimExplode(',', $fields, true))
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['version_based_on'], \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAssociative();
        if ($parentRow) {
            $this->getRecursiveAnsuchen($collection, $parentRow, $fields);
        }
    }

    public function findAnsuchenByNummerAndVersion(string $nummer, int $version): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_ansuchen');
        $row = $queryBuilder
            ->select('*')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('nummer', $queryBuilder->createNamedParameter($nummer, \PDO::PARAM_STR)),
                $queryBuilder->expr()->eq('version', $queryBuilder->createNamedParameter($version, \PDO::PARAM_INT)),
            )
            ->execute()
            ->fetchAssociative();
        if (!$row) {
            return [];
        }
        return $row;
    }

    public function getVerantwortliche(int $ansuchenId, $mm): array
    {
        if (!in_array($mm, ['tx_ieb_ansuchen_angebotverantwortlich_mm', 'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm'])) {
            throw new \InvalidArgumentException('Invalid mm table');
        }
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_angebotverantwortlich');
        return $queryBuilder
            ->select('tx_ieb_domain_model_angebotverantwortlich.*')
            ->from('tx_ieb_domain_model_angebotverantwortlich')
            ->rightJoin(
                'tx_ieb_domain_model_angebotverantwortlich',
                $mm,
                'mm',
                $queryBuilder->expr()->eq('mm.uid_foreign', $queryBuilder->quoteIdentifier('tx_ieb_domain_model_angebotverantwortlich.uid'))
            )
            ->where(
                $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->createNamedParameter($ansuchenId, Connection::PARAM_INT))
            )
            ->execute()
            ->fetchAllAssociative();
    }

    public function getLatestStammdaten(int $pid): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_stammdaten');
        return $queryBuilder
            ->select('tx_ieb_domain_model_stammdaten.*')
            ->from('tx_ieb_domain_model_stammdaten')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid, Connection::PARAM_INT))
            )
            ->orderBy('tstamp', 'DESC')
            ->setMaxResults(1)
            ->execute()
            ->fetchAssociative();
    }

    public function getAllTrainer(int $ansuchenId): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_trainer');
        return $queryBuilder
            ->select('tx_ieb_domain_model_trainer.uid', 'vorname', 'nachname', 'review_frist', 'review_psa_frist')
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
            ->where(
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->createNamedParameter($ansuchenId, Connection::PARAM_INT))
            )
            ->executeQuery()
            ->fetchAllAssociative();

    }

    public function getAllBerater(int $ansuchenId): array
    {
        $queryBuilder = $this->getQueryBuilder('tx_ieb_domain_model_berater');
        return $queryBuilder
            ->select('tx_ieb_domain_model_berater.uid', 'vorname', 'nachname', 'review_frist')
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
            ->where(
                $queryBuilder->expr()->eq('tx_ieb_domain_model_ansuchen.uid', $queryBuilder->createNamedParameter($ansuchenId, Connection::PARAM_INT))
            )
            ->executeQuery()
            ->fetchAllAssociative();

    }


    private function getQueryBuilder(string $tableName): QueryBuilder
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
    }
}