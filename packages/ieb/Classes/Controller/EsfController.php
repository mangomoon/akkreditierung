<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use Psr\Http\Message\ResponseInterface;

class EsfController extends BaseController
{

    protected AnsuchenRepository $ansuchenRepository;

    public function indexAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'ansuchen' => $this->ansuchenRepository->getAllAkkreditiert(),
        ]);
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->collectSingleViewData($ansuchen);
        return $this->htmlResponse();
    }

    public function pdfAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->collectSingleViewData($ansuchen);
        return $this->htmlResponse();
    }

    private function collectSingleViewData(Ansuchen $ansuchen): void
    {
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'versions' => $this->ansuchenRepository->getAllEsfVersonsOfAnsuchen($ansuchen),
        ]);
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }
}