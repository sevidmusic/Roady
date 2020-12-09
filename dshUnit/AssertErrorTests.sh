#!/bin/bash
# AssertErrorTests.sh

set -o posix

testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertError ls 'Test message'" "assertError MUST run without error when failing assertion is expected."
    assertNoError "assertError pwd 'Test message'" "assertError MUST run without error when failing assertion is expected."
    assertNoError "assertError cd 'Test message'" "assertError MUST run without error when failing assertion is expected."
}

testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertError cd ${RANDOM} 'Test message'" "assertError MUST run without error when passing assertion is expected."
    assertNoError "assertError ls ${RANDOM} 'Test message'" "assertError MUST run without error when passing assertion is expected."
}

testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertError "${RANDOM}" "assertError MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertError "ls" "assertError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    assertError "pwd" "assertError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    assertError "cd" "assertError MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorDoesNotProduceAnErrorWhenFailingAssertionIsExpected "3"
runTest testAssertErrorDoesNotProduceAnErrorWhenPassingAssertionIsExpected "2"
runTest testAssertErrorIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIncreasesFAILING_ASSERTIONSOnFailingAssertion "3" "allAssertionsFail"

