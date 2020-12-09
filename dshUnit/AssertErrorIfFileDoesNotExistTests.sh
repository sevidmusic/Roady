#!/bin/bash
# AssertErrorIfFileDoesNotExistTests.sh

set -o posix

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local random_file_path
    random_file_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    assertNoError "assertErrorIfFileDoesNotExist \"echo ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local random_file_path
    random_file_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    assertNoError "assertErrorIfFileDoesNotExist \"cat ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local random_file_path
    random_file_path="${RANDOM}/Foo${RANDOM}"
    assertErrorIfFileDoesNotExist "cat ${random_file_path}" "${random_file_path}" "assertErrorIfFileDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local random_file_path
    random_file_path="${RANDOM}/Bar${RANDOM}"
    assertErrorIfFileDoesNotExist "echo ${random_file_path}" "${random_file_path}" "assertErrorIfFileDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"


