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
class KriterienControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\KriterienController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\KriterienController::class))
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
    public function listActionFetchesAllKriteriensFromRepositoryAndAssignsThemToView(): void
    {
        $allKriteriens = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $kriterienRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\KriterienRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $kriterienRepository->expects(self::once())->method('findAll')->will(self::returnValue($allKriteriens));
        $this->subject->_set('kriterienRepository', $kriterienRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('kriteriens', $allKriteriens);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenKriterienToView(): void
    {
        $kriterien = new \GeorgRinger\Ieb\Domain\Model\Kriterien();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('kriterien', $kriterien);

        $this->subject->showAction($kriterien);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenKriterienToKriterienRepository(): void
    {
        $kriterien = new \GeorgRinger\Ieb\Domain\Model\Kriterien();

        $kriterienRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\KriterienRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $kriterienRepository->expects(self::once())->method('add')->with($kriterien);
        $this->subject->_set('kriterienRepository', $kriterienRepository);

        $this->subject->createAction($kriterien);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenKriterienToView(): void
    {
        $kriterien = new \GeorgRinger\Ieb\Domain\Model\Kriterien();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('kriterien', $kriterien);

        $this->subject->editAction($kriterien);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenKriterienInKriterienRepository(): void
    {
        $kriterien = new \GeorgRinger\Ieb\Domain\Model\Kriterien();

        $kriterienRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\KriterienRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $kriterienRepository->expects(self::once())->method('update')->with($kriterien);
        $this->subject->_set('kriterienRepository', $kriterienRepository);

        $this->subject->updateAction($kriterien);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenKriterienFromKriterienRepository(): void
    {
        $kriterien = new \GeorgRinger\Ieb\Domain\Model\Kriterien();

        $kriterienRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\KriterienRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $kriterienRepository->expects(self::once())->method('remove')->with($kriterien);
        $this->subject->_set('kriterienRepository', $kriterienRepository);

        $this->subject->deleteAction($kriterien);
    }
}
