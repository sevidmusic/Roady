<?php


namespace DarlingCms\dev\traits;


trait Logger
{
    private $logging = false;

    protected function log($sprintFormattedMessage, string ...$sprints)
    {
        if ($this->logging === true) {
            $msgArr = [$sprintFormattedMessage];
            $args = array_merge($msgArr, $sprints);
            error_log(PHP_EOL . call_user_func_array('sprintf', $args));
        }
    }
}