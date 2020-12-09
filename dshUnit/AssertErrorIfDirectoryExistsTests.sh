#!/bin/bash
# AssertErrorIfDirectoryExistsTests.sh

set -o posix

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
    assertNoError "assertErrorIfDirectoryExists \"ls $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertErrorIfDirectoryExists MUST run without error when failing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected"
}

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
    assertNoError "assertErrorIfDirectoryExists \"mkdir $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertErrorIfDirectoryExists MUST run without error when passing assertion is expected."
    [[ "${initial_fails}" == "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected" && return
    increaseFailingTests "testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected"
}

testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    local initial_passes
    initial_passes="${PASSING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
    assertErrorIfDirectoryExists "mkdir $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertErrorIfDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
    [[ "${initial_passes}" -lt "${PASSING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion" && return
    increaseFailingTests "testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion"
}

testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    local initial_fails
    initial_fails="${FAILING_ASSERTIONS}"
    showRunningTestMsg "testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
    assertErrorIfDirectoryExists "ls $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertErrorIfDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
    [[ "${initial_fails}" -lt "${FAILING_ASSERTIONS}" ]] && increasePassingTests "testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion" && return
    increaseFailingTests "testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion"
}

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion

