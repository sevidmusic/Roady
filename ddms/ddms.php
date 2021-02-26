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

class DDMSCommandFactory
{
    public const DDMSDevCommand = 'DDMSDevCommand';

    public function getCommandInstance(string $commandName): DDMSCommandInterface
    {
        switch($commandName) {
            case self::DDMSDevCommand:
                return new DDMSDevCommand();
        }
        return new DDMSHelp();
    }

}

class DDMS extends DDMSCommandBase implements DDMSCommandInterface {

    private $ddmsCommandFactory;

    public function __construct(DDMSCommandFactory $ddmsCommandFactory) {
        $this->ddmsCommandFactory = $ddmsCommandFactory;
    }

    private function determineDDMSCommandName(array $argv)
    {
        foreach($argv as $argument) {
            if(substr($argument, 0, 2) === '--') {
                return $this->convertFlagToCommandName($argument);
            }
        }
        return 'DDMSHelp';
    }

    public function run(array $argv):bool {
        $commandName = $this->determineDDMSCommandName($argv);
        return $this->runCommand($this->ddmsCommandFactory->getCommandInstance($commandName), $argv);
    }

    public function runCommand(DDMSCommandInterface $command, array $argv): bool {
        return $command->run($argv);
    }

    private function convertFlagToCommandName($string)
    {
        return 'DDMS' . str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

}

class DDMSDevCommand extends DDMSCommandBase implements DDMSCommandInterface {

    public function run(array $argv):bool {
        var_dump('DDMS Dev Command', $this->prepareArguments($argv));
        return true;
    }
}

class DDMSHelp extends DDMSCommandBase implements DDMSCommandInterface {

    public function run(array $argv):bool {
        var_dump('DDMS HELP', $this->prepareArguments($argv));
        return true;
    }
}

$ddms = new DDMS(new DDMSCommandFactory());
$ddms->run($argv);










$process = new Process(['printf', '\n\n\e[0m\e[102m\e[30m%s\e[0m\n\n', 'The ddms command line utility is still in development.']);
$process->run();
// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

        echo $process->getOutput();

