#!/bin/bash
# AssertErrorIfDirectoryDoesNotExistTests.sh

set -o posix

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails random_directory_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_directory_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfDirectoryDoesNotExist \"echo ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails random_directory_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_directory_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertErrorIfDirectoryDoesNotExist \"ls ${random_directory_path}\" \"${random_directory_path}\" 'Test message'" "assertErrorIfDirectoryDoesNotExist MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increasePassingTests
}

testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes random_directory_path
    initial_passes="${PASSING_ASSERTIONS}"
    random_directory_path="${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfDirectoryDoesNotExist "ls ${random_directory_path}" "${random_directory_path}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails random_directory_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_directory_path="${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfDirectoryDoesNotExist "echo ${random_directory_path}" "${random_directory_path}" "assertErrorIfDirectoryDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests && return
    increaseFailingTests
}

testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfDirectoryDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfDirectoryDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfDirectoryDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion
