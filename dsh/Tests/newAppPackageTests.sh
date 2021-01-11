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
    echo "" > "${HOME}/temp.temp"
    assertError "dsh --new AppPackage AppName ${HOME}/temp.temp"
    rm "${HOME}/temp.temp"
}

testDshNewAppPackageRunsWithErrorIfADirectoryExistsAtPATH_TO_NEW_APP_PACKAGE() {
    mkdir "${HOME}/tempTempDir"
    assertError "dsh --new AppPackage AppName ${HOME}/tempTempDir"
    rm -R "${HOME}/tempTempDir"
}

# NOTE: [DOMAIN] is optional, no need to test that it is supplied

#testDshNewAppPackageCreatesADirectoryInTheNewAppPackagesDirectoryAtPATH_TO_NEW_APP_PACKAGE()
#testDshNewAppPackageCreatesCssDirectoryInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesJsDirectoryInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesDynamicOutputDirectoryInTheNewAppPackagesDirectory()

#testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesResponsesSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()
#testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesRequestsSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()
#testDshNewAppPackageCreatesOutputComponentsSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesOutputComponentsSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()
#testDshNewAppPackageCreatesConfigSHInTheNewAppPackagesDirectory()
#testDshNewAppPackageCreatesConfigSHInTheNewAppPackagesDirectoryWhoseContentMatchesExpectedContent()

runTest testDshNewAppPackageRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshNewAppPackageRunsWithErrorIfPATH_TO_APP_PACKAGEIsNotSpecified
runTest testDshNewAppPackageRunsWithErrorIfAFileExistsAtPATH_TO_NEW_APP_PACKAGE
runTest testDshNewAppPackageRunsWithErrorIfADirectoryExistsAtPATH_TO_NEW_APP_PACKAGE
