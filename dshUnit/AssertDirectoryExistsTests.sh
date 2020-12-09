#!/bin/bash
# AssertDirectoryExistsTests.sh

set -o posix

testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    random_directory_path="${RANDOM}/${RANDOM}/FooBar${RANDOM}"
    assertNoError "assertDirectoryExists \"ls ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertDirectoryExists MUST run without error when failing assertion is expected."
}

testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertDirectoryExists \"ls $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertDirectoryExists MUST run without error when passing assertion is expected."
}

testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertDirectoryExists "ls $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local random_directory_path
    random_directory_path="${RANDOM}/FooBar${RANDOM}"
    assertDirectoryExists "ls ${random_directory_path}" "${random_directory_path}" "assertDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

