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
 * AnsuchenController
 */
class AnsuchenController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * ansuchenRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository
     */
    protected $ansuchenRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository $ansuchenRepository
     */
    public function injectAnsuchenRepository(\GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository $ansuchenRepository)
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $ansuchens = $this->ansuchenRepository->findAll();
        $this->view->assign('ansuchens', $ansuchens);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }
}
