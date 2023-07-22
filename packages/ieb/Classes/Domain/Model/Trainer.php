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
     * lebenslaufDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lebenslaufDatei = null;

    /**
     * qualifikationBabiDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationBabiDatei = null;

    /**
     * lehrBefugnisDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lehrBefugnisDatei = null;

    /**
     * qualifikationPsaDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationPsaDatei = null;

    /**
     * okbabi
     *
     * @var bool
     */
    protected $okbabi = false;

    /**
     * okpsa
     *
     * @var bool
     */
    protected $okpsa = false;

    /**
     * archiviert
     *
     * @var bool
     */
    protected $archiviert = false;

    /**
     * reviewC21BabiStatus
     *
     * @var int
     */
    protected $reviewC21BabiStatus = 0;

    /**
     * reviewC21PsaStatus
     *
     * @var int
     */
    protected $reviewC21PsaStatus = 0;

    /**
     * reviewC22BabiStatus
     *
     * @var int
     */
    protected $reviewC22BabiStatus = 0;

    /**
     * reviewC22PsaStatus
     *
     * @var int
     */
    protected $reviewC22PsaStatus = 0;

    /**
     * reviewC22Quali1
     *
     * @var bool
     */
    protected $reviewC22Quali1 = false;

    /**
     * reviewC22Quali2
     *
     * @var bool
     */
    protected $reviewC22Quali2 = false;

    /**
     * reviewC22Quali3
     *
     * @var bool
     */
    protected $reviewC22Quali3 = false;

    /**
     * reviewC22Quali4
     *
     * @var bool
     */
    protected $reviewC22Quali4 = false;

    /**
     * reviewC22Quali5
     *
     * @var bool
     */
    protected $reviewC22Quali5 = false;

    /**
     * reviewC22Quali6
     *
     * @var bool
     */
    protected $reviewC22Quali6 = false;

    /**
     * reviewC22Quali7
     *
     * @var bool
     */
    protected $reviewC22Quali7 = false;

    /**
     * reviewC22Quali8
     *
     * @var bool
     */
    protected $reviewC22Quali8 = false;

    /**
     * reviewC2BabiCommentInternal
     *
     * @var string
     */
    protected $reviewC2BabiCommentInternal = '';

    /**
     * reviewC2BabiCommentTr
     *
     * @var string
     */
    protected $reviewC2BabiCommentTr = '';

    /**
     * reviewC2PsaCommentInternal
     *
     * @var string
     */
    protected $reviewC2PsaCommentInternal = '';

    /**
     * reviewC2PsaCommentTr
     *
     * @var string
     */
    protected $reviewC2PsaCommentTr = '';

    /**
     * reviewC2PsaCommentInternalStep
     *
     * @var string
     */
    protected $reviewC2PsaCommentInternalStep = '';

    /**
     * reviewC2BabiCommentInternalStep
     *
     * @var string
     */
    protected $reviewC2BabiCommentInternalStep = '';

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

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
    public function getFullName()
    {
        return implode(' ', array_filter([$this->vorname, $this->nachname]));
    }

    /**
     * Returns the okbabi
     *
     * @return bool okbabi
     */
    public function getOkbabi()
    {
        return $this->okbabi;
    }

    /**
     * Sets the okbabi
     *
     * @param bool $okbabi
     * @return void
     */
    public function setOkbabi(bool $okbabi)
    {
        $this->okbabi = $okbabi;
    }

    /**
     * Returns the boolean state of okbabi
     *
     * @return bool okbabi
     */
    public function isOkbabi()
    {
        return $this->okbabi;
    }

    /**
     * Returns the okpsa
     *
     * @return bool
     */
    public function getOkpsa()
    {
        return $this->okpsa;
    }

    /**
     * Sets the okpsa
     *
     * @param bool $okpsa
     * @return void
     */
    public function setOkpsa(bool $okpsa)
    {
        $this->okpsa = $okpsa;
    }

    /**
     * Returns the boolean state of okpsa
     *
     * @return bool
     */
    public function isOkpsa()
    {
        return $this->okpsa;
    }

    /**
     * Returns the reviewC21BabiStatus
     *
     * @return int
     */
    public function getReviewC21BabiStatus()
    {
        return $this->reviewC21BabiStatus;
    }

    /**
     * Sets the reviewC21BabiStatus
     *
     * @param int $reviewC21BabiStatus
     * @return void
     */
    public function setReviewC21BabiStatus(int $reviewC21BabiStatus)
    {
        $this->reviewC21BabiStatus = $reviewC21BabiStatus;
    }

    /**
     * Returns the reviewC21PsaStatus
     *
     * @return int
     */
    public function getReviewC21PsaStatus()
    {
        return $this->reviewC21PsaStatus;
    }

    /**
     * Sets the reviewC21PsaStatus
     *
     * @param int $reviewC21PsaStatus
     * @return void
     */
    public function setReviewC21PsaStatus(int $reviewC21PsaStatus)
    {
        $this->reviewC21PsaStatus = $reviewC21PsaStatus;
    }

    /**
     * Returns the reviewC22BabiStatus
     *
     * @return int
     */
    public function getReviewC22BabiStatus()
    {
        return $this->reviewC22BabiStatus;
    }

    /**
     * Sets the reviewC22BabiStatus
     *
     * @param int $reviewC22BabiStatus
     * @return void
     */
    public function setReviewC22BabiStatus(int $reviewC22BabiStatus)
    {
        $this->reviewC22BabiStatus = $reviewC22BabiStatus;
    }

    /**
     * Returns the reviewC22PsaStatus
     *
     * @return int
     */
    public function getReviewC22PsaStatus()
    {
        return $this->reviewC22PsaStatus;
    }

    /**
     * Sets the reviewC22PsaStatus
     *
     * @param int $reviewC22PsaStatus
     * @return void
     */
    public function setReviewC22PsaStatus(int $reviewC22PsaStatus)
    {
        $this->reviewC22PsaStatus = $reviewC22PsaStatus;
    }

    /**
     * Returns the reviewC22Quali1
     *
     * @return bool
     */
    public function getReviewC22Quali1()
    {
        return $this->reviewC22Quali1;
    }

    /**
     * Sets the reviewC22Quali1
     *
     * @param bool $reviewC22Quali1
     * @return void
     */
    public function setReviewC22Quali1(bool $reviewC22Quali1)
    {
        $this->reviewC22Quali1 = $reviewC22Quali1;
    }

    /**
     * Returns the boolean state of reviewC22Quali1
     *
     * @return bool
     */
    public function isReviewC22Quali1()
    {
        return $this->reviewC22Quali1;
    }

    /**
     * Returns the reviewC22Quali2
     *
     * @return bool
     */
    public function getReviewC22Quali2()
    {
        return $this->reviewC22Quali2;
    }

    /**
     * Sets the reviewC22Quali2
     *
     * @param bool $reviewC22Quali2
     * @return void
     */
    public function setReviewC22Quali2(bool $reviewC22Quali2)
    {
        $this->reviewC22Quali2 = $reviewC22Quali2;
    }

    /**
     * Returns the boolean state of reviewC22Quali2
     *
     * @return bool
     */
    public function isReviewC22Quali2()
    {
        return $this->reviewC22Quali2;
    }

    /**
     * Returns the reviewC22Quali3
     *
     * @return bool
     */
    public function getReviewC22Quali3()
    {
        return $this->reviewC22Quali3;
    }

    /**
     * Sets the reviewC22Quali3
     *
     * @param bool $reviewC22Quali3
     * @return void
     */
    public function setReviewC22Quali3(bool $reviewC22Quali3)
    {
        $this->reviewC22Quali3 = $reviewC22Quali3;
    }

    /**
     * Returns the boolean state of reviewC22Quali3
     *
     * @return bool
     */
    public function isReviewC22Quali3()
    {
        return $this->reviewC22Quali3;
    }

    /**
     * Returns the reviewC22Quali4
     *
     * @return bool
     */
    public function getReviewC22Quali4()
    {
        return $this->reviewC22Quali4;
    }

    /**
     * Sets the reviewC22Quali4
     *
     * @param bool $reviewC22Quali4
     * @return void
     */
    public function setReviewC22Quali4(bool $reviewC22Quali4)
    {
        $this->reviewC22Quali4 = $reviewC22Quali4;
    }

    /**
     * Returns the boolean state of reviewC22Quali4
     *
     * @return bool
     */
    public function isReviewC22Quali4()
    {
        return $this->reviewC22Quali4;
    }

    /**
     * Returns the reviewC22Quali5
     *
     * @return bool
     */
    public function getReviewC22Quali5()
    {
        return $this->reviewC22Quali5;
    }

    /**
     * Sets the reviewC22Quali5
     *
     * @param bool $reviewC22Quali5
     * @return void
     */
    public function setReviewC22Quali5(bool $reviewC22Quali5)
    {
        $this->reviewC22Quali5 = $reviewC22Quali5;
    }

    /**
     * Returns the boolean state of reviewC22Quali5
     *
     * @return bool
     */
    public function isReviewC22Quali5()
    {
        return $this->reviewC22Quali5;
    }

    /**
     * Returns the reviewC22Quali6
     *
     * @return bool
     */
    public function getReviewC22Quali6()
    {
        return $this->reviewC22Quali6;
    }

    /**
     * Sets the reviewC22Quali6
     *
     * @param bool $reviewC22Quali6
     * @return void
     */
    public function setReviewC22Quali6(bool $reviewC22Quali6)
    {
        $this->reviewC22Quali6 = $reviewC22Quali6;
    }

    /**
     * Returns the boolean state of reviewC22Quali6
     *
     * @return bool
     */
    public function isReviewC22Quali6()
    {
        return $this->reviewC22Quali6;
    }

    /**
     * Returns the reviewC22Quali7
     *
     * @return bool
     */
    public function getReviewC22Quali7()
    {
        return $this->reviewC22Quali7;
    }

    /**
     * Sets the reviewC22Quali7
     *
     * @param bool $reviewC22Quali7
     * @return void
     */
    public function setReviewC22Quali7(bool $reviewC22Quali7)
    {
        $this->reviewC22Quali7 = $reviewC22Quali7;
    }

    /**
     * Returns the boolean state of reviewC22Quali7
     *
     * @return bool
     */
    public function isReviewC22Quali7()
    {
        return $this->reviewC22Quali7;
    }

    /**
     * Returns the reviewC22Quali8
     *
     * @return bool
     */
    public function getReviewC22Quali8()
    {
        return $this->reviewC22Quali8;
    }

    /**
     * Sets the reviewC22Quali8
     *
     * @param bool $reviewC22Quali8
     * @return void
     */
    public function setReviewC22Quali8(bool $reviewC22Quali8)
    {
        $this->reviewC22Quali8 = $reviewC22Quali8;
    }

    /**
     * Returns the boolean state of reviewC22Quali8
     *
     * @return bool
     */
    public function isReviewC22Quali8()
    {
        return $this->reviewC22Quali8;
    }

    /**
     * Returns the reviewC2BabiCommentInternal
     *
     * @return string
     */
    public function getReviewC2BabiCommentInternal()
    {
        return $this->reviewC2BabiCommentInternal;
    }

    /**
     * Sets the reviewC2BabiCommentInternal
     *
     * @param string $reviewC2BabiCommentInternal
     * @return void
     */
    public function setReviewC2BabiCommentInternal(string $reviewC2BabiCommentInternal)
    {
        $this->reviewC2BabiCommentInternal = $reviewC2BabiCommentInternal;
    }

    /**
     * Returns the reviewC2BabiCommentTr
     *
     * @return string
     */
    public function getReviewC2BabiCommentTr()
    {
        return $this->reviewC2BabiCommentTr;
    }

    /**
     * Sets the reviewC2BabiCommentTr
     *
     * @param string $reviewC2BabiCommentTr
     * @return void
     */
    public function setReviewC2BabiCommentTr(string $reviewC2BabiCommentTr)
    {
        $this->reviewC2BabiCommentTr = $reviewC2BabiCommentTr;
    }

    /**
     * Returns the reviewC2PsaCommentInternal
     *
     * @return string
     */
    public function getReviewC2PsaCommentInternal()
    {
        return $this->reviewC2PsaCommentInternal;
    }

    /**
     * Sets the reviewC2PsaCommentInternal
     *
     * @param string $reviewC2PsaCommentInternal
     * @return void
     */
    public function setReviewC2PsaCommentInternal(string $reviewC2PsaCommentInternal)
    {
        $this->reviewC2PsaCommentInternal = $reviewC2PsaCommentInternal;
    }

    /**
     * Returns the reviewC2PsaCommentTr
     *
     * @return string
     */
    public function getReviewC2PsaCommentTr()
    {
        return $this->reviewC2PsaCommentTr;
    }

    /**
     * Sets the reviewC2PsaCommentTr
     *
     * @param string $reviewC2PsaCommentTr
     * @return void
     */
    public function setReviewC2PsaCommentTr(string $reviewC2PsaCommentTr)
    {
        $this->reviewC2PsaCommentTr = $reviewC2PsaCommentTr;
    }

    /**
     * Returns the reviewC2PsaCommentInternalStep
     *
     * @return string
     */
    public function getReviewC2PsaCommentInternalStep()
    {
        return $this->reviewC2PsaCommentInternalStep;
    }

    /**
     * Sets the reviewC2PsaCommentInternalStep
     *
     * @param string $reviewC2PsaCommentInternalStep
     * @return void
     */
    public function setReviewC2PsaCommentInternalStep(string $reviewC2PsaCommentInternalStep)
    {
        $this->reviewC2PsaCommentInternalStep = $reviewC2PsaCommentInternalStep;
    }

    /**
     * Returns the reviewC2BabiCommentInternalStep
     *
     * @return string
     */
    public function getReviewC2BabiCommentInternalStep()
    {
        return $this->reviewC2BabiCommentInternalStep;
    }

    /**
     * Sets the reviewC2BabiCommentInternalStep
     *
     * @param string $reviewC2BabiCommentInternalStep
     * @return void
     */
    public function setReviewC2BabiCommentInternalStep(string $reviewC2BabiCommentInternalStep)
    {
        $this->reviewC2BabiCommentInternalStep = $reviewC2BabiCommentInternalStep;
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
}
