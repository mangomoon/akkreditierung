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
class StaticBeraterTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\StaticBerater|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\StaticBerater::class,
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
    public function getBasedOnReturnsInitialValueForBerater(): void
    {
        self::assertEquals(
            null,
            $this->subject->getBasedOn()
        );
    }

    /**
     * @test
     */
    public function setBasedOnForBeraterSetsBasedOn(): void
    {
        $basedOnFixture = new \GeorgRinger\Ieb\Domain\Model\Berater();
        $this->subject->setBasedOn($basedOnFixture);

        self::assertEquals($basedOnFixture, $this->subject->_get('basedOn'));
    }
}
