<?php

namespace GeorgRinger\Ieb\Import;

class TrainerImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->deleteAllFromNewTable('tx_ieb_domain_model_trainer');
        $rows = $this->getAllFromOldTable('tx_ieb_domain_model_trainer');

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

        foreach (['fe_user_traeger', 'lebenslauf_upload', 'qualifikation_babi_datei_upload', 'qualifikation_psa_datei_upload'] as $field) {
            unset($insert[$field]);
        }

        $insert = $this->addFiles($old, $insert, 'tx_ieb_domain_model_stammdaten', ['lebenslauf_upload' => 'lebenslauf_upload', 'qualifikation_babi_datei_upload' => 'qualifikation_babi_datei', 'qualifikation_psa_datei_upload' => 'qualifikation_psa_datei']);


        $this->newConnection->insert('tx_ieb_domain_model_trainer', $insert);
    }

}