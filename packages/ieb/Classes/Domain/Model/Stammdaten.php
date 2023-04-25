<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * Stammdaten
 */
class Stammdaten extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * markenname
     *
     * @var string
     */
    protected $markenname = '';

    /**
     * nachweis
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $nachweis = null;

    /**
     * rechtsform
     *
     * @var int
     */
    protected $rechtsform = 0;

    /**
     * strasse
     *
     * @var string
     */
    protected $strasse = '';

    /**
     * plz
     *
     * @var int
     */
    protected $plz = 0;

    /**
     * ort
     *
     * @var string
     */
    protected $ort = '';

    /**
     * seit
     *
     * @var string
     */
    protected $seit = '';

    /**
     * website
     *
     * @var string
     */
    protected $website = '';

    /**
     * email
     *
     * @var string
     */
    protected $email = '';

    /**
     * telefon
     *
     * @var string
     */
    protected $telefon = '';

    /**
     * leitbild
     *
     * @var string
     */
    protected $leitbild = '';

    /**
     * leitbildDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $leitbildDatei = null;

    /**
     * qmsZertifikatDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qmsZertifikatDatei = null;

    /**
     * qmsZertifikat
     *
     * @var string
     */
    protected $qmsZertifikat = '';

    /**
     * qmsTyp
     *
     * @var int
     */
    protected $qmsTyp = 0;

    /**
     * qualitaetSicherung
     *
     * @var string
     */
    protected $qualitaetSicherung = '';

    /**
     * zertifikatBis
     *
     * @var \DateTime
     */
    protected $zertifikatBis = null;

    /**
     * qualitaetSicherungDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualitaetSicherungDatei = null;

    /**
     * qualitaetPersonal
     *
     * @var string
     */
    protected $qualitaetPersonal = '';

    /**
     * qualitaetPersonalDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualitaetPersonalDatei = null;

    /**
     * trPp3
     *
     * @var bool
     */
    protected $trPp3 = false;

    /**
     * pruefbescheidDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $pruefbescheidDatei = null;

    /**
     * pruefbescheid
     *
     * @var string
     */
    protected $pruefbescheid = '';

    /**
     * pruefbescheidBis
     *
     * @var \DateTime
     */
    protected $pruefbescheidBis = null;

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

    /**
     * ok
     *
     * @var bool
     */
    protected $ok = false;

    /**
     * standorte
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Standort
     */
    protected $standorte = null;

    /**
     * weiterbildungErklaerung
     *
     * @var bool
     */
    protected $weiterbildungErklaerung = false;

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the nachweis
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getNachweis()
    {
        return $this->nachweis;
    }

    /**
     * Sets the nachweis
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $nachweis
     * @return void
     */
    public function setNachweis($nachweis)
    {
        $this->nachweis = $nachweis;
    }

    /**
     * Returns the rechtsform
     *
     * @return int
     */
    public function getRechtsform()
    {
        return $this->rechtsform;
    }

    /**
     * Sets the rechtsform
     *
     * @param int $rechtsform
     * @return void
     */
    public function setRechtsform(int $rechtsform)
    {
        $this->rechtsform = $rechtsform;
    }

    /**
     * Returns the strasse
     *
     * @return string
     */
    public function getStrasse()
    {
        return $this->strasse;
    }

    /**
     * Sets the strasse
     *
     * @param string $strasse
     * @return void
     */
    public function setStrasse(string $strasse)
    {
        $this->strasse = $strasse;
    }

    /**
     * Returns the plz
     *
     * @return int
     */
    public function getPlz()
    {
        return (int) $this->plz;
    }

    /**
     * Sets the plz
     *
     * @param int $plz
     * @return void
     */
    public function setPlz($plz)
    {
        $this->plz = (int) $plz;
    }

    /**
     * Returns the ort
     *
     * @return string
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * Sets the ort
     *
     * @param string $ort
     * @return void
     */
    public function setOrt(string $ort)
    {
        $this->ort = $ort;
    }

    /**
     * Returns the website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website
     *
     * @param string $website
     * @return void
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * Returns the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Returns the telefon
     *
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Sets the telefon
     *
     * @param string $telefon
     * @return void
     */
    public function setTelefon(string $telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * Returns the leitbild
     *
     * @return string
     */
    public function getLeitbild()
    {
        return $this->leitbild;
    }

    /**
     * Sets the leitbild
     *
     * @param string $leitbild
     * @return void
     */
    public function setLeitbild(string $leitbild)
    {
        $this->leitbild = $leitbild;
    }

    /**
     * Returns the leitbildDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLeitbildDatei()
    {
        return $this->leitbildDatei;
    }

    /**
     * Sets the leitbildDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $leitbildDatei
     * @return void
     */
    public function setLeitbildDatei($leitbildDatei)
    {
        $this->leitbildDatei = $leitbildDatei;
    }

    /**
     * Returns the qmsZertifikatDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQmsZertifikatDatei()
    {
        return $this->qmsZertifikatDatei;
    }

    /**
     * Sets the qmsZertifikatDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qmsZertifikatDatei
     * @return void
     */
    public function setQmsZertifikatDatei($qmsZertifikatDatei)
    {
        $this->qmsZertifikatDatei = $qmsZertifikatDatei;
    }

    /**
     * Returns the qmsZertifikat
     *
     * @return string
     */
    public function getQmsZertifikat()
    {
        return $this->qmsZertifikat;
    }

    /**
     * Sets the qmsZertifikat
     *
     * @param string $qmsZertifikat
     * @return void
     */
    public function setQmsZertifikat(string $qmsZertifikat)
    {
        $this->qmsZertifikat = $qmsZertifikat;
    }

    /**
     * Returns the qmsTyp
     *
     * @return int
     */
    public function getQmsTyp()
    {
        return $this->qmsTyp;
    }

    /**
     * Sets the qmsTyp
     *
     * @param int $qmsTyp
     * @return void
     */
    public function setQmsTyp(int $qmsTyp)
    {
        $this->qmsTyp = $qmsTyp;
    }

    /**
     * Returns the zertifikatBis
     *
     * @return \DateTime
     */
    public function getZertifikatBis()
    {
        return $this->zertifikatBis;
    }

    /**
     * Sets the zertifikatBis
     *
     * @param \DateTime $zertifikatBis
     * @return void
     */
    public function setZertifikatBis(\DateTime $zertifikatBis)
    {
        $this->zertifikatBis = $zertifikatBis;
    }

    /**
     * Returns the qualitaetSicherung
     *
     * @return string
     */
    public function getQualitaetSicherung()
    {
        return $this->qualitaetSicherung;
    }

    /**
     * Sets the qualitaetSicherung
     *
     * @param string $qualitaetSicherung
     * @return void
     */
    public function setQualitaetSicherung(string $qualitaetSicherung)
    {
        $this->qualitaetSicherung = $qualitaetSicherung;
    }

    /**
     * Returns the qualitaetSicherungDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQualitaetSicherungDatei()
    {
        return $this->qualitaetSicherungDatei;
    }

    /**
     * Sets the qualitaetSicherungDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualitaetSicherungDatei
     * @return void
     */
    public function setQualitaetSicherungDatei($qualitaetSicherungDatei)
    {
        $this->qualitaetSicherungDatei = $qualitaetSicherungDatei;
    }

    /**
     * Returns the qualitaetPersonal
     *
     * @return string
     */
    public function getQualitaetPersonal()
    {
        return $this->qualitaetPersonal;
    }

    /**
     * Sets the qualitaetPersonal
     *
     * @param string $qualitaetPersonal
     * @return void
     */
    public function setQualitaetPersonal(string $qualitaetPersonal)
    {
        $this->qualitaetPersonal = $qualitaetPersonal;
    }

    /**
     * Returns the qualitaetPersonalDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQualitaetPersonalDatei()
    {
        return $this->qualitaetPersonalDatei;
    }

    /**
     * Sets the qualitaetPersonalDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualitaetPersonalDatei
     * @return void
     */
    public function setQualitaetPersonalDatei($qualitaetPersonalDatei)
    {
        $this->qualitaetPersonalDatei = $qualitaetPersonalDatei;
    }

    /**
     * Returns the trPp3
     *
     * @return bool
     */
    public function getTrPp3()
    {
        return $this->trPp3;
    }

    /**
     * Sets the trPp3
     *
     * @param bool $trPp3
     * @return void
     */
    public function setTrPp3(bool $trPp3)
    {
        $this->trPp3 = $trPp3;
    }

    /**
     * Returns the boolean state of trPp3
     *
     * @return bool
     */
    public function isTrPp3()
    {
        return $this->trPp3;
    }

    /**
     * Returns the pruefbescheid
     *
     * @return string
     */
    public function getPruefbescheid()
    {
        return $this->pruefbescheid;
    }

    /**
     * Sets the pruefbescheid
     *
     * @param string $pruefbescheid
     * @return void
     */
    public function setPruefbescheid(string $pruefbescheid)
    {
        $this->pruefbescheid = $pruefbescheid;
    }

    /**
     * Returns the pruefbescheidDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getPruefbescheidDatei()
    {
        return $this->pruefbescheidDatei;
    }

    /**
     * Sets the pruefbescheidDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $pruefbescheidDatei
     * @return void
     */
    public function setPruefbescheidDatei($pruefbescheidDatei)
    {
        $this->pruefbescheidDatei = $pruefbescheidDatei;
    }

    /**
     * Returns the pruefbescheidBis
     *
     * @return \DateTime
     */
    public function getPruefbescheidBis()
    {
        return $this->pruefbescheidBis;
    }

    /**
     * Sets the pruefbescheidBis
     *
     * @param \DateTime $pruefbescheidBis
     * @return void
     */
    public function setPruefbescheidBis(\DateTime $pruefbescheidBis)
    {
        $this->pruefbescheidBis = $pruefbescheidBis;
    }

    /**
     * Returns the standorte
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Standort
     */
    public function getStandorte()
    {
        return $this->standorte;
    }

    /**
     * Sets the standorte
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standorte
     * @return void
     */
    public function setStandorte(\GeorgRinger\Ieb\Domain\Model\Standort $standorte)
    {
        $this->standorte = $standorte;
    }

    /**
     * Returns the lockedBy
     *
     * @return int
     */
    public function getLockedBy()
    {
        return $this->lockedBy;
    }

    /**
     * Sets the lockedBy
     *
     * @param int $lockedBy
     * @return void
     */
    public function setLockedBy(int $lockedBy)
    {
        $this->lockedBy = $lockedBy;
    }

    /**
     * Returns the seit
     *
     * @return string seit
     */
    public function getSeit()
    {
        return $this->seit;
    }

    /**
     * Sets the seit
     *
     * @param string $seit
     * @return void
     */
    public function setSeit(string $seit)
    {
        $this->seit = $seit;
    }

    /**
     * Returns the markenname
     *
     * @return string
     */
    public function getMarkenname()
    {
        return $this->markenname;
    }

    /**
     * Sets the markenname
     *
     * @param string $markenname
     * @return void
     */
    public function setMarkenname(string $markenname)
    {
        $this->markenname = $markenname;
    }

    /**
     * Returns the ok
     *
     * @return bool
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * Sets the ok
     *
     * @param bool $ok
     * @return void
     */
    public function setOk(bool $ok)
    {
        $this->ok = $ok;
    }

    /**
     * Returns the boolean state of ok
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->ok;
    }
    public function getAddressFilled()
    {
        return $this->getStrasse() && $this->getPlz() && $this->getOrt();
    }

    /**
     * Returns the weiterbildungErklaerung
     *
     * @return bool
     */
    public function getWeiterbildungErklaerung()
    {
        return $this->weiterbildungErklaerung;
    }

    /**
     * Sets the weiterbildungErklaerung
     *
     * @param bool $weiterbildungErklaerung
     * @return void
     */
    public function setWeiterbildungErklaerung(bool $weiterbildungErklaerung)
    {
        $this->weiterbildungErklaerung = $weiterbildungErklaerung;
    }

    /**
     * Returns the boolean state of weiterbildungErklaerung
     *
     * @return bool
     */
    public function isWeiterbildungErklaerung()
    {
        return $this->weiterbildungErklaerung;
    }
}
