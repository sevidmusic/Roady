#!/bin/bash
# newOutputComponents.sh

set -o posix

test_app_name="AppName${RANDOM}"
test_doc_file_name="TestDynamicOutputFile.txt"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newOutputComponents.sh" 'dontClear'
dsh -n App "${test_app_name}"
echo " -- Test file content -- " >> "$(dsh -l)Apps/${test_app_name}/DynamicOutput/${test_doc_file_name}"

expectedDynamicOutputComponentFileContent() {
    local expectedDOCTemplateFilePath
    expectedDOCTemplateFilePath="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/DynamicOutputComponent.php"
    expectedContent="$(cat "${expectedDOCTemplateFilePath}")"
    [[ -z "${1}" ]] && logErrorMsgAndExit1 "Please specify the name of the App the new test DynamicOutputComponent will be defined for."
    [[ -z "${2}" ]] && logErrorMsgAndExit1 "Please specify a name to assign to the new test DynamicOutputComponent."
    [[ -z "${3}" ]] && logErrorMsgAndExit1 "Please specify a container to assign to the new test DynamicOutputComponent."
    [[ -z "${4}" ]] && logErrorMsgAndExit1 "Please specify a position to assign to the new test DynamicOutputComponent."
    [[ -z "${5}" ]] && logErrorMsgAndExit1 "Please specify the output to assignt to the new test DynamicOutputComponent."
    [[ ! -f "${expectedDOCTemplateFilePath}" ]] && logErrorMsgAndExit1 "The DynamicOutputComponent.php file template does not exist at $(determineDshDirectoryPath)/FileTemplates/DynamicOutputComponent.php!"
    expectedContent="$(echo "${expectedContent}" | sed "s/APP_NAME/${1}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/DYNAMIC_OUTPUT_COMPONENT_NAME/${2}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/DYNAMIC_OUTPUT_COMPONENT_CONTAINER/${3}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/DYNAMIC_OUTPUT_COMPONENT_POSITION/${4}/g")"
    expectedContent="$(echo "${expectedContent}" | sed "s/DYNAMIC_OUTPUT_FILE/${5}/g")"
    printf "%s" "${expectedContent}"
}

testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new DynamicOutputComponent AppName${RANDOM} DOCName DOCContainer 4 ${test_doc_file_name}" "--new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if App does not exist."
}

testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists() {
    showLoadingBar "Creating test DynamicOutputComponent DOCName for test App ${test_app_name} to be used by testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists()" 'dontClear'
    dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer 4 ${test_doc_file_name} &> /dev/null
    assertError "dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer 4 ${test_doc_file_name}" "--new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if an DynamicOutputComponent named <DYNAMIC_OUTPUT_COMPONENT> is already defined for the secified App."
}

testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_NAMEIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent ${test_app_name}" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_CONTAINERIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent ${test_app_name} DOCName" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_POSITIONIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer 2" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp() {
    local output_component_name
    output_component_name="DOCName${RANDOM}"
    assertFileExists "dsh --new DynamicOutputComponent ${test_app_name} ${output_component_name} DOCContainer 4 ${test_doc_file_name}" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php" "dsh --new DynamicOutputComponent <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST create a DynamicOutputComponent configuration file at Apps/<APP_NAME>/OutputComponents/<DYNAMIC_OUTPUT_COMPONENT_NAME>.php"
}

testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent() {
    local output_component_name
    output_component_name="DOCName${RANDOM}"
    dsh --new DynamicOutputComponent ${test_app_name} ${output_component_name} DOCContainer 4 ${test_doc_file_name}
    assertEquals "$(expectedDynamicOutputComponentFileContent ${test_app_name} ${output_component_name} DOCContainer 4 ${test_doc_file_name})" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php")"
}

testDshNewDynamicOutputComponentRunsWithErrorIfSpecifiedDynamicOutputFileDoesNotExist(){
    assertError "dsh -n DynamicOutputComponent "${test_app_name}" ${RANDOM}DOCName ${RANDOM}Container 0 ${RANDOM}DOCFile"
}

runTest testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
runTest testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp
runTest testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent
runTest testDshNewDynamicOutputComponentRunsWithErrorIfSpecifiedDynamicOutputFileDoesNotExist

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
