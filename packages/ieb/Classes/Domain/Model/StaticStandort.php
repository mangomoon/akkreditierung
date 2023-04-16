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
 * Standort
 */
class StaticStandort extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * adresse
     *
     * @var string
     */
    protected $adresse = '';

    /**
     * plz
     *
     * @var int
     */
    protected $plz = '';

    /**
     * ort
     *
     * @var string
     */
    protected $ort = '';

    /**
     * pruefBescheid
     *
     * @var bool
     */
    protected $pruefBescheid = false;

    /**
     * koopSchule
     *
     * @var string
     */
    protected $koopSchule = null;

    /**
     * koopSchuleDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $koopSchuleDatei = null;

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
     * reviewCommentStatus
     *
     * @var int
     */
    protected $reviewCommentStatus = 0;

    /**
     * reviewFrist
     *
     * @var \DateTime
     */
    protected $reviewFrist = null;

    /**
     * basedOn
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Standort
     */
    protected $basedOn = null;

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
     * Returns the adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Sets the adresse
     *
     * @param string $adresse
     * @return void
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
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
     * Returns the pruefBescheid
     *
     * @return bool
     */
    public function getPruefBescheid()
    {
        return $this->pruefBescheid;
    }

    /**
     * Sets the pruefBescheid
     *
     * @param bool $pruefBescheid
     * @return void
     */
    public function setPruefBescheid(bool $pruefBescheid)
    {
        $this->pruefBescheid = $pruefBescheid;
    }

    /**
     * Returns the boolean state of pruefBescheid
     *
     * @return bool
     */
    public function isPruefBescheid()
    {
        return $this->pruefBescheid;
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
     * Returns the reviewCommentStatus
     *
     * @return int
     */
    public function getReviewCommentStatus()
    {
        return $this->reviewCommentStatus;
    }

    /**
     * Sets the reviewCommentStatus
     *
     * @param int $reviewCommentStatus
     * @return void
     */
    public function setReviewCommentStatus(int $reviewCommentStatus)
    {
        $this->reviewCommentStatus = $reviewCommentStatus;
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
     * Returns the koopSchule
     *
     * @return string koopSchule
     */
    public function getKoopSchule()
    {
        return $this->koopSchule;
    }

    /**
     * Sets the koopSchule
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $koopSchule
     * @return void
     */
    public function setKoopSchule($koopSchule)
    {
        $this->koopSchule = $koopSchule;
    }

    /**
     * Returns the koopSchuleDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getKoopSchuleDatei()
    {
        return $this->koopSchuleDatei;
    }

    /**
     * Sets the koopSchuleDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $koopSchuleDatei
     * @return void
     */
    public function setKoopSchuleDatei($koopSchuleDatei)
    {
        $this->koopSchuleDatei = $koopSchuleDatei;
    }

    /**
     * Returns the plz
     *
     * @return int plz
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * Sets the plz
     *
     * @param string $plz
     * @return void
     */
    public function setPlz(string $plz)
    {
        $this->plz = $plz;
    }

    /**
     * Returns the basedOn
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Standort
     */
    public function getBasedOn()
    {
        return $this->basedOn;
    }

    /**
     * Sets the basedOn
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $basedOn
     * @return void
     */
    public function setBasedOn(\GeorgRinger\Ieb\Domain\Model\Standort $basedOn)
    {
        $this->basedOn = $basedOn;
    }
}
