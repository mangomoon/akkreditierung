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
class AnsuchenController extends BaseController
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
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $newAnsuchen
     */
    public function createAction(\GeorgRinger\Ieb\Domain\Model\Ansuchen $newAnsuchen)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ansuchenRepository->add($newAnsuchen);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("ansuchen")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('ansuchen', $ansuchen);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen
     */
    public function updateAction(\GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ansuchenRepository->update($ansuchen);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen
     */
    public function deleteAction(\GeorgRinger\Ieb\Domain\Model\Ansuchen $ansuchen)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ansuchenRepository->remove($ansuchen);
        $this->redirect('list');
    }
}
