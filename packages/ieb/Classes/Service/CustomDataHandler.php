<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use GeorgRinger\Ieb\ExtensionConfiguration;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CustomDataHandler
{

    protected DataHandler $dataHandler;
    protected BackendUserAuthentication $backendUser;

    public function __construct()
    {
        $extensionConfiguration = new ExtensionConfiguration();
        $this->initFakeTableInfo();
        $this->backendUser = GeneralUtility::makeInstance(BackendUserAuthentication::class);
        $this->backendUser->setBeUserByUid($extensionConfiguration->getUserIdForDatahandler());
        $this->backendUser->fetchGroupData();
        $GLOBALS['LANG'] = GeneralUtility::makeInstance(LanguageServiceFactory::class)->createFromUserPreferences($this->backendUser);

        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->admin = true;
    }

    public function copyRecord(string $table, int $id, int $destinationPid, array $overrideValues = []): int
    {
        $command[$table][$id]['copy'] = $destinationPid;
        $this->dataHandler->start([], $command, $this->backendUser);
        $this->dataHandler->process_cmdmap(); // todo logging/errors

        $newId = $this->dataHandler->copyMappingArray[$table][$id];

        if (!empty($overrideValues)) {
            $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
            $connection->update($table, $overrideValues, ['uid' => $newId]);
        }

        return $newId;
    }

    private function initFakeTableInfo(): void
    {
        $GLOBALS['PAGES_TYPES'] = [];
        foreach ([6, 244, 255, 'default'] as $doktype) {
            $GLOBALS['PAGES_TYPES'][$doktype] = [
                'allowedTables' => '*',
            ];
        }
    }
}