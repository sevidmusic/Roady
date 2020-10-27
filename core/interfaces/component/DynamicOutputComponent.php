<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;

interface DynamicOutputComponent extends OutputComponentInterface
{

    public function getSharedDynamicOutputFilesDirectoryPath(): string;

    public function getAppsDynamicOutputFilesDirectoryPath(): string;

}
