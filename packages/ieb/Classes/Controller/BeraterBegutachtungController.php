<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Trainer;
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
class BeraterBegutachtungController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;
    protected Repository\BeraterRepository $beraterRepository;
    protected Repository\TextbausteineRepository $textbausteineRepository;


    public function showAction(Berater $berater, Ansuchen $ansuchen, int $ansuchenCompareId = 0, Dto\Begutachtung\BeraterBegutachtung $begutachtung = null): ResponseInterface
    {
        $begutachtung = $begutachtung ?? new Dto\Begutachtung\BeraterBegutachtung();
        $begutachtung->beraterId = $berater->getUid();
        $begutachtung->ansuchenId = $ansuchen->getUid();

        $this->beraterRepository->setGutachterLockedAndPersist($berater);

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach ($values as $property => $value) {
            $getter = 'get' . ucfirst($property);
            $begutachtung->$property = $berater->$getter();
        }

        $this->view->assignMultiple([
            'berater' => $berater,
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
            'diff' => (new DiffService())->generateDiff($ansuchen->getUid(), $ansuchenCompareId),
            'textbausteine' => $this->textbausteineRepository->getGroupedItems(),
        ]);
        return $this->htmlResponse();
    }

    public function updateAction(Dto\Begutachtung\BeraterBegutachtung $begutachtung)
    {
        // check
        $ansuchen = $this->ansuchenRepository->findByIdentifier($begutachtung->ansuchenId);
        $berater = $this->beraterRepository->findByIdentifier($begutachtung->beraterId);
        if (!$berater || !$ansuchen || $ansuchen->getPid() !== $berater->getPid()) {
            return $this->htmlResponse('Nicht erlaubt!');
        }

        

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach ($values as $property => $value) {
            $setter = 'set' . ucfirst($property);
            $berater->$setter($value);
        }

        $this->commentVersioning($berater);
        $this->beraterRepository->unsetGutachterLockedAndPersist($berater);
        $this->beraterRepository->update($berater);
        $this->addFlashMessage('Begutachtung gespeichert');
        $this->redirectToPageId(217);
    }

    public function abbrechenAction(Berater $berater) {
        $this->commentVersioning($berater);
        $this->beraterRepository->unsetGutachterLockedAndPersist($berater);
        $this->redirectToPageId(217);
    }

    private function commentVersioning(Berater $berater): void
    {
        $this->addNewComment($berater, 'reviewC3CommentInternal');
    }

    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectBeraterRepository(Repository\BeraterRepository $beraterRepository): void
    {
        $this->beraterRepository = $beraterRepository;
    }

    public function injectTextbausteineRepository(Repository\TextbausteineRepository $repository): void
    {
        $this->textbausteineRepository = $repository;
    }


    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForDate('begutachtung', 'reviewFrist');
    }
}