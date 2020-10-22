#!/bin/bash

set -o posix

clear

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

showBanner

showLoadingBar "Preparing to run dsh tests"

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help help" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help help
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h h" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h h
sleep 2

# BUILD APP #
clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help build-app" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help build-app
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h build-app" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h build-app
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --build-app helloWorld" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --build-app helloWorld
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -b helloWorld" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -b helloWorld
sleep 2

# TEST DDMS #
clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help test-ddms" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help test-ddms
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h t" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h t
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --test-ddms" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --test-ddms
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -t" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -t
sleep 2

# START APP SERVER #
clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help start-app-server" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help start-app-server
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h s" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h s
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --start-app-server 8080" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --start-app-server 8080
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -s 8080" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -s 8080
sleep 2

# RUN APP #
clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help run-app" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help run-app
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h r" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh -h r
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --run-app helloWorld"
sleep 2
$PATH_TO_DSH_DIR/dsh --run-app helloWorld
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -r helloWorld"
sleep 2
$PATH_TO_DSH_DIR/dsh -r helloWorld
sleep 2

# FLAGS #
clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh --help flags" 'dontClear'
sleep 2
$PATH_TO_DSH_DIR/dsh --help flags
sleep 2

clear && showBanner
showLoadingBar "Starting test of ${HIGHLIGHTCOLOR}dsh -h flags"
sleep 2
$PATH_TO_DSH_DIR/dsh -h flags
sleep 2

