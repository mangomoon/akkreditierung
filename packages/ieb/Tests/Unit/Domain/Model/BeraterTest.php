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
class BeraterTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Berater|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Berater::class,
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
    public function getLebenslaufReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLebenslauf()
        );
    }

    /**
     * @test
     */
    public function setLebenslaufForFileReferenceSetsLebenslauf(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLebenslauf($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('lebenslauf'));
    }

    /**
     * @test
     */
    public function getQualifikationsnachweiseReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getQualifikationsnachweise()
        );
    }

    /**
     * @test
     */
    public function setQualifikationsnachweiseForFileReferenceSetsQualifikationsnachweise(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setQualifikationsnachweise($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('qualifikationsnachweise'));
    }

    /**
     * @test
     */
    public function getLebenslaufKommentarReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLebenslaufKommentar()
        );
    }

    /**
     * @test
     */
    public function setLebenslaufKommentarForStringSetsLebenslaufKommentar(): void
    {
        $this->subject->setLebenslaufKommentar('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('lebenslaufKommentar'));
    }

    /**
     * @test
     */
    public function getQualifikationsnachweiseKommentarReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getQualifikationsnachweiseKommentar()
        );
    }

    /**
     * @test
     */
    public function setQualifikationsnachweiseKommentarForStringSetsQualifikationsnachweiseKommentar(): void
    {
        $this->subject->setQualifikationsnachweiseKommentar('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('qualifikationsnachweiseKommentar'));
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
    public function getReviewC3CommentInternalStepReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3CommentInternalStep()
        );
    }

    /**
     * @test
     */
    public function setReviewC3CommentInternalStepForStringSetsReviewC3CommentInternalStep(): void
    {
        $this->subject->setReviewC3CommentInternalStep('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3CommentInternalStep'));
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
}
