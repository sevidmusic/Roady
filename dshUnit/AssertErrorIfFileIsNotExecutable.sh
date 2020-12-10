#!/bin/bash
# AssertErrorIfFileIsNotExecutableTests.sh

set -o posix

RANDOM_FILE_PATH="${RANDOM}/Bar${RANDOM}"

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertErrorIfFileIsNotExecutable \"echo ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when failing assertion is expected."
}

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertErrorIfFileIsNotExecutable \"cat ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when passing assertion is expected."
}

testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertErrorIfFileIsNotExecutable "cat ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertErrorIfFileIsNotExecutable MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertErrorIfFileIsNotExecutable "echo ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertErrorIfFileIsNotExecutable MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"


