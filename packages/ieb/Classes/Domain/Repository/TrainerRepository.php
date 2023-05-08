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
        $query->matching(
            $query->logicalAnd (
                $query->equals('archiviert', false),
                $query->equals('okpsa', true)
            )
        );
        return $query->execute();
    }

}
