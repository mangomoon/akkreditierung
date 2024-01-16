<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Dto\ExternalViewFilter;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use GeorgRinger\Ieb\ExtensionConfiguration;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ExternalViewController extends BaseController
{

    private AnsuchenRepository $ansuchenRepository;
    protected ExtensionConfiguration $extensionConfiguration;

    public function indexAction(): ResponseInterface
    {
        $externalViewFilter = new ExternalViewFilter();
        $bundeslandGroupIds = $this->extensionConfiguration->getBundeslandUserGroups();
        $userGroupsOfCurrentUser = self::getCurrentUserGroups();

        foreach ($bundeslandGroupIds as $bundesland => $userGroupId) {
            if (in_array($userGroupId, $userGroupsOfCurrentUser, true)) {
                $externalViewFilter->bundesland = BundeslandEnum::tryFrom($bundesland);
            }
        }

        $this->view->assignMultiple([
            'ansuchen' => $this->ansuchenRepository->getAllForExternalView($externalViewFilter),
        ]);
        return $this->htmlResponse();
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }
}