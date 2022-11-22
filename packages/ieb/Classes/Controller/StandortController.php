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
 * StandortController
 */
class StandortController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * standortRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\StandortRepository
     */
    protected $standortRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\StandortRepository $standortRepository
     */
    public function injectStandortRepository(\GeorgRinger\Ieb\Domain\Repository\StandortRepository $standortRepository)
    {
        $this->standortRepository = $standortRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $standorts = $this->standortRepository->findAll();
        $this->view->assign('standorts', $standorts);
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
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $newStandort
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Standort $newStandort)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->add($newStandort);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standort
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("standort")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Standort $standort): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('standort', $standort);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standort
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Standort $standort)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->update($standort);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standort
     */
    public function deleteAction(\GeorgRinger\Ieb\Domain\Model\Standort $standort)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->remove($standort);
        $this->redirect('list');
    }
}
