<?php

namespace Extensions\Contests\core\abstractions\component\Actions;

use DarlingDataManagementSystem\abstractions\component\Action as CoreAction;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;
use Extensions\Contests\core\classes\component\Contest\Submission;
use Extensions\Contests\core\classes\component\Contest\User;
use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission as CreateSubmissionInterface;
use RuntimeException;

abstract class CreateSubmission extends CoreAction implements CreateSubmissionInterface
{

    private const ERR_HTML_FORM_NOT_FOUND = 'Warning | %s Error: The specified html form could not be found: %s. Component Name: %s | Component Id: %s | Component Location: %s | Component Container: %s';
    private const ERR_BAD_EMAIL = '<p class="create-submission-error">%s is not a valid email. Please enter a valid email.</p>%s';
    private const ERR_BAD_URL = '<p class="create-submission-error">%s is not a valid YouTube url. Please enter a valid YouTube url.</p>%s';
    private const DO_SUCCESS_MESSAGE_SPRINT = '<span id="formAnchor"></span><div class="created-submission-preview-container"><p class="created-submission-preview-message">Thank you for your submission.</p><div class="created-submission-preview-submission-output">%s</div></div>';
    private $pathToHtmlForm;
    private $componentCrud;

    public function __construct(
        Storable $storable,
        Switchable $switchable,
        Positionable $positionable,
        string $pathToHtmlForm,
        ComponentCrud $componentCrud
    )
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
            $newSubmission = $this->generateSubmissionFromPostData();
            $this->componentCrud->create($newSubmission);
            $this->assignDoSuccessMessageToOutput($newSubmission);
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
        if (
        !filter_var(
            $this->getCurrentRequest()->getPost()['submitterEmail'],
            FILTER_VALIDATE_EMAIL
        )
        ) {
            $this->assignBadEmailErrorMessageToOutput(
                $this->getCurrentRequest()->getPost()['submitterEmail']
            );
            return false;
        }
        if (
        !preg_match(
            '/http.?:\/\/.*youtu.?be/',
            $this->getCurrentRequest()->getPost()['submissionUrl']
        )
        ) {
            $this->assignBadYouTubeUrlErrorMessageToOutput(
                $this->getCurrentRequest()->getPost()['submissionUrl']
            );
            return false;
        }
        return true;
    }

    private function assignBadEmailErrorMessageToOutput(string $badEmail): void
    {
        $this->import(
            [
                'output' => sprintf(
                    self::ERR_BAD_EMAIL,
                    $badEmail,
                    $this->assignUniqueIdToForm(file_get_contents($this->pathToHtmlForm))
                ),
            ]
        );
    }

    private function assignBadYouTubeUrlErrorMessageToOutput(string $badUrl): void
    {
        $this->import(
            [
                'output' => sprintf(
                    self::ERR_BAD_URL,
                    $badUrl,
                    $this->assignUniqueIdToForm(file_get_contents($this->pathToHtmlForm))
                ),
            ]
        );
    }

    private function generateSubmissionFromPostData(): Submission
    {
        return new Submission(
            new \DarlingDataManagementSystem\classes\primary\Storable(
                $this->getCurrentRequest()->getPost()['submissionName'],
                App::deriveNameLocationFromRequest($this->getCurrentRequest()),
                $this->getCurrentRequest()->getPost()['submissionContainer']
            ),
            new \DarlingDataManagementSystem\classes\primary\Switchable(),
            new \DarlingDataManagementSystem\classes\primary\Positionable(
                floatval($this->getCurrentRequest()->getPost()['submissionPosition'])
            ),
            new User(
                new \DarlingDataManagementSystem\classes\primary\Storable(
                    $this->getCurrentRequest()->getPost()['submitterName'],
                    App::deriveNameLocationFromRequest($this->getCurrentRequest()),
                    $this->getCurrentRequest()->getPost()['submitterContainer']
                ),
                $this->getCurrentRequest()->getPost()['submitterEmail']
            ),
            $this->formatYoutubeUrlsAsEmbedUrl($this->getCurrentRequest()->getPost()['submissionUrl'])
        );
    }

    private function formatYoutubeUrlsAsEmbedUrl(string $url): string
    {
        return str_replace(['watch?v=', 'youtu.be'], ['embed/', 'www.youtube.com/embed'], $url);
    }

    private function assignDoSuccessMessageToOutput(Submission $newSubmission): void
    {
        $this->import(
            [
                'output' => sprintf(
                    self::DO_SUCCESS_MESSAGE_SPRINT,
                    $newSubmission->getOutput()
                ),
            ]
        );
    }

    public function getPathToHtmlForm(): string
    {
        if (
            file_exists($this->pathToHtmlForm) === false
            ||
            is_dir($this->pathToHtmlForm) === true
        ) {
            throw new RuntimeException(
                sprintf(
                    self::ERR_HTML_FORM_NOT_FOUND,
                    $this->getType(),
                    $this->pathToHtmlForm,
                    $this->getName(),
                    $this->getUniqueId(),
                    $this->getLocation(),
                    $this->getContainer()
                )
            );
        }
        return $this->pathToHtmlForm;
    }
}
