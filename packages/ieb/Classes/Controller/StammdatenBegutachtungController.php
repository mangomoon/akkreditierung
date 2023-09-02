<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository;
use Psr\Http\Message\ResponseInterface;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class StammdatenBegutachtungController extends BaseController
{

    protected Repository\AnsuchenRepository $ansuchenRepository;
    protected Repository\StammdatenRepository $stammdatenRepository;
    protected Repository\TextbausteineRepository $textbausteineRepository;


    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectStammdatenRepository(Repository\StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    public function showAction(Ansuchen $ansuchen, ?Dto\Begutachtung\StammdatenBegutachtung $begutachtung = null): ResponseInterface
    {
        $stammdaten = $this->stammdatenRepository->getLatestByPid($ansuchen->getPid());
        if (!$stammdaten) {
            return $this->htmlResponse('Not found');
        }

        $begutachtung = $begutachtung ?? new Dto\Begutachtung\StammdatenBegutachtung();
        $begutachtung->stammdatenId = $stammdaten->getUid();
        $begutachtung->ansuchenId = $ansuchen->getUid();

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach ($values as $property => $value) {
            $getter = 'get' . ucfirst($property);
            $begutachtung->$property = $stammdaten->$getter();
        }

        $this->view->assignMultiple([
            'stammdaten' => $stammdaten,
            'begutachtung' => $begutachtung,
            'ansuchen' => $ansuchen,
            'textbausteine' => $this->textbausteineRepository->getAll(),
        ]);
        return $this->htmlResponse();
    }


    public function updateAction(Dto\Begutachtung\StammdatenBegutachtung $begutachtung)
    {
        // check
        $ansuchen = $this->ansuchenRepository->findByIdentifier($begutachtung->ansuchenId);
        $stammdaten = $this->stammdatenRepository->findByIdentifier($begutachtung->stammdatenId);
        if (!$stammdaten || !$ansuchen || $ansuchen->getPid() !== $stammdaten->getPid()) {
            return $this->htmlResponse('Nicht erlaubt!');
        }

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach ($values as $property => $value) {
            $setter = 'set' . ucfirst($property);
            $stammdaten->$setter($value);
        }
        $this->stammdatenRepository->update($stammdaten);
        $this->addFlashMessage('Begutachtung gespeichert');
        $this->redirect('show', null, null, ['stammdaten' => $stammdaten, 'ansuchen' => $ansuchen]);
    }

    public function injectTextbausteineRepository(Repository\TextbausteineRepository $repository): void
    {
        $this->textbausteineRepository = $repository;
    }

}