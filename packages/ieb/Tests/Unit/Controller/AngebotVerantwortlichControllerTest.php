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
class AngebotVerantwortlichControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\AngebotVerantwortlichController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\AngebotVerantwortlichController::class))
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
    public function listActionFetchesAllAngebotVerantwortlichesFromRepositoryAndAssignsThemToView(): void
    {
        $allAngebotVerantwortliches = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $angebotVerantwortlichRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $angebotVerantwortlichRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAngebotVerantwortliches));
        $this->subject->_set('angebotVerantwortlichRepository', $angebotVerantwortlichRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('angebotVerantwortliches', $allAngebotVerantwortliches);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAngebotVerantwortlichToView(): void
    {
        $angebotVerantwortlich = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('angebotVerantwortlich', $angebotVerantwortlich);

        $this->subject->showAction($angebotVerantwortlich);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenAngebotVerantwortlichToAngebotVerantwortlichRepository(): void
    {
        $angebotVerantwortlich = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();

        $angebotVerantwortlichRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $angebotVerantwortlichRepository->expects(self::once())->method('add')->with($angebotVerantwortlich);
        $this->subject->_set('angebotVerantwortlichRepository', $angebotVerantwortlichRepository);

        $this->subject->createAction($angebotVerantwortlich);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAngebotVerantwortlichToView(): void
    {
        $angebotVerantwortlich = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('angebotVerantwortlich', $angebotVerantwortlich);

        $this->subject->editAction($angebotVerantwortlich);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAngebotVerantwortlichInAngebotVerantwortlichRepository(): void
    {
        $angebotVerantwortlich = new \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich();

        $angebotVerantwortlichRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $angebotVerantwortlichRepository->expects(self::once())->method('update')->with($angebotVerantwortlich);
        $this->subject->_set('angebotVerantwortlichRepository', $angebotVerantwortlichRepository);

        $this->subject->updateAction($angebotVerantwortlich);
    }
}
