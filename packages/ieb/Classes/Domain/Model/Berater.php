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
 * Berater
 */
class Berater extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \DateTime
     */
    public $crdate = null;

    /**
     * @var \DateTime
     */
    public $tstamp = null;

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
     * lebenslauf
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lebenslauf = null;

    /**
     * qualifikationsnachweise
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationsnachweise = null;

    /**
     * lebenslaufKommentar
     *
     * @var string
     */
    protected $lebenslaufKommentar = '';

    /**
     * qualifikationsnachweiseKommentar
     *
     * @var string
     */
    protected $qualifikationsnachweiseKommentar = '';

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
     * reviewC3Status
     *
     * @var int
     */
    protected $reviewC3Status = 0;

    /**
     * reviewC32Status
     *
     * @var int
     */
    protected $reviewC32Status = 0;

    /**
     * reviewC3CommentInternal
     *
     * @var string
     */
    protected $reviewC3CommentInternal = '';

    /**
     * reviewC3CommentInternalStep
     *
     * @var string
     */
    protected $reviewC3CommentInternalStep = '';

    /**
     * reviewC3CommentTr
     *
     * @var string
     */
    protected $reviewC3CommentTr = '';

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

    /**
     * statusAfterReview
     *
     * @var int
     */
    protected $statusAfterReview = 0;

    /**
     * reviewFrist
     *
     * @var \DateTime
     */
    protected $reviewFrist = null;

    /**
     * reviewFristMailSent14t
     *
     * @var bool
     */
    protected $reviewFristMailSent14t = false;

    /**
     * reviewFristMailSent1t
     *
     * @var bool
     */
    protected $reviewFristMailSent1t = false;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
    }

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
     * Returns the lebenslauf
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
    public function setLebenslauf($lebenslauf)
    {
        $this->lebenslauf = $lebenslauf;
    }

    /**
     * Returns the qualifikationsnachweise
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getQualifikationsnachweise()
    {
        return $this->qualifikationsnachweise;
    }

    /**
     * Sets the qualifikationsnachweise
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationsnachweise
     * @return void
     */
    public function setQualifikationsnachweise($qualifikationsnachweise)
    {
        $this->qualifikationsnachweise = $qualifikationsnachweise;
    }
    public function getVollerName()
    {
        return $this->vorname . ' ' . $this->nachname;
    }

    /**
     * Returns the lebenslaufKommentar
     *
     * @return string
     */
    public function getLebenslaufKommentar()
    {
        return $this->lebenslaufKommentar;
    }

    /**
     * Sets the lebenslaufKommentar
     *
     * @param string $lebenslaufKommentar
     * @return void
     */
    public function setLebenslaufKommentar(string $lebenslaufKommentar)
    {
        $this->lebenslaufKommentar = $lebenslaufKommentar;
    }

    /**
     * Returns the qualifikationsnachweiseKommentar
     *
     * @return string
     */
    public function getQualifikationsnachweiseKommentar()
    {
        return $this->qualifikationsnachweiseKommentar;
    }

    /**
     * Sets the qualifikationsnachweiseKommentar
     *
     * @param string $qualifikationsnachweiseKommentar
     * @return void
     */
    public function setQualifikationsnachweiseKommentar(string $qualifikationsnachweiseKommentar)
    {
        $this->qualifikationsnachweiseKommentar = $qualifikationsnachweiseKommentar;
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
    public function getFullName()
    {
        return implode(' ', array_filter([$this->vorname, $this->nachname]));
    }

    /**
     * Returns the reviewC3Status
     *
     * @return int
     */
    public function getReviewC3Status()
    {
        return $this->reviewC3Status;
    }

    /**
     * Sets the reviewC3Status
     *
     * @param int $reviewC3Status
     * @return void
     */
    public function setReviewC3Status(int $reviewC3Status)
    {
        $this->reviewC3Status = $reviewC3Status;
    }

    /**
     * Returns the reviewC3CommentInternal
     *
     * @return string
     */
    public function getReviewC3CommentInternal()
    {
        return $this->reviewC3CommentInternal;
    }

    /**
     * Sets the reviewC3CommentInternal
     *
     * @param string $reviewC3CommentInternal
     * @return void
     */
    public function setReviewC3CommentInternal(string $reviewC3CommentInternal)
    {
        $this->reviewC3CommentInternal = $reviewC3CommentInternal;
    }

    /**
     * Returns the reviewC3CommentTr
     *
     * @return string
     */
    public function getReviewC3CommentTr()
    {
        return $this->reviewC3CommentTr;
    }

    /**
     * Sets the reviewC3CommentTr
     *
     * @param string $reviewC3CommentTr
     * @return void
     */
    public function setReviewC3CommentTr(string $reviewC3CommentTr)
    {
        $this->reviewC3CommentTr = $reviewC3CommentTr;
    }

    /**
     * Returns the reviewC3CommentInternalStep
     *
     * @return string
     */
    public function getReviewC3CommentInternalStep()
    {
        return $this->reviewC3CommentInternalStep;
    }

    /**
     * Sets the reviewC3CommentInternalStep
     *
     * @param string $reviewC3CommentInternalStep
     * @return void
     */
    public function setReviewC3CommentInternalStep(string $reviewC3CommentInternalStep)
    {
        $this->reviewC3CommentInternalStep = $reviewC3CommentInternalStep;
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
     * Returns the reviewC32Status
     *
     * @return int
     */
    public function getReviewC32Status()
    {
        return $this->reviewC32Status;
    }

    /**
     * Sets the reviewC32Status
     *
     * @param int $reviewC32Status
     * @return void
     */
    public function setReviewC32Status(int $reviewC32Status)
    {
        $this->reviewC32Status = $reviewC32Status;
    }

    /**
     * Returns the statusAfterReview
     *
     * @return int
     */
    public function getStatusAfterReview()
    {
        return $this->statusAfterReview;
    }

    /**
     * Sets the statusAfterReview
     *
     * @param int $statusAfterReview
     * @return void
     */
    public function setStatusAfterReview(int $statusAfterReview)
    {
        $this->statusAfterReview = $statusAfterReview;
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
    public function setReviewFrist(?\DateTime $reviewFrist)
    {
        $reviewFrist = $reviewFrist === null ? 0 : $reviewFrist;
        $this->reviewFrist = $reviewFrist;
    }

    /**
     * Returns the reviewFristMailSent14t
     *
     * @return bool
     */
    public function getReviewFristMailSent14t()
    {
        return $this->reviewFristMailSent14t;
    }

    /**
     * Sets the reviewFristMailSent14t
     *
     * @param bool $reviewFristMailSent14t
     * @return void
     */
    public function setReviewFristMailSent14t(bool $reviewFristMailSent14t)
    {
        $this->reviewFristMailSent14t = $reviewFristMailSent14t;
    }

    /**
     * Returns the boolean state of reviewFristMailSent14t
     *
     * @return bool
     */
    public function isReviewFristMailSent14t()
    {
        return $this->reviewFristMailSent14t;
    }

    /**
     * Returns the reviewFristMailSent1t
     *
     * @return bool
     */
    public function getReviewFristMailSent1t()
    {
        return $this->reviewFristMailSent1t;
    }

    /**
     * Sets the reviewFristMailSent1t
     *
     * @param bool $reviewFristMailSent1t
     * @return void
     */
    public function setReviewFristMailSent1t(bool $reviewFristMailSent1t)
    {
        $this->reviewFristMailSent1t = $reviewFristMailSent1t;
    }

    /**
     * Returns the boolean state of reviewFristMailSent1t
     *
     * @return bool
     */
    public function isReviewFristMailSent1t()
    {
        return $this->reviewFristMailSent1t;
    }
}
