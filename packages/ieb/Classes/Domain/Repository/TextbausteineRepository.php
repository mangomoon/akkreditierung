<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */
class TextbausteineRepository extends BaseRepository
{

    public function getGroupedItems(): array
    {
        $groupedItems = [];
        $all = $this->getEmptyQuery()->execute(true);
        foreach ($all as $item) {
            $groupedItems[$item['kriterium']][$item['uid']] = $item['baustein'];
        }

        return $groupedItems;
    }
}
