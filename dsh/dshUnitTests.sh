#!/bin/bash
set -o posix

clear

APP="${1}"

TESTGROUP="${2:-all}"

[[ -z "${APP}" ]] && printf "\nPlease specify the name of an existing App directory to run tests against.\n" && exit 1

setupPaths() {
    # Determine real path to dsh directory
    SOURCE="${BASH_SOURCE[0]}"
    while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
      DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
      SOURCE="$(readlink "$SOURCE")"
      [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
    done
    PATH_TO_DSH_DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
    PATH_TO_DSHUI="${PATH_TO_DSH_DIR}/dshui.sh"
    PATH_TO_DSH_FUNCTIONS="${PATH_TO_DSH_DIR}/dshfunctions.sh"
    PATH_TO_DDMS="${PATH_TO_DSH_DIR/dsh/}"
}

loadLibrary() {
    [[ ! -f "${1}" ]] && printf "\n\n\e[33mError! Failed to load ${1}!\e[0m\n\n" && exit 1
    . "${1}"
}

#######

assertSuccess() {
    { ${1} &> /dev/null; } && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} ran without error : )" 0 'dontClear' && return
    notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}An error occured, run ${CLEAR_ALL_TEXT_STYLES}${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${ERRORCOLOR} manually to see error messages." 0 'dontClear'
}

assertError() {
    { ${1} &> /dev/null; } && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}An error  did not occur, an error was expected, run ${CLEAR_ALL_TEXT_STYLES}${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${ERRORCOLOR} manually to see actual output." 0 'dontClear' && return
    notifyUser "As expected, an error occured running ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}" 0 'dontClear'
}

######


setupPaths

loadLibrary "${PATH_TO_DSH_FUNCTIONS}"

loadLibrary "${PATH_TO_DSHUI}"

notifyUser "${HIGHLIGHTCOLOR}dsh Unit Tests will begin in a moment, please note, some tests may take awhile, and their output is hidden, the tests are running, please be patient and let this script complete." 0 'dontClear'
showLoadingBar "Starting ${TESTGROUP} tests" 'dontClear'

[[ ! -d "${PATH_TO_DDMS}/Apps/${APP}" ]] && printf "\nPlease specify the name of an existing App directory to run tests against.\n" && exit 1
# dsh --help
if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'help' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h"
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help help"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h h"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'start-app-server' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help start-app-server"
    assertSuccess "dsh --start-app-server 8080"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h s"
    assertSuccess "dsh -s 8080"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'test-ddms' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help test-ddms"
    assertSuccess "dsh --test-ddms"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h t"
    assertSuccess "dsh -t"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'build-app' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help build-app"
    assertSuccess "dsh --build-app "${APP}""
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h b"
    assertSuccess "dsh -b "${APP}""
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'run-app' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help run-app"
    assertSuccess "dsh --run-app "${APP}""
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h r"
    assertSuccess "dsh -r "${APP}""
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'active-development-servers' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help active-development-servers"
    assertSuccess "dsh --active-development-servers"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h j"
    assertSuccess "dsh -j"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'stop-all-development-servers' ]]; then
    assertSuccess "$PATH_TO_DSH_DIR/dsh --help stop-all-development-servers"
    assertSuccess "dsh --stop-all-development-servers"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h k"
    assertSuccess "dsh -k"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'ndoc' ]]; then
    assertSuccess "${PATH_TO_DSH_DIR}/dsh --help new DynamicOutputComponent"
    assertSuccess "${PATH_TO_DSH_DIR}/dsh --new DynamicOutputComponent starterApp TestDoc 4.2 Welcome.php"
    assertSuccess "$PATH_TO_DSH_DIR/dsh -h n doc"
    assertSuccess "dsh -n doc starterApp TestDoc 4.2 Welcome.php"
fi

