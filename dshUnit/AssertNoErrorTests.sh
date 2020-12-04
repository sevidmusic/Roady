#!/bin/bash
# AssertNoErrorTests.sh

set -o posix

testAssertNoErrorRunsWithoutErrorWhenPassingAssertionIsExpected() {
    local initial_passes numberOfAssertions
    numberOfAssertions="3"
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorRunsWithoutErrorWhenPassingAssertionIsExpected"
    assertNoError "ls" "assertNoError MUST run without error on system command ${HIGHLIGHTCOLOR}ls${NOTIFY_COLOR}."
    assertNoError "pwd" "assertNoError MUST run without error on system command ${HIGHLIGHTCOLOR}pwd${NOTIFY_COLOR}."
    assertNoError "assertNoError ls 'Test message'" "assertNoError MUST run without error on itself."
    [[ "$((initial_passes + numberOfAssertions))" == "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertNoErrorRunsWithoutErrorWhenPassingAssertionIsExpected

testAssertNoErrorRunsWithErrorWhenFailingAssertionIsExpected() {
    local initial_fails numberOfAssertions
    numberOfAssertions="2"
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorRunsWithErrorWhenFailingAssertionIsExpected"
    assertNoError "ls some/dir/that/does/not/exist/${RANDOM}" "Expecting an error, and a failed assertion."
    assertNoError "printf \"%s%29.5'%%s\" \"Foo\" \"bar\"" "Expecting an error, and a failed assertion."
    [[ "$((initial_fails + numberOfAssertions))" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertNoErrorRunsWithErrorWhenFailingAssertionIsExpected

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertNoError 'echo There should not be any errors and PASSING_ASSERTIONS MUST increase' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertNoError '${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion

