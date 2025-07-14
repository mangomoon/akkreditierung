<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchivRepository;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use Psr\Http\Message\ResponseInterface;

class EsfController extends BaseController
{

    use CurrentUserTrait;

    protected AnsuchenRepository $ansuchenRepository;
    protected AnsuchenArchivRepository $ansuchenArchivRepository;

    public function indexAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs()) {
            $this->collectSingleViewDataForGs($ansuchen);
            return $this->htmlResponse();
        } else {
            $this->check($ansuchen);
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        }
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->collectSingleViewData($ansuchen);
        return $this->htmlResponse();
    }

    public function pdfAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs()) {
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        } else {
            $this->check($ansuchen);
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        }
    }
    
    public function pdfgsAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs()) {
            $this->collectSingleViewDataForGs($ansuchen);
            return $this->htmlResponse();
        } 
    }

    private function collectSingleViewData(Ansuchen $ansuchen): void
    {
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'versions' => $this->ansuchenRepository->getAllEsfVersionsOfAnsuchen($ansuchen),
        ]);
    }


    private function isPartOfGs(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupGs(), self::getCurrentUserGroups(), true);
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectAnsuchenArchivRepository(AnsuchenArchivRepository $ansuchenArchivRepository): void
    {
        $this->ansuchenArchivRepository = $ansuchenArchivRepository;
    }



}