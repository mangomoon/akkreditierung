<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;

class AnsuchenBegutachtungFinalizeAfterSnapshotEvent
{

    public function __construct(
        public readonly Ansuchen $ansuchenAfterSnapshot,
        public readonly Ansuchen $ansuchenOld,
        public readonly Stammdaten $stammdaten,
    )
    {

    }

}