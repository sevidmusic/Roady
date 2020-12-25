#!/bin/bash
# newOutputComponents.sh

set -o posix

testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new OutputComponent" "dsh --new OutputComponent <APP_NAME> <OUTPUT_COMPONENT_NAME> <OUTPUT_COMPONENT_CONTAINER> <OUTPUT_COMPONENT_POSITION> <OUTPUT> MUST run with an error if <APP_NAME> is not specified."
}

runTest testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified
