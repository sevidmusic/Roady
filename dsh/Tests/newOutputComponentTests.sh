#!/bin/bash
# newOutputComponents.sh

set -o posix

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in newOutputComponents.sh" 'dontClear'
dsh -n App "${test_app_name}" &> /dev/null

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

testNewOutputComponentDefinesSpecifiedOutputComponentForSpecifiedApp() {
    local output_component_name
    output_component_name="OCName${RANDOM}"
    assertFileExists "dsh --new OutputComponent ${test_app_name} ${output_component_name} OCContainer 4 Output" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/OutputComponents/${output_component_name}.php" "dsh --new OutputComponent <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST create a OutputComponent configuration file at Apps/<APP_NAME>/OutputComponents/<OUTPUT_COMPONENT_NAME>.php"
}

runTest testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
runTest testNewOutputComponentDefinesSpecifiedOutputComponentForSpecifiedApp

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"
