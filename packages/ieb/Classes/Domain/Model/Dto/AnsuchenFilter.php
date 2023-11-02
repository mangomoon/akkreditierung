<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;


class AnsuchenFilter
{

    public string $mode = '';
    public array $status = [];
    public int $bundesland = 0;

}