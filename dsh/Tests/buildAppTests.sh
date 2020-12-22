#!/bin/bash
# buildAppTests.sh

set -o posix

determineDDMSDirectoryPath() {
    printf "%s" "$(determineDshUnitDirectoryPath | sed 's/\/dshUnit//g')"
}

determineDcmsJsonDataDirectoryPath() {
    printf "%s" "$(determineDDMSDirectoryPath)/.dcmsJsonData"
}

removeDcmsJsonDirectory() {
    showLoadingBar "    Attempting to remove $(determineDcmsJsonDataDirectoryPath)" 'dontClear'
    if [[ -d "$(determineDcmsJsonDataDirectoryPath)" ]]; then
        rm -R "$(determineDcmsJsonDataDirectoryPath)"
        [[ -d "$(determineDcmsJsonDataDirectoryPath)" ]] && notifyUser "    ${ERROR_COLOR}Failed to remove$(determineDDMSDirectoryPath).dcmsJsonData" 0 'dontClear'
        [[ ! -d "$(determineDcmsJsonDataDirectoryPath)" ]] && notifyUser "    Removed $(determineDcmsJsonDataDirectoryPath)" 0 'dontClear'
        return 0
    fi
    notifyUser "    ${ERROR_COLOR}Did not remove $(determineDcmsJsonDataDirectoryPath) because it does not exist." 0 'dontClear'
}

moveIntoStarterAppDirectory() {
    # starterApp is used by test for now because it come packaged with the Darling Data Management System, this may change in the future.
    cd "$(determineDDMSDirectoryPath)/Apps/starterApp/"
}

testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --build-app" "dsh --build-app <APP_NAME> <DOMAIN> MUST run with an error if <APP_NAME> is not specified."
}

testDshBuildAppBuildsSpecifiedApp() {
    removeDcmsJsonDirectory
    moveIntoStarterAppDirectory
    dsh --build-app starterApp http://localhost:8080
    assertNoError "/usr/bin/php -e $(determineDDMSDirectoryPath)/dsh/AppWasBuilt.php -a=localhost8080" "AppWasBuilt.php MUST run without error, if it does not then the App was not built."
    removeDcmsJsonDirectory
}

runTest testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified

notifyUser "    ${ERROR_COLOR}Warning: testDshBuildAppBuildsSpecifiedApp will delete the $(determineDcmsJsonDataDirectoryPath) directory?" 0 'dontClear'
notifyUser "    ${ERROR_COLOR} DO NOT RUN THIS TEST IF IT IS NOT OKAY TO REMOVE $(determineDcmsJsonDataDirectoryPath)" 0 'dontClear'
notifyUser "    ${HIGHLIGHTCOLOR}Please enter \"1\" to run the test and allow dsh to delete the $(determineDcmsJsonDataDirectoryPath)" 0 'dontClear'
notifyUser "    ${HIGHLIGHTCOLOR}Please enter \"2\", to skip the test, in which case the $(determineDcmsJsonDataDirectoryPath) directory will not be deleted: " 0 'dontClear'
select rs in "Run" "Skip"; do
    case $rs in
        Run ) runTest testDshBuildAppBuildsSpecifiedApp; break;;
        Skip ) notifyUser "Skipping testDshBuildAppBuildsSpecifiedApp" 0 'dontClear'; break;;
    esac
done

