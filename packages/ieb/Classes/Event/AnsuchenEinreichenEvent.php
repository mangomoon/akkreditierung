<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Model\Stammdaten;

class AnsuchenEinreichenEvent
{

    public function __construct(
        public readonly AnsuchenStatus $previousStatus,
        public readonly Ansuchen $ansuchen,
        public readonly Stammdaten $stammdaten,
        public readonly array $user,
    )
    {

    }

}