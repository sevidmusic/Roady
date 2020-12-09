#!/bin/bash
# AssertErrorIfFileDoesNotExistTests.sh

set -o posix

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfFileDoesNotExist \"echo ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increaseFailingTests"testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertErrorIfFileDoesNotExist \"cat ${random_file_path}\" \"${random_file_path}\" 'Test message'" "assertErrorIfFileDoesNotExist MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increasePassingTests "testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes random_file_path
    initial_passes="${PASSING_ASSERTIONS}"
    random_file_path="${RANDOM}/Foo${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfFileDoesNotExist "cat ${random_file_path}" "${random_file_path}" "assertErrorIfFileDoesNotExist MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_faicat random_file_path
    initial_fails="${FAILING_ASSERTIONS}"
    random_file_path="${RANDOM}/Bar${RANDOM}"
    showRunningTestMsg "testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfFileDoesNotExist "echo ${random_file_path}" "${random_file_path}" "assertErrorIfFileDoesNotExist MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfFileDoesNotExistDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfFileDoesNotExistIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfFileDoesNotExistIncreasesFAILING_ASSERTIONSOnFailingAssertion


