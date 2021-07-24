<?php

namespace roady\interfaces\component;

use roady\interfaces\component\OutputComponent as OutputComponentInterface;

interface DynamicOutputComponent extends OutputComponentInterface
{

    public function getSharedDynamicOutputFilesDirectoryPath(): string;

    public function getAppsDynamicOutputFilesDirectoryPath(): string;

    public function getDynamicFilePath(): string;

}
