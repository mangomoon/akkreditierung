<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BeraterController extends BaseController
{

    protected BeraterRepository $beraterRepository;

    public function injectBeraterRepository(BeraterRepository $BeraterRepository)
    {
        $this->beraterRepository = $BeraterRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('beraters', $this->beraterRepository->getAll());
        return $this->htmlResponse();
    }

    public function showAction(Trainer $trainer): ResponseInterface
    {
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Berater $newBerater)
    {
        $this->beraterRepository->add($newBerater);
        $this->redirect('index');
    }

    public function editAction(Berater $berater): ResponseInterface
    {
        $this->check($berater);
        $this->view->assign('berater', $berater);
        return $this->htmlResponse();
    }

    public function updateAction(Berater $berater)
    {
        $this->check($berater);
        $this->beraterRepository->update($berater);
        $this->redirect('index');
    }

    public function deleteAction(Berater $berater)
    {
        $this->check($berater);
        $this->beraterRepository->remove($berater);
        $this->redirect('index');
    }
}
