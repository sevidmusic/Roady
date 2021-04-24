#!/bin/bash
# newGlobalResponseTests.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newGlobalResponses.sh" 'dontClear'
dsh -n App "${test_app_name}" &> /dev/null

expectedGlobalResponseFileContent() {
    local expectedRESTemplateFilePath
    expectedRESTemplateFilePath="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/GlobalResponse.php"
    expectedContent="$(cat "${expectedRESTemplateFilePath}")"
    [[ -z "${1}" ]] && logErrorMsgAndExit1 "Please specify the name of the App the new test GlobalResponse will be defined for."
    [[ -z "${2}" ]] && logErrorMsgAndExit1 "Please specify a name to assign to the new test GlobalResponse."
    [[ -z "${3}" ]] && logErrorMsgAndExit1 "Please specify a position to assign to the new test GlobalResponse."
    [[ ! -f "${expectedRESTemplateFilePath}" ]] && logErrorMsgAndExit1 "The GlobalResponse.php file template does not exist at $(determineDshDirectoryPath)/FileTemplates/GlobalResponse.php!"
    expectedContent="$(echo "${expectedContent}" | sed "s/APP_NAME/${1}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/GLOBAL_RESPONSE_NAME/${2}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/GLOBAL_RESPONSE_POSITION/${3}/g")"
    printf "%s" "${expectedContent}"
}

testNewGlobalResponseRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new GlobalResponse" "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if <APP_NAME> is not specified."
}

testNewGlobalResponseRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new GlobalResponse AppName${RANDOM} GRESName GRESPosition " "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if App does not exist."
}

testNewGlobalResponseRunsWithErrorIfAnGlobalResponseNamedGLOBAL_RESPONSE_NAMEAlreadyExists() {
    showLoadingBar "Creating test GlobalResponse GRESName for test App ${test_app_name} to be used by testNewGlobalResponseRunsWithErrorIfAnGlobalResponseNamedGLOBAL_RESPONSE_NAMEAlreadyExists()" 'dontClear'
    dsh --new GlobalResponse ${test_app_name} GRESName GRESPosition  &> /dev/null
    assertError "dsh --new GlobalResponse ${test_app_name} GRESName GRESPosition " "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if an GlobalResponse named <GLOBAL_RESPONSE_NAME> is already defined for the secified App."
}

testNewGlobalResponseRunsWithErrorIfGLOBAL_RESPONSE_NAMEIsNotSpecified() {
    assertError "dsh --new GlobalResponse ${test_app_name}" "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if <GLOBAL_RESPONSE_NAME> is not specified."
}

testNewGlobalResponseRunsWithErrorIfGLOBAL_RESPONSE_POSITIONIsNotSpecified() {
    assertError "dsh --new GlobalResponse ${test_app_name} GRESName${RANDOM}" "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if <GLOBAL_RESPONSE_POSITION> is not specified."
}

testNewGlobalResponseRunsWithErrorIfRELATIVE_URLIsNotSpecified() {
    assertError "dsh --new GlobalResponse ${test_app_name} GRESName${RANDOM} GRESPosition" "dsh --new GlobalResponse <APP_NAME> <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION>  MUST run with an error if  is not specified."
}

testNewGlobalResponseCreatesNewGlobalResponseConfigurationFileForSpecifiedApp() {
    local global_response_name
    global_response_name="GRESName${RANDOM}"
    assertFileExists "dsh --new GlobalResponse ${test_app_name} ${global_response_name} GRESPosition " "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Responses/${global_response_name}.php" "dsh --new GlobalResponse <GLOBAL_RESPONSE_NAME> <GLOBAL_RESPONSE_POSITION> <GLOBAL_RESPONSE_POSITION> <DYNAMIC_GLOBAL_RESPONSE_FILE> MUST create a GlobalResponse configuration file at Apps/<APP_NAME>/Responses/<GLOBAL_RESPONSE_NAME>.php"
}

testNewGlobalResponseCreatesNewGlobalResponseConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent() {
    local global_response_name
    global_response_name="GRESName${RANDOM}"
    dsh --new GlobalResponse ${test_app_name} ${global_response_name} GRESPosition
    assertEquals "$(expectedGlobalResponseFileContent ${test_app_name} ${global_response_name} GRESPosition )" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Responses/${global_response_name}.php")"
}

runTest testNewGlobalResponseRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewGlobalResponseRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewGlobalResponseRunsWithErrorIfAnGlobalResponseNamedGLOBAL_RESPONSE_NAMEAlreadyExists
runTest testNewGlobalResponseRunsWithErrorIfGLOBAL_RESPONSE_NAMEIsNotSpecified
runTest testNewGlobalResponseRunsWithErrorIfGLOBAL_RESPONSE_POSITIONIsNotSpecified
runTest testNewGlobalResponseCreatesNewGlobalResponseConfigurationFileForSpecifiedApp
runTest testNewGlobalResponseCreatesNewGlobalResponseConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
