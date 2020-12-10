#!/bin/bash
# AssertErrorIfDirectoryExistsTests.sh

set -o posix

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertErrorIfDirectoryExists \"ls $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertErrorIfDirectoryExists MUST run without error when failing assertion is expected."
}

testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertErrorIfDirectoryExists \"mkdir $(determineDshUnitDirectoryPath)\" \"$(determineDshUnitDirectoryPath)\" 'Test message'" "assertErrorIfDirectoryExists MUST run without error when passing assertion is expected."
}

testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertErrorIfDirectoryExists "mkdir $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertErrorIfDirectoryExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertErrorIfDirectoryExists "ls $(determineDshUnitDirectoryPath)" "$(determineDshUnitDirectoryPath)" "assertErrorIfDirectoryExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfDirectoryExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfDirectoryExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfDirectoryExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

