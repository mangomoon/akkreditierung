<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\AnsuchenArchivFilter;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchivRepository;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SimplePagination;

class AnsuchenArchivController extends BaseController
{

    protected AnsuchenArchivRepository $ansuchenArchivRepository;
    protected ReportingRepository $reportingRepository;

    public function indexAction(AnsuchenArchivFilter $filter = null): ResponseInterface
    {
        if ($filter === null) {
            $filter = new AnsuchenArchivFilter();
        }

        $items = $filter->submitted ? $this->ansuchenArchivRepository->findByFilter($filter) : [];

        $paginator = $this->getPaginator($items);
        $pagination = new SimplePagination($paginator);

        $this->view->assignMultiple([
            'items' => $items,
            'filter' => $filter,
            'pagination' => [
                'paginator' => $paginator,
                'pagination' => $pagination,
            ],
            'options' => $this->getOptions(),
        ]);
        return $this->htmlResponse();
    }

    protected function getOptions(): array
    {
        $options = [
            'tr' => $this->reportingRepository->getAllTraegerNames(),
            'status' => array_column(AnsuchenStatus::cases(), 'name', 'value'),
            'bundesland' => array_column(BundeslandEnum::cases(), 'name', 'value'),
        ];

        return $options;
    }

    public function injectAnsuchenArchivRepository(AnsuchenArchivRepository $ansuchenArchivRepository): void
    {
        $this->ansuchenArchivRepository = $ansuchenArchivRepository;
    }

    public function injectReportingRepository(ReportingRepository $reportingRepository): void
    {
        $this->reportingRepository = $reportingRepository;
    }
}