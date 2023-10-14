<?php

namespace GeorgRinger\Ieb\Import;

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


        $this->newConnection->insert('tx_ieb_domain_model_ansuchen', $insert);
    }

}