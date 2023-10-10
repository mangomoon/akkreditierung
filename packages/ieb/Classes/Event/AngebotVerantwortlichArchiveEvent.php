<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Model\AngebotVerantwortlich;

class AngebotVerantwortlichArchiveEvent
{

    public function __construct(
        public readonly AngebotVerantwortlich $angebotVerantwortlich
    )
    {

    }

}