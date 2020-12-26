#!/bin/bash
# newOutputComponents.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newOutputComponents.sh" 'dontClear'
dsh -n App "${test_app_name}" &> /dev/null

testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new DynamicOutputComponent" "dsh --new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if <APP_NAME> is not specified."
}

testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new DynamicOutputComponent AppName${RANDOM} DOCName DOCContainer 4 DynamicOutputFileName.txt" "--new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if App does not exist."
}

testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists() {
    showLoadingBar "Creating test DynamicOutputComponent DOCName for test App ${test_app_name} to be used by testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists()" 'dontClear'
    dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer 4 DynamicOutputFileName.txt &> /dev/null
    assertError "dsh --new DynamicOutputComponent ${test_app_name} DOCName DOCContainer 4 DynamicOutputFileName.txt" "--new DynamicOutputComponent <APP_NAME> <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST run with an error if an DynamicOutputComponent named <DYNAMIC_OUTPUT_COMPONENT> is already defined for the secified App."
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

testNewDynamicOutputComponentDefinesSpecifiedDynamicOutputComponentForSpecifiedApp() {
    local output_component_name
    output_component_name="DOCName${RANDOM}"
    assertFileExists "dsh --new DynamicOutputComponent ${test_app_name} ${output_component_name} DOCContainer 4 DynamicOutputFileName.txt" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php" "dsh --new DynamicOutputComponent <DYNAMIC_OUTPUT_COMPONENT_NAME> <DYNAMIC_OUTPUT_COMPONENT_CONTAINER> <DYNAMIC_OUTPUT_COMPONENT_POSITION> <DYNAMIC_OUTPUT_FILE> MUST create a DynamicOutputComponent configuration file at Apps/<APP_NAME>/OutputComponents/<DYNAMIC_OUTPUT_COMPONENT_NAME>.php"
}

runTest testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewDynamicOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
runTest testNewDynamicOutputComponentDefinesSpecifiedDynamicOutputComponentForSpecifiedApp

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
