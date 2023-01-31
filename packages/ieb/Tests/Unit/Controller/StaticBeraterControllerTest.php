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
class StaticBeraterControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\StaticBeraterController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\StaticBeraterController::class))
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
    public function listActionFetchesAllStaticBeratersFromRepositoryAndAssignsThemToView(): void
    {
        $allStaticBeraters = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $staticBeraterRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StaticBeraterRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $staticBeraterRepository->expects(self::once())->method('findAll')->will(self::returnValue($allStaticBeraters));
        $this->subject->_set('staticBeraterRepository', $staticBeraterRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('staticBeraters', $allStaticBeraters);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenStaticBeraterToView(): void
    {
        $staticBerater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('staticBerater', $staticBerater);

        $this->subject->showAction($staticBerater);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenStaticBeraterToStaticBeraterRepository(): void
    {
        $staticBerater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();

        $staticBeraterRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StaticBeraterRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $staticBeraterRepository->expects(self::once())->method('add')->with($staticBerater);
        $this->subject->_set('staticBeraterRepository', $staticBeraterRepository);

        $this->subject->createAction($staticBerater);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenStaticBeraterToView(): void
    {
        $staticBerater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('staticBerater', $staticBerater);

        $this->subject->editAction($staticBerater);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenStaticBeraterInStaticBeraterRepository(): void
    {
        $staticBerater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();

        $staticBeraterRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StaticBeraterRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $staticBeraterRepository->expects(self::once())->method('update')->with($staticBerater);
        $this->subject->_set('staticBeraterRepository', $staticBeraterRepository);

        $this->subject->updateAction($staticBerater);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenStaticBeraterFromStaticBeraterRepository(): void
    {
        $staticBerater = new \GeorgRinger\Ieb\Domain\Model\StaticBerater();

        $staticBeraterRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\StaticBeraterRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $staticBeraterRepository->expects(self::once())->method('remove')->with($staticBerater);
        $this->subject->_set('staticBeraterRepository', $staticBeraterRepository);

        $this->subject->deleteAction($staticBerater);
    }
}
