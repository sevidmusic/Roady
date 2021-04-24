#!/bin/bash
# AssertErrorIfDirectoryDoesNotExistTests.sh

set -o posix

RANDOM_DIRECTORY_PATH="${RANDOM}/FooBarBaz${RANDOM}"

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertErrorIfDirectoryDoesNotExist \"echo ${RANDOM_DIRECTORY_PATH}\" \"${RANDOM_DIRECTORY_PATH}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertErrorIfDirectoryDoesNotExist \"ls ${RANDOM_DIRECTORY_PATH}\" \"${RANDOM_DIRECTORY_PATH}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertErrorIfDirectoryDoesNotExist "ls ${RANDOM_DIRECTORY_PATH}" "${RANDOM_DIRECTORY_PATH}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertErrorIfDirectoryDoesNotExist "echo ${RANDOM_DIRECTORY_PATH}" "${RANDOM_DIRECTORY_PATH}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"
