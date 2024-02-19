<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\ReportingFilter;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use GeorgRinger\Ieb\ExtensionConfiguration;
use League\Csv;
use League\Csv\CharsetConverter;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ReportingController extends ActionController
{
    use CurrentUserTrait;

    private ReportingRepository $reportingRepository;
    protected ExtensionConfiguration $extensionConfiguration;

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
            $csvContent = $this->generateCsv($items, $fields);
            $this->csvResponse($csvContent, 'Organisationen-ohne-Ansuchen.csv');
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
                    'nummer' => 'Nummer',
                    'name' => 'Name',
                    'status' => 'Status',
                ];
                $csvContent = $this->generateCsv($items, $fields);
                $filename = date("Ymd") . '_IEB-Data.csv';
                $this->csvResponse($csvContent, $filename);
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
        //DebuggerUtility::var_dump($items);
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
                $csvContent = $this->generateCsv($items, $fields);
                $filename = date("Ymd") . '_ansuchen.csv';
                $this->csvResponse($csvContent, $filename);
            }
        }
        $this->view->assignMultiple([
            'dateRanges' => $availableDateRanges,
            'selected' => $selected,
            'items' => $items,
        ]);


        return $this->htmlResponse();
    }

    protected function csvResponse(string $result, string $filename)
    {
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: text/csv');
        header('Content-Length: ' . strlen($result));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        echo $result;
        exit;
    }

    protected function generateCsv(array $rows, array $fieldlist): string
    {
        $encoder = (new CharsetConverter())
            ->inputEncoding('utf-8')
            ->outputEncoding('iso-8859-15')
        ;
        $csv = Csv\Writer::createFromString();
        $csv->addFormatter($encoder);
        $csv->insertOne(array_values($fieldlist));
        $allowedKeys = array_keys($fieldlist);
        $csv->setDelimiter(";");
        foreach ($rows as $row) {
            $limitedSet = array_intersect_key($row, array_flip($allowedKeys));
            $csv->insertOne($limitedSet);
        }

        return $csv->toString();
    }

    private function isPartOfGs(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupGs(), self::getCurrentUserGroups(), true);
    }


    public function initializeAction()
    {
        $this->extensionConfiguration = new ExtensionConfiguration();
    }

    public function injectReportingRepository(ReportingRepository $reportingRepository): void
    {
        $this->reportingRepository = $reportingRepository;
    }
}