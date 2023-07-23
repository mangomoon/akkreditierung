<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Model\Dto\BeraterSearch;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

class BeraterRepository extends BaseRepository
{


    public function findBySearch(?BeraterSearch $search)
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


    public function getActive() {


        $query = $this->getQuery();
        $query->setOrderings(array('nachname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        $query->matching(
            $query->logicalAnd (
                $query->equals('archiviert', false),
                $query->equals('ok', true)
            )
        );
        return $query->execute();
    }
    
}
