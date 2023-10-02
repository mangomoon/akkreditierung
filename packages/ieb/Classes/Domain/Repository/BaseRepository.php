<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
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
        $object->setPid(self::getCurrentUserPid());
        parent::add($object);
    }

    public function getAll(): QueryResultInterface
    {
        $query = $this->getQuery();

        return $query->execute();
    }

    public function getAllSorted(string $sorter): QueryResultInterface
    {
        $query = $this->getQuery();
        $query->setOrderings([$sorter => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    public function getLatest(): ?object
    {
        return $this->getAll()->getFirst();
    }

    public function getLatestByPid(int $pid): ?object
    {
        $query = $this->getQuery($pid);
        return $query->execute()->getFirst();
    }

    public function getByIdAndPid(int $identifier, int $pid): ?object
    {
        $query = $this->getQuery($pid);
        $query->matching(
            $query->logicalAnd(
                $query->equals('uid', $identifier)
            )
        );
        return $query->execute()->getFirst();
    }

    /**
     * Get query with predefined pid check
     */
    protected function getQuery(int $forcedPid = 0): QueryInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(true);
        $currentUser = self::getCurrentUser();
        $pid = $forcedPid > 0 ? $forcedPid : $currentUser['pid'] ?? -1;
        $query->getQuerySettings()->setStoragePageIds([$pid]);
        $query->setOrderings(['uid' => QueryInterface::ORDER_DESCENDING]);

        return $query;
    }

    protected function getEmptyQuery(): QueryInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        return $query;
    }

    public function setLockedAndPersist(AbstractEntity $item)
    {
        $item->setLockedBy(self::getCurrentUserId());
        $this->update($item);
        $this->persistenceManager->persistAll();
    }

    public function setGutachterLockedAndPersist(AbstractEntity $item)
    {
        $item->setGutachterLockedBy(self::getCurrentUserId());
        $this->update($item);
        $this->persistenceManager->persistAll();
    }

    public function setUnlockedAndPersist(AbstractEntity $item)
    {
        $item->setLockedBy(0);
        $this->update($item);
        $this->persistenceManager->persistAll();
    }

    public function setUnGutachterLockedAndPersist(AbstractEntity $item)
    {
        $item->setGutachterLockedBy(0);
        $this->update($item);
        $this->persistenceManager->persistAll();
    }

    public function forcePersist(): void
    {
        $this->persistenceManager->persistAll();
    }

    public function duplicateToStaticVersion(AbstractEntity $entity): AbstractEntity
    {
        switch (get_class($entity)) {
            case Model\Stammdaten::class:
                /** @var Model\Stammdaten $entity */
                $target = new Model\StaticStammdaten();
                $fields = ['name', 'nachweis', 'rechtsform', 'strasse', 'plz', 'ort'];
                break;
            default:
                throw new \RuntimeException(sprintf('Class "%s" is not configured to be duplicatable', get_class($entity)));
        }

        foreach ($fields as $field) {
            $getter = 'get' . ucfirst($field);
            $setter = 'set' . ucfirst($field);
            $value = $entity->$getter();
            if ($value !== null) {
                $target->$setter($value);
            }
        }

        $target->setPid($entity->getPid());
        $target->setBasedOn($entity);

        return $target;
    }
}
