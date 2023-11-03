<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\Dto\PersonSearch;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PersonSearchController extends ActionController
{

    protected TrainerRepository $trainerRepository;
    protected BeraterRepository $beraterRepository;

    public function indexAction(PersonSearch $search = null): ResponseInterface
    {
        if ($search === null) {
            $search = new PersonSearch();
        }

        $this->view->assignMultiple([
            'search' => $search,
            'trainer' => $this->trainerRepository->findInPersonSearch($search),
            'berater' => $this->beraterRepository->findInPersonSearch($search),
        ]);
        return $this->htmlResponse();
    }

    public function injectTrainerRepository(TrainerRepository $trainerRepository): void
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function injectBeraterRepository(BeraterRepository $beraterRepository): void
    {
        $this->beraterRepository = $beraterRepository;
    }
}