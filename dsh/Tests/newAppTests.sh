#!/bin/bash
# newAppTests.sh

set -o posix

testNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new App" "dsh --new App <APP_NAME> <DOMAIN> MUST run with an error if the name to assign to the new App is not specified via the first parameter."
}

runTest testNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified
