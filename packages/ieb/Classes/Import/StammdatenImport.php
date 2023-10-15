<?php

namespace GeorgRinger\Ieb\Import;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class StammdatenImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->deleteAllFromNewTable('tx_ieb_domain_model_stammdaten');
        $rows = $this->getAllFromOldTable('tx_ieb_domain_model_stammdaten');

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

        foreach (['fe_user_traeger','nachweis_upload','leitbild_datei_upload','qms_zertifikat_datei_upload','qualitaet_sicherung_datei_upload','qualitaet_personal_datei_upload'] as $field) {
            unset($insert[$field]);
        }

        $insert = $this->addFiles($old, $insert, 'tx_ieb_domain_model_stammdaten', ['nachweis_upload' => 'nachweis', 'leitbild_datei_upload' => 'leitbild_datei', 'qms_zertifikat_datei_upload' => 'qms_zertifikat_datei', 'qualitaet_sicherung_datei_upload' => 'qualitaet_sicherung_datei', 'qualitaet_personal_datei_upload' => 'qualitaet_personal_datei']);

        $this->newConnection->insert('tx_ieb_domain_model_stammdaten', $insert);
    }



}