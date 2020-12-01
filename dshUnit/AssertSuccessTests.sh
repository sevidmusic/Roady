#!/bin/bash
# AssertSuccessTests.sh

set -o posix

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass() {
    assertSuccess "ls" "Testing that assertSuccess runs without error testing system command ${HIGHLIGHTCOLOR}ls${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertSuccess "pwd" "Testing that assertSuccess runs without error testing system command ${HIGHLIGHTCOLOR}pwd${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertSuccess "assertSuccess ls '${test_msg}'" "Test assertSuccess runs without error testing itself."
}

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass

testAssertSuccessIncreasesPASSESForPassingTest() {
    local initial_passes
    initial_passes="${PASSES}"
    showLoadingBar "    Testing: assertSuccess increases number of PASSES on passing test" 'dontClear'
    assertSuccess 'pwd' &> /dev/null
    [[ "${initial_passes}" == "${PASSES}" ]] && ((FAILS++)) && notifyUser "Failed asserting that PASSES increases after a passing assertSuccess test." 0 'dontClear' && return
    [[ "${initial_passes}" -lt "${PASSES}" ]] && notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear' && return
}

testAssertSuccessIncreasesPASSESForPassingTest

testAssertSuccessIncreasesFAILSForFailingTest() {
    local initial_fails initial_passes
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    showLoadingBar "    Testing: assertSuccess increases number of FAILS on failing test" 'dontClear'
    assertSuccess '${RANDOM}' &> /dev/null
    [[ "${initial_fails}" == "${FAILS}" ]] && ((FAILS++)) && notifyUser "Failed asserting that FAILS increases after a failing assertSuccess test." 0 'dontClear' && return
    # Manually reduce FAILS so failure count is accurate, we expected an error, as long as FAILS was increased, we can safely decrease it here and know this test passed
    ((FAILS--))
    # Manually increase PASSES, if we are here this test passed, but since were testing for failure assertSuccess will not have increased PASSES, so we have to
    ((PASSES++))
    [[ "${initial_fails}" == "${FAILS}" ]] && [[ "${initial_passes}" -lt "${PASSES}" ]] &&  notifyUser "${CLEAR_ALL_STYLES}    ${SUCCESS_COLOR}Test Passed ${HIGHLIGHTCOLOR}:)" 0 'dontClear' && return
    notifyUser "    ${ERROR_COLOR}testAssertSuccessIncreasesFAILSForFailingTest failed correcting PASSES and FAILS after successful test!" 0 'dontClear'
}

testAssertSuccessIncreasesFAILSForFailingTest

