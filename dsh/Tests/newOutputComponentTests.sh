#!/bin/bash
# newOutputComponents.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newOutputComponents.sh" 'dontClear'
dsh -n App "${test_app_name}" &> /dev/null

expectedOutputComponentFileContent() {
    local expectedOCTemplateFilePath
    expectedOCTemplateFilePath="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/OutputComponent.php"
    expectedContent="$(cat "${expectedOCTemplateFilePath}")"
    [[ -z "${1}" ]] && logErrorMsgAndExit1 "Please specify the name of the App the new test OutputComponent will be defined for."
    [[ -z "${2}" ]] && logErrorMsgAndExit1 "Please specify a name to assign to the new test OutputComponent."
    [[ -z "${3}" ]] && logErrorMsgAndExit1 "Please specify a container to assign to the new test OutputComponent."
    [[ -z "${4}" ]] && logErrorMsgAndExit1 "Please specify a position to assign to the new test OutputComponent."
    [[ -z "${5}" ]] && logErrorMsgAndExit1 "Please specify the output to assignt to the new test OutputComponent."
    [[ ! -f "${expectedOCTemplateFilePath}" ]] && logErrorMsgAndExit1 "The OutputComponent.php file template does not exist at $(determineDshDirectoryPath)/FileTemplates/OutputComponent.php!"
    expectedContent="$(echo "${expectedContent}" | sed "s/APP_NAME/${1}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/OUTPUT_COMPONENT_NAME/${2}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/OUTPUT_COMPONENT_CONTAINER/${3}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/OUTPUT_COMPONENT_POSITION/${4}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/OUTPUT/${5}/g")"
    printf "%s" "${expectedContent}"
}

testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new OutputComponent AppName${RANDOM} OCName OCContainer 4 Output" "--new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if App does not exist."
}

testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists() {
    showLoadingBar "Creating test OutputComponent OCName for test App ${test_app_name} to be used by testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists()" 'dontClear'
    dsh --new OutputComponent ${test_app_name} OCName OCContainer 4 Output &> /dev/null
    assertError "dsh --new OutputComponent ${test_app_name} OCName OCContainer 4 Output" "--new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if an OutputComponent named <OUTPUT_COMPONENT> is already defined for the secified App."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent ${test_app_name}" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified() {
    assertError "dsh --new OutputComponent ${test_app_name} AppName" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified() {
    assertError "dsh --new OutputComponent ${test_app_name} AppName OCName" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified() {
    assertError "dsh --new OutputComponent ${test_app_name} AppName OCName 2" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp() {
    local output_component_name
    output_component_name="OCName${RANDOM}"
    assertFileExists "dsh --new OutputComponent ${test_app_name} ${output_component_name} OCContainer 4 Output" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php" "dsh --new OutputComponent <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST create a OutputComponent configuration file at Apps/<APP_NAME>/OutputComponents/<OUTPUT_COMPONENT_NAME>.php"
}

testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent() {
    local output_component_name
    output_component_name="OCName${RANDOM}"
    dsh --new OutputComponent ${test_app_name} ${output_component_name} OCContainer 4 "Foo bar baz"
    assertEquals "$(expectedOutputComponentFileContent ${test_app_name} ${output_component_name} OCContainer 4 "Foo bar baz")" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php")"
}
runTest testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
runTest testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp
runTest testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
