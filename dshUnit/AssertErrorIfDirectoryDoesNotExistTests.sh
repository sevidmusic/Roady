#!/bin/bash
# AssertErrorIfDirectoryDoesNotExistTests.sh

set -o posix

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local random_directory_path
    random_directory_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    assertNoError "assertErrorIfDirectoryDoesNotExist \"echo ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when failing assertion is expected."
}

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local random_directory_path
    random_directory_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    assertNoError "assertErrorIfDirectoryDoesNotExist \"ls ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when passing assertion is expected."
}

testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local random_directory_path
    random_directory_path="${RANDOM}/Foo${RANDOM}"
    assertErrorIfDirectoryDoesNotExist "ls ${random_directory_path}" "${random_directory_path}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local random_directory_path
    random_directory_path="${RANDOM}/Bar${RANDOM}"
    assertErrorIfDirectoryDoesNotExist "echo ${random_directory_path}" "${random_directory_path}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"
