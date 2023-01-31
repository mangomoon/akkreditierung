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
}
