#!/bin/bash
# dshUnitAssertions.sh

set -o posix

assertSuccess() {
    local initial_passes
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    notifyUser "    ${2}" 0 'dontClear'
    showLoadingBar "    Testing: ${CLEAR_ALL_STYLES}${COLOR_19}assertSuccess \"${CLEAR_ALL_STYLES}${COLOR_21}${1}${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        ((PASSES++))
        [[ "${initial_passes}" -lt "${PASSES}" ]] && notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear' && return
    else
        notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}An error occurred!" 0 'dontClear'
        notifyUser "${CLEAR_ALL_STYLES}    Error Message: ${ERROR_COLOR}${error}" 0 'dontClear'
        ((FAILS++))
        [[ "${initial_fails}" -lt "${FAILS}" ]] &&  notifyUser ${CLEAR_ALL_STYLES}    "${ERROR_COLOR}Test Failed ${HIGHLIGHTCOLOR}:(" 0 'dontClear' && return
    fi
}

