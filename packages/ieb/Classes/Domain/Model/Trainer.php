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
 * Trainer
 */
class Trainer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \DateTime
     */
    public $tstamp = null;

    /**
     * @var \DateTime
     */
    public $crdate = null;

    /**
     * nachname
     *
     * @var string
     */
    protected $nachname = '';

    /**
     * vorname
     *
     * @var string
     */
    protected $vorname = '';

    /**
     * verwendungBabi
     *
     * @var bool
     */
    protected $verwendungBabi = false;

    /**
     * verwendungPsa
     *
     * @var bool
     */
    protected $verwendungPsa = false;

    /**
     * lebenslauf
     *
     * @var string
     */
    protected $lebenslauf = '';

    /**
     * qualifikationBabi
     *
     * @var string
     */
    protected $qualifikationBabi = '';

    /**
     * lehrBefugnis
     *
     * @var string
     */
    protected $lehrBefugnis = '';

    /**
     * qualifikationPsa1
     *
     * @var bool
     */
    protected $qualifikationPsa1 = false;

    /**
     * qualifikationPsa2
     *
     * @var bool
     */
    protected $qualifikationPsa2 = false;

    /**
     * qualifikationPsa3
     *
     * @var bool
     */
    protected $qualifikationPsa3 = false;

    /**
     * qualifikationPsa4
     *
     * @var bool
     */
    protected $qualifikationPsa4 = false;

    /**
     * qualifikationPsa5
     *
     * @var bool
     */
    protected $qualifikationPsa5 = false;

    /**
     * qualifikationPsa6
     *
     * @var bool
     */
    protected $qualifikationPsa6 = false;

    /**
     * qualifikationPsa7
     *
     * @var bool
     */
    protected $qualifikationPsa7 = false;

    /**
     * qualifikationPsa8
     *
     * @var bool
     */
    protected $qualifikationPsa8 = false;

    /**
     * qualifikationPsa
     *
     * @var string
     */
    protected $qualifikationPsa = '';

    /**
     * qualifikationPsaKommentar
     *
     * @var string
     */
    protected $qualifikationPsaKommentar = '';

    /**
     * anerkennungPp3
     *
     * @var bool
     */
    protected $anerkennungPp3 = false;

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * lebenslaufDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lebenslaufDatei = null;

    /**
     * qualifikationBabiDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationBabiDatei = null;

    /**
     * lehrBefugnisDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lehrBefugnisDatei = null;

    /**
     * qualifikationPsaDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationPsaDatei = null;

    /**
     * ok
     *
     * @var bool
     */
    protected $ok = false;

    /**
     * archiviert
     *
     * @var bool
     */
    protected $archiviert = false;

    /**
     * Returns the nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Sets the nachname
     *
     * @param string $nachname
     * @return void
     */
    public function setNachname(string $nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * Returns the vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Sets the vorname
     *
     * @param string $vorname
     * @return void
     */
    public function setVorname(string $vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * Returns the verwendungBabi
     *
     * @return bool
     */
    public function getVerwendungBabi()
    {
        return $this->verwendungBabi;
    }

    /**
     * Sets the verwendungBabi
     *
     * @param bool $verwendungBabi
     * @return void
     */
    public function setVerwendungBabi(bool $verwendungBabi)
    {
        $this->verwendungBabi = $verwendungBabi;
    }

    /**
     * Returns the boolean state of verwendungBabi
     *
     * @return bool
     */
    public function isVerwendungBabi()
    {
        return $this->verwendungBabi;
    }

    /**
     * Returns the verwendungPsa
     *
     * @return bool
     */
    public function getVerwendungPsa()
    {
        return $this->verwendungPsa;
    }

    /**
     * Sets the verwendungPsa
     *
     * @param bool $verwendungPsa
     * @return void
     */
    public function setVerwendungPsa(bool $verwendungPsa)
    {
        $this->verwendungPsa = $verwendungPsa;
    }

    /**
     * Returns the boolean state of verwendungPsa
     *
     * @return bool
     */
    public function isVerwendungPsa()
    {
        return $this->verwendungPsa;
    }

    /**
     * Returns the lebenslauf
     *
     * @return string
     */
    public function getLebenslauf()
    {
        return $this->lebenslauf;
    }

    /**
     * Sets the lebenslauf
     *
     * @param string $lebenslauf
     * @return void
     */
    public function setLebenslauf(string $lebenslauf)
    {
        $this->lebenslauf = $lebenslauf;
    }

    /**
     * Returns the qualifikationBabi
     *
     * @return string
     */
    public function getQualifikationBabi()
    {
        return $this->qualifikationBabi;
    }

    /**
     * Sets the qualifikationBabi
     *
     * @param string $qualifikationBabi
     * @return void
     */
    public function setQualifikationBabi(string $qualifikationBabi)
    {
        $this->qualifikationBabi = $qualifikationBabi;
    }

    /**
     * Returns the lehrBefugnis
     *
     * @return string
     */
    public function getLehrBefugnis()
    {
        return $this->lehrBefugnis;
    }

    /**
     * Sets the lehrBefugnis
     *
     * @param string $lehrBefugnis
     * @return void
     */
    public function setLehrBefugnis(string $lehrBefugnis)
    {
        $this->lehrBefugnis = $lehrBefugnis;
    }

    /**
     * Returns the qualifikationPsa1
     *
     * @return bool
     */
    public function getQualifikationPsa1()
    {
        return $this->qualifikationPsa1;
    }

    /**
     * Sets the qualifikationPsa1
     *
     * @param bool $qualifikationPsa1
     * @return void
     */
    public function setQualifikationPsa1(bool $qualifikationPsa1)
    {
        $this->qualifikationPsa1 = $qualifikationPsa1;
    }

    /**
     * Returns the boolean state of qualifikationPsa1
     *
     * @return bool
     */
    public function isQualifikationPsa1()
    {
        return $this->qualifikationPsa1;
    }

    /**
     * Returns the qualifikationPsa2
     *
     * @return bool
     */
    public function getQualifikationPsa2()
    {
        return $this->qualifikationPsa2;
    }

    /**
     * Sets the qualifikationPsa2
     *
     * @param bool $qualifikationPsa2
     * @return void
     */
    public function setQualifikationPsa2(bool $qualifikationPsa2)
    {
        $this->qualifikationPsa2 = $qualifikationPsa2;
    }

    /**
     * Returns the boolean state of qualifikationPsa2
     *
     * @return bool
     */
    public function isQualifikationPsa2()
    {
        return $this->qualifikationPsa2;
    }

    /**
     * Returns the qualifikationPsa3
     *
     * @return bool
     */
    public function getQualifikationPsa3()
    {
        return $this->qualifikationPsa3;
    }

    /**
     * Sets the qualifikationPsa3
     *
     * @param bool $qualifikationPsa3
     * @return void
     */
    public function setQualifikationPsa3(bool $qualifikationPsa3)
    {
        $this->qualifikationPsa3 = $qualifikationPsa3;
    }

    /**
     * Returns the boolean state of qualifikationPsa3
     *
     * @return bool
     */
    public function isQualifikationPsa3()
    {
        return $this->qualifikationPsa3;
    }

    /**
     * Returns the qualifikationPsa4
     *
     * @return bool
     */
    public function getQualifikationPsa4()
    {
        return $this->qualifikationPsa4;
    }

    /**
     * Sets the qualifikationPsa4
     *
     * @param bool $qualifikationPsa4
     * @return void
     */
    public function setQualifikationPsa4(bool $qualifikationPsa4)
    {
        $this->qualifikationPsa4 = $qualifikationPsa4;
    }

    /**
     * Returns the boolean state of qualifikationPsa4
     *
     * @return bool
     */
    public function isQualifikationPsa4()
    {
        return $this->qualifikationPsa4;
    }

    /**
     * Returns the qualifikationPsa5
     *
     * @return bool
     */
    public function getQualifikationPsa5()
    {
        return $this->qualifikationPsa5;
    }

    /**
     * Sets the qualifikationPsa5
     *
     * @param bool $qualifikationPsa5
     * @return void
     */
    public function setQualifikationPsa5(bool $qualifikationPsa5)
    {
        $this->qualifikationPsa5 = $qualifikationPsa5;
    }

    /**
     * Returns the boolean state of qualifikationPsa5
     *
     * @return bool
     */
    public function isQualifikationPsa5()
    {
        return $this->qualifikationPsa5;
    }

    /**
     * Returns the qualifikationPsa6
     *
     * @return bool
     */
    public function getQualifikationPsa6()
    {
        return $this->qualifikationPsa6;
    }

    /**
     * Sets the qualifikationPsa6
     *
     * @param bool $qualifikationPsa6
     * @return void
     */
    public function setQualifikationPsa6(bool $qualifikationPsa6)
    {
        $this->qualifikationPsa6 = $qualifikationPsa6;
    }

    /**
     * Returns the boolean state of qualifikationPsa6
     *
     * @return bool
     */
    public function isQualifikationPsa6()
    {
        return $this->qualifikationPsa6;
    }

    /**
     * Returns the qualifikationPsa7
     *
     * @return bool
     */
    public function getQualifikationPsa7()
    {
        return $this->qualifikationPsa7;
    }

    /**
     * Sets the qualifikationPsa7
     *
     * @param bool $qualifikationPsa7
     * @return void
     */
    public function setQualifikationPsa7(bool $qualifikationPsa7)
    {
        $this->qualifikationPsa7 = $qualifikationPsa7;
    }

    /**
     * Returns the boolean state of qualifikationPsa7
     *
     * @return bool
     */
    public function isQualifikationPsa7()
    {
        return $this->qualifikationPsa7;
    }

    /**
     * Returns the qualifikationPsa8
     *
     * @return bool
     */
    public function getQualifikationPsa8()
    {
        return $this->qualifikationPsa8;
    }

    /**
     * Sets the qualifikationPsa8
     *
     * @param bool $qualifikationPsa8
     * @return void
     */
    public function setQualifikationPsa8(bool $qualifikationPsa8)
    {
        $this->qualifikationPsa8 = $qualifikationPsa8;
    }

    /**
     * Returns the boolean state of qualifikationPsa8
     *
     * @return bool
     */
    public function isQualifikationPsa8()
    {
        return $this->qualifikationPsa8;
    }

    /**
     * Returns the qualifikationPsa
     *
     * @return string
     */
    public function getQualifikationPsa()
    {
        return $this->qualifikationPsa;
    }

    /**
     * Sets the qualifikationPsa
     *
     * @param string $qualifikationPsa
     * @return void
     */
    public function setQualifikationPsa(string $qualifikationPsa)
    {
        $this->qualifikationPsa = $qualifikationPsa;
    }

    /**
     * Returns the qualifikationPsaKommentar
     *
     * @return string
     */
    public function getQualifikationPsaKommentar()
    {
        return $this->qualifikationPsaKommentar;
    }

    /**
     * Sets the qualifikationPsaKommentar
     *
     * @param string $qualifikationPsaKommentar
     * @return void
     */
    public function setQualifikationPsaKommentar(string $qualifikationPsaKommentar)
    {
        $this->qualifikationPsaKommentar = $qualifikationPsaKommentar;
    }

    /**
     * Returns the anerkennungPp3
     *
     * @return bool
     */
    public function getAnerkennungPp3()
    {
        return $this->anerkennungPp3;
    }

    /**
     * Sets the anerkennungPp3
     *
     * @param bool $anerkennungPp3
     * @return void
     */
    public function setAnerkennungPp3(bool $anerkennungPp3)
    {
        $this->anerkennungPp3 = $anerkennungPp3;
    }

    /**
     * Returns the boolean state of anerkennungPp3
     *
     * @return bool
     */
    public function isAnerkennungPp3()
    {
        return $this->anerkennungPp3;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function getVollerName()
    {
        return $this->vorname . ' ' . $this->nachname;
    }

    /**
     * Returns the lebenslaufDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLebenslaufDatei()
    {
        return $this->lebenslaufDatei;
    }

    /**
     * Sets the lebenslaufDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslaufDatei
     * @return void
     */
    public function setLebenslaufDatei($lebenslaufDatei)
    {
        $this->lebenslaufDatei = $lebenslaufDatei;
    }

    /**
     * Returns the qualifikationBabiDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQualifikationBabiDatei()
    {
        return $this->qualifikationBabiDatei;
    }

    /**
     * Sets the qualifikationBabiDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationBabiDatei
     * @return void
     */
    public function setQualifikationBabiDatei($qualifikationBabiDatei)
    {
        $this->qualifikationBabiDatei = $qualifikationBabiDatei;
    }

    /**
     * Returns the lehrBefugnisDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLehrBefugnisDatei()
    {
        return $this->lehrBefugnisDatei;
    }

    /**
     * Sets the lehrBefugnisDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lehrBefugnisDatei
     * @return void
     */
    public function setLehrBefugnisDatei($lehrBefugnisDatei)
    {
        $this->lehrBefugnisDatei = $lehrBefugnisDatei;
    }

    /**
     * Returns the qualifikationPsaDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQualifikationPsaDatei()
    {
        return $this->qualifikationPsaDatei;
    }

    /**
     * Sets the qualifikationPsaDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationPsaDatei
     * @return void
     */
    public function setQualifikationPsaDatei($qualifikationPsaDatei)
    {
        $this->qualifikationPsaDatei = $qualifikationPsaDatei;
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

    /**
     * Returns the archiviert
     *
     * @return bool
     */
    public function getArchiviert()
    {
        return $this->archiviert;
    }

    /**
     * Sets the archiviert
     *
     * @param bool $archiviert
     * @return void
     */
    public function setArchiviert(bool $archiviert)
    {
        $this->archiviert = $archiviert;
    }

    /**
     * Returns the boolean state of archiviert
     *
     * @return bool
     */
    public function isArchiviert()
    {
        return $this->archiviert;
    }
}
