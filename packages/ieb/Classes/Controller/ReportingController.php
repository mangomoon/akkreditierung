<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\ReportingFilter;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepositoryTrait;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\CsvService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ReportingController extends ActionController
{
    use CurrentUserTrait;
    use AnsuchenRepositoryTrait;

    private ReportingRepository $reportingRepository;
    protected ExtensionConfiguration $extensionConfiguration;
    protected CsvService $csvService;
    protected array $relationCache = [];

    public function indexAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'userIsPartOfGs' => $this->isPartOfGs(),
        ]);
        return $this->htmlResponse();
    }

    public function noRequestAction(bool $csv = false): ResponseInterface
    {
        if (!$this->isPartOfGs()) {
            $this->addFlashMessage('Sie haben keine Berechtigung für diese Aktion.', '', AbstractMessage::ERROR);
            return $this->redirect('index');
        }
        $items = $this->reportingRepository->getTrWithNoAnsuchen();

        if ($csv && !empty($items)) {
            $fields = [
                'name' => 'Name',
                'strasse' => 'Strasse',
                'plz' => 'PLZ',
                'ort' => 'Ort',
                'telefon' => 'Telefon',
                'email' => 'E-Mail',
            ];
            $csvContent = $this->csvService->generateCsv($items, $fields);
            $this->csvService->response($csvContent, 'Organisationen-ohne-Ansuchen.csv');
        }
        $this->view->assign('items', $items);
        return $this->htmlResponse();
    }

    public function filterAction(ReportingFilter $reportingFilter = null): ResponseInterface
    {
        $items = [];
        if (is_null($reportingFilter)) {
            $reportingFilter = new ReportingFilter();
        }

        if (!$this->isPartOfGs()) {
            $reportingFilter->trPid = self::getCurrentUserPid();
        }

        if ($reportingFilter->submitted) {
            $items = $this->reportingRepository->getByFilter($reportingFilter);

            if ($reportingFilter->csv && !empty($items)) {
                $fields = [
                    'name' => 'Name',
                    'nummer' => 'Nummer',
                    'status' => 'Status',
                    'bundesland' => 'Bundesland',
                    'typ' => 'Programmbereich',
                ];
                $csvContent = $this->csvService->generateCsv($items, $fields);
                $filename = date("Ymd") . '_IEB-Data.csv';
                $this->csvService->response($csvContent, $filename);
            }
        }

        $this->view->assignMultiple([
            'items' => $items,
            'reportingFilter' => $reportingFilter,
            'userIsPartOfGs' => $this->isPartOfGs(),
            'filter' => [
                'bundesland' => array_column(BundeslandEnum::cases(), 'name', 'value'),
                'status' => array_column(AnsuchenStatus::cases(), 'name', 'value'),
                'tr' => $this->reportingRepository->getAllTraegerNames(),
            ],
        ]);

        return $this->htmlResponse();
    }

    public function dateLogAction(string $selected = ''): ResponseInterface
    {
        $availableDateRanges = $this->reportingRepository->getDateLogUsage();
        $items = null;
        if ($selected && isset($availableDateRanges[$selected])) {
            $split = GeneralUtility::intExplode('-', $selected);
            $items = $this->reportingRepository->getDateLog($split[0], $split[1]);
        }
        $this->view->assignMultiple([
            'dateRanges' => $availableDateRanges,
            'selected' => $selected,
            'items' => $items,
        ]);

        return $this->htmlResponse();
    }

    public function gutachtenStatistikAction(string $selected = '', bool $csv = true): ResponseInterface
    {
        $availableDateRanges = $this->reportingRepository->getDateLogUsage();
        $items = null;
        if ($selected && isset($availableDateRanges[$selected])) {
            $split = GeneralUtility::intExplode('-', $selected);
            $items = $this->reportingRepository->getDateLog($split[0], $split[1]);
            
            if ($csv && !empty($items)) {
                $fields = [
                    'zuteilung_datum' => 'Datum',
                    'nummer' => 'Ansuchen',
                    //'gutachter1' => 'als Gutachter 1',
                    'review_verrechnung_check1' => '€ für 1',
                    'review_verrechnung1' => 'Komm für 1',
                    //'gutachter2' => 'als Gutachter 2',
                    'review_verrechnung_check2' => '€ für 2',
                    'review_verrechnung2' => 'Komm für 2',
                    'version' => 'Version',
                    'pid' => 'Träger',
                    'review_incoming_status' => 'Status bei Zuteilung',
                ];
                $csvContent = $this->csvService->generateCsv($items, $fields);
                $filename = date("Ymd") . '_GutachterZuteilung.csv';
                $this->csvService->response($csvContent, $filename);
            }
        }
        $this->view->assignMultiple([
            'dateRanges' => $availableDateRanges,
            'selected' => $selected,
            'items' => $items,
        ]);


        return $this->htmlResponse();
    }

    public function fullCsvAction()
    {
        $filter = new ReportingFilter();
        $filter->aboveStatus = AnsuchenStatus::IN_ARBEIT->value;
        $raws = $this->reportingRepository->getByFilter($filter);
        $raws = $this->switchToParentVersion($raws);

        $out = [];

        foreach ($raws as $raw) {
            // raw

            // uid, Nr
            $item = [];
            foreach (['uid', 'nummer'] as $value) {
                $item[$value] = $raw[$value];
            }
            // Träger Name (siehe unten Stammdaten)
            $item['markenname'] = '';

            // Bundesland
            try {
                $item['bundesland'] = BundeslandEnum::tryFrom($raw['bundesland'])->name;
            } catch (\Exception $e) {
                $item['bundesland'] = 'uknown ' . $raw['bundesland'];
            }

            // Bereich
            $item['typ'] = match ($raw['typ']) {
                1 => 'BaBi',
                2 => 'PSA',
                default => 'unknown_' . $raw['typ'],
            };

            // Programmperiode
            $pp = substr($raw['nummer'], 0, 1);
            $item['pp3'] = $pp;


            // Akkkreditierungsstatus
            switch($raw['status']) {
                case 30:
                    $akkstatus = "Ersteinreichung";
                    break;
                case 40:
                    $akkstatus = "Ersteinreichung";
                    break;
                case 80:
                    $akkstatus = "Nachbesserungsauftrag";
                    break;
                case 85:
                    $akkstatus = "Nachbesserungsauftrag";
                    break;
                case 90:
                    $akkstatus = "Nachbesserungsauftrag";
                    break;
                case 100:
                    $akkstatus = "akkreditiert";
                    break;
                case 160:
                    $akkstatus = "akkreditiert";
                    break;
                case 170:
                    $akkstatus = "akkreditiert";
                    break;
                case 200:
                    $akkstatus = "akkreditiert";
                    break;
                case 210:
                    $akkstatus = "akkreditiert";
                    break;
                case 215:
                    $akkstatus = "akkreditiert";
                    break;
                case 140:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 150:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 155:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 220:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 230:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 235:
                    $akkstatus = "akkreditiert mit Auflage";
                    break;
                case 800:
                    $akkstatus = "nicht akkreditiert";
                    break;
                case 810:
                    $akkstatus = "Akkreditierung entzogen";
                    break;
                case 820:
                    $akkstatus = "Akkreditierung ausgesetzt";
                    break;
            }
            $item['akkstatus'] = $akkstatus;

            //Einreich-Status
            //...
            try {
                $item['status'] = AnsuchenStatus::tryFrom($raw['status'])->name;
            } catch (\Exception $e) {
                $item['status'] = 'unknown_' . $raw['status'];
            }
            
            // Datum Ersteinreichung
            //...
            $firstVersion = $this->reportingRepository->findAnsuchenByNummerAndVersion($raw['nummer'], 0);
            if ($firstVersion) {
                foreach (['einreich_datum'] as $firstVersionDate) {
                    if ($firstVersion[$firstVersionDate]) {
                        $date = strtotime($firstVersion[$firstVersionDate]);
                        $item[$firstVersionDate] = $date ? date('d.m.Y', $date) : '';
                    } else {
                        $item[$firstVersionDate] = '';
                    }
                }
            }

            // Datum Erstzuteilung
            //...
            $item['zuteilung_datum'] = '';
            $allVersions = [];
            $this->reportingRepository->getRecursiveAnsuchen($allVersions, $raw, 'uid,version,version_based_on,einreich_datum,zuteilung_datum');
            // oldest first, latest last
            $allVersions = array_reverse($allVersions);
            foreach ($allVersions as $version) {
                if ($version['zuteilung_datum']) {
                    $date = strtotime($version['zuteilung_datum']);
                    $item['zuteilung_datum'] = $date ? date('d.m.Y', $date) : '';
                    break;
                }
            }

            // Akkreditierungsdatum
            // date as date
            foreach (['akkreditierung_datum'] as $value) {
                if ($raw[$value]) {
                    $date = strtotime($raw[$value]);
                    $item[$value] = $date ? date('d.m.Y', $date) : '';
                } else {
                    $item[$value] = '';
                }
            }

            // Akkreditierungsdatum Ende
            $item['ende'] = '31.12.2028';

            // Gutachter 1 Erstzuteilung
            $item['gutachtereinserstzuteilung'] = '###';

            // Gutachter 2 Erstzuteilung
            $item['gutachterzweierstzuteilung'] = '###';

            // Gutachter 1 und 2 letzte Zuteilung
            foreach (['gutachter1', 'gutachter2'] as $gutachterId) {
                $item[$gutachterId] = '';
                if ($raw[$gutachterId] && !isset($this->relationCache['user'][$raw[$gutachterId]])) {
                    $userRow = BackendUtility::getRecord('fe_users', $raw[$gutachterId], '*', '', false);
                    if ($userRow) {
                        $this->relationCache['user'][$userRow['uid']] = $userRow['first_name'] . ' ' . $userRow['last_name'];
                    }
                }
                if ($this->relationCache['user'][$raw[$gutachterId]] ?? false) {
                    $item[$gutachterId] = $this->relationCache['user'][$raw[$gutachterId]];
                }
            }

            //$item['einreich_datum'] = '';

            
            // ### FRISTEN
            // date as timestamp
            foreach (['review_frist_pruefbescheid'] as $value) {
                $item[$value] = $raw[$value] ? date('d.m.Y', $raw[$value]) : '';
            }
            //stammdaten
            $item['review_oecert_frist'] = '';
            if (!isset($this->relationCache['stammdaten'][$raw['pid']])) {
                $this->relationCache['stammdaten'][$raw['pid']] = $this->reportingRepository->getLatestStammdaten($raw['pid']);
            }
            if ($this->relationCache['stammdaten'][$raw['pid']] ?? false) {
                $stammdaten = $this->relationCache['stammdaten'][$raw['pid']];
                $item['markenname'] = $stammdaten['markenname'] ?: $stammdaten['name'];
                $item['review_oecert_frist'] = $stammdaten['review_oecert_frist'] ? date('d.m.Y', $stammdaten['review_oecert_frist']) : '';
            }

            // all frists
            $frists = [];
            // trainer
            $trainer = $this->reportingRepository->getAllTrainer($raw['uid']);
            if ($trainer) {
                foreach ($trainer as $t) {
                    $frist = $raw['typ'] === 1 ? $t['review_frist'] : $t['review_psa_frist'];
                    if ($frist) {
                        $frists[$frist] = $t['vorname'] . ' ' . $t['nachname'];
                    }
                }
            }
            // berater
            $berater = $this->reportingRepository->getAllBerater($raw['uid']);
            if ($berater) {
                foreach ($berater as $b) {
                    if ($b['review_frist']) {
                        $frists[$b['review_frist']] = $b['vorname'] . ' ' . $b['nachname'];
                    }
                }

            }

            $item['nextFrist1'] = '';
            $item['nextFrist2'] = '';

            ksort($frists);
            if ($frists) {
                $firstKey = array_key_first($frists);
                $item['nextFrist1'] = date('d.m.Y', $firstKey);
                unset($frists[$firstKey]);

                $nextFrists = [];
                foreach ($frists as $key => $value) {
                    $nextFrists[] = date('d.m.Y', $key);
                }
                $item['nextFrist2'] = implode('|', $nextFrists);
            }

            //### FRISTEN ENDE


            // verantwortliche
            foreach (['verantwortliche', 'verantwortliche_mail'] as $verantwortliche) {
                $item['verantwortlich1'] = '';
                $item['verantwortlich2'] = '';

                $mm = $verantwortliche === 'verantwortliche_mail' ? 'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm' : 'tx_ieb_ansuchen_angebotverantwortlich_mm';
                $users = $this->reportingRepository->getVerantwortliche($raw['uid'], $mm);
                if ($users) {
                    //$userList = [];
                    $i=0;
                    foreach ($users as $user) {
                        $i++;
                        //$userList[] = sprintf('%s %s [%s] %s', $user['vorname'], $user['nachname'], $user['email'], $user['ok'] ? 'ok' : '');
                        $verantwortlichemail = $user['email'];
                        $verant = "verantwortlich".$i;
                        $item[$verant] = $verantwortlichemail;
                        
                    }
                }
            }

            // Prüfbescheid, Kinderbetreuung, Einzelunterricht, Fernlehre
            // boolean
            foreach (['pruefbescheid_check', 'kinderbetreuung', 'einzelunterricht', 'fernlehre'] as $value) {
                $item[$value] = $raw[$value] ? 'ja' : 'nein';
            }

            // Kompetenzen
            for ($i = 1; $i <= 9; $i++) {
                $item['kompetenz' . $i] = '';
            }
            if ($raw['typ'] === 1) {
                for ($i = 1; $i <= 5; $i++) {
                    $item['kompetenz' . $i] = $raw['kompetenz' . $i];
                }
            } elseif ($raw['typ'] === 2) {
                for ($i = 6; $i <= 9; $i++) {
                    $item['kompetenz' . $i] = $raw['kompetenz' . ($i - 5)];
                }
            }
            $item['kompetenz_text'] = $raw['kompetenz_text1'];

            
            // Bezeichnung
            $item['bezeichnung'] = $raw['name'];




            




            $out[] = $item;
        }

//        print_r($out);die;

        $firstrow = ["uid", "Nr", "Träger Name", "Bundesland", "Bereich", "Programmperiode","Akkreditierungs-Status","Einreich-Status","Datum Ersteinreichung","Datum Erstzuteilung","Akkreditierungsdatum", "Akkreditierungsdatum Ende","Gutachter 1 Erstzuteilung","Gutachter 2 Erstzuteilung","Gutachter 1 letzte Zuteilung","Gutachter 2 letzte Zuteilung","Nächste Frist","Frist Prüfbescheid", "Frist Ö-Cert","Weitere Fristen","Kontaktperson 1","Kontaktperson 2","Prüfbescheid","Kinderbetreuung", "Einzelunterricht", "Fernlehre","D Erstspr. (BaBi)", "D Zweitspr. (BaBi)", "M (BaBi)", "Digital (BaBi)", "E (BaBi)", "Kreativität (PSA)", "Gesundheit (PSA)", "Natur", "Weitere Sprache (PSA)", "Welche Sprache (PSA)","Bezeichnung"];

        $csvContent = $this->csvService->generateDirect($out, $firstrow);

        $csvname = date('Y-m-d') ."-Ansuchen.csv";
        $this->csvService->response($csvContent, $csvname);
    }

    private function isPartOfGs(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupGs(), self::getCurrentUserGroups(), true);
    }


    public function initializeAction()
    {
        $this->extensionConfiguration = new ExtensionConfiguration();
        $this->csvService = new CsvService();
    }

    public function injectReportingRepository(ReportingRepository $reportingRepository): void
    {
        $this->reportingRepository = $reportingRepository;
    }
}