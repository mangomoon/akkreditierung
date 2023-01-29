<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationForm;
use GeorgRinger\Ieb\Domain\Model\Dto\RegistrationInvitation;
use GeorgRinger\Ieb\ExtensionConfiguration;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RegistrationRepository
{

    protected ExtensionConfiguration $extensionConfiguration;

    public function __construct()
    {
        $this->extensionConfiguration = new ExtensionConfiguration();
    }

    public function createFromRegistrationForm(RegistrationForm $form)
    {
        // create
        $pageData = [
            'pid' => $this->extensionConfiguration::getParentUserPid(),
            'hidden' => 1,
            'doktype' => PageRepository::DOKTYPE_SYSFOLDER,
            'title' => $form->trName,
        ];

        $pageId = $this->insertToTable('pages', $pageData); // 21 todo remove comment

        // create fe_user
        $userData = [
            'pid' => $pageId,
            'disable' => 1,
            'username' => $form->email,
            'password' => $this->generatePasswordHash($form->password),
            'email' => $form->email,
            'name' => $form->getFullName(),
            'first_name' => $form->vorname,
            'last_name' => $form->nachname,
            'tr_admin' => 1,
        ];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $queryBuilder->insert('fe_users')->values($userData)->execute();

        return $pageId;
    }

    public function updateUserFromInvitation(RegistrationInvitation $form): void
    {
        $userData = [
            'usergroup' => $this->extensionConfiguration->getUsergroupAktiv(),
            'password' => $this->generatePasswordHash($form->password),
        ];
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('fe_users');
        $connection->update('fe_users', $userData, ['uid' => $form->userId]);
    }

    public function getPageRowById(int $pageId)
    {
        return BackendUtility::getRecord('pages', $pageId);
    }

    public function activatePage(int $pageId): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->update('pages')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($pageId, \PDO::PARAM_INT))
            )
            ->set('hidden', 0)
            ->execute();
    }


    public function checkIfExists(string $name): int
    {
        $name = trim($name);
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->getRestrictions()->removeByType(HiddenRestriction::class);

        return (int)$queryBuilder
            ->count('*')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('title', $queryBuilder->createNamedParameter($name)),
                $queryBuilder->expr()->eq('doktype', $queryBuilder->createNamedParameter(PageRepository::DOKTYPE_SYSFOLDER, \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($this->extensionConfiguration::getParentUserPid(), \PDO::PARAM_INT))
            )
            ->execute()->fetchOne();
    }

    protected function insertToTable(string $table, array $data): int
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->insert($table)->values($data)->execute();
        return (int)$queryBuilder->getConnection()->lastInsertId($table);
    }

    protected function generatePasswordHash(string $password): string
    {
        $hashInstance = GeneralUtility::makeInstance(PasswordHashFactory::class)->getDefaultHashInstance('FE');
        return $hashInstance->getHashedPassword($password);
    }

}