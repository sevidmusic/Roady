#!/bin/bash
# AssertErrorIfFileIsNotExecutableTests.sh

set -o posix

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfFileIsNotExecutable \"echo ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertErrorIfFileIsNotExecutable \"cat ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileIsNotExecutable MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increasePassingTests "testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes random_file_path
    initial_passes="${PASSING_ASSERTIONS}"
    random_file_path="${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfFileIsNotExecutable "cat ${random_file_path}" "${random_file_path}" "assertErrorIfFileIsNotExecutable MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfFileIsNotExecutable "echo ${random_file_path}" "${random_file_path}" "assertErrorIfFileIsNotExecutable MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfFileIsNotExecutableDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfFileIsNotExecutableIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfFileIsNotExecutableIncreasesFAILING_ASSERTIONSOnFailingAssertion


