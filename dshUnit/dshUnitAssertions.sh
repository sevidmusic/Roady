#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertSuccess() {
    showLoadingBar "    Testing that an error does not occur running: ${HIGHLIGHTCOLOR}${1}" 'dontClear'
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        notifyUser "    ${2}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        ((PASSES++))
    else
        notifyUser "    ${3}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        notifyUser "    ${ERRORCOLOR}${error}" 0 'dontClear'
        ((FAILS++))
    fi
}

