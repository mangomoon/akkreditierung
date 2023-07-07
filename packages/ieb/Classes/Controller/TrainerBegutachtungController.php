<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Repository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
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

    public function showAction(Trainer $trainer, Ansuchen $ansuchen, Dto\Begutachtung\TrainerBegutachtung $begutachtung = null): ResponseInterface
    {
        $begutachtung = $begutachtung ?? new Dto\Begutachtung\TrainerBegutachtung();
        $begutachtung->trainerId = $trainer->getUid();
        $begutachtung->ansuchenId = $ansuchen->getUid();

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach($values as $property => $value) {
            $getter = 'get' . ucfirst($property);
            $begutachtung->$property = $trainer->$getter();
        }

        $this->view->assignMultiple([
            'trainer' => $trainer,
            'ansuchen' => $ansuchen,
            'begutachtung' => $begutachtung,
        ]);
        return $this->htmlResponse();
    }

    public function updateAction(Dto\Begutachtung\TrainerBegutachtung $begutachtung)
    {
        // check
        $ansuchen = $this->ansuchenRepository->findByIdentifier($begutachtung->ansuchenId);
        $trainer = $this->trainerRepository->findByIdentifier($begutachtung->trainerId);
        if (!$trainer || !$ansuchen || $ansuchen->getPid() !== $trainer->getPid()) {
            return $this->htmlResponse('Nicht erlaubt!');
        }

        $values = $this->getPropertiesOfBegutachtung($begutachtung);
        foreach($values as $property => $value) {
            $setter = 'set' . ucfirst($property);
            $trainer->$setter($value);
        }
        $this->trainerRepository->update($trainer);
        $this->addFlashMessage('Begutachtung gespeichert');
        $this->redirect('show', null, null, ['trainer' => $trainer, 'ansuchen' => $ansuchen]);
    }

    protected function getPropertiesOfBegutachtung(Dto\Begutachtung\TrainerBegutachtung $object):array
    {
        $properties = ObjectAccess::getGettableProperties($object);
        foreach (['ansuchenId', 'trainerId', 'pid', 'uid'] as $property) {
            unset($properties[$property]);
        }
        return $properties;
    }


    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectTrainerRepository(Repository\TrainerRepository $trainerRepository): void
    {
        $this->trainerRepository = $trainerRepository;
    }

}