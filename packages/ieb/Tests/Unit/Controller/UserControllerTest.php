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
class UserControllerTest extends UnitTestCase
{
    /**
     * @var \GeorgRinger\Ieb\Controller\UserController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\GeorgRinger\Ieb\Controller\UserController::class))
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
    public function listActionFetchesAllUsersFromRepositoryAndAssignsThemToView(): void
    {
        $allUsers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\UserRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $userRepository->expects(self::once())->method('findAll')->will(self::returnValue($allUsers));
        $this->subject->_set('userRepository', $userRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('users', $allUsers);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenUserToView(): void
    {
        $user = new \GeorgRinger\Ieb\Domain\Model\User();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('user', $user);

        $this->subject->showAction($user);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenUserToUserRepository(): void
    {
        $user = new \GeorgRinger\Ieb\Domain\Model\User();

        $userRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\UserRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects(self::once())->method('add')->with($user);
        $this->subject->_set('userRepository', $userRepository);

        $this->subject->createAction($user);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenUserToView(): void
    {
        $user = new \GeorgRinger\Ieb\Domain\Model\User();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('user', $user);

        $this->subject->editAction($user);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenUserInUserRepository(): void
    {
        $user = new \GeorgRinger\Ieb\Domain\Model\User();

        $userRepository = $this->getMockBuilder(\GeorgRinger\Ieb\Domain\Repository\UserRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects(self::once())->method('update')->with($user);
        $this->subject->_set('userRepository', $userRepository);

        $this->subject->updateAction($user);
    }
}
