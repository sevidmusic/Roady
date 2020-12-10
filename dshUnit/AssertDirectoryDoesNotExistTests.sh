#!/bin/bash
# AssertDirectoryDoesNotExistTests.sh

set -o posix

RANDOM_DIRECTORY_PATH="${RANDOM}/BarBazFoo${RANDOM}"
EXISTING_DIRECTORY_PATH="$(determineDshUnitDirectoryPath)"

testAssertDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertDirectoryDoesNotExist \"ls ${EXISTING_DIRECTORY_PATH}\" \"${EXISTING_DIRECTORY_PATH}\" 'Test message'" "assertDirectoryDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertDirectoryDoesNotExist \"cat ${RANDOM_DIRECTORY_PATH}\" \"${RANDOM_DIRECTORY_PATH}\" 'Test message'" "assertDirectoryDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertDirectoryDoesNotExist "cat ${RANDOM_DIRECTORY_PATH}" "${RANDOM_DIRECTORY_PATH}" "assertDirectoryDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertDirectoryDoesNotExist "ls ${EXISTING_DIRECTORY_PATH}" "${EXISTING_DIRECTORY_PATH}" "assertDirectoryDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

