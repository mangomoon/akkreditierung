<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Georg Ringer <mail@ringer.it>
 */
class AnsuchenTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Ansuchen|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Ansuchen::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName(): void
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('name'));
    }

    /**
     * @test
     */
    public function getVersionReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getVersion()
        );
    }

    /**
     * @test
     */
    public function setVersionForIntSetsVersion(): void
    {
        $this->subject->setVersion(12);

        self::assertEquals(12, $this->subject->_get('version'));
    }

    /**
     * @test
     */
    public function getVersionBasedOnReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getVersionBasedOn()
        );
    }

    /**
     * @test
     */
    public function setVersionBasedOnForIntSetsVersionBasedOn(): void
    {
        $this->subject->setVersionBasedOn(12);

        self::assertEquals(12, $this->subject->_get('versionBasedOn'));
    }

    /**
     * @test
     */
    public function getVersionActiveReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getVersionActive());
    }

    /**
     * @test
     */
    public function setVersionActiveForBoolSetsVersionActive(): void
    {
        $this->subject->setVersionActive(true);

        self::assertEquals(true, $this->subject->_get('versionActive'));
    }

    /**
     * @test
     */
    public function getNummerReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNummer()
        );
    }

    /**
     * @test
     */
    public function setNummerForStringSetsNummer(): void
    {
        $this->subject->setNummer('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('nummer'));
    }

    /**
     * @test
     */
    public function getAkkreditierungDatumReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getAkkreditierungDatum()
        );
    }

    /**
     * @test
     */
    public function setAkkreditierungDatumForDateTimeSetsAkkreditierungDatum(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setAkkreditierungDatum($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('akkreditierungDatum'));
    }

    /**
     * @test
     */
    public function getEinreichDatumReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getEinreichDatum()
        );
    }

    /**
     * @test
     */
    public function setEinreichDatumForDateTimeSetsEinreichDatum(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEinreichDatum($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('einreichDatum'));
    }

    /**
     * @test
     */
    public function getZuteilungDatumReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getZuteilungDatum()
        );
    }

    /**
     * @test
     */
    public function setZuteilungDatumForStringSetsZuteilungDatum(): void
    {
        $this->subject->setZuteilungDatum('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('zuteilungDatum'));
    }

    /**
     * @test
     */
    public function getAkkreditierungEntscheidungDatumReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getAkkreditierungEntscheidungDatum()
        );
    }

    /**
     * @test
     */
    public function setAkkreditierungEntscheidungDatumForDateTimeSetsAkkreditierungEntscheidungDatum(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setAkkreditierungEntscheidungDatum($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('akkreditierungEntscheidungDatum'));
    }

    /**
     * @test
     */
    public function getTypReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getTyp()
        );
    }

    /**
     * @test
     */
    public function setTypForIntSetsTyp(): void
    {
        $this->subject->setTyp(12);

        self::assertEquals(12, $this->subject->_get('typ'));
    }

    /**
     * @test
     */
    public function getBundeslandReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getBundesland()
        );
    }

    /**
     * @test
     */
    public function setBundeslandForIntSetsBundesland(): void
    {
        $this->subject->setBundesland(12);

        self::assertEquals(12, $this->subject->_get('bundesland'));
    }

    /**
     * @test
     */
    public function getKompetenzbereicheReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getKompetenzbereiche()
        );
    }

    /**
     * @test
     */
    public function setKompetenzbereicheForIntSetsKompetenzbereiche(): void
    {
        $this->subject->setKompetenzbereiche(12);

        self::assertEquals(12, $this->subject->_get('kompetenzbereiche'));
    }

    /**
     * @test
     */
    public function getKompetenzbereicheTextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKompetenzbereicheText()
        );
    }

    /**
     * @test
     */
    public function setKompetenzbereicheTextForStringSetsKompetenzbereicheText(): void
    {
        $this->subject->setKompetenzbereicheText('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kompetenzbereicheText'));
    }

    /**
     * @test
     */
    public function getUebersichtTextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getUebersichtText()
        );
    }

    /**
     * @test
     */
    public function setUebersichtTextForStringSetsUebersichtText(): void
    {
        $this->subject->setUebersichtText('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('uebersichtText'));
    }

    /**
     * @test
     */
    public function getUebersichtDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getUebersichtDatei()
        );
    }

    /**
     * @test
     */
    public function setUebersichtDateiForFileReferenceSetsUebersichtDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setUebersichtDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('uebersichtDatei'));
    }

    /**
     * @test
     */
    public function getZielgruppenAnspracheReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getZielgruppenAnsprache()
        );
    }

    /**
     * @test
     */
    public function setZielgruppenAnspracheForStringSetsZielgruppenAnsprache(): void
    {
        $this->subject->setZielgruppenAnsprache('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('zielgruppenAnsprache'));
    }

    /**
     * @test
     */
    public function getZielgruppenAnspracheDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getZielgruppenAnspracheDatei()
        );
    }

    /**
     * @test
     */
    public function setZielgruppenAnspracheDateiForFileReferenceSetsZielgruppenAnspracheDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setZielgruppenAnspracheDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('zielgruppenAnspracheDatei'));
    }

    /**
     * @test
     */
    public function getFernlehreReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getFernlehre());
    }

    /**
     * @test
     */
    public function setFernlehreForBoolSetsFernlehre(): void
    {
        $this->subject->setFernlehre(true);

        self::assertEquals(true, $this->subject->_get('fernlehre'));
    }

    /**
     * @test
     */
    public function getKinderbetreuungReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKinderbetreuung());
    }

    /**
     * @test
     */
    public function setKinderbetreuungForBoolSetsKinderbetreuung(): void
    {
        $this->subject->setKinderbetreuung(true);

        self::assertEquals(true, $this->subject->_get('kinderbetreuung'));
    }

    /**
     * @test
     */
    public function getLernzieleReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLernziele()
        );
    }

    /**
     * @test
     */
    public function setLernzieleForFileReferenceSetsLernziele(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLernziele($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('lernziele'));
    }

    /**
     * @test
     */
    public function getLernstandserhebungReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLernstandserhebung()
        );
    }

    /**
     * @test
     */
    public function setLernstandserhebungForFileReferenceSetsLernstandserhebung(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLernstandserhebung($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('lernstandserhebung'));
    }

    /**
     * @test
     */
    public function getDiversityReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getDiversity()
        );
    }

    /**
     * @test
     */
    public function setDiversityForFileReferenceSetsDiversity(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setDiversity($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('diversity'));
    }

    /**
     * @test
     */
    public function getDidaktikKommentarReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDidaktikKommentar()
        );
    }

    /**
     * @test
     */
    public function setDidaktikKommentarForStringSetsDidaktikKommentar(): void
    {
        $this->subject->setDidaktikKommentar('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('didaktikKommentar'));
    }

    /**
     * @test
     */
    public function getBeratungTextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getBeratungText()
        );
    }

    /**
     * @test
     */
    public function setBeratungTextForStringSetsBeratungText(): void
    {
        $this->subject->setBeratungText('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('beratungText'));
    }

    /**
     * @test
     */
    public function getBeratungDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getBeratungDatei()
        );
    }

    /**
     * @test
     */
    public function setBeratungDateiForFileReferenceSetsBeratungDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setBeratungDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('beratungDatei'));
    }

    /**
     * @test
     */
    public function getReviewB1CommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewB1CommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewB1CommentInternalForStringSetsReviewB1CommentInternal(): void
    {
        $this->subject->setReviewB1CommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewB1CommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewB1CommenTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewB1CommenTr()
        );
    }

    /**
     * @test
     */
    public function setReviewB1CommenTrForStringSetsReviewB1CommenTr(): void
    {
        $this->subject->setReviewB1CommenTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewB1CommenTr'));
    }

    /**
     * @test
     */
    public function getReviewB1StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewB1Status()
        );
    }

    /**
     * @test
     */
    public function setReviewB1StatusForIntSetsReviewB1Status(): void
    {
        $this->subject->setReviewB1Status(12);

        self::assertEquals(12, $this->subject->_get('reviewB1Status'));
    }

    /**
     * @test
     */
    public function getReviewB2CommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewB2CommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewB2CommentInternalForStringSetsReviewB2CommentInternal(): void
    {
        $this->subject->setReviewB2CommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewB2CommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewB2CommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewB2CommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewB2CommentTrForStringSetsReviewB2CommentTr(): void
    {
        $this->subject->setReviewB2CommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewB2CommentTr'));
    }

    /**
     * @test
     */
    public function getReviewB2StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewB2Status()
        );
    }

    /**
     * @test
     */
    public function setReviewB2StatusForIntSetsReviewB2Status(): void
    {
        $this->subject->setReviewB2Status(12);

        self::assertEquals(12, $this->subject->_get('reviewB2Status'));
    }

    /**
     * @test
     */
    public function getReviewC1CommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC1CommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewC1CommentInternalForStringSetsReviewC1CommentInternal(): void
    {
        $this->subject->setReviewC1CommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC1CommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewC1CommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC1CommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewC1CommentTrForStringSetsReviewC1CommentTr(): void
    {
        $this->subject->setReviewC1CommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC1CommentTr'));
    }

    /**
     * @test
     */
    public function getReviewC1StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewC1Status()
        );
    }

    /**
     * @test
     */
    public function setReviewC1StatusForIntSetsReviewC1Status(): void
    {
        $this->subject->setReviewC1Status(12);

        self::assertEquals(12, $this->subject->_get('reviewC1Status'));
    }

    /**
     * @test
     */
    public function getReviewC2CommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC2CommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewC2CommentInternalForStringSetsReviewC2CommentInternal(): void
    {
        $this->subject->setReviewC2CommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC2CommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewC2CommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC2CommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewC2CommentTrForStringSetsReviewC2CommentTr(): void
    {
        $this->subject->setReviewC2CommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC2CommentTr'));
    }

    /**
     * @test
     */
    public function getReviewC2StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewC2Status()
        );
    }

    /**
     * @test
     */
    public function setReviewC2StatusForIntSetsReviewC2Status(): void
    {
        $this->subject->setReviewC2Status(12);

        self::assertEquals(12, $this->subject->_get('reviewC2Status'));
    }

    /**
     * @test
     */
    public function getReviewC3CommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3CommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewC3CommentInternalForStringSetsReviewC3CommentInternal(): void
    {
        $this->subject->setReviewC3CommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3CommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewC3CommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3CommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewC3CommentTrForStringSetsReviewC3CommentTr(): void
    {
        $this->subject->setReviewC3CommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3CommentTr'));
    }

    /**
     * @test
     */
    public function getReviewC3StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewC3Status()
        );
    }

    /**
     * @test
     */
    public function setReviewC3StatusForIntSetsReviewC3Status(): void
    {
        $this->subject->setReviewC3Status(12);

        self::assertEquals(12, $this->subject->_get('reviewC3Status'));
    }

    /**
     * @test
     */
    public function getReviewTotalCommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewTotalCommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewTotalCommentInternalForStringSetsReviewTotalCommentInternal(): void
    {
        $this->subject->setReviewTotalCommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewTotalCommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewTotalCommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewTotalCommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewTotalCommentTrForStringSetsReviewTotalCommentTr(): void
    {
        $this->subject->setReviewTotalCommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewTotalCommentTr'));
    }

    /**
     * @test
     */
    public function getReviewTotalStatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewTotalStatus()
        );
    }

    /**
     * @test
     */
    public function setReviewTotalStatusForIntSetsReviewTotalStatus(): void
    {
        $this->subject->setReviewTotalStatus(12);

        self::assertEquals(12, $this->subject->_get('reviewTotalStatus'));
    }

    /**
     * @test
     */
    public function getReviewTotalFristReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getReviewTotalFrist()
        );
    }

    /**
     * @test
     */
    public function setReviewTotalFristForDateTimeSetsReviewTotalFrist(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setReviewTotalFrist($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('reviewTotalFrist'));
    }

    /**
     * @test
     */
    public function getLockedByReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getLockedBy()
        );
    }

    /**
     * @test
     */
    public function setLockedByForIntSetsLockedBy(): void
    {
        $this->subject->setLockedBy(12);

        self::assertEquals(12, $this->subject->_get('lockedBy'));
    }

    /**
     * @test
     */
    public function getStatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus(): void
    {
        $this->subject->setStatus(12);

        self::assertEquals(12, $this->subject->_get('status'));
    }

    /**
     * @test
     */
    public function getOkReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getOk());
    }

    /**
     * @test
     */
    public function setOkForBoolSetsOk(): void
    {
        $this->subject->setOk(true);

        self::assertEquals(true, $this->subject->_get('ok'));
    }

    /**
     * @test
     */
    public function getPruefbescheidDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getPruefbescheidDatei()
        );
    }

    /**
     * @test
     */
    public function setPruefbescheidDateiForFileReferenceSetsPruefbescheidDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setPruefbescheidDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('pruefbescheidDatei'));
    }

    /**
     * @test
     */
    public function getPruefbescheidReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPruefbescheid()
        );
    }

    /**
     * @test
     */
    public function setPruefbescheidForStringSetsPruefbescheid(): void
    {
        $this->subject->setPruefbescheid('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('pruefbescheid'));
    }

    /**
     * @test
     */
    public function getKooperationDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getKooperationDatei()
        );
    }

    /**
     * @test
     */
    public function setKooperationDateiForFileReferenceSetsKooperationDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setKooperationDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('kooperationDatei'));
    }

    /**
     * @test
     */
    public function getKooperationReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKooperation()
        );
    }

    /**
     * @test
     */
    public function setKooperationForStringSetsKooperation(): void
    {
        $this->subject->setKooperation('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kooperation'));
    }

    /**
     * @test
     */
    public function getStandortErklaerungReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getStandortErklaerung());
    }

    /**
     * @test
     */
    public function setStandortErklaerungForBoolSetsStandortErklaerung(): void
    {
        $this->subject->setStandortErklaerung(true);

        self::assertEquals(true, $this->subject->_get('standortErklaerung'));
    }

    /**
     * @test
     */
    public function getKompetenz1ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz1());
    }

    /**
     * @test
     */
    public function setKompetenz1ForBoolSetsKompetenz1(): void
    {
        $this->subject->setKompetenz1(true);

        self::assertEquals(true, $this->subject->_get('kompetenz1'));
    }

    /**
     * @test
     */
    public function getKompetenz2ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz2());
    }

    /**
     * @test
     */
    public function setKompetenz2ForBoolSetsKompetenz2(): void
    {
        $this->subject->setKompetenz2(true);

        self::assertEquals(true, $this->subject->_get('kompetenz2'));
    }

    /**
     * @test
     */
    public function getKompetenz3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz3());
    }

    /**
     * @test
     */
    public function setKompetenz3ForBoolSetsKompetenz3(): void
    {
        $this->subject->setKompetenz3(true);

        self::assertEquals(true, $this->subject->_get('kompetenz3'));
    }

    /**
     * @test
     */
    public function getKompetenz4ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz4());
    }

    /**
     * @test
     */
    public function setKompetenz4ForBoolSetsKompetenz4(): void
    {
        $this->subject->setKompetenz4(true);

        self::assertEquals(true, $this->subject->_get('kompetenz4'));
    }

    /**
     * @test
     */
    public function getKompetenz5ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz5());
    }

    /**
     * @test
     */
    public function setKompetenz5ForBoolSetsKompetenz5(): void
    {
        $this->subject->setKompetenz5(true);

        self::assertEquals(true, $this->subject->_get('kompetenz5'));
    }

    /**
     * @test
     */
    public function getKompetenz6ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz6());
    }

    /**
     * @test
     */
    public function setKompetenz6ForBoolSetsKompetenz6(): void
    {
        $this->subject->setKompetenz6(true);

        self::assertEquals(true, $this->subject->_get('kompetenz6'));
    }

    /**
     * @test
     */
    public function getKompetenz7ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz7());
    }

    /**
     * @test
     */
    public function setKompetenz7ForBoolSetsKompetenz7(): void
    {
        $this->subject->setKompetenz7(true);

        self::assertEquals(true, $this->subject->_get('kompetenz7'));
    }

    /**
     * @test
     */
    public function getKompetenz8ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz8());
    }

    /**
     * @test
     */
    public function setKompetenz8ForBoolSetsKompetenz8(): void
    {
        $this->subject->setKompetenz8(true);

        self::assertEquals(true, $this->subject->_get('kompetenz8'));
    }

    /**
     * @test
     */
    public function getKompetenz9ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getKompetenz9());
    }

    /**
     * @test
     */
    public function setKompetenz9ForBoolSetsKompetenz9(): void
    {
        $this->subject->setKompetenz9(true);

        self::assertEquals(true, $this->subject->_get('kompetenz9'));
    }

    /**
     * @test
     */
    public function getErklaerungd1ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungd1());
    }

    /**
     * @test
     */
    public function setErklaerungd1ForBoolSetsErklaerungd1(): void
    {
        $this->subject->setErklaerungd1(true);

        self::assertEquals(true, $this->subject->_get('erklaerungd1'));
    }

    /**
     * @test
     */
    public function getErklaerungd2ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungd2());
    }

    /**
     * @test
     */
    public function setErklaerungd2ForBoolSetsErklaerungd2(): void
    {
        $this->subject->setErklaerungd2(true);

        self::assertEquals(true, $this->subject->_get('erklaerungd2'));
    }

    /**
     * @test
     */
    public function getErklaerungd3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungd3());
    }

    /**
     * @test
     */
    public function setErklaerungd3ForBoolSetsErklaerungd3(): void
    {
        $this->subject->setErklaerungd3(true);

        self::assertEquals(true, $this->subject->_get('erklaerungd3'));
    }

    /**
     * @test
     */
    public function getErklaerungd4ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungd4());
    }

    /**
     * @test
     */
    public function setErklaerungd4ForBoolSetsErklaerungd4(): void
    {
        $this->subject->setErklaerungd4(true);

        self::assertEquals(true, $this->subject->_get('erklaerungd4'));
    }

    /**
     * @test
     */
    public function getKompetenzText1ReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKompetenzText1()
        );
    }

    /**
     * @test
     */
    public function setKompetenzText1ForStringSetsKompetenzText1(): void
    {
        $this->subject->setKompetenzText1('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kompetenzText1'));
    }

    /**
     * @test
     */
    public function getKompetenzText2ReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKompetenzText2()
        );
    }

    /**
     * @test
     */
    public function setKompetenzText2ForStringSetsKompetenzText2(): void
    {
        $this->subject->setKompetenzText2('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kompetenzText2'));
    }

    /**
     * @test
     */
    public function getErklaerungTeilAReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungTeilA());
    }

    /**
     * @test
     */
    public function setErklaerungTeilAForBoolSetsErklaerungTeilA(): void
    {
        $this->subject->setErklaerungTeilA(true);

        self::assertEquals(true, $this->subject->_get('erklaerungTeilA'));
    }

    /**
     * @test
     */
    public function getErklaerungTeilBReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungTeilB());
    }

    /**
     * @test
     */
    public function setErklaerungTeilBForBoolSetsErklaerungTeilB(): void
    {
        $this->subject->setErklaerungTeilB(true);

        self::assertEquals(true, $this->subject->_get('erklaerungTeilB'));
    }

    /**
     * @test
     */
    public function getNummerpp3ReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNummerpp3()
        );
    }

    /**
     * @test
     */
    public function setNummerpp3ForStringSetsNummerpp3(): void
    {
        $this->subject->setNummerpp3('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('nummerpp3'));
    }

    /**
     * @test
     */
    public function getErklaerungd5ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getErklaerungd5());
    }

    /**
     * @test
     */
    public function setErklaerungd5ForBoolSetsErklaerungd5(): void
    {
        $this->subject->setErklaerungd5(true);

        self::assertEquals(true, $this->subject->_get('erklaerungd5'));
    }

    /**
     * @test
     */
    public function getCopyStammdatenReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCopyStammdaten()
        );
    }

    /**
     * @test
     */
    public function setCopyStammdatenForStringSetsCopyStammdaten(): void
    {
        $this->subject->setCopyStammdaten('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('copyStammdaten'));
    }

    /**
     * @test
     */
    public function getCopyTrainerReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCopyTrainer()
        );
    }

    /**
     * @test
     */
    public function setCopyTrainerForStringSetsCopyTrainer(): void
    {
        $this->subject->setCopyTrainer('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('copyTrainer'));
    }

    /**
     * @test
     */
    public function getCopyBeraterReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCopyBerater()
        );
    }

    /**
     * @test
     */
    public function setCopyBeraterForStringSetsCopyBerater(): void
    {
        $this->subject->setCopyBerater('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('copyBerater'));
    }

    /**
     * @test
     */
    public function getCopyStandorteReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCopyStandorte()
        );
    }

    /**
     * @test
     */
    public function setCopyStandorteForStringSetsCopyStandorte(): void
    {
        $this->subject->setCopyStandorte('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('copyStandorte'));
    }

    /**
     * @test
     */
    public function getStammdatenStaticReturnsInitialValueForStaticStammdaten(): void
    {
        self::assertEquals(
            null,
            $this->subject->getStammdatenStatic()
        );
    }

    /**
     * @test
     */
    public function setStammdatenStaticForStaticStammdatenSetsStammdatenStatic(): void
    {
        $stammdatenStaticFixture = new \GeorgRinger\Ieb\Domain\Model\StaticStammdaten();
        $this->subject->setStammdatenStatic($stammdatenStaticFixture);

        self::assertEquals($stammdatenStaticFixture, $this->subject->_get('stammdatenStatic'));
    }

    /**
     * @test
     */
    public function getStandorteStaticReturnsInitialValueForStaticStandort(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getStandorteStatic()
        );
    }

    /**
     * @test
     */
    public function setStandorteStaticForObjectStorageContainingStaticStandortSetsStandorteStatic(): void
    {
        $standorteStatic = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
        $objectStorageHoldingExactlyOneStandorteStatic = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneStandorteStatic->attach($standorteStatic);
        $this->subject->setStandorteStatic($objectStorageHoldingExactlyOneStandorteStatic);

        self::assertEquals($objectStorageHoldingExactlyOneStandorteStatic, $this->subject->_get('standorteStatic'));
    }

    /**
     * @test
     */
    public function addStandorteStaticToObjectStorageHoldingStandorteStatic(): void
    {
        $standorteStatic = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
        $standorteStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $standorteStaticObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($standorteStatic));
        $this->subject->_set('standorteStatic', $standorteStaticObjectStorageMock);

        $this->subject->addStandorteStatic($standorteStatic);
    }

    /**
     * @test
     */
    public function removeStandorteStaticFromObjectStorageHoldingStandorteStatic(): void
    {
        $standorteStatic = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
        $standorteStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $standorteStaticObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($standorteStatic));
        $this->subject->_set('standorteStatic', $standorteStaticObjectStorageMock);

        $this->subject->removeStandorteStatic($standorteStatic);
    }

    /**
     * @test
     */
    public function getVerantwortlicheReturnsInitialValueForAngebotVerantwortlich(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVerantwortliche()
        );
    }

    /**
     * @test
     */
    public function setVerantwortlicheForObjectStorageContainingAngebotVerantwortlichSetsVerantwortliche(): void
    {
        $verantwortliche = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $objectStorageHoldingExactlyOneVerantwortliche = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVerantwortliche->attach($verantwortliche);
        $this->subject->setVerantwortliche($objectStorageHoldingExactlyOneVerantwortliche);

        self::assertEquals($objectStorageHoldingExactlyOneVerantwortliche, $this->subject->_get('verantwortliche'));
    }

    /**
     * @test
     */
    public function addVerantwortlicheToObjectStorageHoldingVerantwortliche(): void
    {
        $verantwortliche = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $verantwortlicheObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantwortlicheObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($verantwortliche));
        $this->subject->_set('verantwortliche', $verantwortlicheObjectStorageMock);

        $this->subject->addVerantwortliche($verantwortliche);
    }

    /**
     * @test
     */
    public function removeVerantwortlicheFromObjectStorageHoldingVerantwortliche(): void
    {
        $verantwortliche = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $verantwortlicheObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantwortlicheObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($verantwortliche));
        $this->subject->_set('verantwortliche', $verantwortlicheObjectStorageMock);

        $this->subject->removeVerantwortliche($verantwortliche);
    }

    /**
     * @test
     */
    public function getVerantwortlicheMailReturnsInitialValueForAngebotVerantwortlich(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVerantwortlicheMail()
        );
    }

    /**
     * @test
     */
    public function setVerantwortlicheMailForObjectStorageContainingAngebotVerantwortlichSetsVerantwortlicheMail(): void
    {
        $verantwortlicheMail = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $objectStorageHoldingExactlyOneVerantwortlicheMail = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVerantwortlicheMail->attach($verantwortlicheMail);
        $this->subject->setVerantwortlicheMail($objectStorageHoldingExactlyOneVerantwortlicheMail);

        self::assertEquals($objectStorageHoldingExactlyOneVerantwortlicheMail, $this->subject->_get('verantwortlicheMail'));
    }

    /**
     * @test
     */
    public function addVerantwortlicheMailToObjectStorageHoldingVerantwortlicheMail(): void
    {
        $verantwortlicheMail = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $verantwortlicheMailObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantwortlicheMailObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($verantwortlicheMail));
        $this->subject->_set('verantwortlicheMail', $verantwortlicheMailObjectStorageMock);

        $this->subject->addVerantwortlicheMail($verantwortlicheMail);
    }

    /**
     * @test
     */
    public function removeVerantwortlicheMailFromObjectStorageHoldingVerantwortlicheMail(): void
    {
        $verantwortlicheMail = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();
        $verantwortlicheMailObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantwortlicheMailObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($verantwortlicheMail));
        $this->subject->_set('verantwortlicheMail', $verantwortlicheMailObjectStorageMock);

        $this->subject->removeVerantwortlicheMail($verantwortlicheMail);
    }

    /**
     * @test
     */
    public function getTrainerStaticReturnsInitialValueForStaticTrainer(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTrainerStatic()
        );
    }

    /**
     * @test
     */
    public function setTrainerStaticForObjectStorageContainingStaticTrainerSetsTrainerStatic(): void
    {
        $trainerStatic = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
        $objectStorageHoldingExactlyOneTrainerStatic = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTrainerStatic->attach($trainerStatic);
        $this->subject->setTrainerStatic($objectStorageHoldingExactlyOneTrainerStatic);

        self::assertEquals($objectStorageHoldingExactlyOneTrainerStatic, $this->subject->_get('trainerStatic'));
    }

    /**
     * @test
     */
    public function addTrainerStaticToObjectStorageHoldingTrainerStatic(): void
    {
        $trainerStatic = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
        $trainerStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerStaticObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($trainerStatic));
        $this->subject->_set('trainerStatic', $trainerStaticObjectStorageMock);

        $this->subject->addTrainerStatic($trainerStatic);
    }

    /**
     * @test
     */
    public function removeTrainerStaticFromObjectStorageHoldingTrainerStatic(): void
    {
        $trainerStatic = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
        $trainerStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerStaticObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($trainerStatic));
        $this->subject->_set('trainerStatic', $trainerStaticObjectStorageMock);

        $this->subject->removeTrainerStatic($trainerStatic);
    }

    /**
     * @test
     */
    public function getBeraterStaticReturnsInitialValueForStaticBerater(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBeraterStatic()
        );
    }

    /**
     * @test
     */
    public function setBeraterStaticForObjectStorageContainingStaticBeraterSetsBeraterStatic(): void
    {
        $beraterStatic = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
        $objectStorageHoldingExactlyOneBeraterStatic = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBeraterStatic->attach($beraterStatic);
        $this->subject->setBeraterStatic($objectStorageHoldingExactlyOneBeraterStatic);

        self::assertEquals($objectStorageHoldingExactlyOneBeraterStatic, $this->subject->_get('beraterStatic'));
    }

    /**
     * @test
     */
    public function addBeraterStaticToObjectStorageHoldingBeraterStatic(): void
    {
        $beraterStatic = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
        $beraterStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $beraterStaticObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($beraterStatic));
        $this->subject->_set('beraterStatic', $beraterStaticObjectStorageMock);

        $this->subject->addBeraterStatic($beraterStatic);
    }

    /**
     * @test
     */
    public function removeBeraterStaticFromObjectStorageHoldingBeraterStatic(): void
    {
        $beraterStatic = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
        $beraterStaticObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $beraterStaticObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($beraterStatic));
        $this->subject->_set('beraterStatic', $beraterStaticObjectStorageMock);

        $this->subject->removeBeraterStatic($beraterStatic);
    }

    /**
     * @test
     */
    public function getKopieVonReturnsInitialValueForAnsuchen(): void
    {
        self::assertEquals(
            null,
            $this->subject->getKopieVon()
        );
    }

    /**
     * @test
     */
    public function setKopieVonForAnsuchenSetsKopieVon(): void
    {
        $kopieVonFixture = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();
        $this->subject->setKopieVon($kopieVonFixture);

        self::assertEquals($kopieVonFixture, $this->subject->_get('kopieVon'));
    }

    /**
     * @test
     */
    public function getStammdatenReturnsInitialValueForStammdaten(): void
    {
        self::assertEquals(
            null,
            $this->subject->getStammdaten()
        );
    }

    /**
     * @test
     */
    public function setStammdatenForStammdatenSetsStammdaten(): void
    {
        $stammdatenFixture = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();
        $this->subject->setStammdaten($stammdatenFixture);

        self::assertEquals($stammdatenFixture, $this->subject->_get('stammdaten'));
    }

    /**
     * @test
     */
    public function getStandorteReturnsInitialValueForStandort(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getStandorte()
        );
    }

    /**
     * @test
     */
    public function setStandorteForObjectStorageContainingStandortSetsStandorte(): void
    {
        $standorte = new \GeorgRinger\Ieb\Domain\Model\Standort();
        $objectStorageHoldingExactlyOneStandorte = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneStandorte->attach($standorte);
        $this->subject->setStandorte($objectStorageHoldingExactlyOneStandorte);

        self::assertEquals($objectStorageHoldingExactlyOneStandorte, $this->subject->_get('standorte'));
    }

    /**
     * @test
     */
    public function addStandorteToObjectStorageHoldingStandorte(): void
    {
        $standorte = new \GeorgRinger\Ieb\Domain\Model\Standort();
        $standorteObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $standorteObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($standorte));
        $this->subject->_set('standorte', $standorteObjectStorageMock);

        $this->subject->addStandorte($standorte);
    }

    /**
     * @test
     */
    public function removeStandorteFromObjectStorageHoldingStandorte(): void
    {
        $standorte = new \GeorgRinger\Ieb\Domain\Model\Standort();
        $standorteObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $standorteObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($standorte));
        $this->subject->_set('standorte', $standorteObjectStorageMock);

        $this->subject->removeStandorte($standorte);
    }

    /**
     * @test
     */
    public function getTrainerReturnsInitialValueForTrainer(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTrainer()
        );
    }

    /**
     * @test
     */
    public function setTrainerForObjectStorageContainingTrainerSetsTrainer(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();
        $objectStorageHoldingExactlyOneTrainer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTrainer->attach($trainer);
        $this->subject->setTrainer($objectStorageHoldingExactlyOneTrainer);

        self::assertEquals($objectStorageHoldingExactlyOneTrainer, $this->subject->_get('trainer'));
    }

    /**
     * @test
     */
    public function addTrainerToObjectStorageHoldingTrainer(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();
        $trainerObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($trainer));
        $this->subject->_set('trainer', $trainerObjectStorageMock);

        $this->subject->addTrainer($trainer);
    }

    /**
     * @test
     */
    public function removeTrainerFromObjectStorageHoldingTrainer(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();
        $trainerObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($trainer));
        $this->subject->_set('trainer', $trainerObjectStorageMock);

        $this->subject->removeTrainer($trainer);
    }

    /**
     * @test
     */
    public function getBeraterReturnsInitialValueForBerater(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBerater()
        );
    }

    /**
     * @test
     */
    public function setBeraterForObjectStorageContainingBeraterSetsBerater(): void
    {
        $berater = new \GeorgRinger\Ieb\Domain\Model\Berater();
        $objectStorageHoldingExactlyOneBerater = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBerater->attach($berater);
        $this->subject->setBerater($objectStorageHoldingExactlyOneBerater);

        self::assertEquals($objectStorageHoldingExactlyOneBerater, $this->subject->_get('berater'));
    }

    /**
     * @test
     */
    public function addBeraterToObjectStorageHoldingBerater(): void
    {
        $berater = new \GeorgRinger\Ieb\Domain\Model\Berater();
        $beraterObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $beraterObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($berater));
        $this->subject->_set('berater', $beraterObjectStorageMock);

        $this->subject->addBerater($berater);
    }

    /**
     * @test
     */
    public function removeBeraterFromObjectStorageHoldingBerater(): void
    {
        $berater = new \GeorgRinger\Ieb\Domain\Model\Berater();
        $beraterObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $beraterObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($berater));
        $this->subject->_set('berater', $beraterObjectStorageMock);

        $this->subject->removeBerater($berater);
    }
}
