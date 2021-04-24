#!/bin/bash
# locateDDMSDirectoryTests.sh

set -o posix

testDshLocateDDMSDirectoryRunsWithoutError() {
    assertNoError "dsh --locate-ddms-directory"
    assertNoError "dsh -l"
}

testDshLocateDDMSDirectoryReturnsExpectedPath() {
    assertEquals "$(determineDshUnitDirectoryPath | sed 's/dshUnit//g')" "$(dsh --locate-ddms-directory)"
    assertEquals "$(determineDshUnitDirectoryPath | sed 's/dshUnit//g')" "$(dsh -l)"
}

runTest testDshLocateDDMSDirectoryRunsWithoutError 2
runTest testDshLocateDDMSDirectoryReturnsExpectedPath 2
