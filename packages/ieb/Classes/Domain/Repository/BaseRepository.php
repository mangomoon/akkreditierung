<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BaseRepository extends Repository
{

    use CurrentUserTrait;

    public function add($object)
    {
        $object->setPid($this->getCurrentUserPid());
        parent::add($object);
    }

    public function getAll(): QueryResultInterface
    {
        $query = $this->getQuery();
        $query->setOrderings(['uid' => QueryInterface::ORDER_DESCENDING]);

        return $query->execute();
    }

    public function getLatest(): ?object
    {
        return $this->getAll()->getFirst();
    }

    /**
     * Get query with predefined pid check
     */
    protected function getQuery(): QueryInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(true);
        $currentUser = $this->getCurrentUser();
        $query->getQuerySettings()->setStoragePageIds([$currentUser['pid'] ?? -1]);

        return $query;
    }

}
