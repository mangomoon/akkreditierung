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
    protected Repository\TextbausteineRepository $textbausteineRepository;
    protected Repository\UserRepository $userRepository;

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
    public function editAction(Ansuchen $ansuchen, int $diffWithAlternativeId = 0): ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        $begutachtung = new Dto\Begutachtung\BasisBegutachtung();
        $begutachtung->reviewTotalFrist = '';
        return $this->htmlResponse();
    }

    public function updateAction(Ansuchen $ansuchen, Dto\Begutachtung\BasisBegutachtung $begutachtung, array $verantwortliche = []): void
    {
        $begutachtung->verantwortliche = $verantwortliche;
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        $begutachtung->copyToAnsuchen($ansuchen);
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
        $this->addFlashMessage('Ansuchen wurde ergänzt');

        // if status changes, no need to stay in record show
        if ($begutachtung->status > 0) {
            $this->ansuchenRepository->createNewSnapshot($ansuchen, $stammdaten);
            $this->redirect('list');
        }
        $this->redirectTo($ansuchen->getUid());
    }

    public function zuteilungAction(Ansuchen $ansuchen)
    {
        $zuteilung = new Dto\Zuteilung();
        $zuteilung->setGutachter1($ansuchen->getGutachter1() ? $ansuchen->getGutachter1()->getUid() : 0);
        $zuteilung->setGutachter2($ansuchen->getGutachter2() ? $ansuchen->getGutachter2()->getUid() : 0);
        $zuteilung->setAnsuchenId($ansuchen->getUid());
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
        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->redirect('list');
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

    public function finalizeStatusAction(Ansuchen $ansuchen): ResponseInterface
    {
        /** @var Stammdaten $stammdaten */
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());

        try {
            $this->addNewComment($stammdaten, 'reviewA1CommentInternal');
            $this->addNewComment($stammdaten, 'reviewA2CommentInternal');

            $this->addNewComment($ansuchen, 'reviewB1CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB14CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB15CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB22CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB23CommentInternal');
            $this->addNewComment($ansuchen, 'reviewB2CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC1CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC2CommentInternal');
            $this->addNewComment($ansuchen, 'reviewC3CommentInternal');
            $this->addNewComment($ansuchen, 'reviewTotalCommentInternal');
        } catch (\JsonException $e) {
        }

        $ansuchen->setStatus($ansuchen->getUpcomingStatus());
        $ansuchen->setUpcomingStatus(0);
        
        //if ($ansuchen->getAkkreditierungDatum == null) {
            $ansuchen->setAkkreditierungDatum(new \DateTime());
        //}

        $this->stammdatenRepository->update($stammdaten);
        $this->stammdatenRepository->forcePersist();

        $this->ansuchenRepository->update($ansuchen);
        $this->ansuchenRepository->forcePersist();
        $this->ansuchenRepository->createNewSnapshot($ansuchen, $stammdaten);
        $this->redirect('list');
        $this->addFlashMessage('Das Ansuchen wurde an der Träger geschickt');
    }

    protected function addNewComment(Ansuchen|Stammdaten $object, string $fieldName): void
    {
        $commentFieldGetter = 'get' . ucfirst($fieldName . 'Step');
        $comment = $object->$commentFieldGetter();
        if (!$comment) {
            return;
        }
        $getterForData = 'get' . ucfirst($fieldName) . 'Data';
        $comments = $object->$getterForData();
        $comments[] = [
            'user' => self::getCurrentUserName(),
            'user_uid' => self::getCurrentUserId(),
            'comment' => $comment,
            'date' => time(),
        ];
        $setter = 'set' . ucfirst($fieldName);
        $setterStep = 'set' . ucfirst($fieldName) . 'Step';
        $object->$setter(json_encode($comments, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        $object->$setterStep('');
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

    public function injectTextbausteineRepository(Repository\TextbausteineRepository $repository): void
    {
        $this->textbausteineRepository = $repository;
    }

    public function injectUserRepository(Repository\UserRepository $repository): void
    {
        $this->userRepository = $repository;
    }
}