<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Repository;
use GeorgRinger\Ieb\Service\DiffService;
use Psr\Http\Message\ResponseInterface;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class AnsuchenBegutachtungController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;
    protected Repository\StammdatenRepository $stammdatenRepository;


    public function listAction(): ResponseInterface
    {
        $this->view->assign('ansuchen', $this->ansuchenRepository->getAllForBegutachtung());
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen, int $diffWithAlternativeId = 0): ResponseInterface
    {
        $begutachtung = new Dto\Begutachtung\BasisBegutachtung();
        $possibleStatus = [];
        foreach (AnsuchenStatus::statusSetzbarDurchGs() as $status) {
            $possibleStatus[$status] = $this->translate('ansuchen.status.' . $status, (string)$status) . ' [' . $status . ']';
        };
        $begutachtung->setByAnsuchen($ansuchen);
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
            'possibleStatus' => $possibleStatus,
            'diffWithAlternativeId' => $diffWithAlternativeId,
            'versions' => $this->ansuchenRepository->getAllPreviousVersions($ansuchen->getUid()),
            'diff' => (new DiffService())->generateDiff($ansuchen->getUid(), $diffWithAlternativeId ?: $ansuchen->getVersionBasedOn()),
        ]);
        return $this->htmlResponse();
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function editAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    public function updateAction(Ansuchen $ansuchen, Dto\Begutachtung\BasisBegutachtung $begutachtung): void
    {
        $begutachtung->copyToAnsuchen($ansuchen);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->addFlashMessage('Ansuchen wurde ergänzt');

        // if status changes, no need to stay in record show
        if ($begutachtung->status > 0) {
            $this->ansuchenRepository->createNewSnapshot($ansuchen, $this->stammdatenRepository->getLatestByPid($ansuchen->getPid()));
            $this->redirect('list');
        }
        $this->redirectTo($ansuchen->getUid());
    }

    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['save']) && $recordId > 0) {
            $this->redirect('show', null, null, ['ansuchen' => $recordId]);
        }
        if (isset($arguments['saveAndIndex'])) {
            $this->redirect('list');
        }
        $this->redirect('list');
    }

    public function finalizestatusAction(Ansuchen $ansuchen): ResponseInterface
    {
        $ansuchen->setStatus($ansuchen->getUpcomingStatus());
        $this->ansuchenRepository->update($ansuchen);
        $this->redirect('list');
        $this->addFlashMessage('Das Ansuchen wurde an der Träger geschickt');
    }


    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository)
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectStammdatenRepository(Repository\StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

}