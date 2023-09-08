<?php

namespace GeorgRinger\Ieb;

class ExtensionConfiguration
{

    protected int $userIdForDatahandler = 1;
    protected int $usergroupEingeladenInaktiv = 3;
    protected int $usergroupAktiv = 1;
    protected int $usergroupAg = 99;
    protected int $pageRegistration = 15;


    public function getUserIdForDatahandler(): int
    {
        return $this->userIdForDatahandler;
    }

    public static function getParentUserPid(): int
    {
        return 14;
    }

    public function getUsergroupEingeladenInaktiv(): int
    {
        return $this->usergroupEingeladenInaktiv;
    }

    public function getUsergroupAktiv(): int
    {
        return $this->usergroupAktiv;
    }

    public function getPageRegistration(): int
    {
        return $this->pageRegistration;
    }

    public function getUsergroupAg(): int
    {
        return $this->usergroupAg;
    }

}