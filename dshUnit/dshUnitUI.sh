#!/bin/bash
# dshUnitAssertions.sh

set -o posix

showAssertionMsg() {
    notifyUser "    ${3}" 0 'dontClear'
    showLoadingBar "    ${CLEAR_ALL_STYLES}${COLOR_3}Asserting: ${CLEAR_ALL_STYLES}${COLOR_19}${1} \"${CLEAR_ALL_STYLES}${COLOR_21}${2}${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'
}

showAssertionPassedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}${1:-Assertion} Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear'
}

showPassingTestDidNotIncreasePASSING_ASSERTIONSWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test passed, however, the number of PASSING_ASSERTIONS was not increased!" 0 'dontClear'
}

showErrorOccurredMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}An error occurred!" 0 'dontClear'
    notifyUser "${CLEAR_ALL_STYLES}    Error Message: ${ERROR_COLOR}${1}" 0 'dontClear'
}

showAssertionFailedMsg() {
    notifyUser "${CLEAR_ALL_STYLES}    ${ERROR_COLOR}${1:-Assertion} Failed ${HIGHLIGHTCOLOR}:(" 0 'dontClear'
}

showFailingTestDidNotIncreaseFAILING_ASSERTIONSWarning() {
    notifyUser "    ${CLEAR_ALL_STYLES}${COLOR_17}Warning: The test failed, however, the number of FAILING_ASSERTIONS was not increased!" 0 'dontClear'
}

showRunningTestMsg() {
    local running_msg expected_assertion_msg
    running_msg="${COLOR_17}-=-=     Running ${1}     =-=-"
    expected_assertion_msg="    ${HIGHLIGHTCOLOR}Expecting ${2} assertions."
    notifyUser "${running_msg}" 0 'dontClear'
    notifyUser "${expected_assertion_msg}" 0 'dontClear'
    printf "\n\e[0m\e[44m\e[30m%s\e[0m" "${running_msg}" >> "$(determineDshUnitDirectoryPath)/dshUnitTests.log"
    printf "\n\e[0m\e[44m\e[30m%s\e[0m" "${expected_assertion_msg}" >> "$(determineDshUnitDirectoryPath)/dshUnitTests.log"
}

showTestPassedMsg() {
    notifyUser "$(showAssertionPassedMsg "${1:-Test}" | sed 's/Assertion/Test/g')" 0 'dontClear'
}

showTestFailedMsg() {
    notifyUser "$(showAssertionFailedMsg "${1:-Test}" | sed 's/Assertion/Test/g')" 0 'dontClear'
}

showNumberOfPassingAssertions() {
    notifyUser "${SUCCESS_COLOR}There were ${PASSING_ASSERTIONS} passing assertions." 0 'dontClear'
}

showNumberOfFailingAssertions() {
    notifyUser "${ERROR_COLOR}There were ${FAILING_ASSERTIONS} failing assertions." 0 'dontClear'
}

showNumberOfPassingTests() {
    notifyUser "${SUCCESS_COLOR}There were ${PASSING_TESTS} passing tests." 0 'dontClear'
}

showNumberOfFailingTests() {
    [[ "${FAILING_TESTS}" -gt 0 ]] && notifyUser "${ERROR_COLOR}There were ${FAILING_TESTS} failing tests." 0 'dontClear'
    notifyUser "${SUCCESS_COLOR}There were ${FAILING_TESTS} failing tests." 0 'dontClear'
}
