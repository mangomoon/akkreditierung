<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model\Dto;


class Zuteilung
{

    /** @var int */
    protected int $gutachter1 = 0;
    /** @var int */
    protected int $gutachter2 = 0;
    /** @var int */
    protected int $ansuchenId = 0;

    public function getGutachter1(): int
    {
        return $this->gutachter1;
    }

    public function setGutachter1(int $gutachter1): void
    {
        $this->gutachter1 = $gutachter1;
    }

    public function getGutachter2(): int
    {
        return $this->gutachter2;
    }

    public function setGutachter2(int $gutachter2): void
    {
        $this->gutachter2 = $gutachter2;
    }

    public function getAnsuchenId(): int
    {
        return $this->ansuchenId;
    }

    public function setAnsuchenId(int $ansuchenId): void
    {
        $this->ansuchenId = $ansuchenId;
    }

    public function anyGutachterSet(): bool
    {
        return $this->gutachter1 > 0 || $this->gutachter2 > 0;
    }

}