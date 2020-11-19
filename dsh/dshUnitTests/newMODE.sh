#!/bin/bash
set -o posix

clear

APP="TestApp${RANDOM}"

TESTGROUP="${1:-all}"

setupPaths() {
    SOURCE="${BASH_SOURCE[0]}"
    while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
      DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
      SOURCE="$(readlink "$SOURCE")"
      [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
    done
    PATH_TO_THIS_DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
    PATH_TO_DSH_DIR="${PATH_TO_THIS_DIR/dshUnitTests/}"
    PATH_TO_DSHUI="${PATH_TO_DSH_DIR}dshui.sh"
    PATH_TO_DSHUNIT="${PATH_TO_DSH_DIR}dshUnit"
    PATH_TO_DSH_FUNCTIONS="${PATH_TO_DSH_DIR}dshfunctions.sh"
    PATH_TO_DDMS="${PATH_TO_DSH_DIR/dsh\//}"
    PATH_TO_DDMS_APP_DIR="${PATH_TO_DDMS}Apps/"
}

loadLibrary() {
    [[ ! -f "${1}" ]] && printf "\n\n\e[33mError! Failed to load ${1}!\e[0m\n\n" && exit 1
    . "${1}"
}

getTestAppDirectory() {
    printf "%s" "${PATH_TO_DDMS_APP_DIR}${APP}"
}

setUpTestAppDirectory() {
    showLoadingBar "Creating test app ${APP}"
    mkdir "$(getTestAppDirectory)"
}

setupPaths

loadLibrary "${PATH_TO_DSH_FUNCTIONS}"

loadLibrary "${PATH_TO_DSHUI}"

loadLibrary "${PATH_TO_DSHUNIT}"

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
