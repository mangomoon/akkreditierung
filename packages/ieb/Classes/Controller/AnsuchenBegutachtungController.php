<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository;
use Psr\Http\Message\ResponseInterface;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class AnsuchenBegutachtungController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;

    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository)
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }


    public function listAction(): ResponseInterface
    {
        $ansuchen = $this->ansuchenRepository->getAllForBegutachtung();
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }


    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }
    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function editAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }


    public function updateAction(Ansuchen $ansuchen)
    {
        $this->ansuchenRepository->update($ansuchen);
        $this->redirect('list');
    }
}