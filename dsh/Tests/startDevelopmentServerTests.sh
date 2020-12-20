#!/bin/bash
# startDevelopmentServerTests.sh

set -o posix

testDshStartDevelopmentServerRunsWithoutError() {
    assertNoError "dsh --start-development-server" "dsh --start-development-server MUST run without error."
}

runTest testDshStartDevelopmentServerRunsWithoutError
