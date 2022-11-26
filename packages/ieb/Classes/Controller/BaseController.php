<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BaseController extends ActionController
{

    use CurrentUserTrait;

    protected function check(AbstractEntity $item)
    {
        if (!$this->isObjectAllowedForCurrentUser($item)) {
            $this->addFlashMessage('Fehler bei PID check', '', AbstractMessage::ERROR);
            $this->redirect('index');
        }
    }

    protected function isObjectAllowedForCurrentUser(AbstractEntity $object): bool
    {
        if ($object->getPid() === 0) {
            return false;
        }
        $currentUser = $this->getCurrentUser();
        if (!$currentUser) {
            return false;
        }
        return $object->getPid() === $currentUser['pid'];
    }
}
