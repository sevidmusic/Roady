#!/bin/bash
# AssertErrorIfFileIsNotExecutableTests.sh

set -o posix

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local random_file_path
    random_file_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    assertNoError "assertErrorIfFileIsNotExecutable \"echo ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when failing assertion is expected."
}

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local random_file_path
    random_file_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    assertNoError "assertErrorIfFileIsNotExecutable \"cat ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when passing assertion is expected."
}

testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local random_file_path
    random_file_path="${RANDOM}/Foo${RANDOM}"
    assertErrorIfFileIsNotExecutable "cat ${random_file_path}" "${random_file_path}" "assertErrorIfFileIsNotExecutable MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local random_file_path
    random_file_path="${RANDOM}/Bar${RANDOM}"
    assertErrorIfFileIsNotExecutable "echo ${random_file_path}" "${random_file_path}" "assertErrorIfFileIsNotExecutable MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"


