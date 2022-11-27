<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;


use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Service\CustomDataHandler;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

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


    public function clone(Ansuchen $ansuchen): void
    {
        // todo clear all review fields?
        $overrideValues = [
            'status' => 10,
            'name' => $ansuchen->getName() . ' [KOPIE]',
            'kopie_von' => $ansuchen->getUid(),
        ];
        $this->customDataHandler->copyRecord('tx_ieb_domain_model_ansuchen', $ansuchen->getUid(), $ansuchen->getPid(), $overrideValues);
    }
}
