#!/bin/bash
# buildAppTests.sh

set -o posix

testDhBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --build-app" "dsh --build-app <APP_NAME> <DOMAIN> MUST run with an error if <APP_NAME> is not specified."
}

runTest testDhBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified
