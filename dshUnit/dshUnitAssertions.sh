#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertNoError() {
    local initial_passes initial_fails error
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showAssertionMsg "assertNoError" "${1}" "${2}"
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        ((PASSING_ASSERTIONS++))
        [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && showAssertionPassedMsg && return
        showPassingTestDidNotIncreasePASSING_ASSERTIONSWarning
    else
        showErrorOccurredMsg "${error}"
        ((FAILING_ASSERTIONS++))
        [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] &&  showAssertionFailedMsg && return
        showFailingTestDidNotIncreaseFAILING_ASSERTIONSWarning
    fi
}

