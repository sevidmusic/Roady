#!/bin/bash
set -o posix

clear
# THIS LINE IS VERY IMPORTANT | IT IS THE ONLY LINE REQUIRED FOR ALL TEST FILES source dshUnit
. "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd | sed 's/dshUnitTests//g')dshUnit"

APP="TestApp${RANDOM}"

TESTGROUP="${1:-all}"

getTestAppDirectory() {
    printf "%s" "${PATH_TO_DDMS_APP_DIR}${APP}"
}

setUpTestAppDirectory() {
    showLoadingBar "Creating test app ${APP}"
    mkdir "$(getTestAppDirectory)"
}

disableCtrlC

[[ -z "${APP}" ]] && notifyUser "${ERRORCOLOR}A random App name could not be generated for testing." 0 'dontClear' && exit 1

setUpTestAppDirectory

[[ ! -d "$(getTestAppDirectory)" ]] && notifyUser "${ERRORCOLOR}A test App does not could not be created at $(getTestAppDirectory)." 0 'dontClear' && exit 1

notifyUser "${HIGHLIGHTCOLOR}dsh Unit Tests will begin in a moment, please note, some tests may take awhile, and their output is hidden, the tests are running, please be patient and let this script complete." 0 'dontClear'

showLoadingBar "Starting ${TESTGROUP} tests defined in for test group ${TESTGROUP}. Using app ${APP} as a testing App where needed." 'dontClear'

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

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'ndoc' ]]; then
    testErrorIfAppDoesNotExist
    testErrorIfSpecifiedAppDirectoryNameIsEmpty
    testDynamicOutputDirectoryExistsAfterRunningDshNewDoc
    sleep 3
fi

tearDownTestAppDirectory() {
    showLoadingBar "Removing test app ${APP}" 'dontClear'
    rm -R "$(getTestAppDirectory)"
}

tearDownTestAppDirectory


# THIS IS IMPORTANT | THIS MUST BE LAST | IF NOT RE-ENABLED HERE USER WILL NOT HAVE CTRL-C AFTER THIS SCRIPT HAS RUN
enableCtrlC
