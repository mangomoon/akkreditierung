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
class KriterienTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Kriterien|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Kriterien::class,
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
    public function getChiffreReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getChiffre()
        );
    }

    /**
     * @test
     */
    public function setChiffreForStringSetsChiffre(): void
    {
        $this->subject->setChiffre('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('chiffre'));
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
    public function getHinweisReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getHinweis()
        );
    }

    /**
     * @test
     */
    public function setHinweisForStringSetsHinweis(): void
    {
        $this->subject->setHinweis('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('hinweis'));
    }

    /**
     * @test
     */
    public function getPruefkriterienReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPruefkriterien()
        );
    }

    /**
     * @test
     */
    public function setPruefkriterienForStringSetsPruefkriterien(): void
    {
        $this->subject->setPruefkriterien('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('pruefkriterien'));
    }

    /**
     * @test
     */
    public function getHilfetextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getHilfetext()
        );
    }

    /**
     * @test
     */
    public function setHilfetextForStringSetsHilfetext(): void
    {
        $this->subject->setHilfetext('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('hilfetext'));
    }

    /**
     * @test
     */
    public function getPpdReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPpd()
        );
    }

    /**
     * @test
     */
    public function setPpdForStringSetsPpd(): void
    {
        $this->subject->setPpd('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('ppd'));
    }
}
