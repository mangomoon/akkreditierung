<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\ReportingFilter;
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

    public function gutachtenStatistikAction(string $selected = '', int $csv = 0): ResponseInterface
    {
        $availableDateRanges = $this->reportingRepository->getDateLogUsage();
        $items = null;
        if ($selected && isset($availableDateRanges[$selected])) {
            $split = GeneralUtility::intExplode('-', $selected);
            $items = $this->reportingRepository->getDateLog($split[0], $split[1]);
            if ($csv && !empty($items)) {
                $fields = [
                    'name' => 'Name',
                    'nummer' => 'Nummer',
                ];
                $csvContent = $this->csvService->generateCsv($items, $fields);
                $filename = date("Ymd") . '_ansuchen.csv';
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
        $filter->statusList = AnsuchenStatus::statusSichtbarDurchGs();
        $raws = $this->reportingRepository->getByFilter($filter);
        $out = [];

        foreach ($raws as $raw) {
            // raw
            $item = [];
            foreach (['uid', 'nummer', 'name'] as $value) {
                $item[$value] = $raw[$value];
            }
            try {
                $item['status'] = AnsuchenStatus::tryFrom($raw['status'])->name;
            } catch (\Exception $e) {
                $item['status'] = 'unknown_' . $raw['status'];
            }
            try {
                $item['bundesland'] = BundeslandEnum::tryFrom($raw['bundesland'])->name;
            } catch (\Exception $e) {
                $item['bundesland'] = 'uknown ' . $raw['bundesland'];
            }
            $item['typ'] = match ($raw['typ']) {
                1 => 'BaBi',
                2 => 'PSA',
                default => 'unknown_' . $raw['typ'],
            };

            // boolean
            foreach (['kinderbetreuung', 'einzelunterricht', 'pp3', 'fernlehre', 'pruefbescheid_check'] as $value) {
                $item[$value] = $raw[$value] ? 'ja' : 'nein';
            }

            // kompetenzen
            for ($i = 1; $i <= 10; $i++) {
                $item['kompetenz' . $i] = '';
            }
            if ($raw['typ'] === 1) {
                for ($i = 1; $i <= 5; $i++) {
                    $item['kompetenz' . $i] = $raw['kompetenz' . $i];
                }
            } elseif ($raw['typ'] === 2) {
                for ($i = 6; $i <= 10; $i++) {
                    $item['kompetenz' . $i] = $raw['kompetenz' . ($i - 5)];
                }
            }
            $item['kompetenz_text'] = $raw['kompetenz_text1'];

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

            // date as date
            foreach (['akkreditierung_datum'] as $value) {
                if ($raw[$value]) {
                    $date = strtotime($raw[$value]);
                    $item[$value] = $date ? date('d.m.Y', $date) : '';
                } else {
                    $item[$value] = '';
                }
            }
            // date as timestamp
            foreach (['review_frist_pruefbescheid'] as $value) {
                $item[$value] = $raw[$value] ? date('d.m.Y', $raw[$value]) : '';
            }

            $item['einreich_datum'] = '';
            $item['ende'] = '31.12.2028';
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

            // gutachter
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

            // verantwortliche
            foreach (['verantwortliche', 'verantwortliche_mail'] as $verantwortliche) {
                $item[$verantwortliche] = '';

                $mm = $verantwortliche === 'verantwortliche_mail' ? 'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm' : 'tx_ieb_ansuchen_angebotverantwortlich_mm';
                $users = $this->reportingRepository->getVerantwortliche($raw['uid'], $mm);
                if ($users) {
                    $userList = [];
                    foreach ($users as $user) {
                        $userList[] = sprintf('%s %s [%s] %s', $user['vorname'], $user['nachname'], $user['email'], $user['ok'] ? 'ok' : '');
                    }
                    $item[$verantwortliche] = implode('|', $userList);
                }
            }

            //stammdaten
            $item['markenname'] = '';
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

            $out[] = $item;
        }

//        print_r($out);die;
        $csvContent = $this->csvService->generateDirect($out, array_keys($out[0]));
        $this->csvService->response($csvContent, 'IEB-Data.csv');
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