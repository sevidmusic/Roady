#!/bin/bash
set -o posix

# THIS LINE IS VERY IMPORTANT | IT IS THE ONLY LINE REQUIRED FOR ALL TEST FILES source dshUnit
. "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd | sed 's/dshUnitTests//g')dshUnit"

setTestGroup() {
    TESTGROUP="${1:-all}"
}

setRandomTestAppName() {
    APP="TestApp${RANDOM}"
    [[ -z "${APP}" ]] && notifyUser "${ERRORCOLOR}A random App name could not be generated for testing." 0 'dontClear' && exit 1
}

getTestAppDirectory() {
    printf "%s" "${PATH_TO_DDMS_APP_DIR}${APP}"
}

setUpTestAppDirectory() {
    showLoadingBar "Creating test app ${APP}" 'dontClear'
    mkdir "$(getTestAppDirectory)"
    [[ ! -d "$(getTestAppDirectory)" ]] && notifyUser "${ERRORCOLOR}A test App does not could not be created at $(getTestAppDirectory)." 0 'dontClear' && exit 1
}

testErrorIfAppDoesNotExist() {
    notifyUser "Running ${HIGHLIGHTCOLOR}testErrorIfAppDoesNotExist()" 0 'dontClear'
    assertError "dsh -n doc nonExistentAppName${RANDOM} TestDoc 4.2 Welcome.php"
}

testErrorIfSpecifiedAppDirectoryNameIsEmpty() {
    notifyUser "Running ${HIGHLIGHTCOLOR}testErrorIfSpecifiedAppNameIsEmpty()" 0 'dontClear'
    assertError "dsh -n doc \"\" TestDoc 4.2 Welcome.php"
}

testDynamicOutputDirectoryExistsAfterRunningDshNewDoc() {
    notifyUser "Running ${HIGHLIGHTCOLOR}testDynamicOutputDirectoryExistsAfterRunningDshNewDoc()" 0 'dontClear'
    assertDirectroyExists "${PATH_TO_DDMS_APP_DIR}${APP}/DynamicOutput"
}

tearDownTestAppDirectory() {
    showLoadingBar "Removing test app ${APP}" 'dontClear'
    rm -R "$(getTestAppDirectory)"
}

setTestGroup

setRandomTestAppName

setUpTestAppDirectory

showTestsRunningLoadingBar "${TESTGROUP}" "newMODE.sh" "${APP}"

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'ndoc' ]]; then
    testErrorIfAppDoesNotExist
    testErrorIfSpecifiedAppDirectoryNameIsEmpty
    testDynamicOutputDirectoryExistsAfterRunningDshNewDoc
    sleep 3
fi


tearDownTestAppDirectory

