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
 * BeraterController
 */
class BeraterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * beraterRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\BeraterRepository
     */
    protected $beraterRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\BeraterRepository $beraterRepository
     */
    public function injectBeraterRepository(\GeorgRinger\Ieb\Domain\Repository\BeraterRepository $beraterRepository)
    {
        $this->beraterRepository = $beraterRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $beraters = $this->beraterRepository->findAll();
        $this->view->assign('beraters', $beraters);
        return $this->htmlResponse();
    }
}
