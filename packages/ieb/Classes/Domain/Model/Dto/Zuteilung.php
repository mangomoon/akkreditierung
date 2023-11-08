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

    /** @var bool */
    protected $reviewVerrechnungCheck1 = false;

    /** @var bool */
    protected $reviewVerrechnungCheck2 = false;

    /** @var string */
    protected $reviewVerrechnung1 = '';

    /** @var string */
    protected $reviewVerrechnung2 = '';



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


    public function getReviewVerrechnungCheck1()
    {
        return $this->reviewVerrechnungCheck1;
    }

    public function setReviewVerrechnungCheck1(bool $reviewVerrechnungCheck1)
    {
        $this->reviewVerrechnungCheck1 = $reviewVerrechnungCheck1;
    }

    public function isReviewVerrechnungCheck1()
    {
        return $this->reviewVerrechnungCheck1;
    }

    public function getReviewVerrechnungCheck2()
    {
        return $this->reviewVerrechnungCheck2;
    }

    public function setReviewVerrechnungCheck2(bool $reviewVerrechnungCheck2)
    {
        $this->reviewVerrechnungCheck2 = $reviewVerrechnungCheck2;
    }

    public function isReviewVerrechnungCheck2()
    {
        return $this->reviewVerrechnungCheck2;
    }

    public function getReviewVerrechnung1()
    {
        return $this->reviewVerrechnung1;
    }

    public function setReviewVerrechnung1(string $reviewVerrechnung1)
    {
        $this->reviewVerrechnung1 = $reviewVerrechnung1;
    }

    public function getReviewVerrechnung2()
    {
        return $this->reviewVerrechnung2;
    }

    public function setReviewVerrechnung2(string $reviewVerrechnung2)
    {
        $this->reviewVerrechnung2 = $reviewVerrechnung2;
    }

}