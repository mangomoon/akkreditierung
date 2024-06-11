<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Trainer;
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
class TrainerBegutachtungController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;
    protected Repository\TrainerRepository $trainerRepository;
    protected Repository\TextbausteineRepository $textbausteineRepository;
    protected array $commentFields = ['reviewC2BabiCommentInternal', 'reviewC2PsaCommentInternal'];

    public function showAction(Trainer $trainer, Ansuchen $ansuchen, int $ansuchenCompareId = 0, Dto\Begutachtung\TrainerBegutachtung $begutachtung = null): ResponseInterface
    {
        

        $this->trainerRepository->setGutachterLockedAndPersist($trainer);
        

        $begutachtung = $begutachtung ?? new Dto\Begutachtung\TrainerBegutachtung();
        $begutachtung->trainerId = $trainer->getUid();
        $begutachtung->ansuchenId = $ansuchen->getUid();

        

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach ($values as $property => $value) {
            $getter = 'get' . ucfirst($property);
            $begutachtung->$property = $trainer->$getter();
        }

        $this->view->assignMultiple([
            'trainer' => $trainer,
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
            'textbausteine' => $this->textbausteineRepository->getGroupedItems(),
            'diff' => (new DiffService())->generateDiff($ansuchen->getUid(), $ansuchenCompareId),
        ]);

        
        return $this->htmlResponse();
    }

    public function updateAction(Dto\Begutachtung\TrainerBegutachtung $begutachtung)
    {



        // check
        $ansuchen = $this->ansuchenRepository->findByIdentifier($begutachtung->ansuchenId);
        /** @var Trainer $trainer */
        $trainer = $this->trainerRepository->findByIdentifier($begutachtung->trainerId);
        if (!$trainer || !$ansuchen || $ansuchen->getPid() !== $trainer->getPid()) {
            return $this->htmlResponse('Fehler! Bearbeitung nicht möglilch.');
        }

        $this->trainerRepository->unsetGutachterLockedAndPersist($trainer);
        
        $values = $this->getPropertiesOfBegutachtung($begutachtung);

        
        

        if($trainer->getReviewC21BabiStatus() == 1 && $trainer->getReviewC22BabiStatus() == 1) {
            $trainer->setReviewFrist = null;
        }
        if($trainer->getReviewC21PsaStatus() == 1 && $trainer->getReviewC22PsaStatus() == 1) {
            $this->trainerRepository->setReviewPsaFrist = null;
        }

        foreach ($values as $property => $value) {
            if (!in_array($property, $this->commentFields, true)) {
                $setter = 'set' . ucfirst($property);
                $trainer->$setter($value);
                $trainer->setGutachterLockedBy(0);
            }
        }
        
        
        $this->trainerRepository->update($trainer);
        $this->trainerRepository->forcePersist();
        
        $this->addFlashMessage('Begutachtung gespeichert');
        // $this->redirect('show', null, null, ['ansuchen' => $ansuchen, 'trainer' => $trainer]);
        $this->redirectToPageId(217);
    }

    public function abbrechenAction(Trainer $trainer)
    {
        $this->trainerRepository->unsetGutachterLockedAndPersist($trainer);
        //$this->redirectToPageId(217);
        $targetUrl = $this->uriBuilder
            ->setTargetPageUid(217) // The UID of the target page
            ->setLinkAccessRestrictedPages(true)
            ->buildFrontendUri();
        $this->redirectToUri($targetUrl);
    }

    private function commentVersioning(Trainer $trainer): void
    {
        foreach ($this->commentFields as $commentField) {
            $this->addNewComment($trainer, $commentField);
        }
    }

    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectTrainerRepository(Repository\TrainerRepository $trainerRepository): void
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function injectTextbausteineRepository(Repository\TextbausteineRepository $repository): void
    {
        $this->textbausteineRepository = $repository;
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForDate('begutachtung', 'reviewFrist');
        $this->setTypeConverterConfigurationForDate('begutachtung', 'reviewPsaFrist');
    }

}