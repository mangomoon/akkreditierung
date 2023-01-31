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
class StaticBerater extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lebenslauf = null;

    /**
     * qualifikationsnachweise
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $qualifikationsnachweise = null;

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
     * lockedBy
     *
     * @var \DateTime
     */
    protected $lockedBy = null;

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * standorte
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort>
     */
    protected $standorte = null;

    /**
     * basedOn
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Berater
     */
    protected $basedOn = null;

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
    public function setLebenslauf(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslauf)
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
    public function setQualifikationsnachweise(\TYPO3\CMS\Extbase\Domain\Model\FileReference $qualifikationsnachweise)
    {
        $this->qualifikationsnachweise = $qualifikationsnachweise;
    }

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
        $this->standorte = $this->standorte ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the basedOn
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Berater
     */
    public function getBasedOn()
    {
        return $this->basedOn;
    }

    /**
     * Sets the basedOn
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $basedOn
     * @return void
     */
    public function setBasedOn(\GeorgRinger\Ieb\Domain\Model\Berater $basedOn)
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
     * Adds a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticStandort $standorte
     * @return void
     */
    public function addStandorte(\GeorgRinger\Ieb\Domain\Model\StaticStandort $standorte)
    {
        $this->standorte->attach($standorte);
    }

    /**
     * Removes a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteToRemove The StaticStandort to be removed
     * @return void
     */
    public function removeStandorte(\GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteToRemove)
    {
        $this->standorte->detach($standorteToRemove);
    }

    /**
     * Returns the standorte
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort> standorte
     */
    public function getStandorte()
    {
        return $this->standorte;
    }

    /**
     * Sets the standorte
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort> $standorte
     * @return void
     */
    public function setStandorte(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $standorte)
    {
        $this->standorte = $standorte;
    }

    /**
     * Returns the lockedBy
     *
     * @return \DateTime
     */
    public function getLockedBy()
    {
        return $this->lockedBy;
    }

    /**
     * Sets the lockedBy
     *
     * @param \DateTime $lockedBy
     * @return void
     */
    public function setLockedBy(\DateTime $lockedBy)
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
