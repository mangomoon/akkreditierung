<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\Domain\Repository\StammdatenRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class StammdatenController extends BaseController
{


    protected StammdatenRepository $stammdatenRepository;
    protected AnsuchenRepository $ansuchenRepository;

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Stammdaten $newStammdaten)
    {
        $this->stammdatenRepository->add($newStammdaten);
        $this->redirect('index');
    }

    public function editAction(Stammdaten $stammdaten): ResponseInterface
    {
        $this->check($stammdaten);
        $this->stammdatenRepository->setLockedAndPersist($stammdaten);

        $this->view->assign('stammdaten', $stammdaten);
        return $this->htmlResponse();
    }

    public function updateAction(Stammdaten $stammdaten, array $fileDelete = []): ResponseInterface
    {
        $this->check($stammdaten);
        $this->deleteFiles($fileDelete, $stammdaten);
        $stammdaten->setLockedBy(0);
        $this->stammdatenRepository->update($stammdaten);
        
        //$this->redirectToUri('/?id=14');
        return $this->redirectTo($stammdaten->getUid());
    }

    public function indexAction(): ResponseInterface
    {
        $stammdaten = $this->stammdatenRepository->getLatest();
        $used = $stammdaten->getLockedBy();
        if (!$stammdaten) {
            $stammdaten = new Stammdaten();
            $this->view->assign('exists', false);
        } else {
            if ($used == 0) {
                $this->stammdatenRepository->setLockedAndPersist($stammdaten);
            }
            $pid = $stammdaten->getPid();
            $this->view->assignMultiple([
                'exists' => true,
                'usedInAnsuchen' => $this->ansuchenRepository->getAllUsedByGs($pid),
            ]);
        }
        $this->view->assignMultiple([
            'stammdaten' => $stammdaten,
        ]);
        return $this->htmlResponse();
    }


    protected function redirectTo(int $recordId): void
    {
        $arguments = $this->request->getArguments();

        if (isset($arguments['saveAndAnsuchen'])) {
            $this->redirectToUri("/?id=14");
        }
        if (isset($arguments['save'])) {
            $this->redirect('index', null, null, ['stammdaten' => $recordId]);
        }
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newStammdaten');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('stammdaten');
    }

    public function injectStammdatenRepository(StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

}
