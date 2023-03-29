<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Standort;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Domain\Repository\StandortRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

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
//class StandortController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
class StandortController extends BaseController
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
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standort
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Standort $standort): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('standort', $standort);
        return $this->htmlResponse();
    }


    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }


    public function createAction(Standort $newStandort)
    {
        $this->standortRepository->add($newStandort);
        $this->redirect('index');
    }

    public function editAction(Standort $standort): ResponseInterface
    {
        $this->check($standort);
        $this->standortRepository->setLockedAndPersist($standort);

        $this->view->assign('standort', $standort);
        return $this->htmlResponse();
    }

    public function updateAction(Standort $standort): ResponseInterface
    {
        $this->check($standort);
        $this->standortRepository->update($standort);
        //$this->addFlashMessage('Wurde erfolgreich gespeichert');
        $this->redirect('index');
    }

    public function indexAction(): ResponseInterface
    {
        $standorts = $this->standortRepository->getAll();
        $this->view->assign('standorts', $standorts);
        return $this->htmlResponse();
    }

    public function archiveAction(Standort $standort): ResponseInterface
    {
        $this->check($standort);
        $standort->setArchiviert(TRUE);
        $this->standortRepository->update($standort);
        
        $this->redirect('index');
    }
    public function reviveAction(Standort $standort): ResponseInterface
    {
        $this->check($standort);
        $standort->setArchiviert(FALSE);
        $this->standortRepository->update($standort);
        
        $this->redirect('index');
    }
}
