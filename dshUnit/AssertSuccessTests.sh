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

testAssertSuccessIncreasesFAILSForFailingTest() {
    local initial_fails
    initial_fails="${FAILS}"
    notifyUser "Testing that assertSuccess increases FAILS on a failing test." 0 'dontClear'
    assertSuccess '${RANDOM}' "The randomly generated command SHOULD produce an error, something is wrong!" "-> NOTE: Actually testing FAILS increases for failing assertSuccess text. The randomly generated command is not the actual target of this test"
    [[ "${initial_fails}" == "${FAILS}" ]] && ((FAILS++)) && notifyUser "Failed asserting that FAILS increases after a failing assertSuccess test." 0 'dontClear' && return
    notifyUser "    FAILS was increased after a failing assertSuccess test." 0 'dontClear'
    # Manually reduce FAILS so failure count is accurate, we expected an error, as long as FAILS was increased, we can safely decrease it here and know this test passed
    ((FAILS--))
    # Manually increase PASSES, if we are here this test passed, but since were testing for failure assertSuccess will not have increased PASSES, so we have to
    ((PASSES++))
}

testAssertSuccessIncreasesFAILSForFailingTest





