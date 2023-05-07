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
class TrainerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Trainer|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Trainer::class,
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
    public function getNachnameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNachname()
        );
    }

    /**
     * @test
     */
    public function setNachnameForStringSetsNachname(): void
    {
        $this->subject->setNachname('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('nachname'));
    }

    /**
     * @test
     */
    public function getVornameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getVorname()
        );
    }

    /**
     * @test
     */
    public function setVornameForStringSetsVorname(): void
    {
        $this->subject->setVorname('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('vorname'));
    }

    /**
     * @test
     */
    public function getVerwendungBabiReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getVerwendungBabi());
    }

    /**
     * @test
     */
    public function setVerwendungBabiForBoolSetsVerwendungBabi(): void
    {
        $this->subject->setVerwendungBabi(true);

        self::assertEquals(true, $this->subject->_get('verwendungBabi'));
    }

    /**
     * @test
     */
    public function getVerwendungPsaReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getVerwendungPsa());
    }

    /**
     * @test
     */
    public function setVerwendungPsaForBoolSetsVerwendungPsa(): void
    {
        $this->subject->setVerwendungPsa(true);

        self::assertEquals(true, $this->subject->_get('verwendungPsa'));
    }

    /**
     * @test
     */
    public function getLebenslaufReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLebenslauf()
        );
    }

    /**
     * @test
     */
    public function setLebenslaufForStringSetsLebenslauf(): void
    {
        $this->subject->setLebenslauf('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('lebenslauf'));
    }

    /**
     * @test
     */
    public function getQualifikationBabiReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualifikationBabi()
        );
    }

    /**
     * @test
     */
    public function setQualifikationBabiForStringSetsQualifikationBabi(): void
    {
        $this->subject->setQualifikationBabi('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualifikationBabi'));
    }

    /**
     * @test
     */
    public function getLehrBefugnisReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLehrBefugnis()
        );
    }

    /**
     * @test
     */
    public function setLehrBefugnisForStringSetsLehrBefugnis(): void
    {
        $this->subject->setLehrBefugnis('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('lehrBefugnis'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa1ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa1());
    }

    /**
     * @test
     */
    public function setQualifikationPsa1ForBoolSetsQualifikationPsa1(): void
    {
        $this->subject->setQualifikationPsa1(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa1'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa2ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa2());
    }

    /**
     * @test
     */
    public function setQualifikationPsa2ForBoolSetsQualifikationPsa2(): void
    {
        $this->subject->setQualifikationPsa2(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa2'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa3());
    }

    /**
     * @test
     */
    public function setQualifikationPsa3ForBoolSetsQualifikationPsa3(): void
    {
        $this->subject->setQualifikationPsa3(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa3'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa4ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa4());
    }

    /**
     * @test
     */
    public function setQualifikationPsa4ForBoolSetsQualifikationPsa4(): void
    {
        $this->subject->setQualifikationPsa4(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa4'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa5ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa5());
    }

    /**
     * @test
     */
    public function setQualifikationPsa5ForBoolSetsQualifikationPsa5(): void
    {
        $this->subject->setQualifikationPsa5(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa5'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa6ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa6());
    }

    /**
     * @test
     */
    public function setQualifikationPsa6ForBoolSetsQualifikationPsa6(): void
    {
        $this->subject->setQualifikationPsa6(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa6'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa7ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa7());
    }

    /**
     * @test
     */
    public function setQualifikationPsa7ForBoolSetsQualifikationPsa7(): void
    {
        $this->subject->setQualifikationPsa7(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa7'));
    }

    /**
     * @test
     */
    public function getQualifikationPsa8ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getQualifikationPsa8());
    }

    /**
     * @test
     */
    public function setQualifikationPsa8ForBoolSetsQualifikationPsa8(): void
    {
        $this->subject->setQualifikationPsa8(true);

        self::assertEquals(true, $this->subject->_get('qualifikationPsa8'));
    }

    /**
     * @test
     */
    public function getQualifikationPsaReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualifikationPsa()
        );
    }

    /**
     * @test
     */
    public function setQualifikationPsaForStringSetsQualifikationPsa(): void
    {
        $this->subject->setQualifikationPsa('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualifikationPsa'));
    }

    /**
     * @test
     */
    public function getQualifikationPsaKommentarReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualifikationPsaKommentar()
        );
    }

    /**
     * @test
     */
    public function setQualifikationPsaKommentarForStringSetsQualifikationPsaKommentar(): void
    {
        $this->subject->setQualifikationPsaKommentar('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualifikationPsaKommentar'));
    }

    /**
     * @test
     */
    public function getAnerkennungPp3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAnerkennungPp3());
    }

    /**
     * @test
     */
    public function setAnerkennungPp3ForBoolSetsAnerkennungPp3(): void
    {
        $this->subject->setAnerkennungPp3(true);

        self::assertEquals(true, $this->subject->_get('anerkennungPp3'));
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('title'));
    }

    /**
     * @test
     */
    public function getLebenslaufDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLebenslaufDatei()
        );
    }

    /**
     * @test
     */
    public function setLebenslaufDateiForFileReferenceSetsLebenslaufDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLebenslaufDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('lebenslaufDatei'));
    }

    /**
     * @test
     */
    public function getQualifikationBabiDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQualifikationBabiDatei()
        );
    }

    /**
     * @test
     */
    public function setQualifikationBabiDateiForFileReferenceSetsQualifikationBabiDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQualifikationBabiDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qualifikationBabiDatei'));
    }

    /**
     * @test
     */
    public function getLehrBefugnisDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLehrBefugnisDatei()
        );
    }

    /**
     * @test
     */
    public function setLehrBefugnisDateiForFileReferenceSetsLehrBefugnisDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLehrBefugnisDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('lehrBefugnisDatei'));
    }

    /**
     * @test
     */
    public function getQualifikationPsaDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQualifikationPsaDatei()
        );
    }

    /**
     * @test
     */
    public function setQualifikationPsaDateiForFileReferenceSetsQualifikationPsaDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQualifikationPsaDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qualifikationPsaDatei'));
    }

    /**
     * @test
     */
    public function getOkbabiReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getOkbabi());
    }

    /**
     * @test
     */
    public function setOkbabiForBoolSetsOkbabi(): void
    {
        $this->subject->setOkbabi(true);

        self::assertEquals(true, $this->subject->_get('okbabi'));
    }

    /**
     * @test
     */
    public function getOkpsaReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getOkpsa());
    }

    /**
     * @test
     */
    public function setOkpsaForBoolSetsOkpsa(): void
    {
        $this->subject->setOkpsa(true);

        self::assertEquals(true, $this->subject->_get('okpsa'));
    }

    /**
     * @test
     */
    public function getArchiviertReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getArchiviert());
    }

    /**
     * @test
     */
    public function setArchiviertForBoolSetsArchiviert(): void
    {
        $this->subject->setArchiviert(true);

        self::assertEquals(true, $this->subject->_get('archiviert'));
    }
}
