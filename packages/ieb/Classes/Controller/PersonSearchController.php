<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use GeorgRinger\Ieb\Domain\Repository\AngebotVerantwortlichRepository;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\CsvService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PersonSearchController extends ActionController
{
    use CurrentUserTrait;

    protected TrainerRepository $trainerRepository;
    protected BeraterRepository $beraterRepository;
    protected AngebotVerantwortlichRepository $angebotVerantwortlichRepository;
    protected ExtensionConfiguration $extensionConfiguration;
    protected ReportingRepository $reportingRepository;
    protected CsvService $csvService;

    public function indexAction(PersonSearch $search = null): ResponseInterface
    {
        if ($search === null) {
            $search = new PersonSearch();
        }
        if (!$this->isPartOfGs()) {
            $search->trPid = self::getCurrentUserPid();
        }
        $this->view->assignMultiple([
            'search' => $search,
            'tr' => $this->reportingRepository->getAllTraegerNames(),
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


        if (!$this->isPartOfGs()) {
            $search->trPid = self::getCurrentUserPid();
        }

        $csv = [];
        foreach ($this->trainerRepository->findInPersonSearchActive($search) as $row) {

            $pp = substr($row['ansuchenNummer'], 0, 1);
            
            if ($row['ansuchenTyp'] == 1) {
                $typ = "BaBi";
                $frist = $row['review_frist'];
            } else {
                $typ = "PSA";
                $frist = $row['review_psa_frist'];
            }
            if ($frist) {
                $frist = $frist ? date('d.m.Y', $frist) : '';
            } else {
                $frist = "nein";
            }
            $line = [
                'funktion' => 'Trainer',
                'vorname' => $row['vorname'],
                'nachname' => $row['nachname'],
                'typ' => $typ,
                'ansuchen' => $row['ansuchenNummer'],
                'bezeichnung' => $row['ansuchenName'],
                'traeger' => $row['stammdatenName'],
                'pp3' => $pp,
                'Frist' => $frist,
            ];
                $csv[] = $line;
            
            
        }
        foreach ($this->beraterRepository->findInPersonSearchActive($search) as $row) {

            $pp = substr($row['ansuchenNummer'], 0, 1);
            if ($row['ansuchenTyp'] == 1) {
                $typ = "BaBi";
            } else {
                $typ = "PSA";
            }
            $frist = $row['review_frist'];
            if ($frist) {
                $frist = $frist ? date('d.m.Y', $frist) : '';
            } else {
                $frist = "nein";
            }
            $line = [
                'funktion' => 'Berater',
                'vorname' => $row['vorname'],
                'nachname' => $row['nachname'],
                'typ' => $typ,
                'ansuchen' => $row['ansuchenNummer'],
                'bezeichnung' => $row['ansuchenName'],
                'traeger' => $row['stammdatenName'],
                'pp3' => $pp,
                'Frist' => $frist,
            ];

            $csv[] = $line;
        
        }
        foreach ($this->angebotVerantwortlichRepository->findInPersonSearchActive($search) as $row) {
            $pp = substr($row['ansuchenNummer'], 0, 1);
            if ($row['ansuchenTyp'] == 1) {
                $typ = "BaBi";
            } else {
                $typ = "PSA";
            }
            $line = [
                'funktion' => 'Projektleitung',
                'vorname' => $row['vorname'],
                'nachname' => $row['nachname'],
                'typ' => $typ,
                'ansuchen' => $row['ansuchenNummer'],
                'bezeichnung' => $row['ansuchenName'],
                'traeger' => $row['stammdatenName'],
                'pp3' => $pp,

            ];
            $csv[] = $line;
        }

        $firstrow = ["Funktion", "Vorname","Nachname", "Bereich", "Ansuchennummer", "Bezeichnung", "Träger", "PP", "Auflage"];

        $csvname = date('Y-m-d') . "-Personen.csv";

        $csvContent = $this->csvService->generateDirect($csv, $firstrow);
        $this->csvService->response($csvContent, $csvname);
    }

    private function isPartOfGs(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupGs(), self::getCurrentUserGroups(), true);
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
        $this->extensionConfiguration = new ExtensionConfiguration();
        $this->csvService = new CsvService();
    }
}