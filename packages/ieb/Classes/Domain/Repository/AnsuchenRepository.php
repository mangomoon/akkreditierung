<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Domain\Model\Standort;
use GeorgRinger\Ieb\Service\CustomDataHandler;
use http\Exception\RuntimeException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Extbase\Reflection\ReflectionService;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class AnsuchenRepository extends BaseRepository
{
    public function __construct(ObjectManagerInterface $objectManager, protected CustomDataHandler $customDataHandler)
    {
        parent::__construct($objectManager);
    }

    public function getAll(): QueryResultInterface
    {
        $query = $this->getQuery();
        $constraints = [
            $query->equals('version_active', 1),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    public function getAllEditableForTr(): QueryResultInterface
    {
        $query = $this->getQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusBearbeitbarDurchTr()),
            $query->equals('version_active', 1),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }


    public function getAllForBegutachtung()
    {
        $query = $this->getEmptyQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusSichtbarDurchGs()),
            $query->equals('version_active', 1),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    public function clone(Ansuchen $ansuchen): void
    {
        // todo clear all review fields
        $overrideValues = [
            'status' => AnsuchenStatus::NEU_IN_ARBEIT->value,
            'name' => $ansuchen->getName() . ' [KOPIE]',
            'kopie_von' => $ansuchen->getUid(),
        ];
        $this->customDataHandler->copyRecord('tx_ieb_domain_model_ansuchen', $ansuchen->getUid(), $ansuchen->getPid(), $overrideValues);
    }

    public function createNewSnapshot(Ansuchen $ansuchen, Stammdaten $stammdaten): int
    {
        $overrideValues = [
            'version_active' => 1,
            'version_based_on' => $ansuchen->getUid(),
            'version' => $ansuchen->getVersion() + 1,
        ];

        $copyStandorte = $copyBerater = $copyTrainer = [];
        if ($ansuchen->getStandorte()) {
            foreach ($ansuchen->getStandorte() as $standort) {
                $copyStandorte[$standort->getUid()] = ObjectAccess::getGettableProperties($standort);
            }
        }
        if ($ansuchen->getTrainer()) {
            foreach ($ansuchen->getTrainer() as $trainer) {
                $copyTrainer[$trainer->getUid()] = ObjectAccess::getGettableProperties($trainer);
            }
        }
        if ($ansuchen->getBerater()) {
            foreach ($ansuchen->getBerater() as $berater) {
                $copyBerater[$berater->getUid()] = ObjectAccess::getGettableProperties($berater);
            }
        }
        $copyStammdaten = $stammdaten ? $this->convertObjectToArray(ObjectAccess::getGettableProperties($stammdaten)) : [];

        $overrideValues['copy_standorte'] = json_encode($copyStandorte, JSON_PRETTY_PRINT);
        $overrideValues['copy_trainer'] = json_encode($copyTrainer, JSON_PRETTY_PRINT);
        $overrideValues['copy_berater'] = json_encode($copyBerater, JSON_PRETTY_PRINT);
        $overrideValues['copy_stammdaten'] = json_encode($copyStammdaten, JSON_PRETTY_PRINT);

        $newEventId = $this->customDataHandler->copyRecord('tx_ieb_domain_model_ansuchen', $ansuchen->getUid(), $ansuchen->getPid(), $overrideValues);
        $this->getConnection()->update(
            'tx_ieb_domain_model_ansuchen',
            [
                'version_active' => 0,
//                'copy_standorte' => $overrideValues['copy_standorte'],
//                'copy_trainer' => $overrideValues['copy_trainer'],
//                'copy_berater' => $overrideValues['copy_berater'],
//                'copy_stammdaten' => $overrideValues['copy_stammdaten'],
            ],
            ['uid' => $ansuchen->getUid()]
        );
        return $newEventId;
    }

    protected function convertObjectToArray(array $item)
    {
        foreach ($item as $key => $value) {
            if (is_object($value)) {
                switch (get_class($value)) {
                    case ObjectStorage::class:
                        $out = [];
                        foreach ($value as $object) {
                            switch (get_class($object)) {
                                case FileReference::class;
                                    $out[] = [
                                        'publicUrl' => $object->getOriginalResource()->getPublicUrl(),
                                    ];
                                    break;
                                default:
                                    throw new RuntimeException(sprintf('Class %s not supported', get_class($object)));
                                    break;
                            }
                        }
                        $item[$key] = $out;
                        break;
                    case FileReference::class:
                        $item[$key] = [
                            'publicUrl' => $value->getOriginalResource()->getPublicUrl(),
                        ];
                        break;
                }
            }
        }
        return $item;
    }

    protected function getConnection(): Connection
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tx_ieb_domain_model_ansuchen');
    }
}
