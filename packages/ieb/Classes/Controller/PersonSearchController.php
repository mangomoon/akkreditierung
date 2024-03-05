<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PersonSearchController extends ActionController
{

    protected TrainerRepository $trainerRepository;
    protected BeraterRepository $beraterRepository;
    protected AngebotVerantwortlichRepository $angebotVerantwortlichRepository;
    protected ReportingRepository $reportingRepository;

    public function indexAction(PersonSearch $search = null): ResponseInterface
    {
        if ($search === null) {
            $search = new PersonSearch();
        }

        

        $this->view->assignMultiple([
            'search' => $search,
            'trainer' => $this->trainerRepository->findInPersonSearch($search),
            'berater' => $this->beraterRepository->findInPersonSearch($search),
            'angebotverantwortlich' => $this->angebotVerantwortlichRepository->findInPersonSearch($search),
            //'tr' => $this->reportingRepository->getAllTraegerNames(),
        ]);
        return $this->htmlResponse();
    }

    public function injectTrainerRepository(TrainerRepository $trainerRepository): void
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function injectBeraterRepository(BeraterRepository $beraterRepository): void
    {
        $this->beraterRepository = $beraterRepository;
    }

    public function injectAngebotVerantwortlichRepository(AngebotVerantwortlichRepository $angebotVerantwortlichRepository): void
    {
        $this->angebotVerantwortlichRepository = $angebotVerantwortlichRepository;
    }

    public function injectReportingRepository(ReportingRepository $reportingRepository): void
    {
        $this->reportingRepository = $reportingRepository;
    }
}