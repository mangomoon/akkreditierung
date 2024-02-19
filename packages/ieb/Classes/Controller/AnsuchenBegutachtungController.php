<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository;
use GeorgRinger\Ieb\Service\DiffService;
use Psr\Http\Message\ResponseInterface;
use GeorgRinger\Ieb\Event;
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
    protected Repository\TextbausteineRepository $textbausteineRepository;
    protected Repository\UserRepository $userRepository;
    protected Repository\TrainerRepository $trainerRepository;
    protected Repository\BeraterRepository $beraterRepository;

    public function listAction(): ResponseInterface
    {
        if (in_array($this->extensionConfiguration->getUsergroupAg(), self::getCurrentUserGroups(), true)) {
            // $this->view->assign('ansuchen', $this->ansuchenRepository->getAllForAkkreditierungsGruppe(self::getCurrentUserId()));
            $this->view->assign('ansuchen', $this->ansuchenRepository->getAllForAkkreditierungsGruppe());
        } else {
            $this->view->assign('ansuchen', $this->ansuchenRepository->getAllForGs());
        }
        return $this->htmlResponse();
    }

    public function editAction(Ansuchen $ansuchen, int $diffWithAlternativeId = 0): ResponseInterface
    {
        $this->setTitleTag($ansuchen->getTitleTag());
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $begutachtung = new Dto\Begutachtung\BasisBegutachtung();
        $this->ansuchenRepository->setGutachterLockedAndPersist($ansuchen);
        $possibleStatus = [];
        foreach (AnsuchenStatus::statusSetzbarDurchGs() as $status) {
            $possibleStatus[$status] = $this->translate('ansuchen.status.' . $status, (string)$status) . ' [' . $status . ']';
        };
        $begutachtung->setByAnsuchen($ansuchen, $stammdaten);
        $diffCompareId = $diffWithAlternativeId ?: $ansuchen->getVersionBasedOn();
        $diffResult = (new DiffService())->generateDiff($ansuchen->getUid(), $diffCompareId);
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
            'possibleStatus' => $possibleStatus,
            'diffWithAlternativeId' => $diffWithAlternativeId,
            'diffCompareId' => $diffCompareId,
            'versions' => $this->ansuchenRepository->getAllPreviousVersions($ansuchen->getUid()),
            'diff' => $diffResult,
            'angebotVerantwortlicheLive' => $this->getAllVerantwortliche($ansuchen->getPid()),
            'stammdaten' => $stammdaten,
            'textbausteine' => $this->textbausteineRepository->getGroupedItems(),
        ]);
        return $this->htmlResponse();
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function showAction(Ansuchen $ansuchen, int $diffWithAlternativeId = 0): ResponseInterface
    {
        $this->setTitleTag($ansuchen->getTitleTag());
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'stammdaten' => $stammdaten,
        ]);
        $begutachtung = new Dto\Begutachtung\BasisBegutachtung();
        return $this->htmlResponse();
    }


    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     */
    public function begutachtungsSchlussAction(Ansuchen $ansuchen, int $gutachtervorschlag = 0): ResponseInterface
    {

        
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $this->stammdatenRepository->update($stammdaten);
        $this->stammdatenRepository->forcePersist();

        $ansuchen->setGutachterLockedBy(0);
        $ansuchen->setStatus($gutachtervorschlag);
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->eventDispatcher->dispatch(new Event\AnsuchenBegutachtungsSchlussEvent($ansuchen));
        $this->redirect('list');
    }

    public function updateAction(Ansuchen $ansuchen, Dto\Begutachtung\BasisBegutachtung $begutachtung, array $verantwortliche = []): void
    {
        $begutachtung->verantwortliche = $verantwortliche;
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $begutachtung->copyToAnsuchen($ansuchen);
        $ansuchen->setGutachterLockedBy(0);
        $arguments = $this->request->getArguments();

        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $begutachtung->copyToStammdaten($stammdaten, $ansuchen);
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
        //$this->addFlashMessage('Ansuchen wurde ergänzt');

        // if status changes, no need to stay in record show
        // if ($begutachtung->status > 0) {
        //     $this->ansuchenRepository->createNewSnapshot($ansuchen, $stammdaten);
        //     $this->redirect('list');
        // }
        $this->redirectTo($ansuchen->getUid());
    }

    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['save']) && $recordId > 0) {
            $this->redirect('edit', null, null, ['ansuchen' => $recordId]);
        }
        if (isset($arguments['saveAndIndex'])) {
            $this->ansuchenRepository->removeLockByUser($recordId);

            $this->redirect('list');
        }
        $this->redirect('list');
    }

    public function zuteilungAction(Ansuchen $ansuchen)
    {
        $zuteilung = new Dto\Zuteilung();
        $zuteilung->setGutachter1($ansuchen->getGutachter1() ? $ansuchen->getGutachter1()->getUid() : 0);
        $zuteilung->setGutachter2($ansuchen->getGutachter2() ? $ansuchen->getGutachter2()->getUid() : 0);
        $zuteilung->setAnsuchenId($ansuchen->getUid());
        $zuteilung->setReviewVerrechnungCheck1($ansuchen->getReviewVerrechnungCheck1());
        $zuteilung->setReviewVerrechnungCheck2($ansuchen->getReviewVerrechnungCheck2());
        $zuteilung->setReviewVerrechnung1($ansuchen->getReviewVerrechnung1());
        $zuteilung->setReviewVerrechnung2($ansuchen->getReviewVerrechnung2());

        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'zuteilung' => $zuteilung,
            'alleGutachter' => $this->userRepository->getAllGutachter(),
        ]);
    }

    public function zuteilungPersistAction(Dto\Zuteilung $zuteilung)
    {

        /** @var Ansuchen $ansuchen */
        $ansuchen = $this->ansuchenRepository->findByIdentifier($zuteilung->getAnsuchenId());
        /** @var Ansuchen $ansuchen */
        $ansuchen = $this->ansuchenRepository->findByIdentifier($zuteilung->getAnsuchenId());
        if ($zuteilung->getGutachter1()) {
            $gutachter1 = $this->userRepository->findByIdentifier($zuteilung->getGutachter1());
            if ($gutachter1) {
                $ansuchen->setGutachter1($gutachter1);
            }
        }
        if ($zuteilung->getGutachter2()) {
            $gutachter2 = $this->userRepository->findByIdentifier($zuteilung->getGutachter2());
            if ($gutachter2) {
                $ansuchen->setGutachter2($gutachter2);
            }
        }
        // if($zuteilung->getUser()==$ansuchen->getGutachterLockedBy()) {
        //     $ansuchen->setGutachterLockedBy(0);
        // }
        $ansuchen->setZuteilungDatum(new \DateTime());
        $ansuchen->setGutachterLockedBy(0);
        $ansuchen->setReviewVerrechnungCheck1($zuteilung->getReviewVerrechnungCheck1());
        $ansuchen->setReviewVerrechnungCheck2($zuteilung->getReviewVerrechnungCheck2());
        $ansuchen->setReviewVerrechnung1($zuteilung->getReviewVerrechnung1());
        $ansuchen->setReviewVerrechnung2($zuteilung->getReviewVerrechnung2());
        $this->ansuchenRepository->unsetGutachterLockedAndPersist($ansuchen);
        $this->eventDispatcher->dispatch(new Event\AnsuchenZuteilungEvent($ansuchen));
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->redirect('list');
    }


    public function unlockAction(Ansuchen $ansuchen): void
    {
        $this->ansuchenRepository->removeGutachterLockByUser($ansuchen->getUid());
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

    public function finalizeStatusAction(Ansuchen $ansuchen): ResponseInterface
    {
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $gutachter1Name = $ansuchen->getGutachter1() ? $ansuchen->getGutachter1()->getFullName() : '';
        $gutachter2Name = $ansuchen->getGutachter2() ? $ansuchen->getGutachter2()->getFullName() : '';

        $this->addNewCommentByAll($stammdaten, 'reviewA1CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($stammdaten, 'reviewA2CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB1CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB14CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB15CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB22CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB23CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewB2CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewC1CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewC2CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewC3CommentInternal', $gutachter1Name, $gutachter2Name);
        $this->addNewCommentByAll($ansuchen, 'reviewTotalCommentInternal', $gutachter1Name, $gutachter2Name);

        foreach($ansuchen->getTrainer() as $trainer) {
            $this->addNewCommentByAll($trainer, 'reviewC2BabiCommentInternal', $gutachter1Name, $gutachter2Name);
            $this->addNewCommentByAll($trainer, 'reviewC2PsaCommentInternal', $gutachter1Name, $gutachter2Name);
            $this->trainerRepository->update($trainer);
        }
        $this->trainerRepository->forcePersist();
        foreach($ansuchen->getBerater() as $berater) {
            $this->addNewCommentByAll($berater, 'reviewC3CommentInternal', $gutachter1Name, $gutachter2Name);
            $this->beraterRepository->update($berater);
        }
        $this->beraterRepository->forcePersist();

        $ansuchen->setStatus($ansuchen->getUpcomingStatus());

        if (($ansuchen->getAkkreditierungDatum() === null) && ($ansuchen->getUpcomingStatus() > 80)) {
            $ansuchen->setAkkreditierungDatum(new \DateTime());
        }

        $ansuchen->setTrotzdemAbschicken('');
        $ansuchen->setNotitzzettel('');
        $ansuchen->setGutachterLockedBy(0);
        // Zuteilung löschen:
        $ansuchen->setZuteilungDatum(null);
        $ansuchen->setGutachter1(null);
        $ansuchen->setGutachter2(null);
        $ansuchen->setReviewVerrechnung1('');
        $ansuchen->setReviewVerrechnung2('');
        $ansuchen->setReviewVerrechnungCheck1(false);
        $ansuchen->setReviewVerrechnungCheck2(false);
        $ansuchen->setStatusAgEins(0);
        $ansuchen->setStatusAgZwei(0);
        
        $this->stammdatenRepository->update($stammdaten);
        $this->stammdatenRepository->forcePersist();

        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->eventDispatcher->dispatch(new Event\AnsuchenBegutachtungFinalizeEvent($ansuchen, $stammdaten));

        $newAnsuchenId = $this->ansuchenRepository->createNewSnapshot($ansuchen, $stammdaten);
        /** @var Ansuchen $newAnsuchen */
        $newAnsuchen = $this->ansuchenRepository->findByIdentifier($newAnsuchenId);
        $newAnsuchen->setAkkreditierungEntscheidungDatum(new \DateTime());
        $this->ansuchenRepository->update($newAnsuchen);
        //$this->eventDispatcher->dispatch(new Event\AnsuchenBegutachtungFinalizeEvent($ansuchen, $stammdaten));
        
        $this->eventDispatcher->dispatch(new Event\AnsuchenBegutachtungFinalizeAfterSnapshotEvent($newAnsuchen, $ansuchen, $stammdaten));
        $this->eventDispatcher->dispatch(new Event\AnsuchenBegutachtungFinalizeEvent($ansuchen, $stammdaten));
        $this->redirect('list');
        $this->addFlashMessage('Das Ansuchen wurde an der Träger geschickt');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForDate('begutachtung', 'reviewTotalFrist');
        $this->setTypeConverterConfigurationForDate('begutachtung', 'stammdatenReviewOecertFrist');
        $this->setTypeConverterConfigurationForDate('begutachtung', 'reviewFristPruefbescheid');
    }

    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
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

    public function injectTextbausteineRepository(Repository\TextbausteineRepository $repository): void
    {
        $this->textbausteineRepository = $repository;
    }

    public function injectUserRepository(Repository\UserRepository $repository): void
    {
        $this->userRepository = $repository;
    }

    public function injectTrainerRepository(Repository\TrainerRepository $repository): void
    {
        $this->trainerRepository = $repository;
    }

    public function injectBeraterRepository(Repository\BeraterRepository $repository): void
    {
        $this->beraterRepository = $repository;
    }
}