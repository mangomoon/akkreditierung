<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich;
use GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository;
use GeorgRinger\Ieb\Event\AngebotVerantwortlichArchiveEvent;
use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */

/**
 * AngebotVerantwortlichController
 */
//class AngebotVerantwortlichController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
class AngebotVerantwortlichController extends BaseController
{

    /**
     * angebotVerantwortlichRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository
     */
    // protected $angebotVerantwortlichRepository = null;

    protected AngebotVerantwortlichRepository $angebotVerantwortlichRepository;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository $angebotVerantwortlichRepository
     */
    public function injectAngebotVerantwortlichRepository(AngebotVerantwortlichRepository $angebotVerantwortlichRepository)
    {
        $this->angebotVerantwortlichRepository = $angebotVerantwortlichRepository;
    }

    /**
     * action index
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        $angebotVerantwortliches = $this->angebotVerantwortlichRepository->getAllSorted('nachname');
        $this->view->assign('angebotVerantwortliches', $angebotVerantwortliches);
        return $this->htmlResponse();
    }

    public function listAction(): ResponseInterface
    {
        $angebotVerantwortliches = $this->angebotVerantwortlichRepository->getAll();
        $this->view->assign('angebotVerantwortliches', $angebotVerantwortliches);
        return $this->htmlResponse();
    }

    /**
     * @param AngebotVerantwortlich $angebotVerantwortlich
     */
    public function showAction(AngebotVerantwortlich $angebotVerantwortlich): ResponseInterface
    {
        $this->view->assign('angebotVerantwortlich', $angebotVerantwortlich);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newAngebotVerantwortlich');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('angebotVerantwortlich');
    }

    /**
     * action create
     *
     * @param AngebotVerantwortlich $newAngebotVerantwortlich
     */
    public function createAction(AngebotVerantwortlich $newAngebotVerantwortlich)
    {
        $this->angebotVerantwortlichRepository->add($newAngebotVerantwortlich);
        $this->redirect('index');
    }

    /**
     * action edit
     *
     * @param AngebotVerantwortlich $angebotVerantwortlich
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("angebotVerantwortlich")
     */
    public function editAction(AngebotVerantwortlich $angebotVerantwortlich): ResponseInterface
    {
        $this->check($angebotVerantwortlich);
        $this->view->assign('angebotVerantwortlich', $angebotVerantwortlich);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param AngebotVerantwortlich $angebotVerantwortlich
     */
    public function updateAction(AngebotVerantwortlich $angebotVerantwortlich, array $fileDelete = []): ResponseInterface
    {
        $this->check($angebotVerantwortlich);
        $this->deleteFiles($fileDelete, $angebotVerantwortlich);
        $this->angebotVerantwortlichRepository->update($angebotVerantwortlich);
        $this->redirect('index');
    }


    /**
     * action archive
     *
     * @param AngebotVerantwortlich $angebotVerantwortlich
     */
    public function archiveAction(AngebotVerantwortlich $angebotVerantwortlich): ResponseInterface
    {
        $this->check($angebotVerantwortlich);
        $angebotVerantwortlich->setArchiviert(true);
        $this->angebotVerantwortlichRepository->update($angebotVerantwortlich);
        $this->eventDispatcher->dispatch(new AngebotVerantwortlichArchiveEvent($angebotVerantwortlich));

        $this->redirect('index');
    }

    /**
     * action revive
     *
     * @param AngebotVerantwortlich $angebotVerantwortlich
     */
    public function reviveAction(AngebotVerantwortlich $angebotVerantwortlich): ResponseInterface
    {
        $this->check($angebotVerantwortlich);
        $angebotVerantwortlich->setArchiviert(false);
        $this->angebotVerantwortlichRepository->update($angebotVerantwortlich);

        $this->redirect('index');
    }


}
