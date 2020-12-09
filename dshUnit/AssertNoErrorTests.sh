#!/bin/bash
# AssertNoErrorTests.sh

set -o posix

testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    showRunningTestMsg "testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertNoError ls 'Test message'" "assertNoError MUST run without error"
    [[ $? -gt 0 ]] && increaseFailingTests "testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increasePassingTests "testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    showRunningTestMsg "testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "${RANDOM}${RANDOM}Foo" "assertError MUST not produce any errors on a failing assertion, rather errors produced by the command passed to assertError should be captured and displayed in dshUnit's UI."
    [[ $? -gt 0 ]] && increaseFailingTests "testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increasePassingTests "testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertNoError 'echo There should not be any errors and PASSING_ASSERTIONS MUST increase' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertNoError '${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion

