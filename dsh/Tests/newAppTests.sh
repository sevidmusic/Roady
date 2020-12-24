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
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App at $(determineAppsDirectoryPath '<APP_NAME>')."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsOutputComponentsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/OutputComponents" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's OutputComponents at $(determineAppsDirectoryPath '<APP_NAME>')/OutputComponents."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsRequestsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/Requests" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's Requests at $(determineAppsDirectoryPath '<APP_NAME>')/Requests."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsResponsesDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/Responses" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's Responses at $(determineAppsDirectoryPath '<APP_NAME>')/Responses."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsDynamicOutputDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/DynamicOutput" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's DynamicOutput at $(determineAppsDirectoryPath '<APP_NAME>')/DynamicOutput."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsCssDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/css" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's css at $(determineAppsDirectoryPath '<APP_NAME>')/css."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsJsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/js" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's js at $(determineAppsDirectoryPath '<APP_NAME>')/js."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

runTest testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshNewAppCreatesNewAppsDirectory
runTest testDshNewAppCreatesNewAppsOutputComponentsDirectory
runTest testDshNewAppCreatesNewAppsRequestsDirectory
runTest testDshNewAppCreatesNewAppsResponsesDirectory
runTest testDshNewAppCreatesNewAppsDynamicOutputDirectory
runTest testDshNewAppCreatesNewAppsCssDirectory
runTest testDshNewAppCreatesNewAppsJsDirectory


# @todo
# - Apps/<APP_NAME>/OutputComponents/
# - Apps/<APP_NAME>/Requests/
# - Apps/<APP_NAME>/Responses/
# - Apps/<APP_NAME>DynamicOutput/
# - Apps/<APP_NAME>/css/
# - Apps/<APP_NAME>/js

