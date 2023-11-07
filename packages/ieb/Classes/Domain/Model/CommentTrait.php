<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;

trait CommentTrait
{

    protected function getConvertedJson(string $input): array
    {
        $final = [];
        foreach ((array)json_decode($input, true) as $item) {
            if (is_array($item)) {
                $final[] = $item;
            }
        }
        return $final;
    }

    /**
     * @param string $input
     */
    protected function getConvertedJsonSimple(string $input)
    {
        return json_decode($input, true);
    }


}