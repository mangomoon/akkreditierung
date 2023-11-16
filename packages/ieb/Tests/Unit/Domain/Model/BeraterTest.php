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
    public function getReviewC32StatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewC32Status()
        );
    }

    /**
     * @test
     */
    public function setReviewC32StatusForIntSetsReviewC32Status(): void
    {
        $this->subject->setReviewC32Status(12);

        self::assertEquals(12, $this->subject->_get('reviewC32Status'));
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
    public function getStatusAfterReviewReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getStatusAfterReview()
        );
    }

    /**
     * @test
     */
    public function setStatusAfterReviewForIntSetsStatusAfterReview(): void
    {
        $this->subject->setStatusAfterReview(12);

        self::assertEquals(12, $this->subject->_get('statusAfterReview'));
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
    public function getReviewFristMailSent14tReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getReviewFristMailSent14t());
    }

    /**
     * @test
     */
    public function setReviewFristMailSent14tForBoolSetsReviewFristMailSent14t(): void
    {
        $this->subject->setReviewFristMailSent14t(true);

        self::assertEquals(true, $this->subject->_get('reviewFristMailSent14t'));
    }

    /**
     * @test
     */
    public function getReviewFristMailSent1tReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getReviewFristMailSent1t());
    }

    /**
     * @test
     */
    public function setReviewFristMailSent1tForBoolSetsReviewFristMailSent1t(): void
    {
        $this->subject->setReviewFristMailSent1t(true);

        self::assertEquals(true, $this->subject->_get('reviewFristMailSent1t'));
    }

    /**
     * @test
     */
    public function getPp3ReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getPp3());
    }

    /**
     * @test
     */
    public function setPp3ForBoolSetsPp3(): void
    {
        $this->subject->setPp3(true);

        self::assertEquals(true, $this->subject->_get('pp3'));
    }

    /**
     * @test
     */
    public function getGutachterLockedByReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getGutachterLockedBy()
        );
    }

    /**
     * @test
     */
    public function setGutachterLockedByForIntSetsGutachterLockedBy(): void
    {
        $this->subject->setGutachterLockedBy(12);

        self::assertEquals(12, $this->subject->_get('gutachterLockedBy'));
    }

    /**
     * @test
     */
    public function getReviewC3GsCommentInternalStepReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3GsCommentInternalStep()
        );
    }

    /**
     * @test
     */
    public function setReviewC3GsCommentInternalStepForStringSetsReviewC3GsCommentInternalStep(): void
    {
        $this->subject->setReviewC3GsCommentInternalStep('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3GsCommentInternalStep'));
    }

    /**
     * @test
     */
    public function getReviewC3Ag1CommentInternalStepReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3Ag1CommentInternalStep()
        );
    }

    /**
     * @test
     */
    public function setReviewC3Ag1CommentInternalStepForStringSetsReviewC3Ag1CommentInternalStep(): void
    {
        $this->subject->setReviewC3Ag1CommentInternalStep('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3Ag1CommentInternalStep'));
    }

    /**
     * @test
     */
    public function getReviewC3Ag2CommentInternalStepReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getReviewC3Ag2CommentInternalStep()
        );
    }

    /**
     * @test
     */
    public function setReviewC3Ag2CommentInternalStepForStringSetsReviewC3Ag2CommentInternalStep(): void
    {
        $this->subject->setReviewC3Ag2CommentInternalStep('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('reviewC3Ag2CommentInternalStep'));
    }
}
