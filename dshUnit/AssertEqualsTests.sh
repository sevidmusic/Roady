#!/bin/bash
# AssertEqualsTests.sh

set -o posix

testAssertEqualsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertEquals 'Foo' 'Bar' 'Test message'" "assertEquals MUST run without error when failing assertion is expected."
}

testAssertEqualsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertEquals 'Foo' 'Foo' 'Test message'" "assertEquals MUST run without error when failing assertion is expected."
}

testAssertEqualsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertEquals 'Foo' 'Foo' "assertEquals MUST run without error when failing assertion is expected."
}

testAssertEqualsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertEquals 'Foo' 'Bar' "assertEquals MUST run without error when failing assertion is expected."
}

runTest testAssertEqualsDoesNotProduceAnErrorWhenFailingAssertionIsExpected "1"
runTest testAssertEqualsDoesNotProduceAnErrorWhenPassingAssertionIsExpected "1"
runTest testAssertEqualsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertEqualsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

