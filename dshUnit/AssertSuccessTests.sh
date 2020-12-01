#!/bin/bash
# AssertSuccessTests.sh

set -o posix

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass() {
    notifyUser "Testing that assertSuccess runs without error for command that is expected to pass." 0 'dontClear'
    assertSuccess "ls" "assertSuccess ran without error for test that is expected to pass." "Failed asserting that assertSucces ran without error for test that is expected to fail."
    assertSuccess "assertSuccess ls 'pass.' 'Fail.'" "assertSuccess ran without error for test that is expected to pass." "Failed asserting that assertSucces ran without error for test that is expected to fail."
}

testAssertSuccessRunsWithoutErrorForTestThatIsExpectedToPass

testAssertSuccessIncreasesPASSESForPassingTest() {
    local initial_passes
    initial_passes="${PASSES}"
    notifyUser "Testing that assertSuccess increases PASSES on a passing test." 0 'dontClear'
    assertSuccess 'pwd' "-> NOTE: Actually testing PASSES increases for passing assertSuccess text. \"pwd\" is not the actual target of this test" "pwd SHOULD NOT produce an error, something is wrong!"
    [[ "${initial_passes}" == "${PASSES}" ]] && ((FAILS++)) && notifyUser "Failed asserting that PASSES increases after a passing assertSuccess test." 0 'dontClear' && return
    notifyUser "    PASSES was increased after a passing assertSuccess test." 0 'dontClear'
}

testAssertSuccessIncreasesPASSESForPassingTest
