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
class StaticStandortTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\StaticStandort|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\StaticStandort::class,
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
    public function getAdresseReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAdresse()
        );
    }

    /**
     * @test
     */
    public function setAdresseForStringSetsAdresse(): void
    {
        $this->subject->setAdresse('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('adresse'));
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
    public function getPruefBescheidReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getPruefBescheid());
    }

    /**
     * @test
     */
    public function setPruefBescheidForBoolSetsPruefBescheid(): void
    {
        $this->subject->setPruefBescheid(true);

        self::assertEquals(true, $this->subject->_get('pruefBescheid'));
    }

    /**
     * @test
     */
    public function getKoopSchuleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKoopSchule()
        );
    }

    /**
     * @test
     */
    public function setKoopSchuleForStringSetsKoopSchule(): void
    {
        $this->subject->setKoopSchule('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('koopSchule'));
    }

    /**
     * @test
     */
    public function getKoopSchuleDateiReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getKoopSchuleDatei()
        );
    }

    /**
     * @test
     */
    public function setKoopSchuleDateiForFileReferenceSetsKoopSchuleDatei(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setKoopSchuleDatei($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('koopSchuleDatei'));
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
    public function getReviewCommentStatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getReviewCommentStatus()
        );
    }

    /**
     * @test
     */
    public function setReviewCommentStatusForIntSetsReviewCommentStatus(): void
    {
        $this->subject->setReviewCommentStatus(12);

        self::assertEquals(12, $this->subject->_get('reviewCommentStatus'));
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
    public function getBasedOnReturnsInitialValueForStandort(): void
    {
        self::assertEquals(
            null,
            $this->subject->getBasedOn()
        );
    }

    /**
     * @test
     */
    public function setBasedOnForStandortSetsBasedOn(): void
    {
        $basedOnFixture = new \GeorgRinger\Ieb\Domain\Model\Standort();
        $this->subject->setBasedOn($basedOnFixture);

        self::assertEquals($basedOnFixture, $this->subject->_get('basedOn'));
    }
}
