#!/bin/bash
# AssertFileDoesNotExistTests.sh

set -o posix

RANDOM_FILE_PATH="${RANDOM}/BarBazFoo${RANDOM}"
EXISTING_FILE_PATH="$(determineDshUnitDirectoryPath)/dshUnit"

testAssertFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertFileDoesNotExist \"cat ${EXISTING_FILE_PATH}\" \"${EXISTING_FILE_PATH}\" 'Test message'" "assertFileDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertFileDoesNotExist \"cat ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertFileDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertFileDoesNotExist "cat ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertFileDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertFileDoesNotExist "cat ${EXISTING_FILE_PATH}" "${EXISTING_FILE_PATH}" "assertFileDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

