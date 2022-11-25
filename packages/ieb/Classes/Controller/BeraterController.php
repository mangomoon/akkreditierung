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
 * BeraterController
 */
class BeraterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * beraterRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\BeraterRepository
     */
    protected $beraterRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\BeraterRepository $beraterRepository
     */
    public function injectBeraterRepository(\GeorgRinger\Ieb\Domain\Repository\BeraterRepository $beraterRepository)
    {
        $this->beraterRepository = $beraterRepository;
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $beraters = $this->beraterRepository->findAll();
        $this->view->assign('beraters', $beraters);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Berater $berater): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('berater', $berater);
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
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $newBerater
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Berater $newBerater)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->beraterRepository->add($newBerater);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("berater")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Berater $berater): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('berater', $berater);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Berater $berater)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->beraterRepository->update($berater);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Berater $berater
     */
    public function deleteAction(\GeorgRinger\Ieb\Domain\Model\Berater $berater)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->beraterRepository->remove($berater);
        $this->redirect('list');
    }
}
