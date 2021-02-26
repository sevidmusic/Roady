<?php

require str_replace('ddms', '', __DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

$namedArgs = [];
$positionalArgs = [];

function in_array_recursive(string $needle, array $haystack): bool {
    foreach($haystack as $value) {
        if($value === $needle) {
            return true;
        }
        if (is_array($value) && in_array_recursive($needle, $value)) {
            return true;
        }
    }
    return false;
}

foreach($argv as $position => $arg) {
    if(substr($arg, 0, 2) === '--') {
        $nextItemKey = $position + 1;
        while(isset($argv[$nextItemKey]) && substr($argv[$nextItemKey], 0, 2) !== '--') {
            $namedArgs[str_replace('--' , '', $arg)][] = $argv[$nextItemKey];
            $nextItemKey++;
        }
        continue;
    }
    if (!in_array_recursive($arg, $namedArgs)) {
        $positionalArgs[$position] = $arg;
    }
}

$process = new Process(['printf', '\n\n\e[0m\e[102m\e[30m%s\e[0m\n\n', 'The ddms command line utility is still in development.']);
$process->run();

// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

echo $process->getOutput();

var_dump($namedArgs);
var_dump($positionalArgs);

