#!/bin/bash
# helpFLAGTests.sh

set -o posix

testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid() {
    assertError "dsh --help foo" "dsh --help <FLAG> must log an error if an invalid flag is specified."
    assertError "dsh --help --foo" "dsh --help <FLAG> must log an error if an invalid flag is specified."
    assertError "dsh --help -f" "dsh --help <FLAG> must log an error if an invalid flag is specified."
}

testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid() {
    # long form tests
    assertNoError "dsh --help --help" "dsh --help --help MUST run without error."
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
    # short form tests
    assertNoError "dsh -h -h" "dsh -h -h MUST run without error."
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

testDshHelpHelpOutputMatchesHelpTxtHelpFileContent() {
    assertEquals "$(dsh --help --help)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/help.txt")" "dsh --help --help output MUST match help.txt help file content."
}

testDshHelpFLAGOutputMatchesHelpFLAGHelpFileContent() {
    assertEquals "$(dsh --help FLAG)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/helpFLAG.txt")" "dsh --help FLAG output MUST match helpFLAG.txt help file content."
}

testDshHelpFlagsOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help flags)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/helpFlags.txt")" "dsh --help flags output MUST match helpFlags.txt help file content."
}

testDshHelpStartDevelopmentServerOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --start-development-server)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/startDevelopmentServer.txt")" "dsh --help --start-development-server output MUST match startDevelopmentServer.txt help file content."
}

testDshHelpBuildAppOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --build-app)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/buildApp.txt")" "dsh --help --build-app output MUST match buildApp.txt help file content."
}

testDshHelpNewOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/new.txt")" "dsh --help --new output MUST match new.txt help file content."
}

testDshHelpNewAppOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new App)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newApp.txt")" "dsh --help --new App output MUST match newApp.txt help file content."
}

testDshHelpNewOutputComponentOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new OutputComponent)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newOutputComponent.txt")" "dsh --help --new OutputComponent output MUST match newOutputComponent.txt help file content."
}

testDshHelpNewDynamicOutputComponentOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new DynamicOutputComponent)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newDynamicOutputComponent.txt")" "dsh --help --new DynamicOutputComponent output MUST match newDynamicOutputComponent.txt help file content."
}

testDshHelpNewRequestOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new Request)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newRequest.txt")" "dsh --help --new Request output MUST match newRequest.txt help file content."
}

testDshHelpNewResponseOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new Response)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newResponse.txt")" "dsh --help --new Response output MUST match newResponse.txt help file content."
}

testDshHelpNewGlobalResponseOutputMatchesHelpFlagsHelpFileContent() {
    assertEquals "$(dsh --help --new GlobalResponse)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles/newGlobalResponse.txt")" "dsh --help --new GlobalResponse output MUST match newGlobalResponse.txt help file content."
}


runTest testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid 3
runTest testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid 30
runTest testDshHelpHelpOutputMatchesHelpTxtHelpFileContent
runTest testDshHelpFLAGOutputMatchesHelpFLAGHelpFileContent
runTest testDshHelpFlagsOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpStartDevelopmentServerOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpBuildAppOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewAppOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewOutputComponentOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewDynamicOutputComponentOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewRequestOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewResponseOutputMatchesHelpFlagsHelpFileContent
runTest testDshHelpNewGlobalResponseOutputMatchesHelpFlagsHelpFileContent



