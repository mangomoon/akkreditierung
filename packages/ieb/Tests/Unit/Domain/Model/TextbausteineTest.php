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
class TextbausteineTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Domain\Model\Textbausteine|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GeorgRinger\Ieb\Domain\Model\Textbausteine::class,
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
    public function getKriteriumReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKriterium()
        );
    }

    /**
     * @test
     */
    public function setKriteriumForStringSetsKriterium(): void
    {
        $this->subject->setKriterium('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kriterium'));
    }

    /**
     * @test
     */
    public function getBausteinReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getBaustein()
        );
    }

    /**
     * @test
     */
    public function setBausteinForStringSetsBaustein(): void
    {
        $this->subject->setBaustein('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('baustein'));
    }
}
