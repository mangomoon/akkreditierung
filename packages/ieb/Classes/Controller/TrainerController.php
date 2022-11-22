<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * TrainerController
 */
class TrainerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * trainerRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\TrainerRepository
     */
    protected $trainerRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\TrainerRepository $trainerRepository
     */
    public function injectTrainerRepository(\GeorgRinger\Ieb\Domain\Repository\TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $trainers = $this->trainerRepository->findAll();
        $this->view->assign('trainers', $trainers);
        return $this->htmlResponse();
    }
}
