<?php

require str_replace('ddms', '', __DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DDMSUserInterface {

    const ERROR = 'error';
    const NOTICE = 'notice';
    const SUCCESS = 'success';
    const WARNING = 'warning';

    public function notify(string $message, string $noticeType = self::NOTICE): void
    {
        switch($noticeType) {
            case self::ERROR:
                $message = sprintf('%s    %s    %s', PHP_EOL, "\e[0m\e[102m\e[30m" . $message . "\e[0m", PHP_EOL . PHP_EOL);
                break;
            case self::SUCCESS:
                $message = sprintf('%s    %s    %s', PHP_EOL, "\e[0m\e[104m\e[30m" . $message . "\e[0m", PHP_EOL . PHP_EOL);
                break;
            case self::WARNING:
                $message = sprintf('%s    %s    %s', PHP_EOL, "\e[0m\e[103m\e[30m" . $message . "\e[0m", PHP_EOL . PHP_EOL);
                break;
            /** NOTICE */
            default:
                $message = sprintf('%s    %s    %s', PHP_EOL, "\e[0m\e[101m\e[30m" . $message . "\e[0m", PHP_EOL . PHP_EOL);
                break;
        }
        echo $message;
    }

}

interface DDMSCommandInterface
{
    public function run(array $argv): bool;

    public function prepareArguments(array $argv): array;

}

abstract class DDMSCommandBase implements DDMSCommandInterface
{

    public function __construct(protected DDMSUserInterface $ddmsUserInterface) {}

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

    public function getCommandInstance(string $commandName, DDMSUserInterface $ddmsUserInterface): DDMSCommandInterface
    {
        switch($commandName) {
            case self::DDMSDevCommand:
                return new DDMSDevCommand($ddmsUserInterface);
        }
        return new DDMSHelp($ddmsUserInterface);
    }

}

class DDMS extends DDMSCommandBase implements DDMSCommandInterface {

    public function __construct(protected DDMSUserInterface $ddmsUserInterface, private DDMSCommandFactory $ddmsCommandFactory) {}

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
        return $this->runCommand($this->ddmsCommandFactory->getCommandInstance($commandName, $this->ddmsUserInterface), $argv);
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
        $this->ddmsUserInterface->notify('ddms is still under development.', DDMSUserInterface::NOTICE);
        return true;
    }
}

class DDMSHelp extends DDMSCommandBase implements DDMSCommandInterface {

    public function run(array $argv):bool {
        $this->ddmsUserInterface->notify('ddms is still under development.', DDMSUserInterface::NOTICE);
        $this->ddmsUserInterface->notify('ERROR COLOR', DDMSUserInterface::ERROR);
        $this->ddmsUserInterface->notify('WARNING COLOR', DDMSUserInterface::WARNING);
        $this->ddmsUserInterface->notify('SUCCESS COLOR', DDMSUserInterface::SUCCESS);
        return true;
    }
}

$ddms = new DDMS(new DDMSUserInterface(), new DDMSCommandFactory());
$ddms->run($argv);

