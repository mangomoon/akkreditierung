<?php

namespace GeorgRinger\Ieb\Import;

class FeUserImport extends AbstractImport
{

    public function run(): int
    {
        $count = 0;
        $this->deleteAllFromNewTable('fe_users');
        $rows = $this->getAllFromOldTable('fe_users_final');

        foreach ($rows as $row) {
            $this->insert($row);
            $count++;
        }
        return $count;
    }

    protected function insert(array $old): void
    {
        $insert = [
            'import' => $old['uid'],
            'tr_admin' => 1,
            'usergroup' => 1,
            'password' => 'xxx',
            'pid' => $this->getPageIdFromTraegerUid($old['uid']),
        ];
        foreach (['ausschluss'] as $field) {
            $insert[$field] = '';
        }

        foreach (['uid', 'tstamp', 'crdate', 'first_name', 'last_name', 'name', 'email', 'telephone', 'fax', 'title', 'zip', 'city', 'company', 'username'] as $field) {
            $insert[$field] = $old[$field];
        }

        $this->newConnection->insert('fe_users', $insert);
    }

}