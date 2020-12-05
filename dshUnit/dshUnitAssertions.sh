#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertNoError() {
    showAssertionMsg "assertNoError" "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    [[ $? -eq 0 ]] && increasePassingAssertions && return
    showErrorOccurredMsg "${error}"
    increaseFailedAssertions
}

assertError() {
    showAssertionMsg "assertError" "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    [[ $? -eq 0 ]] && increaseFailedAssertions && return
    showErrorOccurredMsg "${error}"
    increasePassingAssertions
}

