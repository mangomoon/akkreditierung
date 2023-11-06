<?php

namespace GeorgRinger\Ieb\Service\Checks;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FristUeberwachungService
{

    private array $configuration = [
        'ansuchen_total' => [
            'table' => 'tx_ieb_domain_model_ansuchen',
            'frist' => 'review_total_frist',
            't1' => 'review_total_frist_mail_sent1t',
            't14' => 'review_total_frist_mail_sent14t',
            't14Skip' => true,
        ],
        'ansuchen_pruefbescheid' => [
            'table' => 'tx_ieb_domain_model_ansuchen',
            'frist' => 'review_frist_pruefbescheid',
            't1' => 'review_frist_pruefbescheid_mail_sent1t',
            't14' => 'review_frist_pruefbescheid_mail_sent14t',
            't14Skip' => true,
        ],
        'berater' => [
            'table' => 'tx_ieb_domain_model_berater',
            'frist' => 'review_frist',
            't1' => 'review_frist_mail_sent1t',
            't14' => 'review_frist_mail_sent14t',
            'join' => 'tx_ieb_ansuchen_berater_mm',
        ],
        'trainer' => [
            'table' => 'tx_ieb_domain_model_trainer',
            'frist' => 'review_frist',
            't1' => 'review_frist_mail_sent1t',
            't14' => 'review_frist_mail_sent14t',
            'join' => 'tx_ieb_ansuchen_trainer_mm',
        ],
        'stammdaten' => [
            'table' => 'tx_ieb_domain_model_stammdaten',
            'frist' => 'review_oecert_frist',
            't1' => 'review_oecert_frist_mail_sent1t',
            't14' => 'review_oecert_frist_mail_sent14t',
            't14AlternativeDays' => 180,
        ],
    ];
    protected array $idLists = [];
    protected array $records = [];
    protected ExtensionConfiguration $extensionConfiguration;
    protected MailService $mailService;

    public function __construct(protected readonly array $emails, protected readonly bool $skipPersistSent = false)
    {
        $this->mailService = GeneralUtility::makeInstance(MailService::class);
        $this->extensionConfiguration = new ExtensionConfiguration();
    }

    public function sendEmails(): int
    {
        $this->collect();
        if (empty($this->records)) {
            return 0;
        }

        $this->sendMails();

        if (!$this->skipPersistSent) {
            $this->setAsSent();
        }

        return count($this->records);
    }

    private function collect()
    {
        foreach ($this->configuration as $k => $_) {
            if (str_starts_with($k, 'ansuchen_')) {
                $this->getAnsuchenDirect($k);
            } elseif ($k === 'berater' || $k === 'trainer') {
                $this->getFromJoin($k);
            } elseif ($k === 'stammdaten') {
                $this->getFromStammdaten($k);
            }
        }
    }

    protected function sendMails(): void
    {
        foreach ($this->records as $uid => $records) {
            $variables = [
                'records' => $records,
                'ansuchen' => BackendUtility::getRecord('tx_ieb_domain_model_ansuchen', $uid),
            ];

            $recipients = $this->getRecipientsForAnsuchen($uid);

            $this->mailService
                ->send('Checks/FristenUeberwachung', $recipients, $variables);
        }
    }

    protected function getRecipientsForAnsuchen(int $ansuchenId): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_angebotverantwortlich');
        $rows = $queryBuilder
            ->select('tx_ieb_domain_model_angebotverantwortlich.*')
            ->from('tx_ieb_domain_model_angebotverantwortlich')
            ->rightJoin(
                'tx_ieb_domain_model_angebotverantwortlich',
                'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm',
                'mm',
                $queryBuilder->expr()->eq('mm.uid_foreign', $queryBuilder->quoteIdentifier('tx_ieb_domain_model_angebotverantwortlich.uid'))
            )
            ->where(
                $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->createNamedParameter($ansuchenId, Connection::PARAM_INT)),
                $queryBuilder->expr()->eq('tx_ieb_domain_model_angebotverantwortlich.ok', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT)),
            )
            ->execute()
            ->fetchAllAssociative();

        $recipients = [$this->extensionConfiguration->getEmailAddressGs() => ''];
        foreach ($rows as $row) {
            if (GeneralUtility::validEmail($row['email'])) {
                $recipients[$row['email']] = sprintf('%s %s', $row['vorname'], $row['nachname']);
            }
        }
        return $recipients;
    }

    protected function setAsSent(): void
    {
        foreach ($this->idLists as $table => $config) {
            foreach ($config as $fristField => $idList) {
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
                $queryBuilder->update($table)
                    ->set($fristField, $GLOBALS['EXEC_TIME'])
                    ->where(
                        $queryBuilder->expr()->in('uid', $queryBuilder->createNamedParameter($idList, Connection::PARAM_INT_ARRAY))
                    )
                    ->execute();
            }
        }
    }

    private function getAnsuchenDirect(string $type): void
    {
        $configuration = $this->configuration[$type];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);
        $where = $this->getConstraint($queryBuilder, $configuration);
        $where[] = $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT));

        $rows = $queryBuilder
            ->select(...['uid', 'pid', $configuration['frist'], $configuration['t1'], $configuration['t14']])
            ->from($configuration['table'])
            ->where(...$where)
            ->execute()
            ->fetchAllAssociative();

        $this->addToRecords($rows, $configuration, $type);
    }

    private function getFromStammdaten(string $type): void
    {
        $configuration = $this->configuration[$type];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);
        $maxIdRows = $queryBuilder
            ->select('pid')
            ->addSelectLiteral('max(uid) as uid')
            ->from($configuration['table'])
            ->groupBy('pid')
            ->execute()
            ->fetchAllAssociative();
        if (empty($maxIdRows)) {
            return;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);
        $where = $this->getConstraint($queryBuilder, $configuration, false);
        $where[] = $queryBuilder->expr()->in('uid', $queryBuilder->createNamedParameter(array_column($maxIdRows, 'uid'), Connection::PARAM_INT_ARRAY));

        $stammdatenRowsWithFrist = $queryBuilder
            ->select(...['pid', $configuration['frist'], $configuration['t1'], $configuration['t14']])
            ->addSelectLiteral('uid as stammdatenUid')
            ->from($configuration['table'])
            ->where(...$where)
            ->execute()
            ->fetchAllAssociative();
        $stammdatenRowsWithFristByPid = [];
        foreach ($stammdatenRowsWithFrist as $item) {
            $stammdatenRowsWithFristByPid[$item['pid']] = $item;
        }

        // now fetch all ansuchen which match with those pids
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');
        $ansuchenRows = $queryBuilder
            ->select(...['uid', 'pid', 'version_active', 'status'])
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(...[
                $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusForFristMails(), Connection::PARAM_INT_ARRAY)),
                $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT)),
                $queryBuilder->expr()->in('pid', $queryBuilder->createNamedParameter(array_column($stammdatenRowsWithFrist, 'pid'), Connection::PARAM_INT_ARRAY)),
            ])
            ->execute()
            ->fetchAllAssociative();
        foreach ($ansuchenRows as &$row) {
            $row[$configuration['frist']] = $stammdatenRowsWithFristByPid[$row['pid']][$configuration['frist']];
            $row[$configuration['t1']] = $stammdatenRowsWithFristByPid[$row['pid']][$configuration['t1']];
            $row[$configuration['t14']] = $stammdatenRowsWithFristByPid[$row['pid']][$configuration['t14']];
            $row['relationUid'] = $stammdatenRowsWithFristByPid[$row['pid']]['stammdatenUid'];
        }
        $this->addToRecords($ansuchenRows, $configuration, $type);
    }

    private function getFromJoin(string $type): void
    {
        $configuration = $this->configuration[$type];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);
        $where = $this->getConstraint($queryBuilder, $configuration);

        $rows = $queryBuilder
            ->select(...['tx_ieb_domain_model_ansuchen.uid', 'tx_ieb_domain_model_ansuchen.pid', $configuration['frist'], $configuration['t1'], $configuration['t14']])
            ->addSelectLiteral($configuration['table'] . '.uid as relationUid')
            ->leftJoin(
                $configuration['table'],
                $configuration['join'],
                $configuration['join'],
                $queryBuilder->expr()->eq($configuration['join'] . '.uid_foreign', $queryBuilder->quoteIdentifier($configuration['table'] . '.uid'))
            )
            ->leftJoin(
                $configuration['join'],
                'tx_ieb_domain_model_ansuchen',
                'tx_ieb_domain_model_ansuchen',
                $queryBuilder->expr()->eq($configuration['join'] . '.uid_local', $queryBuilder->quoteIdentifier('tx_ieb_domain_model_ansuchen.uid'))
            )
            ->from($configuration['table'])
            ->where(...$where)
            ->execute()
            ->fetchAllAssociative();

        $this->addToRecords($rows, $configuration, $type);
    }

    /**
     * @param \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder
     * @param mixed $configuration
     * @return array
     */
    protected function getConstraint(\TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder, array $configuration, bool $addAnsuchenConstraint = true): array
    {
        $now = $GLOBALS['EXEC_TIME'];
        $emptyFields = [$configuration['t1']];
        $dateConstraints = [
            $queryBuilder->expr()->andX(
                $queryBuilder->expr()->eq($configuration['t1'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now + 86400, Connection::PARAM_INT)),
            ),
        ];
        if (!($configuration['t14Skip'] ?? false)) {
            $days = $configuration['t14AlternativeDays'] ?? 14;
            $dateConstraints[] = $queryBuilder->expr()->andX(
                $queryBuilder->expr()->eq($configuration['t14'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now + (86400 * $days), Connection::PARAM_INT)),
            );
            $emptyFields[] = $configuration['t14'];
        }

        $dateToLateConstraints = [
            $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now, Connection::PARAM_INT)),
        ];
        foreach ($emptyFields as $emptyField) {
            $dateToLateConstraints[] = $queryBuilder->expr()->eq($emptyField, $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }
        $dateConstraints[] = $queryBuilder->expr()->andX(...$dateToLateConstraints);

        $where = [
            $queryBuilder->expr()->gt($configuration['frist'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
            $queryBuilder->expr()->orX(...$dateConstraints),
        ];

        if ($addAnsuchenConstraint) {
            $where[] = $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT));
            $where[] = $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusForFristMails(), Connection::PARAM_INT_ARRAY));

        }

        return $where;
    }

    protected function addToRecords(array $rows, array $configuration, string $type): void
    {
        $t14Field = $configuration['t14'];
        $t1Field = $configuration['t1'];
        $fristField = $configuration['frist'];
        foreach ($rows as $row) {
            $relevantUpdateId = $row['relationUid'] ?: $row['uid'];

            if (!($configuration['t14Skip'] ?? false) && !$row[$t14Field] && $row[$fristField] - (86400 * ($configuration['t14AlternativeDays'] ?? 14)) > $GLOBALS['EXEC_TIME']) {
                $this->records[$row['uid']][$type]['t14'][] = $row;
                $this->idLists[$configuration['table']][$t14Field][] = $relevantUpdateId;
            } else {
                $this->records[$row['uid']][$type]['t1'][] = $row;
                $this->idLists[$configuration['table']][$t1Field][] = $relevantUpdateId;
            }

        }
    }

    /**
     * SELECT uid,name,review_frist_pruefbescheid as f1,review_frist_pruefbescheid_mail_sent1t as t1_,review_frist_pruefbescheid_mail_sent14t as t14_, from_unixtime(review_frist_pruefbescheid,"%Y-%m-%d %h %i %s") AS frist, from_unixtime(review_frist_pruefbescheid_mail_sent1t,"%Y-%m-%d %h %i %s") AS t1, from_unixtime(review_frist_pruefbescheid_mail_sent14t,"%Y-%m-%d %h %i %s") AS t14 FROM `tx_ieb_domain_model_ansuchen` where version_active=1;
     */

}