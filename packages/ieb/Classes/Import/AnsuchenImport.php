<?php

namespace GeorgRinger\Ieb\Import;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class AnsuchenImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->truncateNewTable('tx_ieb_domain_model_ansuchen');
        $rows = $this->getAllFromOldTable('tx_ieb_domain_model_ansuchen');

        foreach ($rows as $row) {
            $this->insert($row);
            $count++;
        }
        return $count;
    }

    protected function insert(array $old): void
    {

        $insert = $old;
        $insert['import'] = $old['uid'];
        $insert['version_active'] = 1;
        $insert['pid'] = $this->getPageIdFromTraegerUid($old['fe_user_traeger']);

        foreach (['fe_user_traeger', 'trainer_array', 'berater_array', 'angebotverantwortlich_array'] as $field) {
            unset($insert[$field]);
        }

        $trainers = $this->split($old['trainer_array']);
        if ($trainers) {
            $queryBuilder = $this->newConnection->createQueryBuilder();
            $rows = $queryBuilder
                ->select('uid')
                ->from('tx_ieb_domain_model_trainer')
                ->where(
                    $queryBuilder->expr()->in('import', $trainers)
                )
                ->execute()
                ->fetchAllAssociative();

            $this->newConnection->delete('tx_ieb_ansuchen_trainer_mm', ['uid_local' => $old['uid']]);
            foreach ($rows as $row) {
                $this->newConnection->insert('tx_ieb_ansuchen_trainer_mm', ['uid_local' => $old['uid'], 'uid_foreign' => $row['uid']]);
            }
            $insert['trainer'] = count($rows);
        }

        $berater = $this->split($old['berater_array']);
        if ($berater) {
            $queryBuilder = $this->newConnection->createQueryBuilder();
            $rows = $queryBuilder
                ->select('uid')
                ->from('tx_ieb_domain_model_berater')
                ->where(
                    $queryBuilder->expr()->in('import', $berater)
                )
                ->execute()
                ->fetchAllAssociative();

            $this->newConnection->delete('tx_ieb_ansuchen_berater_mm', ['uid_local' => $old['uid']]);
            foreach ($rows as $row) {
                $this->newConnection->insert('tx_ieb_ansuchen_berater_mm', ['uid_local' => $old['uid'], 'uid_foreign' => $row['uid']]);
            }
            $insert['berater'] = count($rows);
        }

        if ($old['angebotverantwortlich_array']) {
            // find it by pid
            $queryBuilder = $this->newConnection->createQueryBuilder();
            $page = $queryBuilder
                ->select('uid')
                ->from('pages')
                ->where(
                    $queryBuilder->expr()->eq('title', $old['angebotverantwortlich_array']),
                    $queryBuilder->expr()->eq('pid', 4),
                )
                ->execute()
                ->fetchAssociative();
            $queryBuilder = $this->newConnection->createQueryBuilder();
            $veranwortlichRow = $queryBuilder
                ->select('*')
                ->from('tx_ieb_domain_model_angebotverantwortlich')
                ->where(
                    $queryBuilder->expr()->eq('pid', $page['uid'])
                )
                ->execute()
                ->fetchAssociative();

            $relations = [
                'verantwortliche' => 'tx_ieb_ansuchen_angebotverantwortlich_mm',
                'verantwortliche_mail' => 'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm',
            ];
            foreach ($relations as $field => $mmTable) {
                $this->newConnection->delete($mmTable, ['uid_local' => $old['uid']]);
                $this->newConnection->insert($mmTable, ['uid_local' => $old['uid'], 'uid_foreign' => $veranwortlichRow['uid']]);
                $insert[$field] = 1;
            }
        }


        $this->newConnection->insert('tx_ieb_domain_model_ansuchen', $insert);
    }

    private function split(string $value): array
    {
        return GeneralUtility::trimExplode(';', $value, true);
    }

}