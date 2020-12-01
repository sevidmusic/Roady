#!/bin/bash
# AssertSuccessTests.sh

set -o posix

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass() {
    notifyUser "Testing that assertSuccess runs without error for command that is expected to pass." 0 'dontClear'
    assertSuccess ls "assertSuccess ran without error for test that is expected to pass." "Failed asserting that assertSucces ran without error for test that is expected to fail."
    assertSuccess "assertSuccess ls 'pass.' 'Fail.'" "assertSuccess ran without error for test that is expected to pass." "Failed asserting that assertSucces ran without error for test that is expected to fail."
}

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass

