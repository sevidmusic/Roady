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

testAssertNoErrorIncreasesPASSING_ASSERTIONSForPassingTest() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesPASSING_ASSERTIONSForPassingTest"
    assertNoError 'echo There should not be any errors' "Testing: assertNoError increases number of PASSING_ASSERTIONS on passing test"
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && showTestPassedMsg && return
    ((FAILING_ASSERTIONS++))
    showAssertionFailedMsg
}

testAssertNoErrorIncreasesPASSING_ASSERTIONSForPassingTest

testAssertNoErrorIncreasesFAILING_ASSERTIONSForFailingTest() {
    local initial_fails initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesFAILING_ASSERTIONSForFailingTest"
    assertNoError '${RANDOM}' "Testing: assertNoError increases number of FAILING_ASSERTIONS on failing test"
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && showTestPassedMsg && FAILING_ASSERTIONS="${initial_fails}" && ((PASSING_ASSERTIONS++)) && return
    # Manually increase FAILING_ASSERTIONS an error occured but FAILING_ASSERTIONS was not increased.
    ((FAILING_ASSERTIONS++))
    showAssertionFailedMsg
}

testAssertNoErrorIncreasesFAILING_ASSERTIONSForFailingTest

