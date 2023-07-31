<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */

/**
 * The repository for AngebotVerantwortliches
 */
class AngebotVerantwortlichRepository extends BaseRepository
{
    public function getActive($pid = 0) {
        $query = $this->getQuery($pid);
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
