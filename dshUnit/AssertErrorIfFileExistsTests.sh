#!/bin/bash
# AssertErrorIfFileExistsTests.sh

set -o posix

testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfFileExists \"cat $(determineDshUnitDirectoryPath)/dshUnit\" \"$(determineDshUnitDirectoryPath)/dshUnit\" 'Test message'" "assertErrorIfFileExists MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertErrorIfFileExists \"mkdir $(determineDshUnitDirectoryPath)/dshUnit\" \"$(determineDshUnitDirectoryPath)/dshUnit\" 'Test message'" "assertErrorIfFileExists MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfFileExists "mkdir $(determineDshUnitDirectoryPath)/dshUnit" "$(determineDshUnitDirectoryPath)/dshUnit" "assertErrorIfFileExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfFileExists "cat $(determineDshUnitDirectoryPath)/dshUnit" "$(determineDshUnitDirectoryPath)/dshUnit" "assertErrorIfFileExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion

