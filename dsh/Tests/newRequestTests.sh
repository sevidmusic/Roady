#!/bin/bash
# newRequestTests.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newRequests.sh" 'dontClear'
dsh -n App "${test_app_name}"

expectedRequestFileContent() {
    local expectedREQTemplateFilePath
    expectedREQTemplateFilePath="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/Request.php"
    expectedContent="$(cat "${expectedREQTemplateFilePath}")"
    [[ -z "${1}" ]] && logErrorMsgAndExit1 "Please specify the name of the App the new test Request will be defined for."
    [[ -z "${2}" ]] && logErrorMsgAndExit1 "Please specify a name to assign to the new test Request."
    [[ -z "${3}" ]] && logErrorMsgAndExit1 "Please specify a container to assign to the new test Request."
    [[ -z "${4}" ]] && logErrorMsgAndExit1 "Please specify the relative url to assign to the new test Request."
    [[ ! -f "${expectedREQTemplateFilePath}" ]] && logErrorMsgAndExit1 "The Request.php file template does not exist at $(determineDshDirectoryPath)/FileTemplates/Request.php!"
    expectedContent="$(echo "${expectedContent}" | sed "s/APP_NAME/${1}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/REQUEST_NAME/${2}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/REQUEST_CONTAINER/${3}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/RELATIVE_URL/${4}/g" | sed 's/\/\//\//g')"
    printf "%s" "${expectedContent}"
}

testNewRequestRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new Request" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if <APP_NAME> is not specified."
}

testNewRequestRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new Request AppName${RANDOM} REQName REQContainer REQRelativeUrl" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if App does not exist."
}

testNewRequestRunsWithErrorIfAnRequestNamedREQUEST_NAMEAlreadyExists() {
    showLoadingBar "Creating test Request REQName for test App ${test_app_name} to be used by testNewRequestRunsWithErrorIfAnRequestNamedREQUEST_NAMEAlreadyExists()" 'dontClear'
    dsh --new Request ${test_app_name} REQName REQContainer REQRelativeUrl &> /dev/null
    assertError "dsh --new Request ${test_app_name} REQName REQContainer REQRelativeUrl" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if an Request named <REQUEST_NAME> is already defined for the secified App."
}

testNewRequestRunsWithErrorIfREQUEST_NAMEIsNotSpecified() {
    assertError "dsh --new Request ${test_app_name}" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if <REQUEST_NAME> is not specified."
}

testNewRequestRunsWithErrorIfREQUEST_CONTAINERIsNotSpecified() {
    assertError "dsh --new Request ${test_app_name} REQName${RANDOM}" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if <REQUEST_CONTAINER> is not specified."
}

testNewRequestRunsWithErrorIfRELATIVE_URLIsNotSpecified() {
    assertError "dsh --new Request ${test_app_name} REQName${RANDOM} REQContainer" "dsh --new Request <APP_NAME> <REQUEST_NAME> <REQUEST_CONTAINER> <RELATIVE_URL> MUST run with an error if <RELATIVE_URL> is not specified."
}

testNewRequestCreatesNewRequestConfigurationFileForSpecifiedApp() {
    local request_name
    request_name="REQName${RANDOM}"
    assertFileExists "dsh --new Request ${test_app_name} ${request_name} REQContainer index.php" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Requests/${request_name}.php" "dsh --new Request <REQUEST_NAME> <REQUEST_CONTAINER> <REQUEST_POSITION> <DYNAMIC_REQUEST_FILE> MUST create a Request configuration file at Apps/<APP_NAME>/Requests/<REQUEST_NAME>.php"
}

testNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent() {
    local request_name
    request_name="REQName${RANDOM}"
    dsh --new Request ${test_app_name} ${request_name} REQContainer "\/"
    assertEquals "$(expectedRequestFileContent ${test_app_name} ${request_name} REQContainer "\/")" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Requests/${request_name}.php")"
}
runTest testNewRequestRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewRequestRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewRequestRunsWithErrorIfAnRequestNamedREQUEST_NAMEAlreadyExists
runTest testNewRequestRunsWithErrorIfREQUEST_NAMEIsNotSpecified
runTest testNewRequestRunsWithErrorIfREQUEST_CONTAINERIsNotSpecified
runTest testNewRequestRunsWithErrorIfRELATIVE_URLIsNotSpecified
runTest testNewRequestCreatesNewRequestConfigurationFileForSpecifiedApp
runTest testNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
