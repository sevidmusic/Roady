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
runTest testDshNewAppPackageCreatesADirectoryForTheTheNewAppPackageAtPATH_TO_NEW_APP_PACKAGEForwardSlashAppName
runTest testDshNewAppPackageCreatesCssDirectoryInTheNewAppPackagesDirectory
