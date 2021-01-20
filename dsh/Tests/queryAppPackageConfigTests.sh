#!/bin/bash
# queryAppPackageConfigTests.sh

set -o posix

getTestAppPackagePath() {
    printf "%s" "${HOME}/TestAppPackage"
}

setup() {
    showLoadingBar "Creating ${HOME}/TestAppPackage" 'dontClear'
    dsh -n AppPackage "TestAppPackage" "${HOME}"
}

teardown() {
    showLoadingBar "Removing $(getTestAppPackagePath)" 'dontClear'
    rm -Rf "$(getTestAppPackagePath)"
}

testDshQueryAppPackageConfigRunsWithErrorIfAppPackageDoesNotExistAtPATH_TO_APP_PACKAGE() {
    assertError "dsh --query-app-package-config ${RANDOM} app_name"
}

testDshQueryAppPackageConfigRunsWithErrorIfASettingNamedSETTING_NAMEIsNotDefinedInTheAppPackagesConfigSH() {
    assertError "dsh --query-app-package-config $(getTestAppPackagePath) setting${RANDOM}"
}

testDshQueryAppPackageConfigRunsWithErrorIfSettingNamedSETTING_NAMEHasNoValue() {
    printf "%s" 'emptySetting=""' >> "$(getTestAppPackagePath)/config.sh"
    assertError "dsh --query-app-package-config $(getTestAppPackagePath) emptySetting"
}

testDshQueryAppPackageConfigReturnsValueOfSettingNamedSETTING_NAMEDefinedInAppPackageConfigSHAtPATH_TO_APP_PACKAGE() {
    assertEquals "TestAppPackage" "$(dsh --query-app-package-config $(getTestAppPackagePath) app_name)"
}

setup
runTest testDshQueryAppPackageConfigRunsWithErrorIfAppPackageDoesNotExistAtPATH_TO_APP_PACKAGE
runTest testDshQueryAppPackageConfigRunsWithErrorIfASettingNamedSETTING_NAMEIsNotDefinedInTheAppPackagesConfigSH
runTest testDshQueryAppPackageConfigRunsWithErrorIfSettingNamedSETTING_NAMEHasNoValue
runTest testDshQueryAppPackageConfigReturnsValueOfSettingNamedSETTING_NAMEDefinedInAppPackageConfigSHAtPATH_TO_APP_PACKAGE
teardown

