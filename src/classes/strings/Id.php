<?php

namespace roady\classes\strings;

use roady\interfaces\strings\Id as IdInterface;
use roady\classes\strings\AlphanumericText;
use roady\classes\strings\Text;

class Id extends AlphanumericText implements IdInterface
{

    /**
     * Instantiate a new Id instance.
     *
     * @see Id
     *
     */
    public function __construct()
    {
        parent::__construct(
            new AlphanumericText(
                new Text($this->randomChars())
            )
        );
    }

    /**
     * Return a a random string of alphanumeric characters.
     * that is between 60 and 80 characters in length.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->randomChars();
     * // example output:
     * t9yv3izPCBrRUmlaYlRH182j4xKfTvQWQiA8zYOdSiBJJsg5sdqmxeNA5cbMAn4
     *
     * ```
     *
     */
    private function randomChars(): string
    {
        return substr(
            $this->shuffledChars(),
            0,
            rand(60, 80)
        );
    }

    /**
     * Return a large shuffled string of alphanumeric characters.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->shuffledChars();
     * // example output (excluding newlines):
     * pvwrLLtV46XXSVmQ5Gam2oDJWCThzdhK861JanSF2QM48RY849FgbTRUjUIB6s3
     * PAlthZ9KjgR1mmVRfiyCcgB1KegUCE0YWzuHyKNzhTntlFSdQpYOsxbin9z1oGu
     * Yoc6r2jex7s9aVOvD7GiunrWUNPF70HIeDO1Rj8t7eld2JrkcrPW8B2hXDnHu4b
     * OqvEPyCeTQPicS3jNIMABLX6U5kw0pGyx0wWEoMpczTAIAwBJ3QlsfkXodIxgbZ
     * 50DHxLFqEKafu5NwAGE5sk33lvYaOfCMH7NMZdJq49VLSZpqftyqmZkbvi
     *
     * ```
     *
     */
    private function shuffledChars(): string
    {
        return str_shuffle(
            str_repeat(
                str_shuffle('abcdefghijklmnopqrstuvwxyz') .
                str_shuffle('0123456789') .
                str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),
                rand(3, 5)
            )
        );
    }

}

