<?php

namespace Extensions\Contests\core\abstractions\component\Actions;

use DarlingCms\abstractions\component\Action as CoreAction;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission as CreateSubmissionInterface;
use RuntimeException;

abstract class CreateSubmission extends CoreAction implements CreateSubmissionInterface
{

    private $pathToHtmlForm;
    private $componentCrud;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, string $pathToHtmlForm, ComponentCrud $componentCrud)
    {
        if (file_exists($pathToHtmlForm) === false || is_dir($pathToHtmlForm) === true) {
            throw new RuntimeException('Warning: A file does not exist at the specified path to the html form: ' . $pathToHtmlForm);
        }
        $this->pathToHtmlForm = $pathToHtmlForm;
        $this->componentCrud = $componentCrud;
        parent::__construct($storable, $switchable, $positionable);
    }

    public function getOutput(): string
    {
        if ($this->getState() === false) {
            return '';
        }
        if (!in_array($this->getUniqueId(), $this->getCurrentRequest()->getPost())) {
            $this->import(['wasDone' => true]);
            return file_get_contents($this->pathToHtmlForm);
        }
        return parent::getOutput();
    }

    public function do(): bool
    {
        $this->import(['wasDone' => true]);
        return true;
    }
}
