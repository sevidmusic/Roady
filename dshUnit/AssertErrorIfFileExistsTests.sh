#!/bin/bash
# AssertErrorIfFileExistsTests.sh

set -o posix

testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected() {
    assertNoError "assertErrorIfFileExists \"cat $(determineDshUnitDirectoryPath)/dshUnit\" \"$(determineDshUnitDirectoryPath)/dshUnit\" 'Test message'" "assertErrorIfFileExists MUST run without error when failing assertion is expected."
}

testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected() {
    assertNoError "assertErrorIfFileExists \"mkdir $(determineDshUnitDirectoryPath)/dshUnit\" \"$(determineDshUnitDirectoryPath)/dshUnit\" 'Test message'" "assertErrorIfFileExists MUST run without error when passing assertion is expected."
}

testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion() {
    assertErrorIfFileExists "mkdir $(determineDshUnitDirectoryPath)/dshUnit" "$(determineDshUnitDirectoryPath)/dshUnit" "assertErrorIfFileExists MUST increase the number of PASSING_ASSERTIONS on passing assertion."
}

testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion() {
    assertErrorIfFileExists "cat $(determineDshUnitDirectoryPath)/dshUnit" "$(determineDshUnitDirectoryPath)/dshUnit" "assertErrorIfFileExists MUST increase the number of FAILING_ASSERTIONS on failing assertion."
}

runTest testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenFailingAssertionIsExpected
runTest testAssertErrorIfFileExistsDoesNotProduceAnErrorWhenPassingAssertionIsExpected
runTest testAssertErrorIfFileExistsIncreasesPASSING_ASSERTIONSOnPassingAssertion
runTest testAssertErrorIfFileExistsIncreasesFAILING_ASSERTIONSOnFailingAssertion "1" "allAssertionsFail"

