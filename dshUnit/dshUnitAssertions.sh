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
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && increasePassingAssertions "assertNoError" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increaseFailedAssertions "assertNoError"
}

assertError() {
    showAssertionMsg "assertError" "${1}" "${2}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && increaseFailedAssertions "assertError" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertError"
}

assertErrorIfDirectoryExists() {
    showAssertionMsg "assertErrorIfDirectoryExists" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ -d "${2}" ]] && increaseFailedAssertions "assertErrorIfDirectoryExists" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertErrorIfDirectoryExists"
}

assertErrorIfFileExists() {
    showAssertionMsg "assertErrorIfFileExists" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ -f "${2}" ]] && increaseFailedAssertions "assertErrorIfFileExists" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertErrorIfFileExists"
}

assertErrorIfDirectoryDoesNotExist() {
    showAssertionMsg "assertErrorIfDirectoryDoesNotExist" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ ! -d "${2}" ]] && increaseFailedAssertions "assertErrorIfDirectoryDoesNotExist" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertErrorIfDirectoryDoesNotExist"
}

assertErrorIfFileDoesNotExist() {
    showAssertionMsg "assertErrorIfFileDoesNotExist" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ ! -f "${2}" ]] && increaseFailedAssertions "assertErrorIfFileDoesNotExist" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertErrorIfFileDoesNotExist"
}

assertErrorIfFileIsNotExecutable() {
    showAssertionMsg "assertErrorIfFileIsNotExecutable" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -eq 0 ]] && [[ ! -x "${2}" ]] && increaseFailedAssertions "assertErrorIfFileIsNotExecutable" && return
    showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    increasePassingAssertions "assertErrorIfFileIsNotExecutable"
}

assertDirectoryExists() {
    showAssertionMsg "assertDirectoryExists" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -gt 0 ]] && showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    [[ -d "${2}" ]] && increasePassingAssertions "assertDirectoryExists" && return
    increaseFailedAssertions "assertDirectoryExists"
}

assertDirectoryDoesNotExist() {
    showAssertionMsg "assertDirectoryDoesNotExist" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -gt 0 ]] && showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    [[ ! -d "${2}" ]] && increasePassingAssertions "assertDirectoryDoesNotExist" && return
    increaseFailedAssertions "assertDirectoryDoesNotExist"
}

assertFileExists() {
    showAssertionMsg "assertFileExists" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -gt 0 ]] && showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    [[ -f "${2}" ]] && increasePassingAssertions "assertFileExists" && return
    increaseFailedAssertions "assertFileExists"
}

assertFileDoesNotExist() {
    showAssertionMsg "assertFileDoesNotExist" "${1}" "${3}"
    captureError "${1}"
    [[ "${CURRENT_ERROR_COUNT:-0}" -gt 0 ]] && showErrorOccurredMsg "${LAST_CAPTURED_ERROR_MSG:-NO_MESSAGE}"
    [[ ! -f "${2}" ]] && increasePassingAssertions "assertFileDoesNotExist" && return
    increaseFailedAssertions "assertFileDoesNotExist"
}

assertEquals() {
    showAssertionMsg "assertEquals" "${1} == ${2}" "${3}"
    [[ "${1}" == "${2}" ]] && increasePassingAssertions "assertEquals" && return
    increaseFailedAssertions "assertEquals"
}

assertNotEquals() {
    showAssertionMsg "assertNotEquals" "${1} != ${2}" "${3}"
    [[ "${1}" != "${2}" ]] && increasePassingAssertions "assertNotEquals" && return
    increaseFailedAssertions "assertNotEquals"
}
