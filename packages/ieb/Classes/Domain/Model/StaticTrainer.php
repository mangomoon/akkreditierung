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
class StaticTrainer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * nachname
     *
     * @var string
     */
    protected $nachname = null;

    /**
     * vorname
     *
     * @var string
     */
    protected $vorname = null;

    /**
     * verwendungBabi
     *
     * @var bool
     */
    protected $verwendungBabi = null;

    /**
     * verwendungPsa
     *
     * @var bool
     */
    protected $verwendungPsa = null;

    /**
     * lebenslauf
     *
     * @var string
     */
    protected $lebenslauf = null;

    /**
     * qualifikationBabi
     *
     * @var string
     */
    protected $qualifikationBabi = null;

    /**
     * lehrBefugnis
     *
     * @var string
     */
    protected $lehrBefugnis = null;

    /**
     * qualifikationPsa1
     *
     * @var bool
     */
    protected $qualifikationPsa1 = null;

    /**
     * qualifikationPsa2
     *
     * @var bool
     */
    protected $qualifikationPsa2 = null;

    /**
     * qualifikationPsa3
     *
     * @var bool
     */
    protected $qualifikationPsa3 = null;

    /**
     * qualifikationPsa4
     *
     * @var bool
     */
    protected $qualifikationPsa4 = null;

    /**
     * qualifikationPsa5
     *
     * @var bool
     */
    protected $qualifikationPsa5 = null;

    /**
     * qualifikationPsa6
     *
     * @var bool
     */
    protected $qualifikationPsa6 = null;

    /**
     * qualifikationPsa7
     *
     * @var bool
     */
    protected $qualifikationPsa7 = null;

    /**
     * qualifikationPsa8
     *
     * @var bool
     */
    protected $qualifikationPsa8 = null;

    /**
     * qualifikationPsa
     *
     * @var string
     */
    protected $qualifikationPsa = null;

    /**
     * qualifikationPsaKommentar
     *
     * @var string
     */
    protected $qualifikationPsaKommentar = null;

    /**
     * anerkennungPp3
     *
     * @var bool
     */
    protected $anerkennungPp3 = null;

    /**
     * reviewCommentInternal
     *
     * @var string
     */
    protected $reviewCommentInternal = '';

    /**
     * reviewCommentTr
     *
     * @var string
     */
    protected $reviewCommentTr = '';

    /**
     * reviewStatus
     *
     * @var int
     */
    protected $reviewStatus = 0;

    /**
     * reviewFrist
     *
     * @var \DateTime
     */
    protected $reviewFrist = null;

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
     * @var string
     */
    protected $lehrBefugnisDatei = '';

    /**
     * qualifikationPsaDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationPsaDatei = null;

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

    /**
     * basedOn
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Trainer
     */
    protected $basedOn = null;

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

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
     * Returns the basedOn
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Trainer
     */
    public function getBasedOn()
    {
        return $this->basedOn;
    }

    /**
     * Sets the basedOn
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $basedOn
     * @return void
     */
    public function setBasedOn(\GeorgRinger\Ieb\Domain\Model\Trainer $basedOn)
    {
        $this->basedOn = $basedOn;
    }

    /**
     * Returns the reviewCommentInternal
     *
     * @return string
     */
    public function getReviewCommentInternal()
    {
        return $this->reviewCommentInternal;
    }

    /**
     * Sets the reviewCommentInternal
     *
     * @param string $reviewCommentInternal
     * @return void
     */
    public function setReviewCommentInternal(string $reviewCommentInternal)
    {
        $this->reviewCommentInternal = $reviewCommentInternal;
    }

    /**
     * Returns the reviewCommentTr
     *
     * @return string
     */
    public function getReviewCommentTr()
    {
        return $this->reviewCommentTr;
    }

    /**
     * Sets the reviewCommentTr
     *
     * @param string $reviewCommentTr
     * @return void
     */
    public function setReviewCommentTr(string $reviewCommentTr)
    {
        $this->reviewCommentTr = $reviewCommentTr;
    }

    /**
     * Returns the reviewStatus
     *
     * @return int
     */
    public function getReviewStatus()
    {
        return $this->reviewStatus;
    }

    /**
     * Sets the reviewStatus
     *
     * @param int $reviewStatus
     * @return void
     */
    public function setReviewStatus(int $reviewStatus)
    {
        $this->reviewStatus = $reviewStatus;
    }

    /**
     * Returns the reviewFrist
     *
     * @return \DateTime
     */
    public function getReviewFrist()
    {
        return $this->reviewFrist;
    }

    /**
     * Sets the reviewFrist
     *
     * @param \DateTime $reviewFrist
     * @return void
     */
    public function setReviewFrist(\DateTime $reviewFrist)
    {
        $this->reviewFrist = $reviewFrist;
    }

    /**
     * Returns the lebenslauf
     *
     * @return string lebenslauf
     */
    public function getLebenslauf()
    {
        return $this->lebenslauf;
    }

    /**
     * Sets the lebenslauf
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslauf
     * @return void
     */
    public function setLebenslauf(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslauf)
    {
        $this->lebenslauf = $lebenslauf;
    }

    /**
     * Returns the qualifikationBabi
     *
     * @return string qualifikationBabi
     */
    public function getQualifikationBabi()
    {
        return $this->qualifikationBabi;
    }

    /**
     * Sets the qualifikationBabi
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationBabi
     * @return void
     */
    public function setQualifikationBabi(\TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationBabi)
    {
        $this->qualifikationBabi = $qualifikationBabi;
    }

    /**
     * Returns the lehrBefugnis
     *
     * @return string lehrBefugnis
     */
    public function getLehrBefugnis()
    {
        return $this->lehrBefugnis;
    }

    /**
     * Sets the lehrBefugnis
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lehrBefugnis
     * @return void
     */
    public function setLehrBefugnis(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lehrBefugnis)
    {
        $this->lehrBefugnis = $lehrBefugnis;
    }

    /**
     * Returns the qualifikationPsa
     *
     * @return string qualifikationPsa
     */
    public function getQualifikationPsa()
    {
        return $this->qualifikationPsa;
    }

    /**
     * Sets the qualifikationPsa
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationPsa
     * @return void
     */
    public function setQualifikationPsa(\TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationPsa)
    {
        $this->qualifikationPsa = $qualifikationPsa;
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
    public function setLebenslaufDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslaufDatei)
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
    public function setQualifikationBabiDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationBabiDatei)
    {
        $this->qualifikationBabiDatei = $qualifikationBabiDatei;
    }

    /**
     * Returns the lehrBefugnisDatei
     *
     * @return string
     */
    public function getLehrBefugnisDatei()
    {
        return $this->lehrBefugnisDatei;
    }

    /**
     * Sets the lehrBefugnisDatei
     *
     * @param string $lehrBefugnisDatei
     * @return void
     */
    public function setLehrBefugnisDatei(string $lehrBefugnisDatei)
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
    public function setQualifikationPsaDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationPsaDatei)
    {
        $this->qualifikationPsaDatei = $qualifikationPsaDatei;
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
}
