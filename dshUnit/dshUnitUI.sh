#!/bin/bash
# dshUnitAssertions.sh

set -o posix

showStartingTestMsg() {
    notifyUser "    ${2}" 0 'dontClear'
    showLoadingBar "    Testing: ${CLEAR_ALL_STYLES}${COLOR_19}assertNoError \"${CLEAR_ALL_STYLES}${COLOR_21}${1}${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'
}

showTestPassedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear'
}

showPassingTestDidNotIncreasePASSESWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test passed, however, the number of PASSES was not increased!" 0 'dontClear'
}

showErrorOccurredMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}An error occurred!" 0 'dontClear'
    notifyUser "${CLEAR_ALL_STYLES}    Error Message: ${ERROR_COLOR}${1}" 0 'dontClear'
}

showTestFailedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}Test Failed ${HIGHLIGHTCOLOR}:(" 0 'dontClear'
}

showFailingTestDidNotIncreaseFAILSWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test failed, but the number of FAILS was not increased!" 0 'dontClear'
}

