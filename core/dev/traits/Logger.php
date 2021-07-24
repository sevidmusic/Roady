<?php


namespace roady\dev\traits;


trait Logger
{
    private bool $logging = false;

    protected function log(string $sprintFormattedMessage, string ...$sprints): void
    {
        if ($this->logging === true) {
            $msgArr = [$sprintFormattedMessage];
            $args = array_merge($msgArr, $sprints);
            error_log(PHP_EOL . call_user_func_array('sprintf', $args));
        }
    }

    protected function turnLoggingOn(): void
    {
        $this->logging = true;
    }

    protected function turnLoggingOff(): void
    {
        $this->logging = false;
    }

}
