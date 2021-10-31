<?php

namespace roady\interfaces\component;

use roady\interfaces\component\OutputComponent;

/**
 * A DynamicOutputComponent is an OutputComponent whose output is
 * generated from a file located either in a specific App's
 * DynamicOutput directory, or in roady's SharedDynamicOutput
 * directory.
 *
 * Methods:
 *
 * public function getState(): bool;
 * public function switchState(): bool;
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public function getOutput(): string;
 * public function increasePosition(): bool;
 * public function decreasePosition(): bool;
 * public function getPosition(): float;
 * public function getSharedDynamicOutputFilesDirectoryPath(): string;
 * public function getAppsDynamicOutputFilesDirectoryPath(): string;
 * public function getDynamicFilePath(): string;
 *
 */
interface DynamicOutputComponent extends OutputComponent
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
