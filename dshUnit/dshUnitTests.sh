#!/bin/bash
# TestTests.sh

set -o posix

testTestsCanRun() {
    printf "\n\n\e[102mIf you see thi, then tests can run : )\e[0m\n\n"
    assertSuccess "pwd"
    assertError "ls asdfasdfe"
}

testTestsCanRun

