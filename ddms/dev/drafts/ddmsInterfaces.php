<?php

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
