<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Model\Berater;

class BeraterArchiveEvent
{

    public function __construct(
        public readonly Berater $berater
    )
    {

    }

}