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
class AngebotVerantwortlichTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich::class,
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
    public function getVerantwortlichReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getVerantwortlich());
    }

    /**
     * @test
     */
    public function setVerantwortlichForBoolSetsVerantwortlich(): void
    {
        $this->subject->setVerantwortlich(true);

        self::assertEquals(true, $this->subject->_get('verantwortlich'));
    }
}
