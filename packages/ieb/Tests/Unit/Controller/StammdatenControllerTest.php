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
class StammdatenControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\StammdatenController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\StammdatenController::class))
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
    public function listActionFetchesAllStammdatensFromRepositoryAndAssignsThemToView(): void
    {
        $allStammdatens = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stammdatenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StammdatenRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $stammdatenRepository->expects(self::once())->method('findAll')->will(self::returnValue($allStammdatens));
        $this->subject->_set('stammdatenRepository', $stammdatenRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('stammdatens', $allStammdatens);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenStammdatenToView(): void
    {
        $stammdaten = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('stammdaten', $stammdaten);

        $this->subject->showAction($stammdaten);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenStammdatenToStammdatenRepository(): void
    {
        $stammdaten = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();

        $stammdatenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StammdatenRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $stammdatenRepository->expects(self::once())->method('add')->with($stammdaten);
        $this->subject->_set('stammdatenRepository', $stammdatenRepository);

        $this->subject->createAction($stammdaten);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenStammdatenToView(): void
    {
        $stammdaten = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('stammdaten', $stammdaten);

        $this->subject->editAction($stammdaten);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenStammdatenInStammdatenRepository(): void
    {
        $stammdaten = new \GeorgRinger\Ieb\Domain\Model\Stammdaten();

        $stammdatenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StammdatenRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $stammdatenRepository->expects(self::once())->method('update')->with($stammdaten);
        $this->subject->_set('stammdatenRepository', $stammdatenRepository);

        $this->subject->updateAction($stammdaten);
    }
}
