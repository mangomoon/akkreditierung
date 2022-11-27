<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class AnsuchenController extends BaseController
{

    protected AnsuchenRepository $ansuchenRepository;

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository)
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function listAction(): ResponseInterface
    {
        $ansuchen = $this->ansuchenRepository->getAll();
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Ansuchen $newAnsuchen)
    {
        $this->ansuchenRepository->add($newAnsuchen);
        $this->redirect('list');
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function editAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }


    public function updateAction(Ansuchen $ansuchen)
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->update($ansuchen);
        $this->redirect('list');
    }

    public function deleteAction(Ansuchen $ansuchen)
    {
        $this->check($ansuchen);
        $this->ansuchenRepository->remove($ansuchen);
        $this->redirect('list');
    }
}
