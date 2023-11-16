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

    use CommentTrait;

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $leitbildDatei = null;

    /**
     * qmsZertifikatDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
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
     * weiterbildungErklaerung
     *
     * @var bool
     */
    protected $weiterbildungErklaerung = false;

    /**
     * reviewA1Status
     *
     * @var int
     */
    protected $reviewA1Status = 0;

    /**
     * reviewA1CommentInternal
     *
     * @var string
     */
    protected $reviewA1CommentInternal = '';

    /**
     * reviewA1CommentTr
     *
     * @var string
     */
    protected $reviewA1CommentTr = '';

    /**
     * reviewA1CommentInternalStep
     *
     * @var string
     */
    protected $reviewA1CommentInternalStep = '';

    /**
     * reviewA2Status
     *
     * @var int
     */
    protected $reviewA2Status = 0;

    /**
     * reviewA2CommentInternal
     *
     * @var string
     */
    protected $reviewA2CommentInternal = '';

    /**
     * reviewA2CommentInternalStep
     *
     * @var string
     */
    protected $reviewA2CommentInternalStep = '';

    /**
     * reviewA2CommentTr
     *
     * @var string
     */
    protected $reviewA2CommentTr = '';

    /**
     * reviewOecertFrist
     *
     * @var \DateTime
     */
    protected $reviewOecertFrist = null;

    /**
     * reviewOecertFristMailSent14t
     *
     * @var bool
     */
    protected $reviewOecertFristMailSent14t = false;

    /**
     * reviewOecertFristMailSent1t
     *
     * @var bool
     */
    protected $reviewOecertFristMailSent1t = false;

    /**
     * statusAfterReview
     *
     * @var int
     */
    protected $statusAfterReview = 0;

    /**
     * reviewA1GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewA1GsCommentInternalStep = '';

    /**
     * reviewA2GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewA2GsCommentInternalStep = '';

    /**
     * reviewA1Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewA1Ag1CommentInternalStep = '';

    /**
     * reviewA2Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewA2Ag1CommentInternalStep = '';

    /**
     * reviewA1Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewA1Ag2CommentInternalStep = '';

    /**
     * reviewA2Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewA2Ag2CommentInternalStep = '';

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
        return (int)$this->plz;
    }

    /**
     * Sets the plz
     *
     * @param int $plz
     * @return void
     */
    public function setPlz($plz)
    {
        $this->plz = (int)$plz;
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
    public function setZertifikatBis(?\DateTime $zertifikatBis)
    {
        $zertifikatBis = $zertifikatBis === null ? 0 : $zertifikatBis;
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

    /**
     * Returns the reviewA1Status
     *
     * @return int
     */
    public function getReviewA1Status()
    {
        return $this->reviewA1Status;
    }

    /**
     * Sets the reviewA1Status
     *
     * @param int $reviewA1Status
     * @return void
     */
    public function setReviewA1Status(int $reviewA1Status)
    {
        $this->reviewA1Status = $reviewA1Status;
    }

    /**
     * Returns the reviewA1CommentInternal
     *
     * @return string
     */
    public function getReviewA1CommentInternal()
    {
        return $this->reviewA1CommentInternal;
    }

    /**
     * Sets the reviewA1CommentInternal
     *
     * @param string $reviewA1CommentInternal
     * @return void
     */
    public function setReviewA1CommentInternal(string $reviewA1CommentInternal)
    {
        $this->reviewA1CommentInternal = $reviewA1CommentInternal;
    }

    /**
     * Returns the reviewA1CommentTr
     *
     * @return string
     */
    public function getReviewA1CommentTr()
    {
        return $this->reviewA1CommentTr;
    }

    /**
     * Sets the reviewA1CommentTr
     *
     * @param string $reviewA1CommentTr
     * @return void
     */
    public function setReviewA1CommentTr(string $reviewA1CommentTr)
    {
        $this->reviewA1CommentTr = $reviewA1CommentTr;
    }

    /**
     * Returns the reviewA2Status
     *
     * @return int
     */
    public function getReviewA2Status()
    {
        return $this->reviewA2Status;
    }

    /**
     * Sets the reviewA2Status
     *
     * @param int $reviewA2Status
     * @return void
     */
    public function setReviewA2Status(int $reviewA2Status)
    {
        $this->reviewA2Status = $reviewA2Status;
    }

    /**
     * Returns the reviewA2CommentInternal
     *
     * @return string
     */
    public function getReviewA2CommentInternal()
    {
        return $this->reviewA2CommentInternal;
    }

    /**
     * Sets the reviewA2CommentInternal
     *
     * @param string $reviewA2CommentInternal
     * @return void
     */
    public function setReviewA2CommentInternal(string $reviewA2CommentInternal)
    {
        $this->reviewA2CommentInternal = $reviewA2CommentInternal;
    }

    /**
     * Returns the reviewA2CommentTr
     *
     * @return string
     */
    public function getreviewA2CommentTr()
    {
        return $this->reviewA2CommentTr;
    }

    /**
     * Sets the reviewA2CommentTr
     *
     * @param string $reviewA2CommentTr
     * @return void
     */
    public function setreviewA2CommentTr(string $reviewA2CommentTr)
    {
        $this->reviewA2CommentTr = $reviewA2CommentTr;
    }

    /**
     * Returns the reviewA1CommentInternalStep
     *
     * @return string
     */
    public function getReviewA1CommentInternalStep()
    {
        return $this->reviewA1CommentInternalStep;
    }

    /**
     * Sets the reviewA1CommentInternalStep
     *
     * @param string $reviewA1CommentInternalStep
     * @return void
     */
    public function setReviewA1CommentInternalStep(string $reviewA1CommentInternalStep)
    {
        $this->reviewA1CommentInternalStep = $reviewA1CommentInternalStep;
    }

    /**
     * Returns the reviewA2CommentInternalStep
     *
     * @return string
     */
    public function getReviewA2CommentInternalStep()
    {
        return $this->reviewA2CommentInternalStep;
    }

    /**
     * Sets the reviewA2CommentInternalStep
     *
     * @param string $reviewA2CommentInternalStep
     * @return void
     */
    public function setReviewA2CommentInternalStep(string $reviewA2CommentInternalStep)
    {
        $this->reviewA2CommentInternalStep = $reviewA2CommentInternalStep;
    }
    public function getReviewA1CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewA1CommentInternal);
    }
    public function getReviewA2CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewA2CommentInternal);
    }

    /**
     * Returns the reviewOecertFrist
     *
     * @return \DateTime
     */
    public function getReviewOecertFrist()
    {
        return $this->reviewOecertFrist;
    }

    /**
     * Sets the reviewOecertFrist
     *
     * @param \DateTime $reviewOecertFrist
     * @return void
     */
    public function setReviewOecertFrist(?\DateTime $reviewOecertFrist)
    {
        $reviewOecertFrist = $reviewOecertFrist === null ? 0 : $reviewOecertFrist;
        $this->reviewOecertFrist = $reviewOecertFrist;
    }

    /**
     * Returns the reviewOecertFristMailSent14t
     *
     * @return bool
     */
    public function getReviewOecertFristMailSent14t()
    {
        return $this->reviewOecertFristMailSent14t;
    }

    /**
     * Sets the reviewOecertFristMailSent14t
     *
     * @param bool $reviewOecertFristMailSent14t
     * @return void
     */
    public function setReviewOecertFristMailSent14t(bool $reviewOecertFristMailSent14t)
    {
        $this->reviewOecertFristMailSent14t = $reviewOecertFristMailSent14t;
    }

    /**
     * Returns the boolean state of reviewOecertFristMailSent14t
     *
     * @return bool
     */
    public function isReviewOecertFristMailSent14t()
    {
        return $this->reviewOecertFristMailSent14t;
    }

    /**
     * Returns the reviewOecertFristMailSent1t
     *
     * @return bool
     */
    public function getReviewOecertFristMailSent1t()
    {
        return $this->reviewOecertFristMailSent1t;
    }

    /**
     * Sets the reviewOecertFristMailSent1t
     *
     * @param bool $reviewOecertFristMailSent1t
     * @return void
     */
    public function setReviewOecertFristMailSent1t(bool $reviewOecertFristMailSent1t)
    {
        $this->reviewOecertFristMailSent1t = $reviewOecertFristMailSent1t;
    }

    /**
     * Returns the boolean state of reviewOecertFristMailSent1t
     *
     * @return bool
     */
    public function isReviewOecertFristMailSent1t()
    {
        return $this->reviewOecertFristMailSent1t;
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
     * Returns the reviewA1GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewA1GsCommentInternalStep()
    {
        return $this->reviewA1GsCommentInternalStep;
    }

    /**
     * Sets the reviewA1GsCommentInternalStep
     *
     * @param string $reviewA1GsCommentInternalStep
     * @return void
     */
    public function setReviewA1GsCommentInternalStep(string $reviewA1GsCommentInternalStep)
    {
        $this->reviewA1GsCommentInternalStep = $reviewA1GsCommentInternalStep;
    }

    /**
     * Returns the reviewA2GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewA2GsCommentInternalStep()
    {
        return $this->reviewA2GsCommentInternalStep;
    }

    /**
     * Sets the reviewA2GsCommentInternalStep
     *
     * @param string $reviewA2GsCommentInternalStep
     * @return void
     */
    public function setReviewA2GsCommentInternalStep(string $reviewA2GsCommentInternalStep)
    {
        $this->reviewA2GsCommentInternalStep = $reviewA2GsCommentInternalStep;
    }

    /**
     * Returns the reviewA1Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewA1Ag1CommentInternalStep()
    {
        return $this->reviewA1Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewA1Ag1CommentInternalStep
     *
     * @param string $reviewA1Ag1CommentInternalStep
     * @return void
     */
    public function setReviewA1Ag1CommentInternalStep(string $reviewA1Ag1CommentInternalStep)
    {
        $this->reviewA1Ag1CommentInternalStep = $reviewA1Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewA2Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewA2Ag1CommentInternalStep()
    {
        return $this->reviewA2Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewA2Ag1CommentInternalStep
     *
     * @param string $reviewA2Ag1CommentInternalStep
     * @return void
     */
    public function setReviewA2Ag1CommentInternalStep(string $reviewA2Ag1CommentInternalStep)
    {
        $this->reviewA2Ag1CommentInternalStep = $reviewA2Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewA1Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewA1Ag2CommentInternalStep()
    {
        return $this->reviewA1Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewA1Ag2CommentInternalStep
     *
     * @param string $reviewA1Ag2CommentInternalStep
     * @return void
     */
    public function setReviewA1Ag2CommentInternalStep(string $reviewA1Ag2CommentInternalStep)
    {
        $this->reviewA1Ag2CommentInternalStep = $reviewA1Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewA2Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewA2Ag2CommentInternalStep()
    {
        return $this->reviewA2Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewA2Ag2CommentInternalStep
     *
     * @param string $reviewA2Ag2CommentInternalStep
     * @return void
     */
    public function setReviewA2Ag2CommentInternalStep(string $reviewA2Ag2CommentInternalStep)
    {
        $this->reviewA2Ag2CommentInternalStep = $reviewA2Ag2CommentInternalStep;
    }
}
