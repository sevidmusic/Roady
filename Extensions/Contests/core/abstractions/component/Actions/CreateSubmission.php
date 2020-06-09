<?php

namespace Extensions\Contests\core\abstractions\component\Actions;

use DarlingCms\abstractions\component\Action as CoreAction;
use DarlingCms\classes\component\Web\App;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use Extensions\Contests\core\classes\component\Contest\Submission;
use Extensions\Contests\core\classes\component\Contest\Submitter;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission as CreateSubmissionInterface;
use RuntimeException;

abstract class CreateSubmission extends CoreAction implements CreateSubmissionInterface
{

    private $pathToHtmlForm;
    private $componentCrud;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, string $pathToHtmlForm, ComponentCrud $componentCrud)
    {
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
            $this->import(['output' =>
                $this->assignUniqueIdToForm(file_get_contents($this->pathToHtmlForm))
            ]);
        }
        return parent::getOutput();
    }

    private function assignUniqueIdToForm(string $formHtml): string
    {
        return str_replace(
            'UNIQUE_ID',
            $this->getUniqueId(),
            $formHtml
        );
    }

    public function do(): bool
    {
        $this->import(['wasDone' => true]);
        if ($this->postDataIsAsExpected() === true) {
            $this->componentCrud->create(
                new Submission(
                    new \DarlingCms\classes\primary\Storable(
                        $this->getCurrentRequest()->getPost()['submissionName'],
                        App::deriveNameLocationFromRequest($this->getCurrentRequest()),
                        $this->getCurrentRequest()->getPost()['submissionContainer']
                    ),
                    new \DarlingCms\classes\primary\Switchable(),
                    new \DarlingCms\classes\primary\Positionable(
                        floatval($this->getCurrentRequest()->getPost()['submissionPosition'])
                    ),
                    new Submitter(
                        new \DarlingCms\classes\primary\Storable(
                            $this->getCurrentRequest()->getPost()['submitterName'],
                            App::deriveNameLocationFromRequest($this->getCurrentRequest()),
                            $this->getCurrentRequest()->getPost()['submitterContainer']
                        ),
                        $this->getCurrentRequest()->getPost()['submitterEmail']
                    ),
                    $this->getCurrentRequest()->getPost()['submissionUrl']
                )
            );
        }
        return $this->wasDone();
    }

    private function postDataIsAsExpected(): bool
    {
        $postDataKeys = array_keys($this->getCurrentRequest()->getPost());
        if (
            !in_array($this->getUniqueId(), $this->getCurrentRequest()->getPost())
            ||
            !in_array('CreateSubmissionUniqueId', $postDataKeys)
            ||
            !in_array('submitterName', $postDataKeys)
            ||
            !in_array('submitterContainer', $postDataKeys)
            ||
            !in_array('submitterEmail', $postDataKeys)
            ||
            !in_array('submissionUrl', $postDataKeys)
            ||
            !in_array('submissionName', $postDataKeys)
            ||
            !in_array('submissionContainer', $postDataKeys)
        ) {
            return false;
        }
        return true;
    }

    public function getPathToHtmlForm(): string
    {
        if (file_exists($this->pathToHtmlForm) === false || is_dir($this->pathToHtmlForm) === true) {
            throw new RuntimeException('Warning: A file does not exist at the specified path to the html form: ' . $this->pathToHtmlForm);
        }
        return $this->pathToHtmlForm;
    }
}
