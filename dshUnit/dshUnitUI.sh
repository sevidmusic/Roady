#!/bin/bash
# dshUnitAssertions.sh

set -o posix

# showAssertionMsg <ASSERTION_FUNCTION_NAME><COMMAND_BEING_TESTED> <MESSAGE>
showAssertionMsg() {
    notifyUser "    ${3}" 0 'dontClear'
    showLoadingBar "    ${CLEAR_ALL_STYLES}${COLOR_3}Asserting: ${CLEAR_ALL_STYLES}${COLOR_19}${1} \"${CLEAR_ALL_STYLES}${COLOR_21}${2}${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'
}

# showAssertionPassedMsg
showAssertionPassedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Assertion Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear'
}

# showPassingTestDidNotIncreasePASSING_ASSERTIONSWarning
showPassingTestDidNotIncreasePASSING_ASSERTIONSWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test passed, however, the number of PASSING_ASSERTIONS was not increased!" 0 'dontClear'
}

# showErrorOccurredMsg <ERROR_MESSAGE>
showErrorOccurredMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}An error occurred!" 0 'dontClear'
    notifyUser "${CLEAR_ALL_STYLES}    Error Message: ${ERROR_COLOR}${1}" 0 'dontClear'
}

# showAssertionFailedMsg
showAssertionFailedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}Assertion Failed ${HIGHLIGHTCOLOR}:(" 0 'dontClear'
}

# showFailingTestDidNotIncreaseFAILING_ASSERTIONSWarning
showFailingTestDidNotIncreaseFAILING_ASSERTIONSWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test failed, but the number of FAILING_ASSERTIONS was not increased!" 0 'dontClear'
}

# showRunningTestMsg <TEST_FUNCTION_NAME>
showRunningTestMsg() {
    notifyUser "${COLOR_17}-=-=     Running ${1}     =-=-" 0 'dontClear'
}

showTestPassedMsg() {
    notifyUser "$(showAssertionPassedMsg | sed 's/Assertion/Test/g')" 0 'dontClear'
}
