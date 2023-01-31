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
 * StandortController
 */
class StandortController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * standortRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\StandortRepository
     */
    protected $standortRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\StandortRepository $standortRepository
     */
    public function injectStandortRepository(\GeorgRinger\Ieb\Domain\Repository\StandortRepository $standortRepository)
    {
        $this->standortRepository = $standortRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $standorts = $this->standortRepository->findAll();
        $this->view->assign('standorts', $standorts);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Standort $standort
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Standort $standort): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('standort', $standort);
        return $this->htmlResponse();
    }
}
