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
    public function getStammdatenReturnsInitialValueForStaticStammdaten(): void
    {
        self::assertEquals(
            null,
            $this->subject->getStammdaten()
        );
    }

    /**
     * @test
     */
    public function setStammdatenForStaticStammdatenSetsStammdaten(): void
    {
        $stammdatenFixture = new \GeorgRinger\Ieb\Domain\Model\StaticStammdaten();
        $this->subject->setStammdaten($stammdatenFixture);

        self::assertEquals($stammdatenFixture, $this->subject->_get('stammdaten'));
    }

    /**
     * @test
     */
    public function getStandorteReturnsInitialValueForStaticStandort(): void
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
    public function setStandorteForObjectStorageContainingStaticStandortSetsStandorte(): void
    {
        $standorte = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
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
        $standorte = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
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
        $standorte = new \GeorgRinger\Ieb\Domain\Model\StaticStandort();
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
    public function getTrainerReturnsInitialValueForStaticTrainer(): void
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
    public function setTrainerForObjectStorageContainingStaticTrainerSetsTrainer(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
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
        $trainer = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
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
        $trainer = new \GeorgRinger\Ieb\Domain\Model\StaticTrainer();
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
    public function getBeraterReturnsInitialValueForStaticBerater(): void
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
    public function setBeraterForObjectStorageContainingStaticBeraterSetsBerater(): void
    {
        $berater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
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
        $berater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
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
        $berater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();
        $beraterObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $beraterObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($berater));
        $this->subject->_set('berater', $beraterObjectStorageMock);

        $this->subject->removeBerater($berater);
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
}
