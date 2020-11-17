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
setupPaths
loadLibrary "${PATH_TO_DSH_FUNCTIONS}"
loadLibrary "${PATH_TO_DSHUI}"

[[ ! -d "${PATH_TO_DDMS}/Apps/${APP}" ]] && printf "\nPlease specify the name of an existing App directory to run tests against.\n" && exit 1
# dsh --help
if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'help' ]]; then
    $PATH_TO_DSH_DIR/dsh --help
    $PATH_TO_DSH_DIR/dsh -h
    $PATH_TO_DSH_DIR/dsh --help help
    $PATH_TO_DSH_DIR/dsh -h h
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'start-app-server' ]]; then
    $PATH_TO_DSH_DIR/dsh --help start-app-server
    dsh --start-app-server 8080
    $PATH_TO_DSH_DIR/dsh -h s
    dsh -s 8080
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'test-ddms' ]]; then
    $PATH_TO_DSH_DIR/dsh --help test-ddms
    dsh --test-ddms
    $PATH_TO_DSH_DIR/dsh -h t
    dsh -t
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'build-app' ]]; then
    $PATH_TO_DSH_DIR/dsh --help build-app
    dsh --build-app "${APP}"
    $PATH_TO_DSH_DIR/dsh -h b
    dsh -b "${APP}"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'run-app' ]]; then
    $PATH_TO_DSH_DIR/dsh --help run-app
    dsh --run-app "${APP}"
    $PATH_TO_DSH_DIR/dsh -h r
    dsh -r "${APP}"
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'active-development-servers' ]]; then
    $PATH_TO_DSH_DIR/dsh --help active-development-servers
    dsh --active-development-servers
    $PATH_TO_DSH_DIR/dsh -h j
    dsh -j
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'stop-all-development-servers' ]]; then
    $PATH_TO_DSH_DIR/dsh --help stop-all-development-servers
    dsh --stop-all-development-servers
    $PATH_TO_DSH_DIR/dsh -h k
    dsh -k
fi

if [[ "${TESTGROUP}" == 'all' || "${TESTGROUP}" == 'ndoc' ]]; then
    $PATH_TO_DSH_DIR/dsh --help new DynamicOutputComponent
    sleep 7
    dsh --new DynamicOutputComponent starterApp TestDoc 4.2 Welcome.php
    sleep 3
    $PATH_TO_DSH_DIR/dsh -h n doc
    sleep 7
    dsh -n doc starterApp TestDoc 4.2 Welcome.php
    sleep 3
fi

