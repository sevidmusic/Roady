#!/bin/bash
# newResponseTests.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newResponses.sh" 'dontClear'
dsh -n App "${test_app_name}" &> /dev/null

expectedResponseFileContent() {
    local expectedRESTemplateFilePath
    expectedRESTemplateFilePath="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/Response.php"
    expectedContent="$(cat "${expectedRESTemplateFilePath}")"
    [[ -z "${1}" ]] && logErrorMsgAndExit1 "Please specify the name of the App the new test Response will be defined for."
    [[ -z "${2}" ]] && logErrorMsgAndExit1 "Please specify a name to assign to the new test Response."
    [[ -z "${3}" ]] && logErrorMsgAndExit1 "Please specify a position to assign to the new test Response."
    [[ ! -f "${expectedRESTemplateFilePath}" ]] && logErrorMsgAndExit1 "The Response.php file template does not exist at $(determineDshDirectoryPath)/FileTemplates/Response.php!"
    expectedContent="$(echo "${expectedContent}" | sed "s/APP_NAME/${1}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/RESPONSE_NAME/${2}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/RESPONSE_POSITION/${3}/g")"
    printf "%s" "${expectedContent}"
}

testNewResponseRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new Response" "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if <APP_NAME> is not specified."
}

testNewResponseRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new Response AppName${RANDOM} RESName RESPosition " "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if App does not exist."
}

testNewResponseRunsWithErrorIfAnResponseNamedRESPONSE_NAMEAlreadyExists() {
    showLoadingBar "Creating test Response RESName for test App ${test_app_name} to be used by testNewResponseRunsWithErrorIfAnResponseNamedRESPONSE_NAMEAlreadyExists()" 'dontClear'
    dsh --new Response ${test_app_name} RESName RESPosition  &> /dev/null
    assertError "dsh --new Response ${test_app_name} RESName RESPosition " "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if an Response named <RESPONSE_NAME> is already defined for the secified App."
}

testNewResponseRunsWithErrorIfRESPONSE_NAMEIsNotSpecified() {
    assertError "dsh --new Response ${test_app_name}" "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if <RESPONSE_NAME> is not specified."
}

testNewResponseRunsWithErrorIfRESPONSE_POSITIONIsNotSpecified() {
    assertError "dsh --new Response ${test_app_name} RESName${RANDOM}" "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if <RESPONSE_POSITION> is not specified."
}

testNewResponseRunsWithErrorIfRELATIVE_URLIsNotSpecified() {
    assertError "dsh --new Response ${test_app_name} RESName${RANDOM} RESPosition" "dsh --new Response <APP_NAME> <RESPONSE_NAME> <RESPONSE_POSITION>  MUST run with an error if  is not specified."
}

testNewResponseCreatesNewResponseConfigurationFileForSpecifiedApp() {
    local request_name
    request_name="RESName${RANDOM}"
    assertFileExists "dsh --new Response ${test_app_name} ${request_name} RESPosition " "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Responses/${request_name}.php" "dsh --new Response <RESPONSE_NAME> <RESPONSE_POSITION> <RESPONSE_POSITION> <DYNAMIC_RESPONSE_FILE> MUST create a Response configuration file at Apps/<APP_NAME>/Responses/<RESPONSE_NAME>.php"
}

testNewResponseCreatesNewResponseConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent() {
    local request_name
    request_name="RESName${RANDOM}"
    dsh --new Response ${test_app_name} ${request_name} RESPosition
    assertEquals "$(expectedResponseFileContent ${test_app_name} ${request_name} RESPosition )" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Responses/${request_name}.php")"
}

runTest testNewResponseRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewResponseRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewResponseRunsWithErrorIfAnResponseNamedRESPONSE_NAMEAlreadyExists
runTest testNewResponseRunsWithErrorIfRESPONSE_NAMEIsNotSpecified
runTest testNewResponseRunsWithErrorIfRESPONSE_POSITIONIsNotSpecified
runTest testNewResponseCreatesNewResponseConfigurationFileForSpecifiedApp
runTest testNewResponseCreatesNewResponseConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
