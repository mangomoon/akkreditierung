<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;

use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;

class ExternalViewFilter {

    public ?BundeslandEnum $bundesland = null;
}