<?php

namespace GeorgRinger\Ieb\Import;

class BeraterImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->deleteAllFromNewTable('tx_ieb_domain_model_berater');
        $rows = $this->getAllFromOldTable('tx_ieb_domain_model_berater');

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

        foreach (['fe_user_traeger', 'lebenslauf_datei_upload', 'qualifikationsnachweise_upload'] as $field) {
            unset($insert[$field]);
        }

        $insert = $this->addFiles($old, $insert, 'tx_ieb_domain_model_berater', ['lebenslauf_datei_upload' => 'lebenslauf', 'qualifikationsnachweise_upload' => 'qualifikationsnachweise']);



        $this->newConnection->insert('tx_ieb_domain_model_berater', $insert);
    }

}