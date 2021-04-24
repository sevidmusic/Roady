#!/bin/bash
# helpTests.sh

set -o posix

testDshHelpRunsWithoutError() {
    assertNoError 'dsh --help' 'dsh --help MUST run without error.'
}

testDshHelpCreatesSystemManPageForDsh() {
    local dsh_man_file_path
    dsh_man_file_path="${HOME}/.local/share/man/man1/dsh.1"
    assertFileExists "dsh --help" "${dsh_man_file_path}" "dsh --help MUST create a man page for dsh at ${dsh_man_file_path}. This may entail creating the parent directories."
}

testDshHelpOutputMatchesManDshOutput() {
    assertEquals "$(man dsh)" "$(dsh --help)" "man dsh and dsh --help MUST porduce the same output."
}

runTest testDshHelpRunsWithoutError
runTest testDshHelpCreatesSystemManPageForDsh
runTest testDshHelpOutputMatchesManDshOutput
