#!/bin/bash
# AssertNoErrorTests.sh

set -o posix

testAssertNoErrorRunsWithoutErrorForTestThatIsExpectedToPass() {
    assertNoError "ls" "Testing that assertNoError runs without error testing system command ${HIGHLIGHTCOLOR}ls${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertNoError "pwd" "Testing that assertNoError runs without error testing system command ${HIGHLIGHTCOLOR}pwd${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertNoError "assertNoError ls '${test_msg}'" "Test assertNoError runs without error testing itself."
}

testAssertNoErrorRunsWithoutErrorForTestThatIsExpectedToPass

testAssertNoErrorIncreasesPASSESForPassingTest() {
    local initial_passes
    initial_passes="${PASSES}"
    showLoadingBar "    Testing: assertNoError increases number of PASSES on passing test" 'dontClear'
    assertNoError 'pwd' &> /dev/null
    [[ "${initial_passes}" == "${PASSES}" ]] && ((FAILS++)) && notifyUser "Failed asserting that PASSES increases after a passing assertNoError test." 0 'dontClear' && return
    [[ "${initial_passes}" -lt "${PASSES}" ]] && notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear' && return
}

testAssertNoErrorIncreasesPASSESForPassingTest

testAssertNoErrorIncreasesFAILSForFailingTest() {
    local initial_fails initial_passes
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    showLoadingBar "    Testing: assertNoError increases number of FAILS on failing test" 'dontClear'
    assertNoError '${RANDOM}' &> /dev/null
    [[ "${initial_fails}" == "${FAILS}" ]] && ((FAILS++)) && notifyUser "Failed asserting that FAILS increases after a failing assertNoError test." 0 'dontClear' && return
    # Manually reduce FAILS so failure count is accurate, we expected an error, as long as FAILS was increased, we can safely decrease it here and know this test passed
    ((FAILS--))
    # Manually increase PASSES, if we are here this test passed, but since were testing for failure assertNoError will not have increased PASSES, so we have to
    ((PASSES++))
    [[ "${initial_fails}" == "${FAILS}" ]] && [[ "${initial_passes}" -lt "${PASSES}" ]] &&  notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear' && return
    notifyUser "    ${ERROR_COLOR}testAssertNoErrorIncreasesFAILSForFailingTest failed correcting PASSES and FAILS after successful test!" 0 'dontClear'
}

testAssertNoErrorIncreasesFAILSForFailingTest

