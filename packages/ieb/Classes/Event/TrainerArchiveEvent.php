<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Event;

use GeorgRinger\Ieb\Domain\Model\Trainer;

class TrainerArchiveEvent
{

    public function __construct(
        public readonly Trainer $trainer
    )
    {

    }

}