<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use GeorgRinger\Ieb\Service\CsvService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class PersonSearchController extends ActionController
{

    protected TrainerRepository $trainerRepository;
    protected BeraterRepository $beraterRepository;
    protected AngebotVerantwortlichRepository $angebotVerantwortlichRepository;
    protected ReportingRepository $reportingRepository;
    protected CsvService $csvService;

    public function indexAction(PersonSearch $search = null): ResponseInterface
    {
        if ($search === null) {
            $search = new PersonSearch();
        }

        $this->view->assignMultiple([
            'search' => $search,
            //'tr' => $this->reportingRepository->getAllTraegerNames(),
        ]);

        if ($search->isUsed()) {
            $this->view->assignMultiple([
                'trainer' => $this->trainerRepository->findInPersonSearch($search),
                'berater' => $this->beraterRepository->findInPersonSearch($search),
                'angebotverantwortlich' => $this->angebotVerantwortlichRepository->findInPersonSearch($search),
            ]);
        }
        return $this->htmlResponse();
    }

    public function csvAction()
    {
        $search = new PersonSearch();
        $search->respectStatus = false;

        $csv = [];
        foreach ($this->trainerRepository->findInPersonSearch($search) as $row) {
            $line = [
                'funktion' => 'Trainer',
                'nachname' => $row['nachname'],
                'vorname' => $row['vorname'],
                'ansuchen' => $row['ansuchenNummer'],
            ];

            $csv[] = $line;
        }
        foreach ($this->beraterRepository->findInPersonSearch($search) as $row) {
            $line = [
                'funktion' => 'Berater',
                'nachname' => $row['nachname'],
                'vorname' => $row['vorname'],
                'ansuchen' => $row['ansuchenNummer'],
            ];

            $csv[] = $line;
        }
        foreach ($this->angebotVerantwortlichRepository->findInPersonSearch($search) as $row) {
            $line = [
                'funktion' => 'Projektleitung',
                'nachname' => $row['nachname'],
                'vorname' => $row['vorname'],
                'ansuchen' => $row['ansuchenNummer'],
            ];
            $csv[] = $line;
        }


        $csvContent = $this->csvService->generateDirect($csv, array_keys($csv[0]));
        $this->csvService->response($csvContent, 'personen.csv');
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

    public function initializeAction()
    {
        $this->csvService = new CsvService();
    }
}