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
    public function getPlzReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getPlz()
        );
    }

    /**
     * @test
     */
    public function setPlzForIntSetsPlz(): void
    {
        $this->subject->setPlz(12);

        self::assertEquals(12, $this->subject->_get('plz'));
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
    public function getStandorteReturnsInitialValueForStandort(): void
    {
        self::assertEquals(
            null,
            $this->subject->getStandorte()
        );
    }

    /**
     * @test
     */
    public function setStandorteForStandortSetsStandorte(): void
    {
        $standorteFixture = new \GeorgRinger\Ieb\Domain\Model\Standort();
        $this->subject->setStandorte($standorteFixture);

        self::assertEquals($standorteFixture, $this->subject->_get('standorte'));
    }
}
