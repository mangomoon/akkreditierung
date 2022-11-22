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
class AnsuchenControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\AnsuchenController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\AnsuchenController::class))
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
    public function listActionFetchesAllAnsuchensFromRepositoryAndAssignsThemToView(): void
    {
        $allAnsuchens = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $ansuchenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $ansuchenRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAnsuchens));
        $this->subject->_set('ansuchenRepository', $ansuchenRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('ansuchens', $allAnsuchens);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAnsuchenToView(): void
    {
        $ansuchen = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('ansuchen', $ansuchen);

        $this->subject->showAction($ansuchen);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenAnsuchenToAnsuchenRepository(): void
    {
        $ansuchen = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();

        $ansuchenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $ansuchenRepository->expects(self::once())->method('add')->with($ansuchen);
        $this->subject->_set('ansuchenRepository', $ansuchenRepository);

        $this->subject->createAction($ansuchen);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAnsuchenToView(): void
    {
        $ansuchen = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('ansuchen', $ansuchen);

        $this->subject->editAction($ansuchen);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAnsuchenInAnsuchenRepository(): void
    {
        $ansuchen = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();

        $ansuchenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $ansuchenRepository->expects(self::once())->method('update')->with($ansuchen);
        $this->subject->_set('ansuchenRepository', $ansuchenRepository);

        $this->subject->updateAction($ansuchen);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenAnsuchenFromAnsuchenRepository(): void
    {
        $ansuchen = new \GeorgRinger\Ieb\Domain\Model\Ansuchen();

        $ansuchenRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $ansuchenRepository->expects(self::once())->method('remove')->with($ansuchen);
        $this->subject->_set('ansuchenRepository', $ansuchenRepository);

        $this->subject->deleteAction($ansuchen);
    }
}
