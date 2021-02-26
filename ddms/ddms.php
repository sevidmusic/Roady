<?php

require str_replace('ddms', '', __DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

interface DDMSCommandInterface
{
    public function run(array $argv): bool;

    public function prepareArguments(array $argv): array;

}

abstract class DDMSCommandBase implements DDMSCommandInterface
{
    public function prepareArguments(array $argv): array
    {
        $args = ['FLAGS' => [], 'OPTIONS' => []];
        foreach($argv as $position => $arg) {
            if(substr($arg, 0, 2) === '--') {
                $args['FLAGS'][str_replace('--' , '', $arg)] = [];
                $nextItemKey = $position + 1;
                while(isset($argv[$nextItemKey]) && substr($argv[$nextItemKey], 0, 2) !== '--') {
                    $args['FLAGS'][str_replace('--' , '', $arg)][] = $argv[$nextItemKey];
                    $nextItemKey++;
                }
                continue;
            }
            if (!$this->in_array_recursive($arg, $args['FLAGS'])) {
                $args['OPTIONS'][$position] = $arg;
            }
        }
        return $args;
    }

    private function in_array_recursive(string $needle, array $haystack): bool
    {
        foreach($haystack as $value) {
            if($value === $needle) {
                return true;
            }
            if (is_array($value) && $this->in_array_recursive($needle, $value)) {
                return true;
            }
        }
        return false;
    }

    abstract public function run(array $argv): bool;

}

class DDMS extends DDMSCommandBase implements DDMSCommandInterface {

    public function run(array $argv):bool {
        var_dump($argv);
        return true;
    }

    public function runCommand(DDMSCommandInterface $command, array $argv): bool {
        return $command->run($argv);
    }

}

class DDMSDevCommand extends DDMSCommandBase implements DDMSCommandInterface {

    public function run(array $argv):bool {
        var_dump($this->prepareArguments($argv));
        return true;
    }
}

$ddmsDevCommand = new DDMSDevCommand();
$ddms = new DDMS();
$ddms->run($argv);
$ddms->runCommand($ddmsDevCommand, $argv);










$process = new Process(['printf', '\n\n\e[0m\e[102m\e[30m%s\e[0m\n\n', 'The ddms command line utility is still in development.']);
$process->run();
// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

        echo $process->getOutput();

