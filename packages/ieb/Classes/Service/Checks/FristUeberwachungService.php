<?php

namespace GeorgRinger\Ieb\Service\Checks;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Service\MailService;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FristUeberwachungService
{

    private array $configuration = [
        'ansuchen_pruefbescheid' => [
            'table' => 'tx_ieb_domain_model_ansuchen',
            'frist' => 'review_frist_pruefbescheid',
            't1' => 'review_frist_pruefbescheid_mail_sent1t',
            't14' => 'review_frist_pruefbescheid_mail_sent14t',
        ],
        'ansuchen_pruefbescheid' => [
            'table' => 'tx_ieb_domain_model_ansuchen',
            'frist' => 'review_frist_pruefbescheid',
            't1' => 'review_frist_pruefbescheid_mail_sent1t',
            't14' => 'review_frist_pruefbescheid_mail_sent14t',
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
    ];
    protected array $idLists = [];
    protected array $records = [];
    protected MailService $mailService;

    public function __construct(protected readonly array $emails)
    {
        $this->mailService = GeneralUtility::makeInstance(MailService::class);
    }

    public function sendEmails(): void
    {
        $this->collect();
        print_r($this->records);
        die('ednd');
        if (empty($this->records)) {
            return;
        }

        $this->sendMails();

        $this->setAsSent();

    }

    private function collect()
    {
        foreach ($this->configuration as $k => $_) {
            if (str_starts_with($k, 'ansuchen_')) {
                $this->getAnsuchenDirect($k);
            } elseif ($k === 'berater' || $k === 'trainer') {
                $this->getFromJoin($k);
            }
        }
    }

    protected function sendMails()
    {
        foreach ($this->records as $pid => $records) {
            $variables = [
                'records' => $records,
                'pid' => $pid,
            ];
            $this->mailService
                ->sendSingle($variables, 'Checks/FristenUeberwachung', 'dummy@example.com', 'Jone Doe ' . $pid);

        }
    }

    protected function setAsSent()
    {
        // todo
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
    protected function getConstraint(\TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder, mixed $configuration): array
    {
        $now = $GLOBALS['EXEC_TIME'];
        $where = [
            $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT)),
            $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusForFristMails(), Connection::PARAM_INT_ARRAY)),
            $queryBuilder->expr()->gt($configuration['frist'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq($configuration['t1'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                    $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now + 86400, Connection::PARAM_INT)),
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq($configuration['t14'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                    $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now + (86400 * 14), Connection::PARAM_INT)),
                ),
            ),
        ];

        return $where;
    }

    protected function addToRecords(array $rows, array $configuration, string $type): void
    {
        $t14Field = $configuration['t14'];
        $fristField = $configuration['frist'];
        foreach ($rows as $row) {
            $isRelation = $row['relationUid'] ?? false;

            if (!$row[$t14Field] && $row[$fristField] - (86400 * 14) > $GLOBALS['EXEC_TIME']) {
                $this->records[$row['uid']][$type]['t14'][] = $row;
            } else {
                $this->records[$row['uid']][$type]['t1'][] = $row;
            }
            $this->idLists[$configuration['table']][] = $row['uid'];
        }
    }

    /**
     * SELECT uid,name,review_frist_pruefbescheid as f1,review_frist_pruefbescheid_mail_sent1t as t1_,review_frist_pruefbescheid_mail_sent14t as t14_, from_unixtime(review_frist_pruefbescheid,"%Y-%m-%d %h %i %s") AS frist, from_unixtime(review_frist_pruefbescheid_mail_sent1t,"%Y-%m-%d %h %i %s") AS t1, from_unixtime(review_frist_pruefbescheid_mail_sent14t,"%Y-%m-%d %h %i %s") AS t14 FROM `tx_ieb_domain_model_ansuchen` where version_active=1;
     */

}