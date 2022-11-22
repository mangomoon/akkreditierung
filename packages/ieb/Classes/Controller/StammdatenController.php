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
 * StammdatenController
 */
class StammdatenController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * stammdatenRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\StammdatenRepository
     */
    protected $stammdatenRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\StammdatenRepository $stammdatenRepository
     */
    public function injectStammdatenRepository(\GeorgRinger\Ieb\Domain\Repository\StammdatenRepository $stammdatenRepository)
    {
        $this->stammdatenRepository = $stammdatenRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $stammdatens = $this->stammdatenRepository->findAll();
        $this->view->assign('stammdatens', $stammdatens);
        return $this->htmlResponse();
    }
}
