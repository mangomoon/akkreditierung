<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class CustomDataHandler
{

    public function copyRecord(string $table, int $id, int $destinationPid, array $overrideValues = []): int
    {
        $this->initFakeTableInfo();
        $user = GeneralUtility::makeInstance(BackendUserAuthentication::class);
        $user->setBeUserByUid(1); // todo configurable
        $user->fetchGroupData();
        $GLOBALS['LANG'] = GeneralUtility::makeInstance(LanguageServiceFactory::class)->createFromUserPreferences($user);

        $command[$table][$id]['copy'] = $destinationPid;
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start([], $command, $user);
        $dataHandler->admin = true;
        $dataHandler->process_cmdmap(); // todo logging/errors

        $newId = $dataHandler->copyMappingArray[$table][$id];

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