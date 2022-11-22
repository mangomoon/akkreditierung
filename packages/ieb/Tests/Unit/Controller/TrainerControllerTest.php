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
class TrainerControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\TrainerController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\TrainerController::class))
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
    public function listActionFetchesAllTrainersFromRepositoryAndAssignsThemToView(): void
    {
        $allTrainers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $trainerRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $trainerRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTrainers));
        $this->subject->_set('trainerRepository', $trainerRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('trainers', $allTrainers);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTrainerToView(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('trainer', $trainer);

        $this->subject->showAction($trainer);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTrainerToTrainerRepository(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();

        $trainerRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerRepository->expects(self::once())->method('add')->with($trainer);
        $this->subject->_set('trainerRepository', $trainerRepository);

        $this->subject->createAction($trainer);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTrainerToView(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('trainer', $trainer);

        $this->subject->editAction($trainer);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTrainerInTrainerRepository(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();

        $trainerRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerRepository->expects(self::once())->method('update')->with($trainer);
        $this->subject->_set('trainerRepository', $trainerRepository);

        $this->subject->updateAction($trainer);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTrainerFromTrainerRepository(): void
    {
        $trainer = new \GeorgRinger\Ieb\Domain\Model\Trainer();

        $trainerRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $trainerRepository->expects(self::once())->method('remove')->with($trainer);
        $this->subject->_set('trainerRepository', $trainerRepository);

        $this->subject->deleteAction($trainer);
    }
}
