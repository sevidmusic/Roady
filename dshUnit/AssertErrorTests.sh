#!/bin/bash
# AssertErrorTests.sh

set -o posix

testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertError ls 'Test message'" "assertError MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertError ${RANDOM} 'Test message'" "assertError MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertError "${RANDOM}" "assertError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertError "ls" "assertError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion

