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
 * AngebotVerantwortlichController
 */
class AngebotVerantwortlichController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * angebotVerantwortlichRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository
     */
    protected $angebotVerantwortlichRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository $angebotVerantwortlichRepository
     */
    public function injectAngebotVerantwortlichRepository(\GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository $angebotVerantwortlichRepository)
    {
        $this->angebotVerantwortlichRepository = $angebotVerantwortlichRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $angebotVerantwortliches = $this->angebotVerantwortlichRepository->findAll();
        $this->view->assign('angebotVerantwortliches', $angebotVerantwortliches);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('angebotVerantwortlich', $angebotVerantwortlich);
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
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $newAngebotVerantwortlich
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $newAngebotVerantwortlich)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->angebotVerantwortlichRepository->add($newAngebotVerantwortlich);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("angebotVerantwortlich")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('angebotVerantwortlich', $angebotVerantwortlich);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich $angebotVerantwortlich)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->angebotVerantwortlichRepository->update($angebotVerantwortlich);
        $this->redirect('list');
    }
}
