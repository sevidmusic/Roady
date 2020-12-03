#!/bin/bash
# AssertNoErrorTests.sh

set -o posix

testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass() {
    local initial_passes numberOfAssertions
    numberOfAssertions="3"
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass"
    assertNoError "ls" "assertNoError MUST run without error on system command ${HIGHLIGHTCOLOR}ls${NOTIFY_COLOR}."
    assertNoError "pwd" "assertNoError MUST run without error on system command ${HIGHLIGHTCOLOR}pwd${NOTIFY_COLOR}."
    assertNoError "assertNoError ls '${test_msg}'" "assertNoError MUST run without error on itself."
    [[ "$((initial_passes + numberOfAssertions))" == "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertNoErrorIndicatesPassingTestForCommandsThatAreExpectedToPass

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertNoError 'echo There should not be any errors and PASSING_ASSERTIONS MUST increase' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    notifyUser "${HIGHLIGHTCOLOR}Note: The previous call to assertNoError's results will not be tracked, it was just used to test that PASSING_ASSERTIONS are increased by assertNoError on a pssing assertion." 0 'dontClear'
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests && PASSING_ASSERTIONS="${initial_passes}" && return
    increaseFailingTests
}

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertNoError '${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    notifyUser "${HIGHLIGHTCOLOR}Note: The previous call to assertNoError's results will not be tracked, it was just used to test that FAILING_ASSERTIONS are increased by assertNoError on a failing assertion." 0 'dontClear'
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests && FAILING_ASSERTIONS="${initial_fails}" && return
    increaseFailingTests
}

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion

