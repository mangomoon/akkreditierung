<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich;
use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Model\Standort;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class RelationLockService
{

    private array $configuration = [
        Trainer::class => [
            'table' => 'tx_ieb_domain_model_trainer',
            'mm' => 'tx_ieb_ansuchen_trainer_mm',
        ],
        Berater::class => [
            'table' => 'tx_ieb_domain_model_berater',
            'mm' => 'tx_ieb_ansuchen_berater_mm',
        ],
        AngebotVerantwortlich::class => [
            'table' => 'tx_ieb_domain_model_angebotverantwortlich',
            'mm' => 'tx_ieb_ansuchen_angebotverantwortlich_mm',
        ],
        Standort::class => [
            'table' => 'tx_ieb_domain_model_standort',
            'mm' => 'tx_ieb_ansuchen_standort_mm',
        ],
    ];

    public function usedByAnsuchenInReview(AbstractEntity $object): array
    {
        $class = get_class($object);
        $configuration = $this->configuration[$class] ?? null;
        if (!$configuration) {
            throw new \UnexpectedValueException(sprintf('Relation "%s" is not configured', $class), 1686927696);
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);

        $rows = $queryBuilder
            ->select('mm.uid_foreign', 'mm.uid_local', 'a.*')
            ->from($configuration['table'], 'r')
            ->rightJoin('r', $configuration['mm'], 'mm', $queryBuilder->expr()->eq('r.uid', $queryBuilder->quoteIdentifier('mm.uid_foreign')))
            ->rightJoin('mm', 'tx_ieb_domain_model_ansuchen', 'a', $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->quoteIdentifier('a.uid')))
            ->where(
                $queryBuilder->expr()->eq('r.uid', $queryBuilder->createNamedParameter($object->getUid(), \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('a.version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
                $queryBuilder->expr()->in('a.status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusRelationenGesperrt(), Connection::PARAM_INT_ARRAY)),
            )
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function usedByAnsuchen(AbstractEntity $object): array
    {
        $class = get_class($object);
        $configuration = $this->configuration[$class] ?? null;
        if (!$configuration) {
            throw new \UnexpectedValueException(sprintf('Relation "%s" is not configured', $class), 1686927696);
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);

        $rows = $queryBuilder
            ->select('mm.uid_foreign', 'mm.uid_local', 'a.*')
            ->from($configuration['table'], 'r')
            ->rightJoin('r', $configuration['mm'], 'mm', $queryBuilder->expr()->eq('r.uid', $queryBuilder->quoteIdentifier('mm.uid_foreign')))
            ->rightJoin('mm', 'tx_ieb_domain_model_ansuchen', 'a', $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->quoteIdentifier('a.uid')))
            ->where(
                $queryBuilder->expr()->eq('r.uid', $queryBuilder->createNamedParameter($object->getUid(), \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('a.version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
            )
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

}