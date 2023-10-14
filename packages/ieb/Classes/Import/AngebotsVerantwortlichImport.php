<?php

namespace GeorgRinger\Ieb\Import;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class AngebotsVerantwortlichImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->deleteAllFromNewTable('tx_ieb_domain_model_angebotverantwortlich');
        $rows = $this->getAllFromOldTable('tx_ieb_domain_model_angebotverantwortlich');

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
        $insert['pid'] = $this->getPageIdFromTraegerUid($old['fe_user_traeger']);

        foreach (['fe_user_traeger'] as $field) {
            unset($insert[$field]);
        }

        $this->newConnection->insert('tx_ieb_domain_model_angebotverantwortlich', $insert);
    }



}