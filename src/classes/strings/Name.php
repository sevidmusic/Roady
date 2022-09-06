<?php

namespace roady\classes\strings;

use roady\classes\strings\SafeText;
use roady\interfaces\strings\Name as NameInterface;

class Name extends SafeText implements NameInterface
{

    protected function makeStringSafe(string $string): string
    {
        $string = parent::makeStringSafe($string);
        $string = substr(
            $string,
            $this->positionOfFirstAlphanumericCharacter($string),
            70
        );
        return match(
            empty($string) ||
            $string === '_' ||
            $string === '-' ||
            $string === '.'
        ) {
            true => strval(0),
            default => $string
        };
    }

    public function positionOfFirstAlphanumericCharacter(
        string $string
    ): int
    {
        $stringLength = mb_strlen($string);
        for(
            $firstAlphanumericCharacterIndex = 0;
            $firstAlphanumericCharacterIndex < $stringLength;
            $firstAlphanumericCharacterIndex++
        ) {
            if(
                ctype_alnum(
                    $string[$firstAlphanumericCharacterIndex]
                )
            ) {
                break;
            };
        }
        return $firstAlphanumericCharacterIndex;
    }

}

