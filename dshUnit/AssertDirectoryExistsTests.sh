#!/bin/bash
# AssertDirectoryExistsTests.sh

set -o posix

RANDOM_DIRECTORY_PATH="${RANDOM}/BarBazFoo${RANDOM}"
EXISTING_DIRECTORY_PATH="$(determineDshUnitDirectoryPath)"

testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertDirectoryExists \"ls ${RANDOM_DIRECTORY_PATH}\" \"${RANDOM_DIRECTORY_PATH}\" 'Test message'" "assertDirectoryExists MUST run without error when failing assertion is expected."
}

testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertDirectoryExists \"ls ${EXISTING_DIRECTORY_PATH}\" \"${EXISTING_DIRECTORY_PATH}\" 'Test message'" "assertDirectoryExists MUST run without error when passing assertion is expected."
}

testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertDirectoryExists "ls ${EXISTING_DIRECTORY_PATH}" "${EXISTING_DIRECTORY_PATH}" "assertDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertDirectoryExists "ls ${RANDOM_DIRECTORY_PATH}" "${RANDOM_DIRECTORY_PATH}" "assertDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

