#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertNoError() {
    local initial_passes initial_fails error
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showAssertionMsg "assertNoError" "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    [[ $? -eq 0 ]] && increasePassingAssertions && return
    showErrorOccurredMsg "${error}"
    increaseFailedAssertions
}

