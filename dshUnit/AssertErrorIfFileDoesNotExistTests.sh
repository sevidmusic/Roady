#!/bin/bash
# AssertErrorIfFileDoesNotExistTests.sh

set -o posix

RANDOM_FILE_PATH="${RANDOM}/${RANDOM}/Foo${RANDOM}"

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertErrorIfFileDoesNotExist \"echo ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertErrorIfFileDoesNotExist \"cat ${RANDOM_FILE_PATH}\" \"${RANDOM_FILE_PATH}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertErrorIfFileDoesNotExist "cat ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertErrorIfFileDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertErrorIfFileDoesNotExist "echo ${RANDOM_FILE_PATH}" "${RANDOM_FILE_PATH}" "assertErrorIfFileDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"


