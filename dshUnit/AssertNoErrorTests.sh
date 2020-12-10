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
    assertNoError "assertNoError ${RANDOM}${RANDOM}Foo" "assertError MUST not produce any errors on a failing assertion, rather errors produced by the command passed to assertError should be captured and displayed in dshUnit's UI."
    [[ $? -gt 0 ]] && increaseFailingTests "testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increasePassingTests "testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertNoError 'echo There should not be any errors and PASSING_ASSERTIONS MUST increase' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    assertNoError 'ls' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    assertNoError 'printf There should not be any errors and PASSING_ASSERTIONS MUST increase' "assertNoError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertNoError '${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    assertNoError 'ls ${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    assertNoError 'cat ${RANDOM}' "assertNoError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

testAssertNoErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertNoErrorCapturesButDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertNoErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion "3"
runTest testAssertNoErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion "3" "allAssertionsFail"

