<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * StammdatenController
 */
class StammdatenController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * stammdatenRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\StammdatenRepository
     */
    protected $stammdatenRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\StammdatenRepository $stammdatenRepository
     */
    public function injectStammdatenRepository(\GeorgRinger\Ieb\Domain\Repository\StammdatenRepository $stammdatenRepository)
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $stammdatens = $this->stammdatenRepository->findAll();
        $this->view->assign('stammdatens', $stammdatens);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('stammdaten', $stammdaten);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Stammdaten $newStammdaten
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Stammdaten $newStammdaten)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->stammdatenRepository->add($newStammdaten);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("stammdaten")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('stammdaten', $stammdaten);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Stammdaten $stammdaten)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->stammdatenRepository->update($stammdaten);
        $this->redirect('list');
    }
}
