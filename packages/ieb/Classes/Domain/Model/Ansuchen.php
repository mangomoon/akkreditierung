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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
     * reviewB1CommenTr
     *
     * @var string
     */
    protected $reviewB1CommenTr = '';

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
     * verantwortliche
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $verantwortliche = null;

    /**
     * trainer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GeorgRinger\Ieb\Domain\Model\Trainer>
     */
    protected $trainer = null;

    /**
     * berater
     *
     * @var \GeorgRinger\Ieb\Domain\Model\Berater
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
        $this->standorte = $this->standorte ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->verantwortliche = $this->verantwortliche ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->trainer = $this->trainer ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
        return $this->kompetenzbereiche;
    }

    /**
     * Sets the kompetenzbereiche
     *
     * @param int $kompetenzbereiche
     * @return void
     */
    public function setKompetenzbereiche(int $kompetenzbereiche)
    {
        $this->kompetenzbereiche = $kompetenzbereiche;
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
    public function setUebersichtDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $uebersichtDatei)
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
    public function setZielgruppenAnspracheDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $zielgruppenAnspracheDatei)
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
     * Returns the lernziele
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
    public function setLernziele(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lernziele)
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
    public function setLernstandserhebung(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lernstandserhebung)
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
    public function setDiversity(\TYPO3\CMS\Extbase\Domain\Model\FileReference $diversity)
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
    public function setBeratungDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $beratungDatei)
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
     * Returns the berater
     *
     * @return \GeorgRinger\Ieb\Domain\Model\Berater
     */
    public function getBerater()
    {
        return $this->berater;
    }

    /**
     * Sets the berater
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     * @return void
     */
    public function setBerater(\GeorgRinger\Ieb\Domain\Model\Berater $berater)
    {
        $this->berater = $berater;
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
     * Returns the reviewB1CommenTr
     *
     * @return string
     */
    public function getReviewB1CommenTr()
    {
        return $this->reviewB1CommenTr;
    }

    /**
     * Sets the reviewB1CommenTr
     *
     * @param string $reviewB1CommenTr
     * @return void
     */
    public function setReviewB1CommenTr(string $reviewB1CommenTr)
    {
        $this->reviewB1CommenTr = $reviewB1CommenTr;
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
}
