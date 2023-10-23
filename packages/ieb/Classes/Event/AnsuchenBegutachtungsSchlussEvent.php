<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;

class AnsuchenBegutachtungsSchlussEvent
{

    public function __construct(
        public readonly Ansuchen $ansuchen,
    )
    {

    }

}