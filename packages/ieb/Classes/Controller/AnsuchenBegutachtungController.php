<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Repository;
use GeorgRinger\Ieb\Service\DiffService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


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
    protected Repository\AngebotVerantwortlichRepository $angebotVerantwortlichRepository;


    public function listAction(): ResponseInterface
    {
        $this->view->assign('ansuchen', $this->ansuchenRepository->getAllForBegutachtung());
        return $this->htmlResponse();
    }

    public function showAction(Ansuchen $ansuchen, int $diffWithAlternativeId = 0): ResponseInterface
    {
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $begutachtung = new Dto\Begutachtung\BasisBegutachtung();
        $possibleStatus = [];
        foreach (AnsuchenStatus::statusSetzbarDurchGs() as $status) {
            $possibleStatus[$status] = $this->translate('ansuchen.status.' . $status, (string)$status) . ' [' . $status . ']';
        };
        $begutachtung->setByAnsuchen($ansuchen, $stammdaten);


        $diffResult = (new DiffService())->generateDiff($ansuchen->getUid(), $diffWithAlternativeId ?: $ansuchen->getVersionBasedOn());
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
            'possibleStatus' => $possibleStatus,
            'diffWithAlternativeId' => $diffWithAlternativeId,
            'versions' => $this->ansuchenRepository->getAllPreviousVersions($ansuchen->getUid()),
            'diff' => $diffResult,
            'angebotVerantwortlicheLive' => $this->getAllVerantwortliche($ansuchen->getPid()),
//            'diffAsJson' => sprintf('<script>var ansuchenDiff = %s;</script>', json_encode($diffResult, JSON_UNESCAPED_UNICODE)),
            'stammdaten' => $stammdaten,
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

    public function updateAction(Ansuchen $ansuchen, Dto\Begutachtung\BasisBegutachtung $begutachtung, array $verantwortliche = []): void
    {
        $begutachtung->verantwortliche = $verantwortliche;
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $begutachtung->copyToAnsuchen($ansuchen);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $begutachtung->copyToStammdaten($stammdaten);
        $this->stammdatenRepository->update($stammdaten);
        $this->stammdatenRepository->forcePersist();
        foreach ($verantwortliche as $id => $params) {
            /** @var AngebotVerantwortlich $verantwortlich */
            $verantwortlich = $this->angebotVerantwortlichRepository->getByIdAndPid($id, $ansuchen->getPid());
            if ($verantwortlich) {
                if (isset($params['babi'])) {
                    $verantwortlich->setReviewC1Babi((bool)$params['babi']);
                }
                if (isset($params['psa'])) {
                    $verantwortlich->setReviewC1Psa((bool)$params['psa']);
                }
                $this->angebotVerantwortlichRepository->update($verantwortlich);
            }
        }
        $this->angebotVerantwortlichRepository->forcePersist();
        $this->addFlashMessage('Ansuchen wurde ergänzt');

        // if status changes, no need to stay in record show
        if ($begutachtung->status > 0) {
            $this->ansuchenRepository->createNewSnapshot($ansuchen, $stammdaten);
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

    protected function getAllVerantwortliche(int $pid): array
    {
        $items = [];
        foreach ($this->angebotVerantwortlichRepository->getActive($pid) as $item) {
            $items[$item->getUid()] = $item;
        }
        return $items;
    }

    public function finalizestatusAction(Ansuchen $ansuchen): ResponseInterface
    {
        $ansuchen->setStatus($ansuchen->getUpcomingStatus());
        $ansuchen->setUpcomingStatus(0);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->ansuchenRepository->createNewSnapshot($ansuchen, $this->stammdatenRepository->getLatestByPid($ansuchen->getPid()));
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

    public function injectAngebotVerantwortlicheRepository(Repository\AngebotVerantwortlichRepository $repository): void
    {
        $this->angebotVerantwortlichRepository = $repository;
    }

}