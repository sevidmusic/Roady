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

assertErrorIfDirectoryExists() {
    showAssertionMsg "assertErrorIfDirectoryExists" "${1}" "${3}"
    error="$( "${1}" 2>&1 1>/dev/null)"
    [[ -d "${2}" ]] && [[ $? -eq 0 ]] && increaseFailedAssertions && return
    [[ $? -gt 0 ]] && showErrorOccurredMsg "${error}"
    increasePassingAssertions
}
