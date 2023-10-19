<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Event;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class ArchiveActionListener
{

    public function archiveTrainer(Event\TrainerArchiveEvent $event): void
    {
        $rows = $this->getAllAnsuchenIds($event->trainer->getPid());
        $this->deleteRelations($rows, $event->trainer->getUid(), 'tx_ieb_ansuchen_trainer_mm');
    }

    public function archiveBerater(Event\BeraterArchiveEvent $event): void
    {
        $rows = $this->getAllAnsuchenIds($event->berater->getPid());
        $this->deleteRelations($rows, $event->berater->getUid(), 'tx_ieb_ansuchen_berater_mm');
    }

    public function archiveAngebotVerantwortlich(Event\AngebotVerantwortlichArchiveEvent $event): void
    {
        $rows = $this->getAllAnsuchenIds($event->angebotVerantwortlich->getPid());
        $this->deleteRelations($rows, $event->angebotVerantwortlich->getUid(), 'tx_ieb_ansuchen_angebotverantwortlich_mm');
    }

    /**
     * @param int[] $ansuchenIds
     * @param int $relationId
     * @param string $table
     */
    protected function deleteRelations(array $ansuchenIds, int $relationId, string $table): int
    {
        if (empty($ansuchenIds)) {
            return 0;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        return $queryBuilder
            ->delete($table)
            ->where(
                $queryBuilder->expr()->in('uid_local', $queryBuilder->createNamedParameter($ansuchenIds, Connection::PARAM_INT_ARRAY)),
                $queryBuilder->expr()->in('uid_foreign', $queryBuilder->createNamedParameter($relationId, Connection::PARAM_INT))
            )
            ->executeStatement();
    }

    protected function getAllAnsuchenIds(int $pid): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');

        $rows = $queryBuilder
            ->select('uid', 'name', 'status','status_after_review')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid, \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
                $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusBearbeitbarDurchTrCheck(), \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAllAssociative();

        return array_column($rows, 'uid');
    }
}