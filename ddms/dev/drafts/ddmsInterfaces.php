<?php


interface ddms {
    /**
     * Process $argv, and construct a mutlidimensional array of OPTIONS, --flags,
     * and values passed to --flags. For example, the following hypothetical
     * pseudo command:
     *
     *     `ddms OPTION1 OPTION2 OPTION3 --standAloneFlag1 --multiArgFlag1 value1 value2 --standAloneFlag2 --standAloneFlag3 --multiArgFlag2 foo bar bazzer`
     *
     * MUST result in $ddms->getArguments() returning the following array:
     *
     * array(2) {
     *   ["FLAGS"]=>
     *   array(5) {
     *     ["standAloneFlag1"]=>
     *     array(0) {
     *     }
     *     ["multiArgFlag1"]=>
     *     array(2) {
     *       [0]=>
     *       string(6) "value1"
     *       [1]=>
     *       string(6) "value2"
     *     }
     *     ["standAloneFlag2"]=>
     *     array(0) {
     *     }
     *     ["standAloneFlag3"]=>
     *     array(0) {
     *     }
     *     ["multiArgFlag2"]=>
     *     array(3) {
     *       [0]=>
     *       string(3) "foo"
     *       [1]=>
     *       string(3) "bar"
     *       [2]=>
     *       string(6) "bazzer"
     *     }
     *   }
     *   ["OPTIONS"]=>
     *   array(4) {
     *     [0]=>
     *     string(65) "/home/darling/Downloads/DarlingDataManagementSystem/ddms/ddms.php"
     *     [1]=>
     *     string(7) "OPTION1"
     *     [2]=>
     *     string(7) "OPTION2"
     *     [3]=>
     *     string(7) "OPTION3"
     *   }
     * }
     */
    public function getArguments(): array;
}

interface ddmsCommandException {

}

interface ddmsCommand
{
    /**
     * Returns a help message as a string.
     * @param array $options Optional array of options that may effect the resulting
     *                       help message. Implementations are not required to make
     *                       use of this array, and should only do so if appropriate.
     */
    public function help(array $options = []): string;

}

interface ddmsNew extends ddmsCommand
{
    public function newApp(string $name, string $domain = ''): bool;

    public function newRequest(string $name, $relativeUrl): bool;

    /**
     * Corresponds to ddms command:
     *
     *     ddms --new Response --name NAME --for-app APP_NAME --position FLOAT --respond-to-urls index.php index.php?page=home
     *
     * @param string $name The name to assign to the Response.
     * @param string $forApp The name of the App the Response will be defined for.
     * @param string $position The position to assign the Response, defaults to 0 if not specified.
     */
    public function newResponse(string $name, string $forApp, float $position = 0): bool;
}
