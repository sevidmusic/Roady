<?php

namespace roady\interfaces\component;

use roady\interfaces\component\OutputComponent as OutputComponentInterface;

/**
 * A DynamicOutputComponent is an OutputComponent whose output is
 * generated from a file located either in a specific App's
 * DynamicOutput directory, or in roady's SharedDynamicOutput
 * directory.
 */
interface DynamicOutputComponent extends OutputComponentInterface
{

    /**
     * Returns the complete path to roady's SharedDynamicOutput
     * directory.
     *
     * @return string The complete path to roady's
     *                SharedDynamicOutput directory.
     */
    public function getSharedDynamicOutputFilesDirectoryPath(): string;

    /**
     * Returns the complete path to the relevant App's DynamicOutput
     * directory.
     *
     * @return string The complete path to the relevant App's
     *                DynamicOutput directory.
     */
    public function getAppsDynamicOutputFilesDirectoryPath(): string;

    /**
     * Returns the complete path to the file that generates this
     * object's output.
     *
     * @return string The complete path to the file that generates
     *                this object's output.
     */
    public function getDynamicFilePath(): string;

}
