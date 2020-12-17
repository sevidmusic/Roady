#!/bin/bash
# helpFLAGTests.sh

set -o posix

testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid() {
    assertError "dsh --help foo" "dsh --help <FLAG> must log an error if an invalid flag is specified."
    assertError "dsh --help --foo" "dsh --help <FLAG> must log an error if an invalid flag is specified."
    assertError "dsh --help -f" "dsh --help <FLAG> must log an error if an invalid flag is specified."
}

testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid() {
    assertNoError "dsh --help help" "dsh --help help MUST run without error."
    assertNoError "dsh --help FLAG" "dsh --help FLAG MUST run without error."
    assertNoError "dsh --help flags" "dsh --help flags MUST run without error."
    assertNoError "dsh --help --start-development-server" "dsh --help --start-development-server MUST run without error."
    assertNoError "dsh --help --build-app" "dsh --help --build-app MUST run without error."
    assertNoError "dsh --help --new" "dsh --help --new MUST run without error."
    assertNoError "dsh --help --new App" "dsh --help --new App MUST run without error."
    assertNoError "dsh --help --new OutputComponent" "dsh --help --new OutputComponent MUST run without error."
    assertNoError "dsh --help --new DynamicOutputComponent" "dsh --help --new DynamicOutputComponent MUST run without error."
    assertNoError "dsh --help --new Request" "dsh --help --new Request MUST run without error."
    assertNoError "dsh --help --new Response" "dsh --help --new Response MUST run without error."
    assertNoError "dsh --help --new GlobalResponse" "dsh --help --new GlobalResponse MUST run without error."
    assertNoError "dsh --help --assign-to-response" "dsh --help --assign-to-response MUST run without error."
    assertNoError "dsh --help --php-unit" "dsh --help --php-unit MUST run without error."
    assertNoError "dsh --help --dsh-unit" "dsh --help --dsh-unit MUST run without error."

    assertNoError "dsh -h help" "dsh -h help MUST run without error."
    assertNoError "dsh -h FLAG" "dsh -h FLAG MUST run without error."
    assertNoError "dsh -h flags" "dsh -h flags MUST run without error."
    assertNoError "dsh -h -s" "dsh -h -s MUST run without error."
    assertNoError "dsh -h -b" "dsh -h -b MUST run without error."
    assertNoError "dsh -h -n" "dsh -h -n MUST run without error."
    assertNoError "dsh -h -n App" "dsh -h -n App MUST run without error."
    assertNoError "dsh -h -n OutputComponent" "dsh -h -n OutputComponent MUST run without error."
    assertNoError "dsh -h -n DynamicOutputComponent" "dsh -h -n DynamicOutputComponent MUST run without error."
    assertNoError "dsh -h -n Request" "dsh -h -n Request MUST run without error."
    assertNoError "dsh -h -n Response" "dsh -h -n Response MUST run without error."
    assertNoError "dsh -h -n GlobalResponse" "dsh -h -n GlobalResponse MUST run without error."
    assertNoError "dsh -h -a" "dsh -h -a MUST run without error."
    assertNoError "dsh -h -p" "dsh -h -p MUST run without error."
    assertNoError "dsh -h -d" "dsh -h -d MUST run without error."

}

runTest testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid 3
runTest testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid 30
