<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Utility;

use GeorgRinger\Ieb\Domain\Model\Ansuchen;

class AnsuchenUtility
{

    public static function getMailVeranwortliche(Ansuchen $ansuchen): array
    {
        $recipients = [];
        $veranwortliche = $ansuchen->getVerantwortlicheMail();
        if (!$veranwortliche) {
            return $recipients;
        }
        foreach ($veranwortliche as $item) {
            if ($item->getEmail()) {
                $recipients[$item->getEmail()] = $item->getFullName();
            }
        }

        return $recipients;
    }
}