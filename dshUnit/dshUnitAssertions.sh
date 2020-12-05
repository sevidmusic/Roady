#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertNoError() {
    local initial_passes initial_fails error
    showAssertionMsg "assertNoError" "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    [[ $? -eq 0 ]] && increasePassingAssertions && return
    showErrorOccurredMsg "${error}"
    increaseFailedAssertions
}

