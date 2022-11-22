<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 *
 * @author Georg Ringer <mail@ringer.it>
 */
class BeraterControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\BeraterController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\BeraterController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllBeratersFromRepositoryAndAssignsThemToView(): void
    {
        $allBeraters = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $beraterRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\BeraterRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $beraterRepository->expects(self::once())->method('findAll')->will(self::returnValue($allBeraters));
        $this->subject->_set('beraterRepository', $beraterRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('beraters', $allBeraters);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }
}
