#!/bin/bash
# buildAppTests.sh

set -o posix

showDcmsJsonDataWillBeDeletedByTestWarning() {
    notifyUser "    ${ERROR_COLOR}Warning: ${1} will delete the $(determineDcmsJsonDataDirectoryPath) directory?" 0 'dontClear'
    notifyUser "    ${ERROR_COLOR} DO NOT RUN THIS TEST IF IT IS NOT OKAY TO REMOVE $(determineDcmsJsonDataDirectoryPath)" 0 'dontClear'
    notifyUser "    ${HIGHLIGHTCOLOR}Please enter \"1\" to run the test and allow dsh to delete the $(determineDcmsJsonDataDirectoryPath)" 0 'dontClear'
    notifyUser "    ${HIGHLIGHTCOLOR}Please enter \"2\", to skip the test, in which case the $(determineDcmsJsonDataDirectoryPath) directory will not be deleted: " 0 'dontClear'
}

determineDDMSDirectoryPath() {
    printf "%s" "$(determineDshUnitDirectoryPath | sed 's/\/dshUnit//g')"
}

determineAppDirectoryPath() {
    printf "%s" "$(determineDDMSDirectoryPath)/Apps/${1}"
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

testDshBuildAppRunsWithErrorIfSpecifiedAppsDirectoryDoesNotExist() {
    assertError "dsh --build-app FooBar${RANDOM}" "dsh --build-app <APP_NAME> <DOMAIN> MUST run with an error if specified App does not exist."
}

testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist() {
    mkdir "$(determineAppDirectoryPath FooBarBaz)"
    assertError "dsh --build-app FooBarBaz" "dsh --build-app <APP_NAME> <DOMAIN> MUST run with an error if specified App's Components.php file does not exist."
    rm -R "$(determineAppDirectoryPath FooBarBaz)"
}

testDshBuildAppBuildsSpecifiedApp() {
    removeDcmsJsonDirectory
    moveIntoStarterAppDirectory
    dsh --build-app starterApp http://localhost:8080
    assertNoError "/usr/bin/php -e $(determineDDMSDirectoryPath)/dsh/AppWasBuilt.php -a=localhost8080" "AppWasBuilt.php MUST run without error, if it does not then the App was not built."
    removeDcmsJsonDirectory
}

testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified() {
    removeDcmsJsonDirectory
    assertDirectoryExists "dsh --build-app starterApp" "$(determineDcmsJsonDataDirectoryPath)/localhost8080" "The $(determineDcmsJsonDataDirectoryPath)/localhost8080 directory MUST exist after call to dsh --build-app, if it does not then dsh --build-app failed to build the specified App for the domain http:localhost:8080 even though <DOMAIN> was not specified. http://localhost:8080 MUST be the default domain if <DOMAIN> is not specified."
    removeDcmsJsonDirectory
}

testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified() {
    removeDcmsJsonDirectory
    # @todo use random domain
    assertDirectoryExists "dsh --build-app starterApp http://localhost:8987" "$(determineDcmsJsonDataDirectoryPath)/localhost8987" "dsh --build-app MUST build app for specified domain if <DOMAIN> is spcified as the second parameter."
    removeDcmsJsonDirectory
}

runTest testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshBuildAppRunsWithErrorIfSpecifiedAppsDirectoryDoesNotExist

showDcmsJsonDataWillBeDeletedByTestWarning "testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist"
select rs in "Run" "Skip"; do
    case $rs in
        Run ) runTest testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist; break;;
        Skip ) notifyUser "Skipping testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist" 0 'dontClear'; break;;
    esac
done

showDcmsJsonDataWillBeDeletedByTestWarning "testDshBuildAppBuildsSpecifiedApp"
select rs in "Run" "Skip"; do
    case $rs in
        Run ) runTest testDshBuildAppBuildsSpecifiedApp; break;;
        Skip ) notifyUser "Skipping testDshBuildAppBuildsSpecifiedApp" 0 'dontClear'; break;;
    esac
done

showDcmsJsonDataWillBeDeletedByTestWarning "testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified"
select rs in "Run" "Skip"; do
    case $rs in
        Run ) runTest testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified; break;;
        Skip ) notifyUser "Skipping testDshBuildAppBuildsSpecifiedApp" 0 'dontClear'; break;;
    esac
done

showDcmsJsonDataWillBeDeletedByTestWarning "testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified"
select rs in "Run" "Skip"; do
    case $rs in
        Run ) runTest testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified; break;;
        Skip ) notifyUser "Skipping testDshBuildAppBuildsSpecifiedApp" 0 'dontClear'; break;;
    esac
done

