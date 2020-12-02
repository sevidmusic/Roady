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
    assertNoError 'echo There should not be any errors' "Testing: assertNoError increases number of PASSES on passing test"
    [[ "${initial_passes}" -lt "${PASSES}" ]] && showTestPassedMsg && return
    ((FAILS++))
    showTestFailedMsg
}

testAssertNoErrorIncreasesPASSESForPassingTest

testAssertNoErrorIncreasesFAILSForFailingTest() {
    local initial_fails initial_passes
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    assertNoError '${RANDOM}' "Testing: assertNoError increases number of FAILS on failing test"
    [[ "${initial_fails}" -lt "${FAILS}" ]] && showTestPassedMsg && FAILS="${initial_fails}" && ((PASSES++)) && return # ((PASSES++))
    # Manually increase FAILS an error occured but FAILS was not increased.
    ((FAILS++))
    showTestFailedMsg
}

testAssertNoErrorIncreasesFAILSForFailingTest

