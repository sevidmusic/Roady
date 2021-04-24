#!/bin/bash
# AssertNotEqualsTests.sh

set -o posix

testAssertNotEqualsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertNotEquals 'Bar' 'Bar' 'Test message'" "assertNotEquals MUST run without error when failing assertion is expected."
}

testAssertNotEqualsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertNotEquals 'Bar' 'Foo' 'Test message'" "assertNotEquals MUST run without error when failing assertion is expected."
}

testAssertNotEqualsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertNotEquals 'Bar' 'Foo' "assertNotEquals MUST run without error when failing assertion is expected."
}

testAssertNotEqualsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertNotEquals 'Bar' 'Bar' "assertNotEquals MUST run without error when failing assertion is expected."
}

runTest testAssertNotEqualsDoesNotProduceAnErrorWhenFailingAssertionIsExpected "1"
runTest testAssertNotEqualsDoesNotProduceAnErrorWhenPassingAssertionIsExpected "1"
runTest testAssertNotEqualsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertNotEqualsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

