<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;

class HashService
{

    private const ADDITIONAL_SALT = '_ieb';

    public static function generate(string $data): string
    {
        $key = $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'];
        if (!$key) {
            throw new InvalidArgumentForHashGenerationException('Encryption Key was empty!', 1255069597);
        }
        $key .= self::ADDITIONAL_SALT;
        return hash_hmac('sha1', $data, $key);
    }

    public static function validate(string $data, string $hash): bool
    {
        return hash_equals(self::generate($data), $hash);
    }

}