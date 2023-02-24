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
class StandortControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\StandortController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\StandortController::class))
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
    public function listActionFetchesAllStandortsFromRepositoryAndAssignsThemToView(): void
    {
        $allStandorts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StandortRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $standortRepository->expects(self::once())->method('findAll')->will(self::returnValue($allStandorts));
        $this->subject->_set('standortRepository', $standortRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('standorts', $allStandorts);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenStandortToView(): void
    {
        $standort = new \GeorgRinger\Ieb\Domain\Model\Standort();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('standort', $standort);

        $this->subject->showAction($standort);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenStandortToStandortRepository(): void
    {
        $standort = new \GeorgRinger\Ieb\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StandortRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('add')->with($standort);
        $this->subject->_set('standortRepository', $standortRepository);

        $this->subject->createAction($standort);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenStandortToView(): void
    {
        $standort = new \GeorgRinger\Ieb\Domain\Model\Standort();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('standort', $standort);

        $this->subject->editAction($standort);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenStandortInStandortRepository(): void
    {
        $standort = new \GeorgRinger\Ieb\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StandortRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('update')->with($standort);
        $this->subject->_set('standortRepository', $standortRepository);

        $this->subject->updateAction($standort);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenStandortFromStandortRepository(): void
    {
        $standort = new \GeorgRinger\Ieb\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StandortRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('remove')->with($standort);
        $this->subject->_set('standortRepository', $standortRepository);

        $this->subject->deleteAction($standort);
    }
}
