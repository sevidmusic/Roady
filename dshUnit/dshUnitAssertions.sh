#!/bin/bash
# dshUnitAssertions.sh

set -o posix

captureError() {
    LAST_CAPTURED_ERROR_MSG="$( ${1} 2>&1 1>/dev/null)"
    CURRENT_ERROR_COUNT="$?"
}

assertNoError() {
    showAssertionMsg "assertNoError" "${1}" "${2}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && increasePassingAssertions && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increaseFailedAssertions
}

assertError() {
    showAssertionMsg "assertError" "${1}" "${2}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && increaseFailedAssertions && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions
}

assertErrorIfDirectoryExists() {
    showAssertionMsg "assertErrorIfDirectoryExists" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ -d "${2}" ]] && increaseFailedAssertions && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions
}
