<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\ExternalViewFilter;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchiveRepository;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepositoryTrait;
use GeorgRinger\Ieb\Domain\Repository\ReportingRepository;
use GeorgRinger\Ieb\ExtensionConfiguration;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ExternalViewController extends BaseController
{

    use AnsuchenRepositoryTrait;
    private AnsuchenRepository $ansuchenRepository;
    private AnsuchenArchiveRepository $ansuchenArchiveRepository;
    private ReportingRepository $reportingRepository;
    protected ExtensionConfiguration $extensionConfiguration;

    public function indexAction(ExternalViewFilter $filter = null): ResponseInterface
    {
        if ($filter === null) {
            $filter = new ExternalViewFilter();
        }
        $bundeslandGroupIds = $this->extensionConfiguration->getBundeslandUserGroups();
        $userGroupsOfCurrentUser = self::getCurrentUserGroups();

        foreach ($bundeslandGroupIds as $bundesland => $userGroupId) {
            if (in_array($userGroupId, $userGroupsOfCurrentUser, true)) {
                $filter->bundesland = BundeslandEnum::tryFrom($bundesland);
            }
        }

        $items = $this->ansuchenRepository->getAllForExternalView($filter);
        $items = $this->switchToParentVersion($items);

        $this->view->assignMultiple([
            'ansuchen' => $items,
            'filter' => $filter,
            'options' => $this->getOptions(),
        ]);
        return $this->htmlResponse();
    }

    protected function getOptions(): array
    {
        $options = [
            'tr' => $this->reportingRepository->getAllTraegerNames(),
            'status' => array_column(AnsuchenStatus::cases(), 'name', 'value'),
        ];

        return $options;
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }


    public function injectReportingRepository(ReportingRepository $reportingRepository): void
    {
        $this->reportingRepository = $reportingRepository;
    }

}