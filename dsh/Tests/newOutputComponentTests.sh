#!/bin/bash
# newOutputComponents.sh

set -o posix

testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --new OutputComponent Foo${RANDOM} Logo Bar 4 FooBarBaz" "--new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if App does not exist."
}

testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists() {
    assertError "dsh --new OutputComponent starterApp Logo Bar 4 FooBarBaz" "--new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if an OutputComponent named <OUTPUT_COMPONENT> is already defined for the secified App."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent starterApp" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified() {
    assertError "dsh --new OutputComponent starterApp Foo" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified() {
    assertError "dsh --new OutputComponent starterApp Foo Bar" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified() {
    assertError "dsh --new OutputComponent starterApp Foo Bar 2" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

testNewOutputComponentDefinesSpecifiedOutputComponentForSpecifiedApp() {
    local output_component_name
    output_component_name="OCName${RANDOM}"
    assertFileExists "dsh --new OutputComponent starterApp ${output_component_name} OCContainer 4 Output" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/starterApp/OutputComponents/${output_component_name}.php" "dsh --new OutputComponent <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST create a OutputComponent configuration file at Apps/<APP_NAME>/OutputComponents/<OUTPUT_COMPONENT_NAME>.php"
}

runTest testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
runTest testNewOutputComponentDefinesSpecifiedOutputComponentForSpecifiedApp
