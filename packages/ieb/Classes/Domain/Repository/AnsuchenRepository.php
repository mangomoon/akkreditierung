<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Dto\ExternalViewFilter;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;
use GeorgRinger\Ieb\Service\CustomDataHandler;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

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

    public function getAllAkkreditiert(): QueryResultInterface
    {
        $query = $this->getQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusForAkkreditiertOnly()),
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

    /**
     * @param int $id
     * @return Ansuchen[]
     */
    public function getAllPreviousVersions(int $id): array
    {
        $collection = [];
        $this->buildHistory($id, $collection);
        return $collection;
    }

    public function getAllForExternalView(ExternalViewFilter $filter)
    {
        $query = $this->getEmptyQuery();
        $constraints = [
            $query->in('uid', $this->getMaxAkkredierteIds()),
            $query->equals('version_active', 1),
            $query->greaterThan('version', 0),
            $query->greaterThan('status', 90)
        ];
        if ($filter->bundesland) {
            $constraints[] = $query->equals('bundesland', $filter->bundesland->value);
        }

        if ($filter->ansuchenNummer) {
            $constraints[] = $query->like('nummer', '%' . $filter->ansuchenNummer . '%');
        }
        if ($filter->status >= 0) {
            $constraints[] = $query->equals('status', $filter->status);
        }
        if ($filter->trPid >= 0) {
            $constraints[] = $query->equals('pid', $filter->trPid);
        }
        if ($filter->search) {
            $escapedLikeString = '%' . $filter->search . '%';
            $constraints[] = $query->like('name', $escapedLikeString);
        }


        $query->matching($query->logicalAnd($constraints));

        return $query->execute()->toArray();
    }

    private function getMaxAkkredierteIds(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');
        $maxIdRows = $queryBuilder
            ->addSelectLiteral('max(uid) as uid')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusForAkkreditiertOnlyExtern(), Connection::PARAM_INT_ARRAY))
            )
            ->groupBy('nummer')
            ->execute()
            ->fetchAllAssociative();
        //var_dump($maxIdRows);
        return array_column($maxIdRows, 'uid');
    }

    private function buildHistory(int $id, array &$collection): void
    {
        /** @var Ansuchen $item */
        $item = $this->findByIdentifier($id);
        if ($item) {
            $collection[$item->getUid()] = $item;
            if ($item->getVersionBasedOn()) {
                $this->buildHistory($item->getVersionBasedOn(), $collection);
            }
        }
    }

    public function getAllForGs()
    {
        $query = $this->getEmptyQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusSichtbarDurchGs()),
            $query->equals('version_active', 1),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    public function getAllUsedByGs(int $pid)
    {
        $query = $this->getEmptyQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusSichtbarDurchGs()),
            $query->equals('version_active', 1),
            $query->equals('pid', $pid),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    public function getAllForAkkreditierungsGruppe()
    {
        $query = $this->getEmptyQuery();
        $constraints = [
            $query->in('status', AnsuchenStatus::statusSichtbarDurchGs()),
            $query->equals('version_active', 1),
            $query->greaterThan('gutachter1', 0),
            // $query->logicalOr(
            //     $query->equals('gutachter1', $userId),
            //     $query->equals('gutachter2', $userId),
            // )
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    public function clone(Ansuchen $ansuchen): void
    {
        // todo clear all review fields
        $overrideValues = [
            'status' => AnsuchenStatus::NEU_IN_ARBEIT->value,
            'name' => 'NEU [Kopie von ' . $ansuchen->getName() . ']',
            'kopie_von' => $ansuchen->getUid(),
            'version' => 0,
            'ok' => 0,
            'review_b1_comment_internal' => '',
            'review_b1_comment_internal_step' => '',
            'review_b1_ag1_comment_internal_step' => '',
            'review_b1_ag2_comment_internal_step' => '',
            'review_b1_comment_tr' => '',
            'review_b1_status' => '0',
            'review_b2_comment_internal' => '',
            'review_b2_comment_internal_step' => '',
            'review_b2_ag1_comment_internal_step' => '',
            'review_b2_ag2_comment_internal_step' => '',
            'review_b2_comment_tr' => '',
            'review_b2_status' => '0',
            'review_c1_comment_internal' => '',
            'review_c1_comment_internal_step' => '',
            'review_c1_ag1_comment_internal_step' => '',
            'review_c1_ag2_comment_internal_step' => '',
            'review_c1_comment_tr' => '',
            'review_c1_status' => '0',
            'review_c2_comment_internal' => '',
            'review_c2_comment_internal_step' => '',
            'review_c2_ag1_comment_internal_step' => '',
            'review_c2_ag2_comment_internal_step' => '',
            'review_c2_comment_tr' => '',
            'review_c2_status' => '0',
            'review_c3_comment_internal' => '',
            'review_c3_comment_internal_step' => '',
            'review_c3_ag1_comment_internal_step' => '',
            'review_c3_ag2_comment_internal_step' => '',
            'review_c3_comment_tr' => '',
            'review_c3_status' => '0',
            'review_total_comment_internal' => 0,
            'review_total_comment_internal_step' => '',
            'review_total_ag1_comment_internal_step' => '',
            'review_total_ag2_comment_internal_step' => '',
            'review_total_comment_tr' => '',
            'review_total_status' => '0',
            'review_incoming_status' => '0',
            'review_total_frist' => '0',
            'review_frist_pruefbescheid' => '',
            'review_b14_comment_internal' => '',
            'review_b14_comment_internal_step' => '',
            'review_b14_ag1_comment_internal_step' => '',
            'review_b14_ag2_comment_internal_step' => '',
            'review_b14_comment_tr' => '',
            'review_b14_status' => '0',
            'review_b15_comment_internal' => '',
            'review_b15_ag1_comment_internal_step' => '',
            'review_b15_ag2_comment_internal_step' => '',
            'review_b15_comment_tr' => '',
            'review_b15_status' => '0',
            'review_b22_comment_internal' => '',
            'review_b22_comment_internal_step' => '',
            'review_b22_ag1_comment_internal_step' => '',
            'review_b22_ag2_comment_internal_step' => '',
            'review_b22_comment_tr' => '',
            'review_b22_status' => '0',
            'review_b23_comment_internal' => '',
            'review_b23_comment_internal_step' => '',
            'review_b23_ag1_comment_internal_step' => '',
            'review_b23_ag2_comment_internal_step' => '',
            'review_b23_comment_tr' => '',
            'review_b23_status' => '0',
            'review_frist_pruefbescheid' => '0',
            'erklaerungd1' => '0',
            'erklaerungd2' => '0',
            'erklaerungd3' => '0',
            'erklaerungd5' => '0',
            'status_after_review' => '0',
        ];
        $newId = $this->customDataHandler->copyRecord('tx_ieb_domain_model_ansuchen', $ansuchen->getUid(), $ansuchen->getPid(), $overrideValues);

        GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_ieb_domain_model_ansuchen')
            ->update(
                'tx_ieb_domain_model_ansuchen',
                ['nummer' => $this->createAnsuchenNummer($newId, $ansuchen->getTyp())],
                ['uid' => $newId]
            );
    }

    public function createAnsuchenNummer(int $uid, int $typ): string
    {
        return sprintf('4-%s-%s', str_pad((string)$uid, 4, '0', STR_PAD_LEFT), $typ);
    }

    public function createNewSnapshot(Ansuchen $ansuchen, Stammdaten $stammdaten): int
    {
        $overrideValues = [
            'version_active' => 1,
            'version_based_on' => $ansuchen->getUid(),
            'version' => $ansuchen->getVersion() + 1,
            'upcoming_status' => 0,
        ];
        $jsons = $this->getJsonFromRelations($ansuchen, $stammdaten);
        foreach ($jsons as $key => $value) {
            $overrideValues[$key] = $value;
        }

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

    public function updateJsonRelations(Ansuchen $ansuchen, Stammdaten $stammdaten): void
    {
        $jsons = $this->getJsonFromRelations($ansuchen, $stammdaten);
        $this->getConnection()->update(
            'tx_ieb_domain_model_ansuchen',
            $jsons,
            ['uid' => $ansuchen->getUid()]
        );
    }

    public function getJsonFromRelations(Ansuchen $ansuchen, Stammdaten $stammdaten)
    {
        $copyStandorte = $copyBerater = $copyTrainer = $copyVerantwortliche = $copyVerantwortlicheMail = [];
        if ($ansuchen->getStandorte()) {
            foreach ($ansuchen->getStandorte() as $standort) {
                $copyStandorte[$standort->getUid()] = $this->convertObjectToArray(ObjectAccess::getGettableProperties($standort));
            }
        }
        if ($ansuchen->getTrainer()) {
            foreach ($ansuchen->getTrainer() as $trainer) {
                $copyTrainer[$trainer->getUid()] = $this->convertObjectToArray(ObjectAccess::getGettableProperties($trainer));
            }
        }
        if ($ansuchen->getBerater()) {
            foreach ($ansuchen->getBerater() as $berater) {
                $copyBerater[$berater->getUid()] = $this->convertObjectToArray(ObjectAccess::getGettableProperties($berater));
            }
        }
        if ($ansuchen->getVerantwortliche()) {
            foreach ($ansuchen->getVerantwortliche() as $verantwortliche) {
                $copyVerantwortliche[$verantwortliche->getUid()] = $this->convertObjectToArray(ObjectAccess::getGettableProperties($verantwortliche));
            }
        }
        if ($ansuchen->getVerantwortlicheMail()) {
            foreach ($ansuchen->getVerantwortlicheMail() as $verantwortliche) {
                $copyVerantwortlicheMail[$verantwortliche->getUid()] = $this->convertObjectToArray(ObjectAccess::getGettableProperties($verantwortliche));
            }
        }
        $copyStammdaten = $stammdaten ? $this->convertObjectToArray(ObjectAccess::getGettableProperties($stammdaten)) : [];

        return [
            'copy_standorte' => json_encode($copyStandorte, JSON_PRETTY_PRINT),
            'copy_trainer' => json_encode($copyTrainer, JSON_PRETTY_PRINT),
            'copy_berater' => json_encode($copyBerater, JSON_PRETTY_PRINT),
            'copy_stammdaten' => json_encode($copyStammdaten, JSON_PRETTY_PRINT),
            'copy_verantwortliche' => json_encode($copyVerantwortliche, JSON_PRETTY_PRINT),
            'copy_verantwortliche_mail' => json_encode($copyVerantwortlicheMail, JSON_PRETTY_PRINT),
        ];
    }

    public function getAllEsfVersionsOfAnsuchen(Ansuchen $ansuchen)
    {
        $query = $this->getQuery();
        $query->setOrderings(['uid' => QueryInterface::ORDER_ASCENDING]);

        $constraints = [
            $query->in('status', AnsuchenStatus::statusForAkkreditiertOnly()),
            $query->equals('nummer', $ansuchen->getNummer()),
        ];
        $query->matching($query->logicalAnd($constraints));
        return $query->execute();
    }

    public function removeLockByUser(int $ansuchenId): void
    {
        $this->getConnection()->update('tx_ieb_domain_model_ansuchen',
            ['locked_by' => 0], ['uid' => $ansuchenId]
        );
    }

    public function removeGutachterLockByUser(int $ansuchenId): void
    {
        $this->getConnection()->update('tx_ieb_domain_model_ansuchen',
            ['gutachter_locked_by' => 0], ['uid' => $ansuchenId]
        );
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
                                    $out[$object->getOriginalResource()->getUid()] = [
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

    public function getFirstVersion(string $ansuchennummer)
    {
        $query = $this->getQuery();
        $constraints = [
            $query->equals('nummer', $ansuchennummer),
            $query->equals('version', 0),
        ];
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

}
