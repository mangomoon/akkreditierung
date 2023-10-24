<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb;

use Cassandra\Date;

class ExtensionConfiguration
{
    protected int $userIdForDatahandler = 1;
    protected int $usergroupEingeladenInaktiv = 3;
    protected int $usergroupAktiv = 1;
    protected int $usergroupAg = 3;
    protected int $usergroupGs = 2;
    protected int $pageRegistration = 22;
    protected \DateTime $ansuchenEnde;
    protected string $emailAddressGs = 'office@initiative-erwachsenenbildung.at';
    protected string $emailBabiBurgenland = 'dieter.szorger@bgld.gv.at';
    protected string $emailBabiKärnten = 'nadine.hell@ktn.gv.at';
    protected string $emailBabiNiederoesterreich = 'philipp.roessl@noel.gv.at';
    protected string $emailBabiOberoesterreich = 'guenter.brandstetter@ooe.gv.at';
    protected string $emailBabiSalzburg = 'bildung@salzburg.gv.at';
    protected string $emailBabiSteiermark = 'susanne.lucchesi-palli@stmk.gv.at';
    protected string $emailBabiTirol = 'kultur@tirol.gv.at';
    protected string $emailBabiVorarlberg = 'wissenschaft@vorarlberg.at';
    protected string $emailBabiWien = 'eb@ma13.wien.gv.at';
    protected string $emailPsaBurgenland = 'dieter.szorger@bgld.gv.at';
    protected string $emailPsaKärnten = 'nadine.hell@ktn.gv.at';
    protected string $emailPsaNiederoesterreich = 'philipp.roessl@noel.gv.at';
    protected string $emailPsaOberoesterreich = 'guenter.brandstetter@ooe.gv.at';
    protected string $emailPsaSalzburg = 'bildung@salzburg.gv.at';
    protected string $emailPsaSteiermark = 'susanne.lucchesi-palli@stmk.gv.at';
    protected string $emailPsaTirol = 'kultur@tirol.gv.at';
    protected string $emailPsaVorarlberg = 'wissenschaft@vorarlberg.at';
    protected string $emailPsaWien = 'eb@ma13.wien.gv.at';



    public function __construct() {
        $this->ansuchenEnde = new \DateTime('2028-12-31');
    }


    public function getUserIdForDatahandler(): int
    {
        return $this->userIdForDatahandler;
    }

    public static function getParentUserPid(): int
    {
        return 4;
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

    public function getUsergroupGs(): int
    {
        return $this->usergroupGs;
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