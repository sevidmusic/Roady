#!/bin/bash
# AssertDirectoryExistsTests.sh

set -o posix

testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails random_directory_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_directory_path="${RANDOM}/${RANDOM}/FooBar${RANDOM}"
    showRunningTestMsg "testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertDirectoryExists \"ls ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertDirectoryExists MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertDirectoryExists \"ls $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertDirectoryExists MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increasePassingTests
}

testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertDirectoryExists "ls $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails random_directory_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_directory_path="${RANDOM}/FooBar${RANDOM}"
    showRunningTestMsg "testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertDirectoryExists "ls ${random_directory_path}" "${random_directory_path}" "assertDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion

