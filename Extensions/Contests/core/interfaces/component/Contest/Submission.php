<?php

namespace Extensions\Contests\core\interfaces\component\Contest;

use DarlingCms\interfaces\component\OutputComponent as CoreOutputComponent;
use Extensions\Contests\core\classes\component\Contest\Submitter;

interface Submission extends CoreOutputComponent
{

    public function getSubmitter(): Submitter;

    public function assignMetaData(string $key, $value): void;

    public function getPathToSubmittedFile(): string;

}
