<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Domain\Repository\StammdatenRepository;
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
class StammdatenController extends BaseController
{


    protected StammdatenRepository $stammdatenRepository;

    public function injectStammdatenRepository(StammdatenRepository $stammdatenRepository)
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Stammdaten $newStammdaten)
    {
        $this->stammdatenRepository->add($newStammdaten);
        $this->redirect('index');
    }

    public function editAction(Stammdaten $stammdaten): ResponseInterface
    {
        $this->check($stammdaten);
        $this->stammdatenRepository->setLockedAndPersist($stammdaten);

        $this->view->assign('stammdaten', $stammdaten);
        return $this->htmlResponse();
    }

    public function updateAction(Stammdaten $stammdaten): ResponseInterface
    {
        $this->check($stammdaten);
        $this->stammdatenRepository->update($stammdaten);
        $this->addFlashMessage('Wurde erfolgreich gespeichert');
        $this->redirect('index');
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'item' => $this->stammdatenRepository->getLatest(),
        ]);
        return $this->htmlResponse();
    }



}
