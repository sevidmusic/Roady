<?php

namespace roady\interfaces\component;

use roady\interfaces\component\OutputComponent as OutputComponentInterface;

/**
 * This interface defines an object that implements the
 * OutputComponent interface whose output is generated from
 * a file located either in a specific App's DynamicOutput
 * directory, or in roady's SharedDynamicOutput directory.
 */
interface DynamicOutputComponent extends OutputComponentInterface
{

    /**
     * @return string The complete path to roady's
     * SharedDynamicOutput directory.
     */
    public function getSharedDynamicOutputFilesDirectoryPath(): string;

    /**
     * @return string The complete path to the relevant App's
     * DynamicOutput directory.
     */
    public function getAppsDynamicOutputFilesDirectoryPath(): string;

    /**
     * @return string The complete path to the file that generates this
     * object's output.
     */
    public function getDynamicFilePath(): string;

}
