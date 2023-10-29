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
    protected int $pageRegistration = 22;
    protected \DateTime $ansuchenEnde;
    protected string $emailAddressGs = 'office@initiative-erwachsenenbildung.at';
    /** @var string[]|array[] */
    protected array $emailBabi = [];
    /** @var string[]|array[] */
    protected array $emailPsa = [];

    public function __construct()
    {
        $this->ansuchenEnde = new \DateTime('2028-12-31');
        $this->emailBabi = [
            BundeslandEnum::Burgenland->value => 'dieter.szorger@bgld.gv.at',
            BundeslandEnum::Kärnten->value => 'nadine.hell@ktn.gv.at',
            BundeslandEnum::Niederösterreich->value => 'philipp.roessl@noel.gv.at',
            BundeslandEnum::Oberösterreich->value => ['guenter.brandstetter@ooe.gv.at', 'Theresia.Berger-Schauer@ooe.gv.at'],
            BundeslandEnum::Salzburg->value => 'bildung@salzburg.gv.at',
            BundeslandEnum::Steiermark->value => ['susanne.lucchesi-palli@stmk.gv.at', 'marion.koller@stmk.gv.at'],
            BundeslandEnum::Tirol->value => 'kultur@tirol.gv.at',
            BundeslandEnum::Vorarlberg->value => 'wissenschaft@vorarlberg.at',
            BundeslandEnum::Wien->value => 'eb@ma13.wien.gv.at',
        ];
        $this->emailPsa = [
            BundeslandEnum::Burgenland->value => 'dieter.szorger@bgld.gv.at',
            BundeslandEnum::Kärnten->value => 'nadine.hell@ktn.gv.at',
            BundeslandEnum::Niederösterreich->value => 'philipp.roessl@noel.gv.at',
            BundeslandEnum::Oberösterreich->value => ['guenter.brandstetter@ooe.gv.at', 'Theresia.Berger-Schauer@ooe.gv.at'],
            BundeslandEnum::Salzburg->value => 'bildung@salzburg.gv.at', 
            BundeslandEnum::Steiermark->value => ['susanne.lucchesi-palli@stmk.gv.at', 'marion.koller@stmk.gv.at'],
            BundeslandEnum::Tirol->value => 'kultur@tirol.gv.at',
            BundeslandEnum::Vorarlberg->value => 'wissenschaft@vorarlberg.at',
            BundeslandEnum::Wien->value => 'eb@ma13.wien.gv.at',
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

}