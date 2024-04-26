<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb;

use Cassandra\Date;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;

class ExtensionConfiguration
{
    protected int $userIdForDatahandler = 1;
    protected int $usergroupEingeladenInaktiv = 999;
    protected int $usergroupAktiv = 1;
    protected int $usergroupAg = 3;
    protected int $usergroupGs = 2;
    protected int $usergroupTr = 1;
    protected int $pageRegistration = 22;
    protected \DateTime $ansuchenEnde;
    protected string $emailAddressGs = 'office@levelup-eb.at';
    /** @var string[]|array[] */
    protected array $emailBabi = [];
    /** @var string[]|array[] */
    protected array $emailPsa = [];
    /** @var int[] */
    protected array $bundeslandUserGroups = [];

    public function __construct()
    {
        $this->ansuchenEnde = new \DateTime('2028-12-31');
        $this->emailBabi = [
            BundeslandEnum::Burgenland->value => ['dieter.szorger@bgld.gv.at','jasmin.karnutsch@bgld.gv.at'],
            BundeslandEnum::Kärnten->value => 'abt13.lebenslangeslernen@ktn.gv.at',
            BundeslandEnum::Niederösterreich->value => 'philipp.roessl@noel.gv.at',
            BundeslandEnum::Oberösterreich->value => ['friederike.koll@ooe.gv.at', 'Theresia.Berger-Schauer@ooe.gv.at'],
            BundeslandEnum::Salzburg->value => ['bildung@salzburg.gv.at','adelheid.duerager@salzburg.gv.at','christine.chum@salzburg.gv.at'],
            BundeslandEnum::Steiermark->value => ['susanne.lucchesi-palli@stmk.gv.at', 'marion.koller@stmk.gv.at'],
            BundeslandEnum::Tirol->value => ['f.jenewein@grillhof.at','maria.heim@tirol.gv.at','melanie.wiener@tirol.gv.at'],
            BundeslandEnum::Vorarlberg->value => 'IIb@vorarlberg.at',
            BundeslandEnum::Wien->value => 'eb@ma17.wien.gv.at',
        ];
        $this->emailPsa = [
            BundeslandEnum::Burgenland->value => ['dieter.szorger@bgld.gv.at','jasmin.karnutsch@bgld.gv.at'],
            BundeslandEnum::Kärnten->value => 'abt13.lebenslangeslernen@ktn.gv.at',
            BundeslandEnum::Niederösterreich->value => 'philipp.roessl@noel.gv.at',
            BundeslandEnum::Oberösterreich->value => ['friederike.koll@ooe.gv.at', 'Theresia.Berger-Schauer@ooe.gv.at'],
            BundeslandEnum::Salzburg->value => ['bildung@salzburg.gv.at','adelheid.duerager@salzburg.gv.at','christine.chum@salzburg.gv.at'],
            BundeslandEnum::Steiermark->value => ['susanne.lucchesi-palli@stmk.gv.at', 'marion.koller@stmk.gv.at'],
            BundeslandEnum::Tirol->value => ['f.jenewein@grillhof.at','maria.heim@tirol.gv.at','melanie.wiener@tirol.gv.at'],
            BundeslandEnum::Vorarlberg->value => 'IIb@vorarlberg.at',
            BundeslandEnum::Wien->value => 'eb@ma13.wien.gv.at',
        ];
        $this->bundeslandUserGroups = [
            BundeslandEnum::Burgenland->value => 15,
            BundeslandEnum::Kärnten->value => 9,
            BundeslandEnum::Niederösterreich->value => 7,
            BundeslandEnum::Oberösterreich->value => 8,
            BundeslandEnum::Salzburg->value => 10,
            BundeslandEnum::Steiermark->value => 11,
            BundeslandEnum::Tirol->value => 12,
            BundeslandEnum::Vorarlberg->value => 13,
            BundeslandEnum::Wien->value => 14,
        ];
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

    public function getUsergroupTr(): int
    {
        return $this->usergroupTr;
    }

    public function getAnsuchenEnde(): \DateTime
    {
        return $this->ansuchenEnde;
    }

    public function getEmailAddressGs(): string
    {
        return $this->emailAddressGs;
    }

    public function getEmailBabi(): array
    {
        return $this->emailBabi;
    }

    public function getEmailPsa(): array
    {
        return $this->emailPsa;
    }

    public function getBundeslandUserGroups(): array
    {
        return $this->bundeslandUserGroups;
    }
}