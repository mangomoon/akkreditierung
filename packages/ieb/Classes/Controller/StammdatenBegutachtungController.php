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

    public function injectAnsuchenRepository(Repository\AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectStammdatenRepository(Repository\StammdatenRepository $stammdatenRepository): void
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    public function showAction(Stammdaten $trainer, Ansuchen $ansuchen): ResponseInterface
    {
        $this->view->assignMultiple([
            'stammdaten' => $trainer,
            'ansuchen' => $ansuchen,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("trainer")
     */
    public function editAction(Stammdaten $stammdaten): ResponseInterface
    {
        $this->view->assign('stammdaten', $stammdaten);
        return $this->htmlResponse();
    }

    public function updateAction(Ansuchen $ansuchen, Dto\Begutachtung\BasisBegutachtung $begutachtung): void
    {
//        todo
    }

}