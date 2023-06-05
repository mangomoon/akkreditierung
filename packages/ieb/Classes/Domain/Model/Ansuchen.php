<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;

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
     * @var string
     */
    protected $zuteilungDatum = '';

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
     * kompetenzbereiche
     *
     * @var int
     */
    protected $kompetenzbereiche = 0;

    /**
     * kompetenzbereicheText
     *
     * @var string
     */
    protected $kompetenzbereicheText = '';

    /**
     * uebersichtText
     *
     * @var string
     */
    protected $uebersichtText = '';

    /**
     * uebersichtDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lernstandserhebung = null;

    /**
     * diversity
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * kooperationDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * erklaerungd4
     *
     * @var bool
     */
    protected $erklaerungd4 = false;

    /**
     * kompetenzText1
     *
     * @var string
     */
    protected $kompetenzText1 = '';

    /**
     * kompetenzText2
     *
     * @var string
     */
    protected $kompetenzText2 = '';

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
     * nummerpp3
     *
     * @var string
     */
    protected $nummerpp3 = '';

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
     * copyStandorte
     *
     * @var string
     */
    protected $copyStandorte = '';

    /**
     * stammdatenStatic
     *
     * @var \GeorgRinger\Ieb\Domain\Model\StaticStammdaten
     */
    protected $stammdatenStatic = null;

    /**
     * standorteStatic
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort>
     */
    protected $standorteStatic = null;

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
     * trainerStatic
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticTrainer>
     */
    protected $trainerStatic = null;

    /**
     * beraterStatic
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticBerater>
     */
    protected $beraterStatic = null;

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
        $this->standorteStatic = $this->standorteStatic ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->verantwortliche = $this->verantwortliche ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->verantwortlicheMail = $this->verantwortlicheMail ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->trainerStatic = $this->trainerStatic ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->beraterStatic = $this->beraterStatic ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * @param \DateTime $akkreditierungDatum
     * @return void
     */
    public function setAkkreditierungDatum(\DateTime $akkreditierungDatum)
    {
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
     * @param \DateTime $einreichDatum
     * @return void
     */
    public function setEinreichDatum(\DateTime $einreichDatum)
    {
        $this->einreichDatum = $einreichDatum;
    }

    /**
     * Returns the zuteilungDatum
     *
     * @return string
     */
    public function getZuteilungDatum()
    {
        return $this->zuteilungDatum;
    }

    /**
     * Sets the zuteilungDatum
     *
     * @param string $zuteilungDatum
     * @return void
     */
    public function setZuteilungDatum(string $zuteilungDatum)
    {
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
     * @param \DateTime $akkreditierungEntscheidungDatum
     * @return void
     */
    public function setAkkreditierungEntscheidungDatum(\DateTime $akkreditierungEntscheidungDatum)
    {
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
     * Returns the kompetenzbereiche
     *
     * @return int
     */
    public function getKompetenzbereiche()
    {
        return (int) $this->kompetenzbereiche;
    }

    /**
     * Sets the kompetenzbereiche
     *
     * @param int $kompetenzbereiche
     * @return void
     */
    public function setKompetenzbereiche($kompetenzbereiche)
    {
        $this->kompetenzbereiche = (int) $kompetenzbereiche;
    }

    /**
     * Returns the kompetenzbereicheText
     *
     * @return string
     */
    public function getKompetenzbereicheText()
    {
        return $this->kompetenzbereicheText;
    }

    /**
     * Sets the kompetenzbereicheText
     *
     * @param string $kompetenzbereicheText
     * @return void
     */
    public function setKompetenzbereicheText(string $kompetenzbereicheText)
    {
        $this->kompetenzbereicheText = $kompetenzbereicheText;
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
     * @param \DateTime $reviewTotalFrist
     * @return void
     */
    public function setReviewTotalFrist(\DateTime $reviewTotalFrist)
    {
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
     * Returns the stammdatenStatic
     *
     * @return \GeorgRinger\Ieb\Domain\Model\StaticStammdaten stammdatenStatic
     */
    public function getStammdatenStatic()
    {
        return $this->stammdatenStatic;
    }

    /**
     * Sets the stammdatenStatic
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticStammdaten $stammdatenStatic
     * @return void
     */
    public function setStammdatenStatic(\GeorgRinger\Ieb\Domain\Model\StaticStammdaten $stammdatenStatic)
    {
        $this->stammdatenStatic = $stammdatenStatic;
    }

    /**
     * Adds a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteStatic
     * @return void
     */
    public function addStandorteStatic(\GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteStatic)
    {
        $this->standorteStatic->attach($standorteStatic);
    }

    /**
     * Removes a Standort
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteStaticToRemove The StaticStandort to be removed
     * @return void
     */
    public function removeStandorteStatic(\GeorgRinger\Ieb\Domain\Model\StaticStandort $standorteStaticToRemove)
    {
        $this->standorteStatic->detach($standorteStaticToRemove);
    }

    /**
     * Returns the standorteStatic
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort> standorteStatic
     */
    public function getStandorteStatic()
    {
        return $this->standorteStatic;
    }

    /**
     * Sets the standorteStatic
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticStandort> $standorteStatic
     * @return void
     */
    public function setStandorteStatic(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $standorteStatic)
    {
        $this->standorteStatic = $standorteStatic;
    }

    /**
     * Adds a Trainer
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticTrainer $trainerStatic
     * @return void
     */
    public function addTrainerStatic(\GeorgRinger\Ieb\Domain\Model\StaticTrainer $trainerStatic)
    {
        $this->trainerStatic->attach($trainerStatic);
    }

    /**
     * Removes a Trainer
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticTrainer $trainerStaticToRemove The StaticTrainer to be removed
     * @return void
     */
    public function removeTrainerStatic(\GeorgRinger\Ieb\Domain\Model\StaticTrainer $trainerStaticToRemove)
    {
        $this->trainerStatic->detach($trainerStaticToRemove);
    }

    /**
     * Returns the trainerStatic
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticTrainer> trainerStatic
     */
    public function getTrainerStatic()
    {
        return $this->trainerStatic;
    }

    /**
     * Sets the trainerStatic
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticTrainer> $trainerStatic
     * @return void
     */
    public function setTrainerStatic(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $trainerStatic)
    {
        $this->trainerStatic = $trainerStatic;
    }

    /**
     * Adds a Berater
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticBerater $beraterStatic
     * @return void
     */
    public function addBeraterStatic(\GeorgRinger\Ieb\Domain\Model\StaticBerater $beraterStatic)
    {
        $this->beraterStatic->attach($beraterStatic);
    }

    /**
     * Removes a Berater
     *
     * @param \GeorgRinger\Ieb\Domain\Model\StaticBerater $beraterStaticToRemove The StaticBerater to be removed
     * @return void
     */
    public function removeBeraterStatic(\GeorgRinger\Ieb\Domain\Model\StaticBerater $beraterStaticToRemove)
    {
        $this->beraterStatic->detach($beraterStaticToRemove);
    }

    /**
     * Returns the beraterStatic
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticBerater> beraterStatic
     */
    public function getBeraterStatic()
    {
        return $this->beraterStatic;
    }

    /**
     * Sets the beraterStatic
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\StaticBerater> $beraterStatic
     * @return void
     */
    public function setBeraterStatic(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $beraterStatic)
    {
        $this->beraterStatic = $beraterStatic;
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
     * Returns the kompetenzText2
     *
     * @return string
     */
    public function getKompetenzText2()
    {
        return $this->kompetenzText2;
    }

    /**
     * Sets the kompetenzText2
     *
     * @param string $kompetenzText2
     * @return void
     */
    public function setKompetenzText2(string $kompetenzText2)
    {
        $this->kompetenzText2 = $kompetenzText2;
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
     * Returns the erklaerungd4
     *
     * @return bool erklaerungd4
     */
    public function getErklaerungd4()
    {
        return $this->erklaerungd4;
    }

    /**
     * Sets the erklaerungd4
     *
     * @param bool $erklaerungd4
     * @return void
     */
    public function setErklaerungd4(bool $erklaerungd4)
    {
        $this->erklaerungd4 = $erklaerungd4;
    }

    /**
     * Returns the boolean state of erklaerungd4
     *
     * @return bool erklaerungd4
     */
    public function isErklaerungd4()
    {
        return $this->erklaerungd4;
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
     * Returns the nummerpp3
     *
     * @return string
     */
    public function getNummerpp3()
    {
        return $this->nummerpp3;
    }

    /**
     * Sets the nummerpp3
     *
     * @param string $nummerpp3
     * @return void
     */
    public function setNummerpp3(string $nummerpp3)
    {
        $this->nummerpp3 = $nummerpp3;
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
        return AnsuchenStatus::visibleForAg($this->status);
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
        return $this->getConvertedJson($this->copyStammdaten);
    }
    public function getCopyStandorteData()
    {
        return $this->getConvertedJson($this->copyStandorte);
    }
    public function getReviewB1CommentInternalData()
    {
        return $this->getConvertedJson($this->reviewB1CommentInternal);
    }

    /**
     * @param string $input
     */
    protected function getConvertedJson(string $input)
    {
        return json_decode($input, true);
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
}
