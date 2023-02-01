<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */

/**
 * KriterienController
 */
class KriterienController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * kriterienRepository
     *
     * @var \GeorgRinger\Ieb\Domain\Repository\KriterienRepository
     */
    protected $kriterienRepository = null;

    /**
     * @param \GeorgRinger\Ieb\Domain\Repository\KriterienRepository $kriterienRepository
     */
    public function injectKriterienRepository(\GeorgRinger\Ieb\Domain\Repository\KriterienRepository $kriterienRepository)
    {
        $this->kriterienRepository = $kriterienRepository;
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $kriteriens = $this->kriterienRepository->findAll();
        $this->view->assign('kriteriens', $kriteriens);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('kriterien', $kriterien);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Kriterien $newKriterien
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Kriterien $newKriterien)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->kriterienRepository->add($newKriterien);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("kriterien")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('kriterien', $kriterien);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->kriterienRepository->update($kriterien);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien
     */
    public function deleteAction(\GeorgRinger\Ieb\Domain\Model\Kriterien $kriterien)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->kriterienRepository->remove($kriterien);
        $this->redirect('list');
    }
}
