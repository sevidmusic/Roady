#!/bin/bash
# newOutputComponents.sh

set -o posix

testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
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

runTest testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified
runTest testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified
