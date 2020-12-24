#!/bin/bash
# newAppTests.sh

set -o posix

determineAppsDirectoryPath() {
    printf "%s" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${1}"
}

testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new App" "dsh --new App <APP_NAME> <DOMAIN> MUST run with an error if the name to assign to the new App is not specified via the first parameter."
}

testDshNewAppCreatesNewAppsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new app at $(determineAppsDirectoryPath '<APP_NAME>')."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

runTest testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshNewAppCreatesNewAppsDirectory
