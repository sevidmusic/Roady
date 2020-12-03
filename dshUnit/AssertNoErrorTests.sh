#!/bin/bash
# AssertNoErrorTests.sh

set -o posix

testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass() {
    showRunningTestMsg "testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass"
    assertNoError "ls" "Testing that assertNoError runs without error testing system command ${HIGHLIGHTCOLOR}ls${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertNoError "pwd" "Testing that assertNoError runs without error testing system command ${HIGHLIGHTCOLOR}pwd${NOTIFY_COLOR}. This should pass. dshUnit's assertions MUST also be able to test commands that are not related to dsh, dshUnit, dshUI, or the Darling Data Management System."
    assertNoError "assertNoError ls '${test_msg}'" "Test assertNoError runs without error testing itself."
}

testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass

testAssertNoErrorIncreasesPASSESForPassingTest() {
    local initial_passes
    initial_passes="${PASSES}"
    showRunningTestMsg "testAssertNoErrorIncreasesPASSESForPassingTest"
    assertNoError 'echo There should not be any errors' "Testing: assertNoError increases number of PASSES on passing test"
    [[ "${initial_passes}" -lt "${PASSES}" ]] && showTestPassedMsg && return
    ((FAILS++))
    showAssertionFailedMsg
}

testAssertNoErrorIncreasesPASSESForPassingTest

testAssertNoErrorIncreasesFAILSForFailingTest() {
    local initial_fails initial_passes
    initial_passes="${PASSES}"
    initial_fails="${FAILS}"
    showRunningTestMsg "testAssertNoErrorIncreasesFAILSForFailingTest"
    assertNoError '${RANDOM}' "Testing: assertNoError increases number of FAILS on failing test"
    [[ "${initial_fails}" -lt "${FAILS}" ]] && showTestPassedMsg && FAILS="${initial_fails}" && ((PASSES++)) && return
    # Manually increase FAILS an error occured but FAILS was not increased.
    ((FAILS++))
    showAssertionFailedMsg
}

testAssertNoErrorIncreasesFAILSForFailingTest

