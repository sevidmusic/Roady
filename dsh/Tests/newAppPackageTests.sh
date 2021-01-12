#!/bin/bash
# newAppPackageTests.sh

set -o posix

testDshNewAppPackageRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new AppPackage"
}

testDshNewAppPackageRunsWithErrorIfPATH_TO_APP_PACKAGEIsNotSpecified() {
    assertError "dsh --new AppPackage AppName"
}

testDshNewAppPackageRunsWithErrorIfAFileExistsAtPATH_TO_NEW_APP_PACKAGE() {
    echo "" > "${HOME}/AppName"
    assertError "dsh --new AppPackage AppName ${HOME}"
    rm "${HOME}/AppName"
}

testDshNewAppPackageRunsWithErrorIfADirectoryExistsAtPATH_TO_NEW_APP_PACKAGE() {
    mkdir "${HOME}/AppName"
    assertError "dsh --new AppPackage AppName ${HOME}"
    rm -R "${HOME}/AppName"
}

testDshNewAppPackageCreatesADirectoryForTheTheNewAppPackageAtPATH_TO_NEW_APP_PACKAGEForwardSlashAppName() {
    assertDirectoryExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesCssDirectoryInTheNewAppPackagesDirectory() {
    assertDirectoryExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName/css"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesJsDirectoryInTheNewAppPackagesDirectory() {
    assertDirectoryExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName/js"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesDynamicOutputDirectoryInTheNewAppPackagesDirectory() {
    assertDirectoryExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName/DynamicOutput"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectory() {
    assertFileExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName/Responses.sh"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent() {
    dsh --new AppPackage AppName "${HOME}"
    assertEquals "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/Responses.sh")" "$(cat ${HOME}/AppName/Responses.sh)"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectory() {
    assertFileExists "dsh --new AppPackage AppName ${HOME}" "${HOME}/AppName/Requests.sh"
    rm -R "${HOME}/AppName/"
}

testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent() {
    dsh --new AppPackage AppName "${HOME}"
    assertEquals "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/Requests.sh")" "$(cat ${HOME}/AppName/Requests.sh)"
    rm -R "${HOME}/AppName/"
}

#testDshNewAppPackageCreatesOutputComponentsSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesOutputComponentsSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()
#testDshNewAppPackageCreatesConfigSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesConfigSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()

runTest testDshNewAppPackageRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshNewAppPackageRunsWithErrorIfPATH_TO_APP_PACKAGEIsNotSpecified
runTest testDshNewAppPackageRunsWithErrorIfAFileExistsAtPATH_TO_NEW_APP_PACKAGE
runTest testDshNewAppPackageRunsWithErrorIfADirectoryExistsAtPATH_TO_NEW_APP_PACKAGE
runTest testDshNewAppPackageCreatesADirectoryForTheTheNewAppPackageAtPATH_TO_NEW_APP_PACKAGEForwardSlashAppName
runTest testDshNewAppPackageCreatesCssDirectoryInTheNewAppPackagesDirectory
runTest testDshNewAppPackageCreatesJsDirectoryInTheNewAppPackagesDirectory
runTest testDshNewAppPackageCreatesDynamicOutputDirectoryInTheNewAppPackagesDirectory
runTest testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectory
runTest testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent
runTest testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectory
runTest testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent
