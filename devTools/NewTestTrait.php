<?php

/**
 * This script can be used to automate the creation of a new TestTrait
 * for a specified interface.
 *
 * This script will not write anything to disk. Instead, the code
 * generated for the new TestTrait will be sent to stdout.
 *
 * Usage:
 *
 * ```
 * # Assuming current directory is roady's root directory:
 *
 * # To preview:
 * php devTools/NewTestTraits.php 'ClassName' 'Sub\Name\Space'
 *
 * # To write:
 * php devTools/NewTestTraits.php 'ClassName' 'Sub\Name\Space' > path/to/write/to/ClassNameTestTrait.php
 */

try {
    throwErrorIfNameAndSubnamespaceWereNotSpecified();
    createNewTestTrait(
        strval(getArguments()['name']),
        strval(getArguments()['subnamespace'])
    );
} catch (Exception $e) {
    echo PHP_EOL . $e->getMessage() . PHP_EOL;
}


/**
 * -- Functions --
 */

function templatePath(): string
{
    return strval(
        realpath(
            __DIR__ .
            DIRECTORY_SEPARATOR .
            'templates' .
            DIRECTORY_SEPARATOR .
            'TestTrait.php'
        )
    );
}

/**
 * Return the specified arguments in an array.
 *
 * @return array<string, array<int, mixed>|string|false> Array: ['name' => 'value', 'subnamespace' => 'value']
 */
function getArguments(): array
{
    $args = getopt('', ['name:', 'subnamespace:']);
    return (is_array($args) ? $args : []);
}

function throwErrorIfNameAndSubnamespaceWereNotSpecified(): void
{
    $args = getArguments();
    match(isset($args['name']) && isset($args['subnamespace'])) {
        true => true,
        default => throw new exception(
            'You must specify a --name and --subnamespace.'
        ),
    };
}

function createNewTestTrait(string $className, string $subNamespace): void
{
    $templatePath = templatePath();
    echo match(file_exists($templatePath)) {
        true => generateNewTestTriatFromTemplate($className, $subNamespace),
        default => throw new exception(
            'Error: A TestTrait template file was not found at: ' .
            $templatePath
        ),
    };
}

/**
 * Overview of expected TestTrait Template placeholders:
 *
 * __SUB_NAMESPACE__           The sub namespace to use for the
 *                             new TestTrait.
 *
 * __TARGET_CLASS_NAME__       The name of the interface the TestTrait
 *                             will define tests for.
 *
 * __LC_TARGET_CLASS_NAME__    Lower case form of the name of the
 *                             interface the TestTrait will define
 *                             tests for.
 */
function generateNewTestTriatFromTemplate(string $className, string $subNamespace): string
{
    $template = strval(file_get_contents(templatePath()));
    return str_replace(
        [
            '__TARGET_CLASS_NAME__',
            '__SUB_NAMESPACE__',
            '__LC_TARGET_CLASS_NAME__',
        ],
        [
            $className,
            $subNamespace,
            lcfirst($className)
        ],
        $template
    );

}



