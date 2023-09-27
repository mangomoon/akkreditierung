<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb;

use Cassandra\Date;

class ExtensionConfiguration
{

    protected int $userIdForDatahandler = 1;
    protected int $usergroupEingeladenInaktiv = 3;
    protected int $usergroupAktiv = 1;
    protected int $usergroupAg = 99;
    protected int $pageRegistration = 22;
    protected \DateTime $ansuchenEnde;
    protected string $emailAddressGs = 'office@initiative-erwachsenenbildung.at';

    public function __construct() {
        $this->ansuchenEnde = new \DateTime('2027-12-31');
    }


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

    public function getAnsuchenEnde(): \DateTime
    {
        return $this->ansuchenEnde;
    }

    public function getEmailAddressGs(): string
    {
        return $this->emailAddressGs;
    }

}