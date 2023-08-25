<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Model\Dto\TrainerSearch;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class TrainerRepository extends BaseRepository
{

    public function findBySearch(?TrainerSearch $search)
    {
        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        if (!$search) {
            return $query->execute();
        }

        $constraints = [];
        if ($search->nachname) {
            $constraints[] = $query->like('nachname', '%' . $search->nachname . '%');
        }
        if ($search->vorname) {
            $constraints[] = $query->like('vorname', '%' . $search->vorname . '%');
        }
        if ($constraints) {
            $query->matching($query->logicalAnd($constraints));
        }
        return $query->execute();
    }

    public function getActiveBabi() {


        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        $query->matching(
            $query->logicalAnd (
                $query->equals('archiviert', false),
                $query->equals('okbabi', true)
            )
        );
        return $query->execute();
    }

    public function getActivePSA() {


        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        $query->matching(
            $query->logicalAnd (
                $query->equals('archiviert', false),
                $query->equals('okpsa', true)
            )
        );
        return $query->execute();
    }
    public function getInactiveBabi() {


        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        $query->matching(
            $query->logicalAnd (
                $query->equals('archiviert', false),
                $query->logicalOr (
                    $query->greaterThan('reviewC21BabiStatus', 2),
                    $query->greaterThan('reviewC22BabiStatus', 2)
                )
            )
        );
        return $query->execute();
    }

    public function getInactivePSA() {


        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        $query->matching(
            $query->logicalOr (
                $query->equals('archiviert', true),
                $query->logicalOr (
                    $query->greaterThan('reviewC21PsaStatus', 2),
                    $query->greaterThan('reviewC22PsaStatus', 2)
                )
            )
        );
        return $query->execute();
    }
}
