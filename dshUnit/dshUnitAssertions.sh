#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertNoError() {
    local initial_passes initial_fails error
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    showStartingTestMsg "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        ((PASSES++))
        [[ "${initial_passes}" -lt "${PASSES}" ]] && showTestPassedMsg && return
        showPassingTestDidNotIncreasePASSESWarning
    else
        showErrorOccurredMsg "${error}"
        ((FAILS++))
        [[ "${initial_fails}" -lt "${FAILS}" ]] &&  showTestFailedMsg && return
        showFailingTestDidNotIncreaseFAILSWarning
    fi
}

