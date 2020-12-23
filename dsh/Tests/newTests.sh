#!/bin/bash
# newTests.sh

set -o posix

testDshNewRunsWithErrorIfMODEIsNotSpecified() {
    assertError "dsh --new" "dsh --new MUST run with an error if a mode is not specified as the first argument."
}

runTest testDshNewRunsWithErrorIfMODEIsNotSpecified
