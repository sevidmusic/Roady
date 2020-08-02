<?php

namespace Extensions\Contests\core\interfaces\component\Contest;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as CoreOutputComponent;
use Extensions\Contests\core\classes\component\Contest\User;

interface Submission extends CoreOutputComponent
{

    public function getSubmitter(): User;

    public function assignMetaData(string $key, $value): void;

    public function getUrl(): string;

}
