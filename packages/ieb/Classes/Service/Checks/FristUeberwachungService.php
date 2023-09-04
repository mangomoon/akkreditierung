<?php

namespace GeorgRinger\Ieb\Service\Checks;

use GeorgRinger\Ieb\Service\MailService;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FristUeberwachungService
{

    private array $configuration = [
        'ansuchen' => [
            'table' => 'tx_ieb_domain_model_ansuchen',
            'frist' => 'review_frist_pruefbescheid',
            't14' => 'review_frist_pruefbescheid_mail_sent14t',
            't1' => 'review_frist_pruefbescheid_mail_sent1t',
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
        if (empty($this->records)) {
            return;
        }

        $this->sendMails();
        $this->setAsSent();

    }

    private function collect()
    {
        $this->get('ansuchen');
    }

    protected function sendMails()
    {
        foreach ($this->records as $pid => $records) {
            $variables = [
                'records' => $records,
                'pid' => $pid,
            ];
            $this->mailService
                ->send($variables, 'Checks/FristenUeberwachung', 'dummy@example.com', 'Jone Doe ' . $pid);

        }
    }

    protected function setAsSent()
    {
        // todo
    }

    private function get(string $type): void
    {
        $configuration = $this->configuration[$type] ?? null;
        if (!$configuration) {
            throw new \Exception('No configuration found for type ' . $type, 1693850454);
        }

        $now = time();
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($configuration['table']);
        $where = [
            $queryBuilder->expr()->gt($configuration['frist'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq($configuration['t1'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                    $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now - 86400, Connection::PARAM_INT)),
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq($configuration['t14'], $queryBuilder->createNamedParameter(0, Connection::PARAM_INT)),
                    $queryBuilder->expr()->gte($configuration['frist'], $queryBuilder->createNamedParameter($now - (86400 * 14), Connection::PARAM_INT)),
                ),
            ),
        ];

        if ($type === 'ansuchen') {
            $where[] = $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT));
        }

        $rows = (array)$queryBuilder
            ->select('*')
            ->from($configuration['table'])
            ->where(...$where)
            ->execute()
            ->fetchAllAssociative();

        foreach ($rows as $row) {
            if (!$row[$configuration['t14']]) {
                $this->records[$row['pid']][$type]['t14'][] = $row;//['uid' => $row['uid'], 'name' => $row['name']];
            } else {
                $this->records[$row['pid']][$type]['t1'][] = $row;//['uid' => $row['uid'], 'name' => $row['name']];
            }
            $this->idLists[$type][] = $row['uid'];
        }

    }

    /**
     * SELECT uid,name,review_frist_pruefbescheid as f1,review_frist_pruefbescheid_mail_sent1t as t1_,review_frist_pruefbescheid_mail_sent14t as t14_, from_unixtime(review_frist_pruefbescheid,"%Y-%m-%d %h %i %s") AS frist, from_unixtime(review_frist_pruefbescheid_mail_sent1t,"%Y-%m-%d %h %i %s") AS t1, from_unixtime(review_frist_pruefbescheid_mail_sent14t,"%Y-%m-%d %h %i %s") AS t14 FROM `tx_ieb_domain_model_ansuchen` where version_active=1;
     */

}