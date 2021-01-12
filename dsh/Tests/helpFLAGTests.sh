#!/bin/bash
# helpFLAGTests.sh

set -o posix

determineHelpFilesDirectoryPath() {
   printf "%s" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/helpFiles"
}

expectedHelpFileOutput() {
    local text
    text="$(dshUI -c "$(determineHelpFilesDirectoryPath)/${1}" 93 "[<]\b[^>]*[>]" "[[]\b[^]]*[]]" "dsh --.*[^ A-Z]" "dsh -.*[^ A-Z]" "Darling Data Management System" "DDMS" "dshUnit" "dshUI" "http:\/\/localhost:" "8080" "index.php")"
    printf "%s" "${text}"
}

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

    assertNoError "dsh --help --new AppPackage" "dsh --help --new AppPackage MUST run without error."

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

testDshHelpHelpOutputMatchesDshUIColorized_Help_HelpFileContent() {
    assertEquals "$(dsh --help --help)" "$(expectedHelpFileOutput help.txt)" "dsh --help --help MUST match help.txt help file content."
}

testDshHelpFLAGOutputMatchesDshUIColorized_HelpFLAG_HelpFileContent() {
    assertEquals "$(dsh --help FLAG)" "$(expectedHelpFileOutput helpFLAG.txt)" "dsh --help FLAG MUST match helpFLAG.txt help file content."
}

testDshHelpFlagsOutputMatchesDshUIColorized_HelpFlags_HelpFileOutput() {
    assertEquals "$(dsh --help flags)" "$(expectedHelpFileOutput helpFlags.txt)" "dsh --help flags MUST match helpFlags.txt help file content."
}

testDshHelpStartDevelopmentServerOutputMatchesDshUIColorized_StartDevelopmentServer_HelpFileOutput() {
    assertEquals "$(dsh --help --start-development-server)" "$(expectedHelpFileOutput startDevelopmentServer.txt)" "dsh --help --start-development-server MUST match startDevelopmentServer.txt help file content."
}

testDshHelpBuildAppOutputMatchesDshUIColorized_BuildApp_HelpFileOutput() {
    assertEquals "$(dsh --help --build-app)" "$(expectedHelpFileOutput buildApp.txt)" "dsh --help --build-app MUST match buildApp.txt help file content."
}

testDshHelpNewOutputMatchesDshUIColorized_New_HelpFileOutput() {
    assertEquals "$(dsh --help --new)" "$(expectedHelpFileOutput new.txt)" "dsh --help --new MUST match new.txt help file content."
}

testDshHelpNewAppOutputMatchesDshUIColorized_NewApp_HelpFileOutput() {
    assertEquals "$(dsh --help --new App)" "$(expectedHelpFileOutput newApp.txt)" "dsh --help --new App MUST match newApp.txt help file content."
}

testDshHelpNewAppPackageOutputMatchesDshUIColorized_NewAppPackage_HelpFileOutput() {
    assertEquals "$(dsh --help --new AppPackage)" "$(expectedHelpFileOutput newAppPackage.txt)" "dsh --help --new AppPackage MUST match newAppPackage.txt help file content."
}

testDshHelpNewOutputComponentOutputMatchesDshUIColorized_NewOutputComponent_HelpFileOutput() {
    assertEquals "$(dsh --help --new OutputComponent)" "$(expectedHelpFileOutput newOutputComponent.txt)" "dsh --help --new OutputComponent MUST match newOutputComponent.txt help file content."
}

testDshHelpNewDynamicOutputComponentOutputMatchesDshUIColorized_NewDynamicOutputComponent_HelpFileOutput() {
    assertEquals "$(dsh --help --new DynamicOutputComponent)" "$(expectedHelpFileOutput newDynamicOutputComponent.txt)" "dsh --help --new DynamicOutputComponent MUST match newDynamicOutputComponent.txt help file content."
}

testDshHelpNewRequestOutputMatchesDshUIColorized_NewRequest_HelpFileOutput() {
    assertEquals "$(dsh --help --new Request)" "$(expectedHelpFileOutput newRequest.txt)" "dsh --help --new Request MUST match newRequest.txt help file content."
}

testDshHelpNewResponseOutputMatchesDshUIColorized_NewResponse_HelpFileOutput() {
    assertEquals "$(dsh --help --new Response)" "$(expectedHelpFileOutput newResponse.txt)" "dsh --help --new Response MUST match newResponse.txt help file content."
}

testDshHelpNewGlobalResponseOutputMatchesDshUIColorized_NewGlobalResponse_HelpFileOutput() {
    assertEquals "$(dsh --help --new GlobalResponse)" "$(expectedHelpFileOutput newGlobalResponse.txt)" "dsh --help --new GlobalResponse MUST match newGlobalResponse.txt help file content."
}

testDshHelpAssignToResponseOutputMatchesDshUIColorized_AssignToResponse_HelpFileOutput() {
    assertEquals "$(dsh --help --assign-to-response)" "$(expectedHelpFileOutput assignToResponse.txt)" "dsh --help --assign-to-response output MUST match assignToResponse.txt help file content."
}

testDshHelpPhpUnitOutputMatchesDshUIColorized_PhpUnit_HelpFileOutput() {
    assertEquals "$(dsh --help --php-unit )" "$(expectedHelpFileOutput phpUnit.txt)" "dsh --help --php-unit output MUST match phpUnit.txt help file content."
}

testDshHelpDshUnitOutputMatchesDshUIColorized_DshUnit_HelpFileOutput() {
    assertEquals "$(dsh --help --dsh-unit )" "$(expectedHelpFileOutput dshUnit.txt)" "dsh --help --dsh-unit output MUST match dshUnit.txt help file content."
}

runTest testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid 3
runTest testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid 31
runTest testDshHelpHelpOutputMatchesDshUIColorized_Help_HelpFileContent
runTest testDshHelpFLAGOutputMatchesDshUIColorized_HelpFLAG_HelpFileContent
runTest testDshHelpFlagsOutputMatchesDshUIColorized_HelpFlags_HelpFileOutput
runTest testDshHelpStartDevelopmentServerOutputMatchesDshUIColorized_StartDevelopmentServer_HelpFileOutput
runTest testDshHelpBuildAppOutputMatchesDshUIColorized_BuildApp_HelpFileOutput
runTest testDshHelpNewOutputMatchesDshUIColorized_New_HelpFileOutput
runTest testDshHelpNewAppOutputMatchesDshUIColorized_NewApp_HelpFileOutput
runTest testDshHelpNewAppPackageOutputMatchesDshUIColorized_NewAppPackage_HelpFileOutput
runTest testDshHelpNewOutputComponentOutputMatchesDshUIColorized_NewOutputComponent_HelpFileOutput
runTest testDshHelpNewDynamicOutputComponentOutputMatchesDshUIColorized_NewDynamicOutputComponent_HelpFileOutput
runTest testDshHelpNewRequestOutputMatchesDshUIColorized_NewRequest_HelpFileOutput
runTest testDshHelpNewResponseOutputMatchesDshUIColorized_NewResponse_HelpFileOutput
runTest testDshHelpNewGlobalResponseOutputMatchesDshUIColorized_NewGlobalResponse_HelpFileOutput
runTest testDshHelpAssignToResponseOutputMatchesDshUIColorized_AssignToResponse_HelpFileOutput
runTest testDshHelpPhpUnitOutputMatchesDshUIColorized_PhpUnit_HelpFileOutput
runTest testDshHelpDshUnitOutputMatchesDshUIColorized_DshUnit_HelpFileOutput

