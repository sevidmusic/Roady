#!/bin/bash

set -o posix

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

loadLibrary "${PATH_TO_DSHUI}"

showBanner "dsh Unit Tests"
