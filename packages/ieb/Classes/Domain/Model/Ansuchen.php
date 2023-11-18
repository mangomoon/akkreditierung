<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * Ansuchen
 */
class Ansuchen extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    use CommentTrait;

    /**
     * @var \DateTime
     */
    protected $tstamp = null;


    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * version
     *
     * @var int
     */
    protected $version = 0;

    /**
     * versionBasedOn
     *
     * @var int
     */
    protected $versionBasedOn = 0;

    /**
     * versionActive
     *
     * @var bool
     */
    protected $versionActive = false;

    /**
     * nummer
     *
     * @var string
     */
    protected $nummer = '';

    /**
     * akkreditierungDatum
     *
     * @var \DateTime
     */
    protected $akkreditierungDatum = null;

    /**
     * einreichDatum
     *
     * @var \DateTime
     */
    protected $einreichDatum = null;

    /**
     * zuteilungDatum
     *
     *@var \DateTime
     */
    protected $zuteilungDatum = null;

    /**
     * akkreditierungEntscheidungDatum
     *
     * @var \DateTime
     */
    protected $akkreditierungEntscheidungDatum = null;

    /**
     * typ
     *
     * @var int
     */
    protected $typ = 0;

    /**
     * bundesland
     *
     * @var int
     */
    protected $bundesland = 0;

    /**
     * uebersichtText
     *
     * @var string
     */
    protected $uebersichtText = '';

    /**
     * uebersichtDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $uebersichtDatei = null;

    /**
     * zielgruppenAnsprache
     *
     * @var string
     */
    protected $zielgruppenAnsprache = '';

    /**
     * zielgruppenAnspracheDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $zielgruppenAnspracheDatei = null;

    /**
     * fernlehre
     *
     * @var bool
     */
    protected $fernlehre = false;

    /**
     * kinderbetreuung
     *
     * @var bool
     */
    protected $kinderbetreuung = false;

    /**
     * lernziele
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lernziele = null;

    /**
     * lernstandserhebung
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lernstandserhebung = null;

    /**
     * diversity
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $diversity = null;

    /**
     * didaktikKommentar
     *
     * @var string
     */
    protected $didaktikKommentar = '';

    /**
     * beratungText
     *
     * @var string
     */
    protected $beratungText = '';

    /**
     * beratungDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $beratungDatei = null;

    /**
     * reviewB1CommentInternal
     *
     * @var string
     */
    protected $reviewB1CommentInternal = '';

    /**
     * reviewB1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB1CommentInternalStep = '';

    /**
     * reviewB1CommentTr
     *
     * @var string
     */
    protected $reviewB1CommentTr = '';

    /**
     * reviewB1Status
     *
     * @var int
     */
    protected $reviewB1Status = 0;

    /**
     * reviewB2CommentInternal
     *
     * @var string
     */
    protected $reviewB2CommentInternal = '';

    /**
     * reviewB2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB2CommentInternalStep = '';

    /**
     * reviewB2CommentTr
     *
     * @var string
     */
    protected $reviewB2CommentTr = '';

    /**
     * reviewB2Status
     *
     * @var int
     */
    protected $reviewB2Status = 0;

    /**
     * reviewC1CommentInternal
     *
     * @var string
     */
    protected $reviewC1CommentInternal = '';

    /**
     * reviewC1CommentInternalStep
     *
     * @var string
     */
    protected $reviewC1CommentInternalStep = '';

    /**
     * reviewC1CommentTr
     *
     * @var string
     */
    protected $reviewC1CommentTr = '';

    /**
     * reviewC1Status
     *
     * @var int
     */
    protected $reviewC1Status = 0;

    /**
     * reviewC2CommentInternal
     *
     * @var string
     */
    protected $reviewC2CommentInternal = '';

    /**
     * reviewC2CommentInternalStep
     *
     * @var string
     */
    protected $reviewC2CommentInternalStep = '';

    /**
     * reviewC2CommentTr
     *
     * @var string
     */
    protected $reviewC2CommentTr = '';

    /**
     * reviewC2Status
     *
     * @var int
     */
    protected $reviewC2Status = 0;

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
     * reviewC3Status
     *
     * @var int
     */
    protected $reviewC3Status = 0;

    /**
     * reviewTotalCommentInternal
     *
     * @var string
     */
    protected $reviewTotalCommentInternal = '';

    /**
     * reviewTotalCommentInternalStep
     *
     * @var string
     */
    protected $reviewTotalCommentInternalStep = '';

    /**
     * reviewTotalCommentTr
     *
     * @var string
     */
    protected $reviewTotalCommentTr = '';

    /**
     * reviewTotalStatus
     *
     * @var int
     */
    protected $reviewTotalStatus = 0;

    /**
     * reviewTotalFrist
     *
     * @var \DateTime
     */
    protected $reviewTotalFrist = null;

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

    /**
     * status
     *
     * @var int
     */
    protected $status = 0;

    /**
     * ok
     *
     * @var bool
     */
    protected $ok = false;

    /**
     * pruefbescheidDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
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
     * kooperationDatei
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $kooperationDatei = null;

    /**
     * kooperation
     *
     * @var string
     */
    protected $kooperation = '';

    /**
     * standortErklaerung
     *
     * @var bool
     */
    protected $standortErklaerung = false;

    /**
     * kompetenz1
     *
     * @var bool
     */
    protected $kompetenz1 = false;

    /**
     * kompetenz2
     *
     * @var bool
     */
    protected $kompetenz2 = false;

    /**
     * kompetenz3
     *
     * @var bool
     */
    protected $kompetenz3 = false;

    /**
     * kompetenz4
     *
     * @var bool
     */
    protected $kompetenz4 = false;

    /**
     * kompetenz5
     *
     * @var bool
     */
    protected $kompetenz5 = false;

    /**
     * kompetenz6
     *
     * @var bool
     */
    protected $kompetenz6 = false;

    /**
     * kompetenz7
     *
     * @var bool
     */
    protected $kompetenz7 = false;

    /**
     * kompetenz8
     *
     * @var bool
     */
    protected $kompetenz8 = false;

    /**
     * kompetenz9
     *
     * @var bool
     */
    protected $kompetenz9 = false;

    /**
     * erklaerungd1
     *
     * @var bool
     */
    protected $erklaerungd1 = false;

    /**
     * erklaerungd2
     *
     * @var bool
     */
    protected $erklaerungd2 = false;

    /**
     * erklaerungd3
     *
     * @var bool
     */
    protected $erklaerungd3 = false;

    /**
     * kompetenzText1
     *
     * @var string
     */
    protected $kompetenzText1 = '';

    /**
     * erklaerungTeilA
     *
     * @var bool
     */
    protected $erklaerungTeilA = false;

    /**
     * erklaerungTeilB
     *
     * @var bool
     */
    protected $erklaerungTeilB = false;

    /**
     * erklaerungd5
     *
     * @var bool
     */
    protected $erklaerungd5 = false;

    /**
     * copyStammdaten
     *
     * @var string
     */
    protected $copyStammdaten = '';

    /**
     * copyTrainer
     *
     * @var string
     */
    protected $copyTrainer = '';

    /**
     * copyBerater
     *
     * @var string
     */
    protected $copyBerater = '';

    /**
     * copyVerantwortliche
     *
     * @var string
     */
    protected $copyVerantwortliche = '';

    /**
     * copyVerantwortlicheMail
     *
     * @var string
     */
    protected $copyVerantwortlicheMail = '';

    /**
     * copyStandorte
     *
     * @var string
     */
    protected $copyStandorte = '';

    /**
     * reviewB14CommentInternal
     *
     * @var string
     */
    protected $reviewB14CommentInternal = '';

    /**
     * reviewB14CommentInternalStep
     *
     * @var string
     */
    protected $reviewB14CommentInternalStep = '';

    /**
     * reviewB14CommentTr
     *
     * @var string
     */
    protected $reviewB14CommentTr = '';

    /**
     * reviewB14Status
     *
     * @var int
     */
    protected $reviewB14Status = 0;

    /**
     * reviewB15CommentInternal
     *
     * @var string
     */
    protected $reviewB15CommentInternal = '';

    /**
     * reviewB15CommentInternalStep
     *
     * @var string
     */
    protected $reviewB15CommentInternalStep = '';

    /**
     * reviewB15CommentTr
     *
     * @var string
     */
    protected $reviewB15CommentTr = '';

    /**
     * reviewB15Status
     *
     * @var int
     */
    protected $reviewB15Status = 0;

    /**
     * reviewB22CommentInternal
     *
     * @var string
     */
    protected $reviewB22CommentInternal = '';

    /**
     * reviewB22CommentInternalStep
     *
     * @var string
     */
    protected $reviewB22CommentInternalStep = '';

    /**
     * reviewB22CommentTr
     *
     * @var string
     */
    protected $reviewB22CommentTr = '';

    /**
     * reviewB22Status
     *
     * @var int
     */
    protected $reviewB22Status = 0;

    /**
     * reviewB23CommentInternal
     *
     * @var string
     */
    protected $reviewB23CommentInternal = '';

    /**
     * reviewB23CommentInternalStep
     *
     * @var string
     */
    protected $reviewB23CommentInternalStep = '';

    /**
     * reviewB23CommentTr
     *
     * @var string
     */
    protected $reviewB23CommentTr = '';

    /**
     * reviewB23Status
     *
     * @var int
     */
    protected $reviewB23Status = 0;

    /**
     * upcomingStatus
     *
     * @var int
     */
    protected $upcomingStatus = 0;

    /**
     * gutachterLockedBy
     *
     * @var int
     */
    protected $gutachterLockedBy = 0;

    /**
     * notitzzettel
     *
     * @var string
     */
    protected $notitzzettel = '';

    /**
     * archiviert
     *
     * @var bool
     */
    protected $archiviert = false;

    /**
     * trotzdemAbschicken
     *
     * @var string
     */
    protected $trotzdemAbschicken = '';

    /**
     * reviewTotalFristMailSent14t
     *
     * @var bool
     */
    protected $reviewTotalFristMailSent14t = false;

    /**
     * reviewTotalFristMailSent1t
     *
     * @var bool
     */
    protected $reviewTotalFristMailSent1t = false;

    /**
     * reviewFristPruefbescheid
     *
     * @var \DateTime
     */
    protected $reviewFristPruefbescheid = null;

    /**
     * reviewFristPruefbescheidMailSent14t
     *
     * @var bool
     */
    protected $reviewFristPruefbescheidMailSent14t = false;

    /**
     * reviewFristPruefbescheidMailSent1t
     *
     * @var bool
     */
    protected $reviewFristPruefbescheidMailSent1t = false;

    /**
     * statusAfterReview
     *
     * @var int
     */
    protected $statusAfterReview = 0;

    /**
     * ende
     *
     * @var \DateTime
     */
    protected $ende = null;

    /**
     * pruefbescheidCheck
     *
     * @var int
     */
    protected $pruefbescheidCheck = 0;

    /**
     * statusAgEins
     *
     * @var int
     */
    protected $statusAgEins = 0;

    /**
     * statusAgZwei
     *
     * @var int
     */
    protected $statusAgZwei = 0;

    /**
     * reviewVerrechnungCheck1
     *
     * @var bool
     */
    protected $reviewVerrechnungCheck1 = false;

    /**
     * reviewVerrechnungCheck2
     *
     * @var bool
     */
    protected $reviewVerrechnungCheck2 = false;

    /**
     * reviewVerrechnung1
     *
     * @var string
     */
    protected $reviewVerrechnung1 = '';

    /**
     * reviewVerrechnung2
     *
     * @var string
     */
    protected $reviewVerrechnung2 = '';

    /**
     * einzelunterricht
     *
     * @var bool
     */
    protected $einzelunterricht = false;

    /**
     * pp3
     *
     * @var bool
     */
    protected $pp3 = false;

    /**
     * reviewB1GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB1GsCommentInternalStep = '';

    /**
     * reviewB14GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB14GsCommentInternalStep = '';

    /**
     * reviewB1Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB1Ag1CommentInternalStep = '';

    /**
     * reviewB14Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB14Ag1CommentInternalStep = '';

    /**
     * reviewB1Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB1Ag2CommentInternalStep = '';

    /**
     * reviewB14Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB14Ag2CommentInternalStep = '';

    /**
     * reviewB15GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB15GsCommentInternalStep = '';

    /**
     * reviewB2GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB2GsCommentInternalStep = '';

    /**
     * reviewB22GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB22GsCommentInternalStep = '';

    /**
     * reviewB23GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewB23GsCommentInternalStep = '';

    /**
     * reviewC1GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewC1GsCommentInternalStep = '';

    /**
     * reviewC2GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewC2GsCommentInternalStep = '';

    /**
     * reviewC3GsCommentInternalStep
     *
     * @var string
     */
    protected $reviewC3GsCommentInternalStep = '';

    /**
     * reviewTotalGsCommentInternalStep
     *
     * @var string
     */
    protected $reviewTotalGsCommentInternalStep = '';

    /**
     * reviewB15Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB15Ag1CommentInternalStep = '';

    /**
     * reviewB2Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB2Ag1CommentInternalStep = '';

    /**
     * reviewB22Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB22Ag1CommentInternalStep = '';

    /**
     * reviewB23Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewB23Ag1CommentInternalStep = '';

    /**
     * reviewC1Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewC1Ag1CommentInternalStep = '';

    /**
     * reviewC2Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewC2Ag1CommentInternalStep = '';

    /**
     * reviewC3Ag1CommentInternalStep
     *
     * @var string
     */
    protected $reviewC3Ag1CommentInternalStep = '';

    /**
     * reviewTotalAg1CommentInternalStep
     *
     * @var string
     */
    protected $reviewTotalAg1CommentInternalStep = '';

    /**
     * reviewB15Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB15Ag2CommentInternalStep = '';

    /**
     * reviewB2Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB2Ag2CommentInternalStep = '';

    /**
     * reviewB22Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB22Ag2CommentInternalStep = '';

    /**
     * reviewB23Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewB23Ag2CommentInternalStep = '';

    /**
     * reviewC1Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewC1Ag2CommentInternalStep = '';

    /**
     * reviewC2Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewC2Ag2CommentInternalStep = '';

    /**
     * reviewC3Ag2CommentInternalStep
     *
     * @var string
     */
    protected $reviewC3Ag2CommentInternalStep = '';

    /**
     * reviewTotalAg2CommentInternalStep
     *
     * @var string
     */
    protected $reviewTotalAg2CommentInternalStep = '';

    /**
     * verantwortliche
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich>
     */
    protected $verantwortliche = null;

    /**
     * verantwortlicheMail
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich>
     */
    protected $verantwortlicheMail = null;

    /**
     * kopieVon
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Ansuchen
     */
    protected $kopieVon = null;

    /**
     * stammdaten
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Stammdaten
     */
    protected $stammdaten = null;

    /**
     * standorte
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Standort>
     */
    protected $standorte = null;

    /**
     * trainer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Trainer>
     */
    protected $trainer = null;

    /**
     * berater
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Berater>
     */
    protected $berater = null;

    /**
     * gutachter1
     *
     * @var \GeorgRinger\Ieb\Domain\Model\User
     */
    protected $gutachter1 = null;

    /**
     * gutachter2
     *
     * @var \GeorgRinger\Ieb\Domain\Model\User
     */
    protected $gutachter2 = null;

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
        $this->verantwortliche = $this->verantwortliche ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->verantwortlicheMail = $this->verantwortlicheMail ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->standorte = $this->standorte ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->trainer = $this->trainer ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->berater = $this->berater ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

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
     * Returns the version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets the version
     *
     * @param int $version
     * @return void
     */
    public function setVersion(int $version)
    {
        $this->version = $version;
    }

    /**
     * Returns the versionBasedOn
     *
     * @return int
     */
    public function getVersionBasedOn()
    {
        return $this->versionBasedOn;
    }

    /**
     * Sets the versionBasedOn
     *
     * @param int $versionBasedOn
     * @return void
     */
    public function setVersionBasedOn(int $versionBasedOn)
    {
        $this->versionBasedOn = $versionBasedOn;
    }

    /**
     * Returns the versionActive
     *
     * @return bool
     */
    public function getVersionActive()
    {
        return $this->versionActive;
    }

    /**
     * Sets the versionActive
     *
     * @param bool $versionActive
     * @return void
     */
    public function setVersionActive(bool $versionActive)
    {
        $this->versionActive = $versionActive;
    }

    /**
     * Returns the boolean state of versionActive
     *
     * @return bool
     */
    public function isVersionActive()
    {
        return $this->versionActive;
    }

    /**
     * Returns the nummer
     *
     * @return string
     */
    public function getNummer()
    {
        return $this->nummer;
    }

    /**
     * Sets the nummer
     *
     * @param string $nummer
     * @return void
     */
    public function setNummer(string $nummer)
    {
        $this->nummer = $nummer;
    }

    /**
     * Returns the akkreditierungDatum
     *
     * @return \DateTime
     */
    public function getAkkreditierungDatum()
    {
        return $this->akkreditierungDatum;
    }

    /**
     * Sets the akkreditierungDatum
     *
     * @param ?\DateTime $akkreditierungDatum
     * @return void
     */
    public function setAkkreditierungDatum(?\DateTime $akkreditierungDatum)
    {
        $akkreditierungDatum = $akkreditierungDatum === null ? 0 : $akkreditierungDatum;
        $this->akkreditierungDatum = $akkreditierungDatum;
    }

    /**
     * Returns the einreichDatum
     *
     * @return \DateTime
     */
    public function getEinreichDatum()
    {
        return $this->einreichDatum;
    }

    /**
     * Sets the einreichDatum
     *
     * @param ?\DateTime $einreichDatum
     * @return void
     */
    public function setEinreichDatum(?\DateTime $einreichDatum)
    {
        $einreichDatum = $einreichDatum === null ? 0 : $einreichDatum;
        $this->einreichDatum = $einreichDatum;
    }

    /**
     * Returns the zuteilungDatum
     *
     * @return \DateTime
     */
    public function getZuteilungDatum()
    {
        return $this->zuteilungDatum;
    }

    /**
     * Sets the zuteilungDatum
     *
     * @param ?\DateTime $zuteilungDatum
     * @return void
     */
    public function setZuteilungDatum(?\DateTime $zuteilungDatum)
    {
        $zuteilungDatum = $zuteilungDatum === null ? null : $zuteilungDatum;
        $this->zuteilungDatum = $zuteilungDatum;
    }

    /**
     * Returns the akkreditierungEntscheidungDatum
     *
     * @return \DateTime
     */
    public function getAkkreditierungEntscheidungDatum()
    {
        return $this->akkreditierungEntscheidungDatum;
    }

    /**
     * Sets the akkreditierungEntscheidungDatum
     *
     * @param ?\DateTime $akkreditierungEntscheidungDatum
     * @return void
     */
    public function setAkkreditierungEntscheidungDatum(?\DateTime $akkreditierungEntscheidungDatum)
    {
        $akkreditierungEntscheidungDatum = $akkreditierungEntscheidungDatum === null ? 0 : $akkreditierungEntscheidungDatum;
        $this->akkreditierungEntscheidungDatum = $akkreditierungEntscheidungDatum;
    }

    /**
     * Returns the typ
     *
     * @return int
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Sets the typ
     *
     * @param int $typ
     * @return void
     */
    public function setTyp(int $typ)
    {
        $this->typ = $typ;
    }

    /**
     * Returns the bundesland
     *
     * @return int
     */
    public function getBundesland()
    {
        return $this->bundesland;
    }

    /**
     * Sets the bundesland
     *
     * @param int $bundesland
     * @return void
     */
    public function setBundesland(int $bundesland)
    {
        $this->bundesland = $bundesland;
    }

    /**
     * Returns the uebersichtText
     *
     * @return string
     */
    public function getUebersichtText()
    {
        return $this->uebersichtText;
    }

    /**
     * Sets the uebersichtText
     *
     * @param string $uebersichtText
     * @return void
     */
    public function setUebersichtText(string $uebersichtText)
    {
        $this->uebersichtText = $uebersichtText;
    }

    /**
     * Returns the uebersichtDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getUebersichtDatei()
    {
        return $this->uebersichtDatei;
    }

    /**
     * Sets the uebersichtDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $uebersichtDatei
     * @return void
     */
    public function setUebersichtDatei($uebersichtDatei)
    {
        $this->uebersichtDatei = $uebersichtDatei;
    }

    /**
     * Returns the zielgruppenAnsprache
     *
     * @return string
     */
    public function getZielgruppenAnsprache()
    {
        return $this->zielgruppenAnsprache;
    }

    /**
     * Sets the zielgruppenAnsprache
     *
     * @param string $zielgruppenAnsprache
     * @return void
     */
    public function setZielgruppenAnsprache(string $zielgruppenAnsprache)
    {
        $this->zielgruppenAnsprache = $zielgruppenAnsprache;
    }

    /**
     * Returns the zielgruppenAnspracheDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getZielgruppenAnspracheDatei()
    {
        return $this->zielgruppenAnspracheDatei;
    }

    /**
     * Sets the zielgruppenAnspracheDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $zielgruppenAnspracheDatei
     * @return void
     */
    public function setZielgruppenAnspracheDatei($zielgruppenAnspracheDatei)
    {
        $this->zielgruppenAnspracheDatei = $zielgruppenAnspracheDatei;
    }

    /**
     * Returns the fernlehre
     *
     * @return bool
     */
    public function getFernlehre()
    {
        return $this->fernlehre;
    }

    /**
     * Sets the fernlehre
     *
     * @param bool $fernlehre
     * @return void
     */
    public function setFernlehre(bool $fernlehre)
    {
        $this->fernlehre = $fernlehre;
    }

    /**
     * Returns the boolean state of fernlehre
     *
     * @return bool
     */
    public function isFernlehre()
    {
        return $this->fernlehre;
    }

    /**
     * Returns the kinderbetreuung
     *
     * @return bool
     */
    public function getKinderbetreuung()
    {
        return $this->kinderbetreuung;
    }

    /**
     * Sets the kinderbetreuung
     *
     * @param bool $kinderbetreuung
     * @return void
     */
    public function setKinderbetreuung(bool $kinderbetreuung)
    {
        $this->kinderbetreuung = $kinderbetreuung;
    }

    /**
     * Returns the boolean state of kinderbetreuung
     *
     * @return bool
     */
    public function isKinderbetreuung()
    {
        return $this->kinderbetreuung;
    }

    /**
     * Returns the lernziele
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getLernziele()
    {
        return $this->lernziele;
    }

    /**
     * Sets the lernziele
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lernziele
     * @return void
     */
    public function setLernziele($lernziele)
    {
        $this->lernziele = $lernziele;
    }

    /**
     * Returns the lernstandserhebung
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLernstandserhebung()
    {
        return $this->lernstandserhebung;
    }

    /**
     * Sets the lernstandserhebung
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lernstandserhebung
     * @return void
     */
    public function setLernstandserhebung($lernstandserhebung)
    {
        $this->lernstandserhebung = $lernstandserhebung;
    }

    /**
     * Returns the diversity
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getDiversity()
    {
        return $this->diversity;
    }

    /**
     * Sets the diversity
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $diversity
     * @return void
     */
    public function setDiversity($diversity)
    {
        $this->diversity = $diversity;
    }

    /**
     * Returns the didaktikKommentar
     *
     * @return string
     */
    public function getDidaktikKommentar()
    {
        return $this->didaktikKommentar;
    }

    /**
     * Sets the didaktikKommentar
     *
     * @param string $didaktikKommentar
     * @return void
     */
    public function setDidaktikKommentar(string $didaktikKommentar)
    {
        $this->didaktikKommentar = $didaktikKommentar;
    }

    /**
     * Returns the beratungText
     *
     * @return string
     */
    public function getBeratungText()
    {
        return $this->beratungText;
    }

    /**
     * Sets the beratungText
     *
     * @param string $beratungText
     * @return void
     */
    public function setBeratungText(string $beratungText)
    {
        $this->beratungText = $beratungText;
    }

    /**
     * Returns the beratungDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getBeratungDatei()
    {
        return $this->beratungDatei;
    }

    /**
     * Sets the beratungDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $beratungDatei
     * @return void
     */
    public function setBeratungDatei($beratungDatei)
    {
        $this->beratungDatei = $beratungDatei;
    }

    /**
     * Adds a AngebotVerantwortlich
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortliche
     * @return void
     */
    public function addVerantwortliche(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortliche)
    {
        $this->verantwortliche->attach($verantwortliche);
    }

    /**
     * Removes a AngebotVerantwortlich
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheToRemove The AngebotVerantwortlich to be removed
     * @return void
     */
    public function removeVerantwortliche(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheToRemove)
    {
        $this->verantwortliche->detach($verantwortlicheToRemove);
    }

    /**
     * Returns the verantwortliche
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich>
     */
    public function getVerantwortliche()
    {
        return $this->verantwortliche;
    }

    /**
     * Sets the verantwortliche
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich> $verantwortliche
     * @return void
     */
    public function setVerantwortliche(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $verantwortliche)
    {
        $this->verantwortliche = $verantwortliche;
    }

    /**
     * Returns the reviewB1CommentInternal
     *
     * @return string
     */
    public function getReviewB1CommentInternal()
    {
        return $this->reviewB1CommentInternal;
    }

    /**
     * Sets the reviewB1CommentInternal
     *
     * @param string $reviewB1CommentInternal
     * @return void
     */
    public function setReviewB1CommentInternal(string $reviewB1CommentInternal)
    {
        $this->reviewB1CommentInternal = $reviewB1CommentInternal;
    }

    /**
     * Returns the reviewB1Status
     *
     * @return int
     */
    public function getReviewB1Status()
    {
        return $this->reviewB1Status;
    }

    /**
     * Sets the reviewB1Status
     *
     * @param int $reviewB1Status
     * @return void
     */
    public function setReviewB1Status(int $reviewB1Status)
    {
        $this->reviewB1Status = $reviewB1Status;
    }

    /**
     * Returns the reviewB2CommentInternal
     *
     * @return string
     */
    public function getReviewB2CommentInternal()
    {
        return $this->reviewB2CommentInternal;
    }

    /**
     * Sets the reviewB2CommentInternal
     *
     * @param string $reviewB2CommentInternal
     * @return void
     */
    public function setReviewB2CommentInternal(string $reviewB2CommentInternal)
    {
        $this->reviewB2CommentInternal = $reviewB2CommentInternal;
    }

    /**
     * Returns the reviewB2CommentTr
     *
     * @return string
     */
    public function getReviewB2CommentTr()
    {
        return $this->reviewB2CommentTr;
    }

    /**
     * Sets the reviewB2CommentTr
     *
     * @param string $reviewB2CommentTr
     * @return void
     */
    public function setReviewB2CommentTr(string $reviewB2CommentTr)
    {
        $this->reviewB2CommentTr = $reviewB2CommentTr;
    }

    /**
     * Returns the reviewB2Status
     *
     * @return int
     */
    public function getReviewB2Status()
    {
        return $this->reviewB2Status;
    }

    /**
     * Sets the reviewB2Status
     *
     * @param int $reviewB2Status
     * @return void
     */
    public function setReviewB2Status(int $reviewB2Status)
    {
        $this->reviewB2Status = $reviewB2Status;
    }

    /**
     * Returns the reviewC1CommentInternal
     *
     * @return string
     */
    public function getReviewC1CommentInternal()
    {
        return $this->reviewC1CommentInternal;
    }

    /**
     * Sets the reviewC1CommentInternal
     *
     * @param string $reviewC1CommentInternal
     * @return void
     */
    public function setReviewC1CommentInternal(string $reviewC1CommentInternal)
    {
        $this->reviewC1CommentInternal = $reviewC1CommentInternal;
    }

    /**
     * Returns the reviewC1CommentTr
     *
     * @return string
     */
    public function getReviewC1CommentTr()
    {
        return $this->reviewC1CommentTr;
    }

    /**
     * Sets the reviewC1CommentTr
     *
     * @param string $reviewC1CommentTr
     * @return void
     */
    public function setReviewC1CommentTr(string $reviewC1CommentTr)
    {
        $this->reviewC1CommentTr = $reviewC1CommentTr;
    }

    /**
     * Returns the reviewC1Status
     *
     * @return int
     */
    public function getReviewC1Status()
    {
        return $this->reviewC1Status;
    }

    /**
     * Sets the reviewC1Status
     *
     * @param int $reviewC1Status
     * @return void
     */
    public function setReviewC1Status(int $reviewC1Status)
    {
        $this->reviewC1Status = $reviewC1Status;
    }

    /**
     * Returns the reviewC2CommentInternal
     *
     * @return string
     */
    public function getReviewC2CommentInternal()
    {
        return $this->reviewC2CommentInternal;
    }

    /**
     * Sets the reviewC2CommentInternal
     *
     * @param string $reviewC2CommentInternal
     * @return void
     */
    public function setReviewC2CommentInternal(string $reviewC2CommentInternal)
    {
        $this->reviewC2CommentInternal = $reviewC2CommentInternal;
    }

    /**
     * Returns the reviewC2CommentTr
     *
     * @return string
     */
    public function getReviewC2CommentTr()
    {
        return $this->reviewC2CommentTr;
    }

    /**
     * Sets the reviewC2CommentTr
     *
     * @param string $reviewC2CommentTr
     * @return void
     */
    public function setReviewC2CommentTr(string $reviewC2CommentTr)
    {
        $this->reviewC2CommentTr = $reviewC2CommentTr;
    }

    /**
     * Returns the reviewC2Status
     *
     * @return int
     */
    public function getReviewC2Status()
    {
        return $this->reviewC2Status;
    }

    /**
     * Sets the reviewC2Status
     *
     * @param int $reviewC2Status
     * @return void
     */
    public function setReviewC2Status(int $reviewC2Status)
    {
        $this->reviewC2Status = $reviewC2Status;
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
     * Returns the reviewTotalCommentInternal
     *
     * @return string
     */
    public function getReviewTotalCommentInternal()
    {
        return $this->reviewTotalCommentInternal;
    }

    /**
     * Sets the reviewTotalCommentInternal
     *
     * @param string $reviewTotalCommentInternal
     * @return void
     */
    public function setReviewTotalCommentInternal(string $reviewTotalCommentInternal)
    {
        $this->reviewTotalCommentInternal = $reviewTotalCommentInternal;
    }

    /**
     * Returns the reviewTotalCommentTr
     *
     * @return string
     */
    public function getReviewTotalCommentTr()
    {
        return $this->reviewTotalCommentTr;
    }

    /**
     * Sets the reviewTotalCommentTr
     *
     * @param string $reviewTotalCommentTr
     * @return void
     */
    public function setReviewTotalCommentTr(string $reviewTotalCommentTr)
    {
        $this->reviewTotalCommentTr = $reviewTotalCommentTr;
    }

    /**
     * Returns the reviewTotalStatus
     *
     * @return int
     */
    public function getReviewTotalStatus()
    {
        return $this->reviewTotalStatus;
    }

    /**
     * Sets the reviewTotalStatus
     *
     * @param int $reviewTotalStatus
     * @return void
     */
    public function setReviewTotalStatus(int $reviewTotalStatus)
    {
        $this->reviewTotalStatus = $reviewTotalStatus;
    }

    /**
     * Returns the reviewTotalFrist
     *
     * @return \DateTime
     */
    public function getReviewTotalFrist()
    {
        return $this->reviewTotalFrist;
    }

    /**
     * Sets the reviewTotalFrist
     *
     * @param ?\DateTime $reviewTotalFrist
     * @return void
     */
    public function setReviewTotalFrist(?\DateTime $reviewTotalFrist)
    {
        $reviewTotalFrist = $reviewTotalFrist === null ? 0 : $reviewTotalFrist;
        $this->reviewTotalFrist = $reviewTotalFrist;
    }

    /**
     * Returns the kopieVon
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Ansuchen
     */
    public function getKopieVon()
    {
        return $this->kopieVon;
    }

    /**
     * Sets the kopieVon
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $kopieVon
     * @return void
     */
    public function setKopieVon(\GeorgRinger\Ieb\Domain\Model\Ansuchen $kopieVon)
    {
        $this->kopieVon = $kopieVon;
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
     * Returns the status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param int $status
     * @return void
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Returns the stammdaten
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Stammdaten
     */
    public function getStammdaten()
    {
        return $this->stammdaten;
    }

    /**
     * Sets the stammdaten
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten
     * @return void
     */
    public function setStammdaten(\GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten)
    {
        $this->stammdaten = $stammdaten;
    }

    /**
     * Adds a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standorte
     * @return void
     */
    public function addStandorte(\GeorgRinger\Ieb\Domain\Model\Standort $standorte)
    {
        $this->standorte->attach($standorte);
    }

    /**
     * Removes a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standorteToRemove The Standort to be removed
     * @return void
     */
    public function removeStandorte(\GeorgRinger\Ieb\Domain\Model\Standort $standorteToRemove)
    {
        $this->standorte->detach($standorteToRemove);
    }

    /**
     * Returns the standorte
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Standort>
     */
    public function getStandorte()
    {
        return $this->standorte;
    }

    /**
     * Sets the standorte
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Standort> $standorte
     * @return void
     */
    public function setStandorte(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $standorte)
    {
        $this->standorte = $standorte;
    }

    /**
     * Adds a Trainer
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainer
     * @return void
     */
    public function addTrainer(\GeorgRinger\Ieb\Domain\Model\Trainer $trainer)
    {
        $this->trainer->attach($trainer);
    }

    /**
     * Removes a Trainer
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Trainer $trainerToRemove The Trainer to be removed
     * @return void
     */
    public function removeTrainer(\GeorgRinger\Ieb\Domain\Model\Trainer $trainerToRemove)
    {
        $this->trainer->detach($trainerToRemove);
    }

    /**
     * Returns the trainer
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Trainer>
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * Sets the trainer
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Trainer> $trainer
     * @return void
     */
    public function setTrainer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $trainer)
    {
        $this->trainer = $trainer;
    }

    /**
     * Adds a Berater
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     * @return void
     */
    public function addBerater(\GeorgRinger\Ieb\Domain\Model\Berater $berater)
    {
        $this->berater->attach($berater);
    }

    /**
     * Removes a Berater
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $beraterToRemove The Berater to be removed
     * @return void
     */
    public function removeBerater(\GeorgRinger\Ieb\Domain\Model\Berater $beraterToRemove)
    {
        $this->berater->detach($beraterToRemove);
    }

    /**
     * Returns the berater
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Berater>
     */
    public function getBerater()
    {
        return $this->berater;
    }

    /**
     * Sets the berater
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Berater> $berater
     * @return void
     */
    public function setBerater(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $berater)
    {
        $this->berater = $berater;
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
     * Returns the kooperationDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getKooperationDatei()
    {
        return $this->kooperationDatei;
    }

    /**
     * Sets the kooperationDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $kooperationDatei
     * @return void
     */
    public function setKooperationDatei($kooperationDatei)
    {
        $this->kooperationDatei = $kooperationDatei;
    }

    /**
     * Returns the kooperation
     *
     * @return string
     */
    public function getKooperation()
    {
        return $this->kooperation;
    }

    /**
     * Sets the kooperation
     *
     * @param string $kooperation
     * @return void
     */
    public function setKooperation(string $kooperation)
    {
        $this->kooperation = $kooperation;
    }

    /**
     * Returns the standortErklaerung
     *
     * @return bool
     */
    public function getStandortErklaerung()
    {
        return $this->standortErklaerung;
    }

    /**
     * Sets the standortErklaerung
     *
     * @param bool $standortErklaerung
     * @return void
     */
    public function setStandortErklaerung(bool $standortErklaerung)
    {
        $this->standortErklaerung = $standortErklaerung;
    }

    /**
     * Returns the boolean state of standortErklaerung
     *
     * @return bool
     */
    public function isStandortErklaerung()
    {
        return $this->standortErklaerung;
    }

    /**
     * Returns the kompetenz1
     *
     * @return bool
     */
    public function getKompetenz1()
    {
        return $this->kompetenz1;
    }

    /**
     * Sets the kompetenz1
     *
     * @param bool $kompetenz1
     * @return void
     */
    public function setKompetenz1(bool $kompetenz1)
    {
        $this->kompetenz1 = $kompetenz1;
    }

    /**
     * Returns the boolean state of kompetenz1
     *
     * @return bool
     */
    public function isKompetenz1()
    {
        return $this->kompetenz1;
    }

    /**
     * Returns the kompetenz2
     *
     * @return bool
     */
    public function getKompetenz2()
    {
        return $this->kompetenz2;
    }

    /**
     * Sets the kompetenz2
     *
     * @param bool $kompetenz2
     * @return void
     */
    public function setKompetenz2(bool $kompetenz2)
    {
        $this->kompetenz2 = $kompetenz2;
    }

    /**
     * Returns the boolean state of kompetenz2
     *
     * @return bool
     */
    public function isKompetenz2()
    {
        return $this->kompetenz2;
    }

    /**
     * Returns the kompetenz3
     *
     * @return bool
     */
    public function getKompetenz3()
    {
        return $this->kompetenz3;
    }

    /**
     * Sets the kompetenz3
     *
     * @param bool $kompetenz3
     * @return void
     */
    public function setKompetenz3(bool $kompetenz3)
    {
        $this->kompetenz3 = $kompetenz3;
    }

    /**
     * Returns the boolean state of kompetenz3
     *
     * @return bool
     */
    public function isKompetenz3()
    {
        return $this->kompetenz3;
    }

    /**
     * Returns the kompetenz4
     *
     * @return bool
     */
    public function getKompetenz4()
    {
        return $this->kompetenz4;
    }

    /**
     * Sets the kompetenz4
     *
     * @param bool $kompetenz4
     * @return void
     */
    public function setKompetenz4(bool $kompetenz4)
    {
        $this->kompetenz4 = $kompetenz4;
    }

    /**
     * Returns the boolean state of kompetenz4
     *
     * @return bool
     */
    public function isKompetenz4()
    {
        return $this->kompetenz4;
    }

    /**
     * Returns the kompetenz5
     *
     * @return bool
     */
    public function getKompetenz5()
    {
        return $this->kompetenz5;
    }

    /**
     * Sets the kompetenz5
     *
     * @param bool $kompetenz5
     * @return void
     */
    public function setKompetenz5(bool $kompetenz5)
    {
        $this->kompetenz5 = $kompetenz5;
    }

    /**
     * Returns the boolean state of kompetenz5
     *
     * @return bool
     */
    public function isKompetenz5()
    {
        return $this->kompetenz5;
    }

    /**
     * Returns the kompetenz6
     *
     * @return bool
     */
    public function getKompetenz6()
    {
        return $this->kompetenz6;
    }

    /**
     * Sets the kompetenz6
     *
     * @param bool $kompetenz6
     * @return void
     */
    public function setKompetenz6(bool $kompetenz6)
    {
        $this->kompetenz6 = $kompetenz6;
    }

    /**
     * Returns the boolean state of kompetenz6
     *
     * @return bool
     */
    public function isKompetenz6()
    {
        return $this->kompetenz6;
    }

    /**
     * Returns the kompetenz7
     *
     * @return bool
     */
    public function getKompetenz7()
    {
        return $this->kompetenz7;
    }

    /**
     * Sets the kompetenz7
     *
     * @param bool $kompetenz7
     * @return void
     */
    public function setKompetenz7(bool $kompetenz7)
    {
        $this->kompetenz7 = $kompetenz7;
    }

    /**
     * Returns the boolean state of kompetenz7
     *
     * @return bool
     */
    public function isKompetenz7()
    {
        return $this->kompetenz7;
    }

    /**
     * Returns the kompetenz8
     *
     * @return bool
     */
    public function getKompetenz8()
    {
        return $this->kompetenz8;
    }

    /**
     * Sets the kompetenz8
     *
     * @param bool $kompetenz8
     * @return void
     */
    public function setKompetenz8(bool $kompetenz8)
    {
        $this->kompetenz8 = $kompetenz8;
    }

    /**
     * Returns the boolean state of kompetenz8
     *
     * @return bool
     */
    public function isKompetenz8()
    {
        return $this->kompetenz8;
    }

    /**
     * Returns the kompetenz9
     *
     * @return bool
     */
    public function getKompetenz9()
    {
        return $this->kompetenz9;
    }

    /**
     * Sets the kompetenz9
     *
     * @param bool $kompetenz9
     * @return void
     */
    public function setKompetenz9(bool $kompetenz9)
    {
        $this->kompetenz9 = $kompetenz9;
    }

    /**
     * Returns the boolean state of kompetenz9
     *
     * @return bool
     */
    public function isKompetenz9()
    {
        return $this->kompetenz9;
    }

    /**
     * Returns the kompetenzText1
     *
     * @return string
     */
    public function getKompetenzText1()
    {
        return $this->kompetenzText1;
    }

    /**
     * Sets the kompetenzText1
     *
     * @param string $kompetenzText1
     * @return void
     */
    public function setKompetenzText1(string $kompetenzText1)
    {
        $this->kompetenzText1 = $kompetenzText1;
    }

    /**
     * Returns the erklaerungd1
     *
     * @return bool erklaerungd1
     */
    public function getErklaerungd1()
    {
        return $this->erklaerungd1;
    }

    /**
     * Sets the erklaerungd1
     *
     * @param bool $erklaerungd1
     * @return void
     */
    public function setErklaerungd1(bool $erklaerungd1)
    {
        $this->erklaerungd1 = $erklaerungd1;
    }

    /**
     * Returns the boolean state of erklaerungd1
     *
     * @return bool erklaerungd1
     */
    public function isErklaerungd1()
    {
        return $this->erklaerungd1;
    }

    /**
     * Returns the erklaerungd2
     *
     * @return bool erklaerungd2
     */
    public function getErklaerungd2()
    {
        return $this->erklaerungd2;
    }

    /**
     * Sets the erklaerungd2
     *
     * @param bool $erklaerungd2
     * @return void
     */
    public function setErklaerungd2(bool $erklaerungd2)
    {
        $this->erklaerungd2 = $erklaerungd2;
    }

    /**
     * Returns the boolean state of erklaerungd2
     *
     * @return bool erklaerungd2
     */
    public function isErklaerungd2()
    {
        return $this->erklaerungd2;
    }

    /**
     * Returns the erklaerungd3
     *
     * @return bool erklaerungd3
     */
    public function getErklaerungd3()
    {
        return $this->erklaerungd3;
    }

    /**
     * Sets the erklaerungd3
     *
     * @param bool $erklaerungd3
     * @return void
     */
    public function setErklaerungd3(bool $erklaerungd3)
    {
        $this->erklaerungd3 = $erklaerungd3;
    }

    /**
     * Returns the boolean state of erklaerungd3
     *
     * @return bool erklaerungd3
     */
    public function isErklaerungd3()
    {
        return $this->erklaerungd3;
    }

    /**
     * Returns the erklaerungTeilA
     *
     * @return bool
     */
    public function getErklaerungTeilA()
    {
        return $this->erklaerungTeilA;
    }

    /**
     * Sets the erklaerungTeilA
     *
     * @param bool $erklaerungTeilA
     * @return void
     */
    public function setErklaerungTeilA(bool $erklaerungTeilA)
    {
        $this->erklaerungTeilA = $erklaerungTeilA;
    }

    /**
     * Returns the boolean state of erklaerungTeilA
     *
     * @return bool
     */
    public function isErklaerungTeilA()
    {
        return $this->erklaerungTeilA;
    }

    /**
     * Returns the erklaerungd5
     *
     * @return bool
     */
    public function getErklaerungd5()
    {
        return $this->erklaerungd5;
    }

    /**
     * Sets the erklaerungd5
     *
     * @param bool $erklaerungd5
     * @return void
     */
    public function setErklaerungd5(bool $erklaerungd5)
    {
        $this->erklaerungd5 = $erklaerungd5;
    }

    /**
     * Returns the boolean state of erklaerungd5
     *
     * @return bool
     */
    public function isErklaerungd5()
    {
        return $this->erklaerungd5;
    }

    /**
     * Returns the erklaerungTeilB
     *
     * @return bool
     */
    public function getErklaerungTeilB()
    {
        return $this->erklaerungTeilB;
    }

    /**
     * Sets the erklaerungTeilB
     *
     * @param bool $erklaerungTeilB
     * @return void
     */
    public function setErklaerungTeilB(bool $erklaerungTeilB)
    {
        $this->erklaerungTeilB = $erklaerungTeilB;
    }

    /**
     * Returns the boolean state of erklaerungTeilB
     *
     * @return bool
     */
    public function isErklaerungTeilB()
    {
        return $this->erklaerungTeilB;
    }
    public function getTitleTag()
    {
        return sprintf('%s [%s]', $this->name, $this->nummer);
    }

    /**
     * Adds a AngebotVerantwortlich
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheMail
     * @return void
     */
    public function addVerantwortlicheMail(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheMail)
    {
        $this->verantwortlicheMail->attach($verantwortlicheMail);
    }

    /**
     * Removes a AngebotVerantwortlich
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheMailToRemove The AngebotVerantwortlich to be removed
     * @return void
     */
    public function removeVerantwortlicheMail(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $verantwortlicheMailToRemove)
    {
        $this->verantwortlicheMail->detach($verantwortlicheMailToRemove);
    }

    /**
     * Returns the verantwortlicheMail
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich>
     */
    public function getVerantwortlicheMail()
    {
        return $this->verantwortlicheMail;
    }

    /**
     * Sets the verantwortlicheMail
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich> $verantwortlicheMail
     * @return void
     */
    public function setVerantwortlicheMail(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $verantwortlicheMail)
    {
        $this->verantwortlicheMail = $verantwortlicheMail;
    }
    public function isEditableByTr()
    {
        return AnsuchenStatus::statusBearbeitbarDurchTrCheck($this->status);
    }

    /**
     * Returns the copyStammdaten
     *
     * @return string
     */
    public function getCopyStammdaten()
    {
        return $this->copyStammdaten;
    }

    /**
     * Sets the copyStammdaten
     *
     * @param string $copyStammdaten
     * @return void
     */
    public function setCopyStammdaten(string $copyStammdaten)
    {
        $this->copyStammdaten = $copyStammdaten;
    }

    /**
     * Returns the copyTrainer
     *
     * @return string
     */
    public function getCopyTrainer()
    {
        return $this->copyTrainer;
    }

    /**
     * Sets the copyTrainer
     *
     * @param string $copyTrainer
     * @return void
     */
    public function setCopyTrainer(string $copyTrainer)
    {
        $this->copyTrainer = $copyTrainer;
    }

    /**
     * Returns the copyBerater
     *
     * @return string
     */
    public function getCopyBerater()
    {
        return $this->copyBerater;
    }

    /**
     * Sets the copyBerater
     *
     * @param string $copyBerater
     * @return void
     */
    public function setCopyBerater(string $copyBerater)
    {
        $this->copyBerater = $copyBerater;
    }

    /**
     * Returns the copyStandorte
     *
     * @return string
     */
    public function getCopyStandorte()
    {
        return $this->copyStandorte;
    }

    /**
     * Sets the copyStandorte
     *
     * @param string $copyStandorte
     * @return void
     */
    public function setCopyStandorte(string $copyStandorte)
    {
        $this->copyStandorte = $copyStandorte;
    }
    public function getCopyStammdatenData()
    {
        return $this->getConvertedJsonSimple($this->copyStammdaten);
    }
    public function getCopyStandorteData()
    {
        return $this->getConvertedJson($this->copyStandorte);
    }
    public function getCopyTrainerData()
    {
        return $this->getConvertedJson($this->copyTrainer);
    }
    public function getCopyBeraterData()
    {
        return $this->getConvertedJson($this->copyBerater);
    }
    public function getCopyVerantwortlicheData()
    {
        return $this->getConvertedJson($this->copyVerantwortliche);
    }
    public function getCopyVerantwortlicheMailData()
    {
        return $this->getConvertedJson($this->copyVerantwortlicheMail);
    }
    public function getReviewB1CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB1CommentInternal);
    }
    public function getReviewB14CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB14CommentInternal);
    }
    public function getReviewB15CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB15CommentInternal);
    }
    public function getReviewB22CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB22CommentInternal);
    }
    public function getReviewB23CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB23CommentInternal);
    }
    public function getReviewB2CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB2CommentInternal);
    }
    public function getReviewC1CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewC1CommentInternal);
    }
    public function getReviewC2CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewC2CommentInternal);
    }
    public function getReviewC3CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewC3CommentInternal);
    }
    public function getReviewTotalCommentInternalData()
    {
        return $this->getConvertedJson($this->reviewTotalCommentInternal);
    }

    /**
     * Returns the reviewB1CommentTr
     *
     * @return string reviewB1CommentTr
     */
    public function getReviewB1CommentTr()
    {
        return $this->reviewB1CommentTr;
    }

    /**
     * Sets the reviewB1CommentTr
     *
     * @param string $reviewB1CommentTr
     * @return void
     */
    public function setReviewB1CommentTr(string $reviewB1CommentTr)
    {
        $this->reviewB1CommentTr = $reviewB1CommentTr;
    }

    /**
     * Returns the reviewB14CommentInternal
     *
     * @return string
     */
    public function getReviewB14CommentInternal()
    {
        return $this->reviewB14CommentInternal;
    }

    /**
     * Sets the reviewB14CommentInternal
     *
     * @param string $reviewB14CommentInternal
     * @return void
     */
    public function setReviewB14CommentInternal(string $reviewB14CommentInternal)
    {
        $this->reviewB14CommentInternal = $reviewB14CommentInternal;
    }

    /**
     * Returns the reviewB14CommentTr
     *
     * @return string
     */
    public function getReviewB14CommentTr()
    {
        return $this->reviewB14CommentTr;
    }

    /**
     * Sets the reviewB14CommentTr
     *
     * @param string $reviewB14CommentTr
     * @return void
     */
    public function setReviewB14CommentTr(string $reviewB14CommentTr)
    {
        $this->reviewB14CommentTr = $reviewB14CommentTr;
    }

    /**
     * Returns the reviewB14Status
     *
     * @return int
     */
    public function getReviewB14Status()
    {
        return $this->reviewB14Status;
    }

    /**
     * Sets the reviewB14Status
     *
     * @param int $reviewB14Status
     * @return void
     */
    public function setReviewB14Status(int $reviewB14Status)
    {
        $this->reviewB14Status = $reviewB14Status;
    }

    /**
     * Returns the reviewB15CommentInternal
     *
     * @return string
     */
    public function getReviewB15CommentInternal()
    {
        return $this->reviewB15CommentInternal;
    }

    /**
     * Sets the reviewB15CommentInternal
     *
     * @param string $reviewB15CommentInternal
     * @return void
     */
    public function setReviewB15CommentInternal(string $reviewB15CommentInternal)
    {
        $this->reviewB15CommentInternal = $reviewB15CommentInternal;
    }

    /**
     * Returns the reviewB15CommentTr
     *
     * @return string
     */
    public function getReviewB15CommentTr()
    {
        return $this->reviewB15CommentTr;
    }

    /**
     * Sets the reviewB15CommentTr
     *
     * @param string $reviewB15CommentTr
     * @return void
     */
    public function setReviewB15CommentTr(string $reviewB15CommentTr)
    {
        $this->reviewB15CommentTr = $reviewB15CommentTr;
    }

    /**
     * Returns the reviewB15Status
     *
     * @return int
     */
    public function getReviewB15Status()
    {
        return $this->reviewB15Status;
    }

    /**
     * Sets the reviewB15Status
     *
     * @param int $reviewB15Status
     * @return void
     */
    public function setReviewB15Status(int $reviewB15Status)
    {
        $this->reviewB15Status = $reviewB15Status;
    }

    /**
     * Returns the reviewB22CommentInternal
     *
     * @return string
     */
    public function getReviewB22CommentInternal()
    {
        return $this->reviewB22CommentInternal;
    }

    /**
     * Sets the reviewB22CommentInternal
     *
     * @param string $reviewB22CommentInternal
     * @return void
     */
    public function setReviewB22CommentInternal(string $reviewB22CommentInternal)
    {
        $this->reviewB22CommentInternal = $reviewB22CommentInternal;
    }

    /**
     * Returns the reviewB22CommentTr
     *
     * @return string
     */
    public function getReviewB22CommentTr()
    {
        return $this->reviewB22CommentTr;
    }

    /**
     * Sets the reviewB22CommentTr
     *
     * @param string $reviewB22CommentTr
     * @return void
     */
    public function setReviewB22CommentTr(string $reviewB22CommentTr)
    {
        $this->reviewB22CommentTr = $reviewB22CommentTr;
    }

    /**
     * Returns the reviewB23CommentInternal
     *
     * @return string
     */
    public function getReviewB23CommentInternal()
    {
        return $this->reviewB23CommentInternal;
    }

    /**
     * Sets the reviewB23CommentInternal
     *
     * @param string $reviewB23CommentInternal
     * @return void
     */
    public function setReviewB23CommentInternal(string $reviewB23CommentInternal)
    {
        $this->reviewB23CommentInternal = $reviewB23CommentInternal;
    }

    /**
     * Returns the reviewB23CommentTr
     *
     * @return string
     */
    public function getReviewB23CommentTr()
    {
        return $this->reviewB23CommentTr;
    }

    /**
     * Sets the reviewB23CommentTr
     *
     * @param string $reviewB23CommentTr
     * @return void
     */
    public function setReviewB23CommentTr(string $reviewB23CommentTr)
    {
        $this->reviewB23CommentTr = $reviewB23CommentTr;
    }

    /**
     * Returns the reviewB23Status
     *
     * @return int
     */
    public function getReviewB23Status()
    {
        return $this->reviewB23Status;
    }

    /**
     * Sets the reviewB23Status
     *
     * @param int $reviewB23Status
     * @return void
     */
    public function setReviewB23Status(int $reviewB23Status)
    {
        $this->reviewB23Status = $reviewB23Status;
    }

    /**
     * Returns the reviewB22Status
     *
     * @return int reviewB22Status
     */
    public function getReviewB22Status()
    {
        return $this->reviewB22Status;
    }

    /**
     * Sets the reviewB22Status
     *
     * @param int $reviewB22Status
     * @return void
     */
    public function setReviewB22Status(int $reviewB22Status)
    {
        $this->reviewB22Status = $reviewB22Status;
    }

    /**
     * @return string
     */
    public function getReviewB1CommentInternalStep()
    {
        return $this->reviewB1CommentInternalStep;
    }

    /**
     * @param string $reviewB1CommentInternalStep
     */
    public function setReviewB1CommentInternalStep(string $reviewB1CommentInternalStep)
    {
        $this->reviewB1CommentInternalStep = $reviewB1CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewB2CommentInternalStep()
    {
        return $this->reviewB2CommentInternalStep;
    }

    /**
     * @param string $reviewB2CommentInternalStep
     */
    public function setReviewB2CommentInternalStep(string $reviewB2CommentInternalStep)
    {
        $this->reviewB2CommentInternalStep = $reviewB2CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewC1CommentInternalStep()
    {
        return $this->reviewC1CommentInternalStep;
    }

    /**
     * @param string $reviewC1CommentInternalStep
     */
    public function setReviewC1CommentInternalStep(string $reviewC1CommentInternalStep)
    {
        $this->reviewC1CommentInternalStep = $reviewC1CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewC2CommentInternalStep()
    {
        return $this->reviewC2CommentInternalStep;
    }

    /**
     * @param string $reviewC2CommentInternalStep
     */
    public function setReviewC2CommentInternalStep(string $reviewC2CommentInternalStep)
    {
        $this->reviewC2CommentInternalStep = $reviewC2CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewC3CommentInternalStep()
    {
        return $this->reviewC3CommentInternalStep;
    }

    /**
     * @param string $reviewC3CommentInternalStep
     */
    public function setReviewC3CommentInternalStep(string $reviewC3CommentInternalStep)
    {
        $this->reviewC3CommentInternalStep = $reviewC3CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewTotalCommentInternalStep()
    {
        return $this->reviewTotalCommentInternalStep;
    }

    /**
     * @param string $reviewTotalCommentInternalStep
     */
    public function setReviewTotalCommentInternalStep(string $reviewTotalCommentInternalStep)
    {
        $this->reviewTotalCommentInternalStep = $reviewTotalCommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewB14CommentInternalStep()
    {
        return $this->reviewB14CommentInternalStep;
    }

    /**
     * @param string $reviewB14CommentInternalStep
     */
    public function setReviewB14CommentInternalStep(string $reviewB14CommentInternalStep)
    {
        $this->reviewB14CommentInternalStep = $reviewB14CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewB15CommentInternalStep()
    {
        return $this->reviewB15CommentInternalStep;
    }

    /**
     * @param string $reviewB15CommentInternalStep
     */
    public function setReviewB15CommentInternalStep(string $reviewB15CommentInternalStep)
    {
        $this->reviewB15CommentInternalStep = $reviewB15CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewB22CommentInternalStep()
    {
        return $this->reviewB22CommentInternalStep;
    }

    /**
     * @param string $reviewB22CommentInternalStep
     */
    public function setReviewB22CommentInternalStep(string $reviewB22CommentInternalStep)
    {
        $this->reviewB22CommentInternalStep = $reviewB22CommentInternalStep;
    }

    /**
     * @return string
     */
    public function getReviewB23CommentInternalStep()
    {
        return $this->reviewB23CommentInternalStep;
    }

    /**
     * @param string $reviewB23CommentInternalStep
     */
    public function setReviewB23CommentInternalStep(string $reviewB23CommentInternalStep)
    {
        $this->reviewB23CommentInternalStep = $reviewB23CommentInternalStep;
    }
    public function isEinReichbarDurchTr()
    {
        return in_array($this->status, AnsuchenStatus::statusBearbeitbarDurchTr(), true);
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * Returns the copyVerantwortliche
     *
     * @return string
     */
    public function getCopyVerantwortliche()
    {
        return $this->copyVerantwortliche;
    }

    /**
     * Sets the copyVerantwortliche
     *
     * @param string $copyVerantwortliche
     * @return void
     */
    public function setCopyVerantwortliche(string $copyVerantwortliche)
    {
        $this->copyVerantwortliche = $copyVerantwortliche;
    }

    /**
     * Returns the upcomingStatus
     *
     * @return int
     */
    public function getUpcomingStatus()
    {
        return $this->upcomingStatus;
    }

    /**
     * Sets the upcomingStatus
     *
     * @param int $upcomingStatus
     * @return void
     */
    public function setUpcomingStatus(int $upcomingStatus)
    {
        $this->upcomingStatus = $upcomingStatus;
    }

    /**
     * Returns the gutachterLockedBy
     *
     * @return int
     */
    public function getGutachterLockedBy()
    {
        return $this->gutachterLockedBy;
    }

    /**
     * Sets the gutachterLockedBy
     *
     * @param int $gutachterLockedBy
     * @return void
     */
    public function setGutachterLockedBy(int $gutachterLockedBy)
    {
        $this->gutachterLockedBy = $gutachterLockedBy;
    }

    /**
     * Returns the notitzzettel
     *
     * @return string
     */
    public function getNotitzzettel()
    {
        return $this->notitzzettel;
    }

    /**
     * Sets the notitzzettel
     *
     * @param string $notitzzettel
     * @return void
     */
    public function setNotitzzettel(string $notitzzettel)
    {
        $this->notitzzettel = $notitzzettel;
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

    /**
     * Returns the trotzdemAbschicken
     *
     * @return string
     */
    public function getTrotzdemAbschicken()
    {
        return $this->trotzdemAbschicken;
    }

    /**
     * Sets the trotzdemAbschicken
     *
     * @param string $trotzdemAbschicken
     * @return void
     */
    public function setTrotzdemAbschicken(string $trotzdemAbschicken)
    {
        $this->trotzdemAbschicken = $trotzdemAbschicken;
    }

    /**
     * Returns the reviewTotalFristMailSent14t
     *
     * @return bool
     */
    public function getReviewTotalFristMailSent14t()
    {
        return $this->reviewTotalFristMailSent14t;
    }

    /**
     * Sets the reviewTotalFristMailSent14t
     *
     * @param bool $reviewTotalFristMailSent14t
     * @return void
     */
    public function setReviewTotalFristMailSent14t(bool $reviewTotalFristMailSent14t)
    {
        $this->reviewTotalFristMailSent14t = $reviewTotalFristMailSent14t;
    }

    /**
     * Returns the boolean state of reviewTotalFristMailSent14t
     *
     * @return bool
     */
    public function isReviewTotalFristMailSent14t()
    {
        return $this->reviewTotalFristMailSent14t;
    }

    /**
     * Returns the reviewTotalFristMailSent1t
     *
     * @return bool
     */
    public function getReviewTotalFristMailSent1t()
    {
        return $this->reviewTotalFristMailSent1t;
    }

    /**
     * Sets the reviewTotalFristMailSent1t
     *
     * @param bool $reviewTotalFristMailSent1t
     * @return void
     */
    public function setReviewTotalFristMailSent1t(bool $reviewTotalFristMailSent1t)
    {
        $this->reviewTotalFristMailSent1t = $reviewTotalFristMailSent1t;
    }

    /**
     * Returns the boolean state of reviewTotalFristMailSent1t
     *
     * @return bool
     */
    public function isReviewTotalFristMailSent1t()
    {
        return $this->reviewTotalFristMailSent1t;
    }

    /**
     * Returns the reviewFristPruefbescheid
     *
     * @return \DateTime
     */
    public function getReviewFristPruefbescheid()
    {
        return $this->reviewFristPruefbescheid;
    }

    /**
     * Sets the reviewFristPruefbescheid
     *
     * @param ?\DateTime $reviewFristPruefbescheid
     * @return void
     */
    public function setReviewFristPruefbescheid(?\DateTime $reviewFristPruefbescheid)
    {
        $reviewFristPruefbescheid = $reviewFristPruefbescheid === null ? 0 : $reviewFristPruefbescheid;
        $this->reviewFristPruefbescheid = $reviewFristPruefbescheid;
    }

    /**
     * Returns the reviewFristPruefbescheidMailSent14t
     *
     * @return bool
     */
    public function getReviewFristPruefbescheidMailSent14t()
    {
        return $this->reviewFristPruefbescheidMailSent14t;
    }

    /**
     * Sets the reviewFristPruefbescheidMailSent14t
     *
     * @param bool $reviewFristPruefbescheidMailSent14t
     * @return void
     */
    public function setReviewFristPruefbescheidMailSent14t(bool $reviewFristPruefbescheidMailSent14t)
    {
        $this->reviewFristPruefbescheidMailSent14t = $reviewFristPruefbescheidMailSent14t;
    }

    /**
     * Returns the boolean state of reviewFristPruefbescheidMailSent14t
     *
     * @return bool
     */
    public function isReviewFristPruefbescheidMailSent14t()
    {
        return $this->reviewFristPruefbescheidMailSent14t;
    }

    /**
     * Returns the reviewFristPruefbescheidMailSent1t
     *
     * @return bool
     */
    public function getReviewFristPruefbescheidMailSent1t()
    {
        return $this->reviewFristPruefbescheidMailSent1t;
    }

    /**
     * Sets the reviewFristPruefbescheidMailSent1t
     *
     * @param bool $reviewFristPruefbescheidMailSent1t
     * @return void
     */
    public function setReviewFristPruefbescheidMailSent1t(bool $reviewFristPruefbescheidMailSent1t)
    {
        $this->reviewFristPruefbescheidMailSent1t = $reviewFristPruefbescheidMailSent1t;
    }

    /**
     * Returns the boolean state of reviewFristPruefbescheidMailSent1t
     *
     * @return bool
     */
    public function isReviewFristPruefbescheidMailSent1t()
    {
        return $this->reviewFristPruefbescheidMailSent1t;
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
     * Returns the ende
     *
     * @return \DateTime
     */
    public function getEnde()
    {
        return $this->ende;
    }

    /**
     * Sets the ende
     *
     * @param ?\DateTime $ende
     * @return void
     */
    public function setEnde(?\DateTime $ende)
    {
        $this->ende = $ende;
    }

    /**
     * Returns the pruefbescheidCheck
     *
     * @return int
     */
    public function getPruefbescheidCheck()
    {
        return $this->pruefbescheidCheck;
    }

    /**
     * Sets the pruefbescheidCheck
     *
     * @param int $pruefbescheidCheck
     * @return void
     */
    public function setPruefbescheidCheck(int $pruefbescheidCheck)
    {
        $this->pruefbescheidCheck = $pruefbescheidCheck;
    }

    /**
     * Returns the statusAgEins
     *
     * @return int
     */
    public function getStatusAgEins()
    {
        return $this->statusAgEins;
    }

    /**
     * Sets the statusAgEins
     *
     * @param int $statusAgEins
     * @return void
     */
    public function setStatusAgEins(int $statusAgEins)
    {
        $this->statusAgEins = $statusAgEins;
    }

    /**
     * Returns the statusAgZwei
     *
     * @return int
     */
    public function getStatusAgZwei()
    {
        return $this->statusAgZwei;
    }

    /**
     * Sets the statusAgZwei
     *
     * @param int $statusAgZwei
     * @return void
     */
    public function setStatusAgZwei(int $statusAgZwei)
    {
        $this->statusAgZwei = $statusAgZwei;
    }

    /**
     * Returns the gutachter1
     *
     * @return \GeorgRinger\Ieb\Domain\Model\User
     */
    public function getGutachter1()
    {
        return $this->gutachter1;
    }

    /**
     * Sets the gutachter1
     *
     * @param \GeorgRinger\Ieb\Domain\Model\User $gutachter1
     * @return void
     */
    public function setGutachter1(?\GeorgRinger\Ieb\Domain\Model\User $gutachter1)
    {
        $this->gutachter1 = $gutachter1;
    }

    /**
     * Returns the gutachter2
     *
     * @return \GeorgRinger\Ieb\Domain\Model\User
     */
    public function getGutachter2()
    {
        return $this->gutachter2;
    }

    /**
     * Sets the gutachter2
     *
     * @param \GeorgRinger\Ieb\Domain\Model\User $gutachter2
     * @return void
     */
    public function setGutachter2(?\GeorgRinger\Ieb\Domain\Model\User $gutachter2)
    {
        $this->gutachter2 = $gutachter2;
    }

    /**
     * Returns the reviewVerrechnungCheck1
     *
     * @return bool
     */
    public function getReviewVerrechnungCheck1()
    {
        return $this->reviewVerrechnungCheck1;
    }

    /**
     * Sets the reviewVerrechnungCheck1
     *
     * @param bool $reviewVerrechnungCheck1
     * @return void
     */
    public function setReviewVerrechnungCheck1(bool $reviewVerrechnungCheck1)
    {
        $this->reviewVerrechnungCheck1 = $reviewVerrechnungCheck1;
    }

    /**
     * Returns the boolean state of reviewVerrechnungCheck1
     *
     * @return bool
     */
    public function isReviewVerrechnungCheck1()
    {
        return $this->reviewVerrechnungCheck1;
    }

    /**
     * Returns the reviewVerrechnungCheck2
     *
     * @return bool
     */
    public function getReviewVerrechnungCheck2()
    {
        return $this->reviewVerrechnungCheck2;
    }

    /**
     * Sets the reviewVerrechnungCheck2
     *
     * @param bool $reviewVerrechnungCheck2
     * @return void
     */
    public function setReviewVerrechnungCheck2(bool $reviewVerrechnungCheck2)
    {
        $this->reviewVerrechnungCheck2 = $reviewVerrechnungCheck2;
    }

    /**
     * Returns the boolean state of reviewVerrechnungCheck2
     *
     * @return bool
     */
    public function isReviewVerrechnungCheck2()
    {
        return $this->reviewVerrechnungCheck2;
    }

    /**
     * Returns the reviewVerrechnung1
     *
     * @return string
     */
    public function getReviewVerrechnung1()
    {
        return $this->reviewVerrechnung1;
    }

    /**
     * Sets the reviewVerrechnung1
     *
     * @param string $reviewVerrechnung1
     * @return void
     */
    public function setReviewVerrechnung1(string $reviewVerrechnung1)
    {
        $this->reviewVerrechnung1 = $reviewVerrechnung1;
    }

    /**
     * Returns the reviewVerrechnung2
     *
     * @return string
     */
    public function getReviewVerrechnung2()
    {
        return $this->reviewVerrechnung2;
    }

    /**
     * Sets the reviewVerrechnung2
     *
     * @param string $reviewVerrechnung2
     * @return void
     */
    public function setReviewVerrechnung2(string $reviewVerrechnung2)
    {
        $this->reviewVerrechnung2 = $reviewVerrechnung2;
    }

    /**
     * Returns the einzelunterricht
     *
     * @return bool
     */
    public function getEinzelunterricht()
    {
        return $this->einzelunterricht;
    }

    /**
     * Sets the einzelunterricht
     *
     * @param bool $einzelunterricht
     * @return void
     */
    public function setEinzelunterricht(bool $einzelunterricht)
    {
        $this->einzelunterricht = $einzelunterricht;
    }

    /**
     * Returns the boolean state of einzelunterricht
     *
     * @return bool
     */
    public function isEinzelunterricht()
    {
        return $this->einzelunterricht;
    }

    /**
     * Returns the pp3
     *
     * @return bool
     */
    public function getPp3()
    {
        return $this->pp3;
    }

    /**
     * Sets the pp3
     *
     * @param bool $pp3
     * @return void
     */
    public function setPp3(bool $pp3)
    {
        $this->pp3 = $pp3;
    }

    /**
     * Returns the boolean state of pp3
     *
     * @return bool
     */
    public function isPp3()
    {
        return $this->pp3;
    }

    /**
     * Returns the reviewB1GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB1GsCommentInternalStep()
    {
        return $this->reviewB1GsCommentInternalStep;
    }

    /**
     * Sets the reviewB1GsCommentInternalStep
     *
     * @param string $reviewB1GsCommentInternalStep
     * @return void
     */
    public function setReviewB1GsCommentInternalStep(string $reviewB1GsCommentInternalStep)
    {
        $this->reviewB1GsCommentInternalStep = $reviewB1GsCommentInternalStep;
    }

    /**
     * Returns the reviewB14GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB14GsCommentInternalStep()
    {
        return $this->reviewB14GsCommentInternalStep;
    }

    /**
     * Sets the reviewB14GsCommentInternalStep
     *
     * @param string $reviewB14GsCommentInternalStep
     * @return void
     */
    public function setReviewB14GsCommentInternalStep(string $reviewB14GsCommentInternalStep)
    {
        $this->reviewB14GsCommentInternalStep = $reviewB14GsCommentInternalStep;
    }

    /**
     * Returns the reviewB1Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB1Ag1CommentInternalStep()
    {
        return $this->reviewB1Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB1Ag1CommentInternalStep
     *
     * @param string $reviewB1Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB1Ag1CommentInternalStep(string $reviewB1Ag1CommentInternalStep)
    {
        $this->reviewB1Ag1CommentInternalStep = $reviewB1Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewB14Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB14Ag1CommentInternalStep()
    {
        return $this->reviewB14Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB14Ag1CommentInternalStep
     *
     * @param string $reviewB14Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB14Ag1CommentInternalStep(string $reviewB14Ag1CommentInternalStep)
    {
        $this->reviewB14Ag1CommentInternalStep = $reviewB14Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewB1Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB1Ag2CommentInternalStep()
    {
        return $this->reviewB1Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB1Ag2CommentInternalStep
     *
     * @param string $reviewB1Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB1Ag2CommentInternalStep(string $reviewB1Ag2CommentInternalStep)
    {
        $this->reviewB1Ag2CommentInternalStep = $reviewB1Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewB14Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB14Ag2CommentInternalStep()
    {
        return $this->reviewB14Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB14Ag2CommentInternalStep
     *
     * @param string $reviewB14Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB14Ag2CommentInternalStep(string $reviewB14Ag2CommentInternalStep)
    {
        $this->reviewB14Ag2CommentInternalStep = $reviewB14Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewB15GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB15GsCommentInternalStep()
    {
        return $this->reviewB15GsCommentInternalStep;
    }

    /**
     * Sets the reviewB15GsCommentInternalStep
     *
     * @param string $reviewB15GsCommentInternalStep
     * @return void
     */
    public function setReviewB15GsCommentInternalStep(string $reviewB15GsCommentInternalStep)
    {
        $this->reviewB15GsCommentInternalStep = $reviewB15GsCommentInternalStep;
    }

    /**
     * Returns the reviewB2GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB2GsCommentInternalStep()
    {
        return $this->reviewB2GsCommentInternalStep;
    }

    /**
     * Sets the reviewB2GsCommentInternalStep
     *
     * @param string $reviewB2GsCommentInternalStep
     * @return void
     */
    public function setReviewB2GsCommentInternalStep(string $reviewB2GsCommentInternalStep)
    {
        $this->reviewB2GsCommentInternalStep = $reviewB2GsCommentInternalStep;
    }

    /**
     * Returns the reviewB22GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB22GsCommentInternalStep()
    {
        return $this->reviewB22GsCommentInternalStep;
    }

    /**
     * Sets the reviewB22GsCommentInternalStep
     *
     * @param string $reviewB22GsCommentInternalStep
     * @return void
     */
    public function setReviewB22GsCommentInternalStep(string $reviewB22GsCommentInternalStep)
    {
        $this->reviewB22GsCommentInternalStep = $reviewB22GsCommentInternalStep;
    }

    /**
     * Returns the reviewB23GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewB23GsCommentInternalStep()
    {
        return $this->reviewB23GsCommentInternalStep;
    }

    /**
     * Sets the reviewB23GsCommentInternalStep
     *
     * @param string $reviewB23GsCommentInternalStep
     * @return void
     */
    public function setReviewB23GsCommentInternalStep(string $reviewB23GsCommentInternalStep)
    {
        $this->reviewB23GsCommentInternalStep = $reviewB23GsCommentInternalStep;
    }

    /**
     * Returns the reviewC1GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewC1GsCommentInternalStep()
    {
        return $this->reviewC1GsCommentInternalStep;
    }

    /**
     * Sets the reviewC1GsCommentInternalStep
     *
     * @param string $reviewC1GsCommentInternalStep
     * @return void
     */
    public function setReviewC1GsCommentInternalStep(string $reviewC1GsCommentInternalStep)
    {
        $this->reviewC1GsCommentInternalStep = $reviewC1GsCommentInternalStep;
    }

    /**
     * Returns the reviewC2GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewC2GsCommentInternalStep()
    {
        return $this->reviewC2GsCommentInternalStep;
    }

    /**
     * Sets the reviewC2GsCommentInternalStep
     *
     * @param string $reviewC2GsCommentInternalStep
     * @return void
     */
    public function setReviewC2GsCommentInternalStep(string $reviewC2GsCommentInternalStep)
    {
        $this->reviewC2GsCommentInternalStep = $reviewC2GsCommentInternalStep;
    }

    /**
     * Returns the reviewC3GsCommentInternalStep
     *
     * @return string
     */
    public function getReviewC3GsCommentInternalStep()
    {
        return $this->reviewC3GsCommentInternalStep;
    }

    /**
     * Sets the reviewC3GsCommentInternalStep
     *
     * @param string $reviewC3GsCommentInternalStep
     * @return void
     */
    public function setReviewC3GsCommentInternalStep(string $reviewC3GsCommentInternalStep)
    {
        $this->reviewC3GsCommentInternalStep = $reviewC3GsCommentInternalStep;
    }

    /**
     * Returns the reviewTotalGsCommentInternalStep
     *
     * @return string
     */
    public function getReviewTotalGsCommentInternalStep()
    {
        return $this->reviewTotalGsCommentInternalStep;
    }

    /**
     * Sets the reviewTotalGsCommentInternalStep
     *
     * @param string $reviewTotalGsCommentInternalStep
     * @return void
     */
    public function setReviewTotalGsCommentInternalStep(string $reviewTotalGsCommentInternalStep)
    {
        $this->reviewTotalGsCommentInternalStep = $reviewTotalGsCommentInternalStep;
    }

    /**
     * Returns the reviewB15Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB15Ag1CommentInternalStep()
    {
        return $this->reviewB15Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB15Ag1CommentInternalStep
     *
     * @param string $reviewB15Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB15Ag1CommentInternalStep(string $reviewB15Ag1CommentInternalStep)
    {
        $this->reviewB15Ag1CommentInternalStep = $reviewB15Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewB2Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB2Ag1CommentInternalStep()
    {
        return $this->reviewB2Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB2Ag1CommentInternalStep
     *
     * @param string $reviewB2Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB2Ag1CommentInternalStep(string $reviewB2Ag1CommentInternalStep)
    {
        $this->reviewB2Ag1CommentInternalStep = $reviewB2Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewB22Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB22Ag1CommentInternalStep()
    {
        return $this->reviewB22Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB22Ag1CommentInternalStep
     *
     * @param string $reviewB22Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB22Ag1CommentInternalStep(string $reviewB22Ag1CommentInternalStep)
    {
        $this->reviewB22Ag1CommentInternalStep = $reviewB22Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewB23Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewB23Ag1CommentInternalStep()
    {
        return $this->reviewB23Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewB23Ag1CommentInternalStep
     *
     * @param string $reviewB23Ag1CommentInternalStep
     * @return void
     */
    public function setReviewB23Ag1CommentInternalStep(string $reviewB23Ag1CommentInternalStep)
    {
        $this->reviewB23Ag1CommentInternalStep = $reviewB23Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewC1Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewC1Ag1CommentInternalStep()
    {
        return $this->reviewC1Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewC1Ag1CommentInternalStep
     *
     * @param string $reviewC1Ag1CommentInternalStep
     * @return void
     */
    public function setReviewC1Ag1CommentInternalStep(string $reviewC1Ag1CommentInternalStep)
    {
        $this->reviewC1Ag1CommentInternalStep = $reviewC1Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewC2Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewC2Ag1CommentInternalStep()
    {
        return $this->reviewC2Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewC2Ag1CommentInternalStep
     *
     * @param string $reviewC2Ag1CommentInternalStep
     * @return void
     */
    public function setReviewC2Ag1CommentInternalStep(string $reviewC2Ag1CommentInternalStep)
    {
        $this->reviewC2Ag1CommentInternalStep = $reviewC2Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewC3Ag1CommentInternalStep
     *
     * @return string
     */
    public function getReviewC3Ag1CommentInternalStep()
    {
        return $this->reviewC3Ag1CommentInternalStep;
    }

    /**
     * Sets the reviewC3Ag1CommentInternalStep
     *
     * @param string $reviewC3Ag1CommentInternalStep
     * @return void
     */
    public function setReviewC3Ag1CommentInternalStep(string $reviewC3Ag1CommentInternalStep)
    {
        $this->reviewC3Ag1CommentInternalStep = $reviewC3Ag1CommentInternalStep;
    }

    /**
     * Returns the reviewTotalAg1CommentInternalStep
     *
     * @return string
     */
    public function getReviewTotalAg1CommentInternalStep()
    {
        return $this->reviewTotalAg1CommentInternalStep;
    }

    /**
     * Sets the reviewTotalAg1CommentInternalStep
     *
     * @param string $reviewTotalAg1CommentInternalStep
     * @return void
     */
    public function setReviewTotalAg1CommentInternalStep(string $reviewTotalAg1CommentInternalStep)
    {
        $this->reviewTotalAg1CommentInternalStep = $reviewTotalAg1CommentInternalStep;
    }

    /**
     * Returns the reviewB15Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB15Ag2CommentInternalStep()
    {
        return $this->reviewB15Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB15Ag2CommentInternalStep
     *
     * @param string $reviewB15Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB15Ag2CommentInternalStep(string $reviewB15Ag2CommentInternalStep)
    {
        $this->reviewB15Ag2CommentInternalStep = $reviewB15Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewB2Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB2Ag2CommentInternalStep()
    {
        return $this->reviewB2Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB2Ag2CommentInternalStep
     *
     * @param string $reviewB2Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB2Ag2CommentInternalStep(string $reviewB2Ag2CommentInternalStep)
    {
        $this->reviewB2Ag2CommentInternalStep = $reviewB2Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewB22Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB22Ag2CommentInternalStep()
    {
        return $this->reviewB22Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB22Ag2CommentInternalStep
     *
     * @param string $reviewB22Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB22Ag2CommentInternalStep(string $reviewB22Ag2CommentInternalStep)
    {
        $this->reviewB22Ag2CommentInternalStep = $reviewB22Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewB23Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewB23Ag2CommentInternalStep()
    {
        return $this->reviewB23Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewB23Ag2CommentInternalStep
     *
     * @param string $reviewB23Ag2CommentInternalStep
     * @return void
     */
    public function setReviewB23Ag2CommentInternalStep(string $reviewB23Ag2CommentInternalStep)
    {
        $this->reviewB23Ag2CommentInternalStep = $reviewB23Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewC1Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewC1Ag2CommentInternalStep()
    {
        return $this->reviewC1Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewC1Ag2CommentInternalStep
     *
     * @param string $reviewC1Ag2CommentInternalStep
     * @return void
     */
    public function setReviewC1Ag2CommentInternalStep(string $reviewC1Ag2CommentInternalStep)
    {
        $this->reviewC1Ag2CommentInternalStep = $reviewC1Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewC2Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewC2Ag2CommentInternalStep()
    {
        return $this->reviewC2Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewC2Ag2CommentInternalStep
     *
     * @param string $reviewC2Ag2CommentInternalStep
     * @return void
     */
    public function setReviewC2Ag2CommentInternalStep(string $reviewC2Ag2CommentInternalStep)
    {
        $this->reviewC2Ag2CommentInternalStep = $reviewC2Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewC3Ag2CommentInternalStep
     *
     * @return string
     */
    public function getReviewC3Ag2CommentInternalStep()
    {
        return $this->reviewC3Ag2CommentInternalStep;
    }

    /**
     * Sets the reviewC3Ag2CommentInternalStep
     *
     * @param string $reviewC3Ag2CommentInternalStep
     * @return void
     */
    public function setReviewC3Ag2CommentInternalStep(string $reviewC3Ag2CommentInternalStep)
    {
        $this->reviewC3Ag2CommentInternalStep = $reviewC3Ag2CommentInternalStep;
    }

    /**
     * Returns the reviewTotalAg2CommentInternalStep
     *
     * @return string
     */
    public function getReviewTotalAg2CommentInternalStep()
    {
        return $this->reviewTotalAg2CommentInternalStep;
    }

    /**
     * Sets the reviewTotalAg2CommentInternalStep
     *
     * @param string $reviewTotalAg2CommentInternalStep
     * @return void
     */
    public function setReviewTotalAg2CommentInternalStep(string $reviewTotalAg2CommentInternalStep)
    {
        $this->reviewTotalAg2CommentInternalStep = $reviewTotalAg2CommentInternalStep;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $akkreditierungPdf;

    public function getAkkreditierungPdf(): ?\TYPO3\CMS\Extbase\Domain\Model\FileReference
    {
        return $this->akkreditierungPdf;
    }

    public function setAkkreditierungPdf(?\TYPO3\CMS\Extbase\Domain\Model\FileReference $akkreditierungPdf): void
    {
        $this->akkreditierungPdf = $akkreditierungPdf;
    }
}