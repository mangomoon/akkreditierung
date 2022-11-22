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
class StammdatenTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Stammdaten|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Stammdaten::class,
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
    public function getNachweisReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getNachweis()
        );
    }

    /**
     * @test
     */
    public function setNachweisForFileReferenceSetsNachweis(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setNachweis($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('nachweis'));
    }

    /**
     * @test
     */
    public function getRechtsformReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getRechtsform()
        );
    }

    /**
     * @test
     */
    public function setRechtsformForIntSetsRechtsform(): void
    {
        $this->subject->setRechtsform(12);

        self::assertEquals(12, $this->subject->_get('rechtsform'));
    }

    /**
     * @test
     */
    public function getStrasseReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getStrasse()
        );
    }

    /**
     * @test
     */
    public function setStrasseForStringSetsStrasse(): void
    {
        $this->subject->setStrasse('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('strasse'));
    }

    /**
     * @test
     */
    public function getPlzReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPlz()
        );
    }

    /**
     * @test
     */
    public function setPlzForStringSetsPlz(): void
    {
        $this->subject->setPlz('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('plz'));
    }

    /**
     * @test
     */
    public function getOrtReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getOrt()
        );
    }

    /**
     * @test
     */
    public function setOrtForStringSetsOrt(): void
    {
        $this->subject->setOrt('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('ort'));
    }

    /**
     * @test
     */
    public function getSeitReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getSeit()
        );
    }

    /**
     * @test
     */
    public function setSeitForDateTimeSetsSeit(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setSeit($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('seit'));
    }

    /**
     * @test
     */
    public function getWebsiteReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getWebsite()
        );
    }

    /**
     * @test
     */
    public function setWebsiteForStringSetsWebsite(): void
    {
        $this->subject->setWebsite('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('website'));
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail(): void
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('email'));
    }

    /**
     * @test
     */
    public function getTelefonReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelefon()
        );
    }

    /**
     * @test
     */
    public function setTelefonForStringSetsTelefon(): void
    {
        $this->subject->setTelefon('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('telefon'));
    }

    /**
     * @test
     */
    public function getLeitbildReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLeitbild()
        );
    }

    /**
     * @test
     */
    public function setLeitbildForStringSetsLeitbild(): void
    {
        $this->subject->setLeitbild('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('leitbild'));
    }

    /**
     * @test
     */
    public function getLeitbildDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLeitbildDatei()
        );
    }

    /**
     * @test
     */
    public function setLeitbildDateiForFileReferenceSetsLeitbildDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLeitbildDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('leitbildDatei'));
    }

    /**
     * @test
     */
    public function getQmsZertifikatDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQmsZertifikatDatei()
        );
    }

    /**
     * @test
     */
    public function setQmsZertifikatDateiForFileReferenceSetsQmsZertifikatDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQmsZertifikatDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qmsZertifikatDatei'));
    }

    /**
     * @test
     */
    public function getQmsZertifikatReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQmsZertifikat()
        );
    }

    /**
     * @test
     */
    public function setQmsZertifikatForStringSetsQmsZertifikat(): void
    {
        $this->subject->setQmsZertifikat('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qmsZertifikat'));
    }

    /**
     * @test
     */
    public function getQmsTypReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getQmsTyp()
        );
    }

    /**
     * @test
     */
    public function setQmsTypForIntSetsQmsTyp(): void
    {
        $this->subject->setQmsTyp(12);

        self::assertEquals(12, $this->subject->_get('qmsTyp'));
    }

    /**
     * @test
     */
    public function getZertifikatBisReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getZertifikatBis()
        );
    }

    /**
     * @test
     */
    public function setZertifikatBisForDateTimeSetsZertifikatBis(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setZertifikatBis($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('zertifikatBis'));
    }

    /**
     * @test
     */
    public function getQualitaetSicherungReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualitaetSicherung()
        );
    }

    /**
     * @test
     */
    public function setQualitaetSicherungForStringSetsQualitaetSicherung(): void
    {
        $this->subject->setQualitaetSicherung('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualitaetSicherung'));
    }

    /**
     * @test
     */
    public function getQualitaetSicherungDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQualitaetSicherungDatei()
        );
    }

    /**
     * @test
     */
    public function setQualitaetSicherungDateiForFileReferenceSetsQualitaetSicherungDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQualitaetSicherungDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qualitaetSicherungDatei'));
    }

    /**
     * @test
     */
    public function getQualitaetPersonalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualitaetPersonal()
        );
    }

    /**
     * @test
     */
    public function setQualitaetPersonalForStringSetsQualitaetPersonal(): void
    {
        $this->subject->setQualitaetPersonal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualitaetPersonal'));
    }

    /**
     * @test
     */
    public function getQualitaetPersonalDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQualitaetPersonalDatei()
        );
    }

    /**
     * @test
     */
    public function setQualitaetPersonalDateiForFileReferenceSetsQualitaetPersonalDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQualitaetPersonalDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qualitaetPersonalDatei'));
    }

    /**
     * @test
     */
    public function getTrPp3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getTrPp3());
    }

    /**
     * @test
     */
    public function setTrPp3ForBoolSetsTrPp3(): void
    {
        $this->subject->setTrPp3(true);

        self::assertEquals(true, $this->subject->_get('trPp3'));
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
    public function getPruefbescheidBisReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getPruefbescheidBis()
        );
    }

    /**
     * @test
     */
    public function setPruefbescheidBisForDateTimeSetsPruefbescheidBis(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setPruefbescheidBis($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('pruefbescheidBis'));
    }

    /**
     * @test
     */
    public function getReviewCommentInternalReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewCommentInternal()
        );
    }

    /**
     * @test
     */
    public function setReviewCommentInternalForStringSetsReviewCommentInternal(): void
    {
        $this->subject->setReviewCommentInternal('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewCommentInternal'));
    }

    /**
     * @test
     */
    public function getReviewCommentTrReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewCommentTr()
        );
    }

    /**
     * @test
     */
    public function setReviewCommentTrForStringSetsReviewCommentTr(): void
    {
        $this->subject->setReviewCommentTr('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewCommentTr'));
    }

    /**
     * @test
     */
    public function getReviewStatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewStatus()
        );
    }

    /**
     * @test
     */
    public function setReviewStatusForIntSetsReviewStatus(): void
    {
        $this->subject->setReviewStatus(12);

        self::assertEquals(12, $this->subject->_get('reviewStatus'));
    }

    /**
     * @test
     */
    public function getReviewFristReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getReviewFrist()
        );
    }

    /**
     * @test
     */
    public function setReviewFristForDateTimeSetsReviewFrist(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setReviewFrist($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('reviewFrist'));
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
    public function getBasedOnReturnsInitialValueForStammdaten(): void
    {
        self::assertEquals(
            null,
            $this->subject->getBasedOn()
        );
    }

    /**
     * @test
     */
    public function setBasedOnForStammdatenSetsBasedOn(): void
    {
        $basedOnFixture = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();
        $this->subject->setBasedOn($basedOnFixture);

        self::assertEquals($basedOnFixture, $this->subject->_get('basedOn'));
    }
}
