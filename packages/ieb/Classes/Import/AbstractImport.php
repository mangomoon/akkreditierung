<?php

namespace GeorgRinger\Ieb\Import;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AbstractImport
{

    protected Connection $oldConnection;
    protected Connection $newConnection;
    protected ResourceFactory $resourceFactory;
    protected array $pidList = [];

    public function __construct()
    {
        $this->oldConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName('Import');
        $this->newConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName('Default');
        $this->resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $this->init();
    }

    private function init()
    {
        $queryBuilder = $this->newConnection->createQueryBuilder();
        $rows = $queryBuilder
            ->select('pid', 'uid', 'title')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter(4, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAllAssociative();

        foreach ($rows as $row) {
            $this->pidList[(int)($row['title'])] = $row['uid'];
        }
    }

    public function deleteAllFromNewTable(string $table): int
    {
        $queryBuilder = $this->newConnection->createQueryBuilder();
        return $queryBuilder
            ->delete($table)
            ->where(
                $queryBuilder->expr()->gt('import', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            )
            ->executeStatement();
    }

    public function getAllFromOldTable(string $table): array
    {
        $queryBuilder = $this->oldConnection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll();

        $rows = $queryBuilder
            ->select('*')
            ->from($table)
            ->execute()
            ->fetchAllAssociative();
        return $rows;
    }

    protected function getPageIdFromTraegerUid(int $uid): int
    {
        if (isset($this->pidList[$uid])) {
            return $this->pidList[$uid];
        }
        $this->newConnection->insert('pages', [
            'title' => $uid,
            'pid' => 4,
            'tstamp' => time(),
            'crdate' => time(),
        ]);
        $this->pidList[$uid] = $this->newConnection->lastInsertId('pages');

        return $this->pidList[$uid];
    }

    protected function getFileReferenceFromFile(string $filename, int $pid, string $tableName, string $fieldName, int $foreignUid, int $sorting): int
    {
        $queryBuilder = $this->newConnection->createQueryBuilder();
        $row = $queryBuilder
            ->select('*')
            ->from('sys_file_reference')
            ->where(
                $queryBuilder->expr()->eq('import', $queryBuilder->createNamedParameter($filename))
            )
            ->execute()
            ->fetchAssociative();
        if ($row) {
            return $row['uid'];
        }

        return $this->addFileReferenceFromFile($filename, $pid, $tableName, $fieldName, $foreignUid, $sorting);
    }


    private function addFileReferenceFromFile(string $filename, int $pid, string $tableName, string $fieldName, int $foreignUid, int $sorting): int
    {
        $fileNameTmp = $this->fetchRemoteFile($filename);
        if (!$fileNameTmp) {
            return 0;
        }

        $directory = 'content/import/' . $pid;
        GeneralUtility::mkdir_deep(Environment::getPublicPath() . '/fileadmin/' . $directory);

        $storage = $this->resourceFactory->getDefaultStorage();
        if (!$storage) {
            die('No storage found');
        }
        $potentialFile = null;
        try {
            $potentialFile = $storage->getFile($directory . '/' . $storage->sanitizeFileName($filename));
        } catch (\Exception $e) {
        }
        if ($potentialFile) {
            $this->newConnection->update('sys_file', [
                'import' => $filename,
            ], [
                'uid' => $potentialFile->getUid(),
            ]);
            $finalFile = $potentialFile;
        } else {
            $newFile = $storage->addFile(
                $fileNameTmp,
                $storage->getFolder($directory),
                $filename,
                DuplicationBehavior::CANCEL
            );

            $this->newConnection->update('sys_file', [
                'import' => $filename,
            ], [
                'uid' => $newFile->getUid(),
            ]);
            $finalFile = $newFile;
        }

        $this->newConnection->insert('sys_file_reference', [
            'table_local' => 'sys_file',
            'uid_local' => $finalFile->getUid(),
            'tablenames' => $tableName,
            'uid_foreign' => $foreignUid,
            'fieldname' => $fieldName,
            'pid' => $pid,
            'sorting_foreign' => $sorting,
            'import' => $filename,
        ]);
        return $this->newConnection->lastInsertId('sys_file_reference');
    }

    private function fetchRemoteFile(string $filename): false|string
    {
        $split = explode('_', $filename);
        $dateSuffix = date('Y/m/', (int)$split[0]);
        $url = 'https://akkreditierung.initiative-erwachsenenbildung.at/uploads/tx_ieb_pp3/' . $dateSuffix . $filename;

        $content = GeneralUtility::getUrl($url);
        if (!$content) {
            $url = str_replace('tx_ieb_pp3', 'tx_ieb_pp2', $url);
            $content = GeneralUtility::getUrl($url);
        }

        if (!$content) {
            echo 'ERROR: FILE NOT FOUND: ' . $url . PHP_EOL;
            return false;
        }

        $tmpName = GeneralUtility::tempnam('ieb');
        GeneralUtility::writeFile($tmpName, $content);
        return $tmpName;
    }

    protected function addFiles(array $old, array $insert, string $table, array $fields): array
    {
        foreach ($fields as $from => $to) {
            $split = GeneralUtility::trimExplode(',', $old[$from], true);
            $newIds = [];
            foreach ($split as $k => $file) {
                $referenceId = $this->getFileReferenceFromFile(
                    $file,
                    $insert['pid'],
                    $table,
                    $to,
                    $insert['uid'],
                    $k
                );
                if ($referenceId) {
                    $newIds[] = $referenceId;
                }
            }
            $insert[$to] = count($newIds);
        }
        return $insert;
    }
}