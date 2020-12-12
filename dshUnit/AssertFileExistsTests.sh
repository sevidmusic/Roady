#!/bin/bash
# AssertFileExistsTests.sh

set -o posix

RANDOM_FILE_PATH="${RANDOM}/BarBazFoo${RANDOM}"
EXISTING_FILE_PATH="$(determineDshUnitDirectoryPath)/dshUnit"

testAssertFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertFileExists \"cat ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertFileExists MUST run without error when failing assertion is expected."
}

testAssertFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertFileExists \"cat ${EXISTING_FILE_PATH}\" \"${EXISTING_FILE_PATH}\" 'Test message'" "assertFileExists MUST run without error when passing assertion is expected."
}

testAssertFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertFileExists "cat ${EXISTING_FILE_PATH}" "${EXISTING_FILE_PATH}" "assertFileExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertFileExists "cat ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertFileExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

