<?php

namespace GeorgRinger\Ieb;

class ExtensionConfiguration
{

    protected int $userIdForDatahandler = 1;


    public function getUserIdForDatahandler(): int
    {
        return $this->userIdForDatahandler;
    }

    public static function getParentUserPid(): int
    {
        return 14;
    }


}