<?php

namespace Extensions\Contests\core\abstractions\component\Actions;

use DarlingCms\abstractions\component\Action as CoreAction;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission as CreateSubmissionInterface;
use RuntimeException;

abstract class CreateSubmission extends CoreAction implements CreateSubmissionInterface
{

    private $pathToHtmlForm;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, string $pathToHtmlForm)
    {
        if (file_exists($pathToHtmlForm) === false || is_dir($pathToHtmlForm) === true) {
            throw new RuntimeException('Warning: A file does not exist at the specified path to the html form: ' . $pathToHtmlForm);
        }
        $this->pathToHtmlForm = $pathToHtmlForm;
        parent::__construct($storable, $switchable, $positionable);
    }

}
