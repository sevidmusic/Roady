<?php

namespace roady\abstractions\component;

use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\abstractions\component\OutputComponent as OutputComponentBase;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use RuntimeException;

abstract class DynamicOutputComponent extends OutputComponentBase implements DynamicOutputComponentInterface
{

    private string $appDirectoryName;
    private string $dynamicFileName;
    private string $cachedPhpOutput = '';

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable, string $appDirectoryName, string $dynamicFileName)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->appDirectoryName = $appDirectoryName;
        $this->dynamicFileName = $dynamicFileName;
    }

    private function verifyDynamicFileExists(): void
    {
        if(
            !file_exists(
                $this->getAppsDynamicOutputFilesDirectoryPath() . $this->dynamicFileName
            ) &&
            !file_exists(
                $this->getSharedDynamicOutputFilesDirectoryPath() . $this->dynamicFileName
            )
        )
        {
            throw new RuntimeException($this->getSharedDynamicOutputFilesDirectoryPath() . $this->dynamicFileName . ' file missing.');
        }
    }

    private function verifyAppDirectoryExists(): void
    {
        if(
            !is_dir(
                $this->expectedAppDirectoryPath()
            )
        )
        {
            throw new RuntimeException('App directory missing.');
        }
    }

    private function expectedAppDirectoryPath(): string
    {
        return str_replace(
            $this->currentSubDirectory(),
            'Apps' . DIRECTORY_SEPARATOR . $this->appDirectoryName,
            __DIR__
        );
    }

    private function currentSubDirectory(): string
    {
        return 'core' . DIRECTORY_SEPARATOR . 'abstractions' . DIRECTORY_SEPARATOR . 'component';
    }

    public function getSharedDynamicOutputFilesDirectoryPath(): string
    {
        $sharedDynamicOutputFilesDir = str_replace($this->currentSubDirectory(), 'SharedDynamicOutput' . DIRECTORY_SEPARATOR, __DIR__);
        if(!is_dir($sharedDynamicOutputFilesDir))
        {
            throw new RuntimeException('The Shared Dynamic Output directory does not exist.');
        }
        return $sharedDynamicOutputFilesDir;
    }


    public function getAppsDynamicOutputFilesDirectoryPath(): string
    {
        $appDynamicOutputFileDir = str_replace($this->currentSubDirectory(), 'Apps'. DIRECTORY_SEPARATOR . $this->appDirectoryName . DIRECTORY_SEPARATOR . 'DynamicOutput' . DIRECTORY_SEPARATOR, __DIR__);
        if(!is_dir($appDynamicOutputFileDir))
        {
            throw new RuntimeException('The App\'s Dynamic Output directory does not exist.');
        }

        return $appDynamicOutputFileDir;
    }

    public function getDynamicFilePath(): string
    {
        $this->verifyDynamicFileExists();
        if(file_exists($this->getAppsDynamicOutputFilesDirectoryPath() . $this->dynamicFileName))
        {
            return $this->getAppsDynamicOutputFilesDirectoryPath() . $this->dynamicFileName;
        }
        return $this->getSharedDynamicOutputFilesDirectoryPath() . $this->dynamicFileName;
    }

    private function executeDynamicFileInPhpOutputBuffer(): string
    {
        if(!empty($this->cachedPhpOutput)) {
            return $this->cachedPhpOutput;
        }
        ob_start();
        require $this->getDynamicFilePath();
        $output = ob_get_clean();
        $this->cachedPhpOutput = (
            is_string($output) 
            ? $output 
            : ''
        );
        return $this->cachedPhpOutput;
    }

    private function getDynamicFileContentsAsPlainText(): string
    {
        $content = file_get_contents($this->getDynamicFilePath());
        return (is_string($content) ? $content : '');
    }

    public function getOutput(): string
    {
        if(pathinfo($this->getDynamicFilePath(), PATHINFO_EXTENSION) === 'php') {
            $this->import(['output' => $this->executeDynamicFileInPhpOutputBuffer()]);
        } else {
            $this->import(['output' => $this->getDynamicFileContentsAsPlainText()]);
        }
        return parent::getOutput();
    }
}
