#!/bin/bash
# AssertErrorIfDirectoryExistsTests.sh

set -o posix

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfDirectoryExists \"ls $(pwd)\" $(pwd) 'Test message'" "assertErrorIfDirectoryExists MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails random_directory_name
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    random_directory_name="${RANDOM}${RANDOM}/${RANDOM}"
    assertNoError "assertErrorIfDirectoryExists \"ls ${random_directory_name}\" ${random_directory_name} 'Test message'" "assertErrorIfDirectoryExists MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increasePassingTests
}

testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes random_directory_name
    initial_passes="${PASSING_ASSERTIONS}"
    random_directory_name="${RANDOM}${RANDOM}/${RANDOM}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfDirectoryExists "ls ${random_directory_name}" "${random_directory_name}" "assertErrorIfDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfDirectoryExists "ls $(pwd)" "$(pwd)" "assertErrorIfDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion

