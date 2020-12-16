#!/bin/bash
# helpTests.sh

set -o posix

testDshHelpRunsWithoutError() {
    assertNoError 'dsh --help' 'dsh --help MUST run without error.'
}

runTest testDshHelpRunsWithoutError
