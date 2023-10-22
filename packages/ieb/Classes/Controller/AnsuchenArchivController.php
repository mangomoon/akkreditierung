<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Dto\AnsuchenArchivFilter;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchivRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SimplePagination;

class AnsuchenArchivController extends BaseController
{

    protected AnsuchenArchivRepository $ansuchenArchivRepository;

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
        ]);
        return $this->htmlResponse();
    }

    public function injectAnsuchenArchivRepository(AnsuchenArchivRepository $ansuchenArchivRepository): void
    {
        $this->ansuchenArchivRepository = $ansuchenArchivRepository;
    }

}