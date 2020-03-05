<?php

require(__DIR__ . '/DemoFunctions.php');

ini_set('display_errors', true);

const REQUEST_LOCATION = 'Web';
const REQUEST_CONTAINER = 'Request';
const RESPONSE_LOCATION = 'Web';
const RESPONSE_CONTAINER = 'Response';
const TEMPLATE_LOCATION = 'UserInterface';
const TEMPLATE_CONTAINER = 'Template';
const OUTPUT_COMPONENT_LOCATION = 'Output';
const OUTPUT_COMPONENT_CONTAINER = 'Mock';

processFormIfSubmitted(getMockCrud());
echo getHtml();

function getBody(): string
{
    return (
    empty(getCurrentRequest()->getGet()) === true
        ? '
                <body class="gradientBg">
                    <div id="welcome" class="genericContainer genericContainerLimitedHeight">' . getWelcomeMessage() . '</div>
                    <div id="formContainer" class="genericContainer genericContainerLimitedHeight">' . getForm() . '</div>
                    <div id="requestMenu" class="genericContainer genericContainerLimitedHeight">' . getCurrentRequestInfo() . '</div>
                    ' . (empty(getStoredRequestMenu(getMockCrud())) ? "" : '<div class="genericContainer">' . getStoredRequestMenu(getMockCrud()) . '</div>') . '
                        ' . getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest() . '
                ' . (str_replace([' ', PHP_EOL], '', getScripts()) === '<script></script>' ? '' : getScripts() . PHP_EOL) . '
                </body>'
        : getCollectiveOutputFromOutputAssignedToResponsesToCurrentRequest()
    );
}

function getWelcomeMessage(): string
{
    return <<<'HTML'
    <h1 class="noticeText">Welcome</h1>
    <p class="successText">
        This is a demonstration the possible relationships/interactions of a<span class="highlightText"> Request</span>,  
        <span class="highlightText"> Router</span>, <span class="highlightText"> Response</span>,   
        <span class="highlightText"> Crud</span>,<span class="highlightText"> Template</span>, and 
        <span class="highlightText"> OutputComponent</span>.
    </p>
    <p class="successText">
        It currently demonstrates how a stored <span class="highlightText"> Response</span> that responds
        to the current <span class="highlightText"> Request</span> can be used to determine what
        <span class="highlightText"> OutputComponent(s)</span>
        is/are used to generate output for the <span class="highlightText"> Request</span>, and which <span class="highlightText"> Template(s)</span> is/are used to 
        organize that output.
    </p>
HTML;
}


