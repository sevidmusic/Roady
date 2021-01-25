#!/bin/bash

set -o posix

test_app_name="TestApp${RANDOM}"
test_app_packages="${HOME}/TestAppPackages"
test_app_package_path="${test_app_packages}/${test_app_name}"
test_app_path="$(dsh -l)Apps/${test_app_name}"

setup() {
    [[ -d "${test_app_packages}" ]] || mkdir "${test_app_packages}"
    dsh -n AppPackage "${test_app_name}" "${HOME}/TestAppPackages" "http://localhost:8420"
    showLoadingBar "${COLOR_23}Creating files for the ${test_app_name} Test App Package" 'dontClear'
    printf "\nbody {background: #000000; color: #ffffff; }" > "${test_app_package_path}/css/styles.css"
    printf "\nconsole.log('test js');" > "${test_app_package_path}/js/js.js"
    printf "\n<h1>Test Dynamic Output</h1>" > "${test_app_package_path}/DynamicOutput/DynamicOutputFile.html"
    printf "\ndsh -n GlobalResponse \"\${app_name}\" FooGlobalRes 0" >> "${test_app_package_path}/Responses.sh"
    printf "\ndsh -n Response \"\${app_name}\" FooRes 0" >> "${test_app_package_path}/Responses.sh"
    printf "\ndsh -n Request \"\${app_name}\" FooResReq ReqContainer \"index.php\"" >> "${test_app_package_path}/Requests.sh"
    printf "\ndsh -a \"\${app_name}\" FooRes FooResReq ReqContainer Request" >> "${test_app_package_path}/Requests.sh"
    printf "\ndsh -n DynamicOutputComponent \"\${app_name}\" DOC DOCContainer 0 \"DynamicOutputFile.html\"" >> "${test_app_package_path}/OutputComponents.sh"
    printf "\ndsh -a \"\${app_name}\" FooGlobalRes DOC DOCContainer DynamicOutputComponent" >> "${test_app_package_path}/OutputComponents.sh"
    printf "\ndsh -n OutputComponent \"\${app_name}\" OC OCContainer 0 \"Some Static Output\"" >> "${test_app_package_path}/OutputComponents.sh"
    printf "\ndsh -a \"\${app_name}\" FooRes OC OCContainer OutputComponent" >> "${test_app_package_path}/OutputComponents.sh"
    chmod -R 0755 "${test_app_package_path}"
}

tearDown() {
    [[ -d "${test_app_packages}" ]] && rm -Rf "${test_app_packages}"
    [[ -d "${test_app_path}" ]] && rm -Rf "${test_app_path}"
}

testMakeApp() {
    dsh -n App "${test_app_name}" "$(dsh -q "${test_app_package_path}" domain)"
    [[ -d "${test_app_path}/css" ]] &&  rm -Rf "${test_app_path}/css"
    [[ -d "${test_app_path}/js" ]] &&  rm -Rf "${test_app_path}/js"
    [[ -d "${test_app_path}/DynamicOutput" ]] &&  rm -Rf "${test_app_path}/DynamicOutput"
    cp -R "${test_app_package_path}/css" "${test_app_path}/css"
    cp -R "${test_app_package_path}/js" "${test_app_path}/js"
    cp -R "${test_app_package_path}/DynamicOutput" "${test_app_path}/DynamicOutput"
    cp "${test_app_package_path}/config.sh" "${test_app_path}/.config.sh"
    . "${test_app_package_path}/Responses.sh"
    . "${test_app_package_path}/Requests.sh"
    . "${test_app_package_path}/OutputComponents.sh"
}

testDshMakeAppRunsWithErrorIfPATH_TO_APP_PACKAGEIsNotSpecified() {
    setup
    assertError "dsh --make-app"
    tearDown
}

testDshMakeAppRunsWithErrorIfAnAppPackageDoesNotExistAtPATH_TO_APP_PACKAGE() {
    setup
    assertError "dsh --make-app ${RANDOM}AppPackage"
    tearDown
}

testDshMakeAppRunsWithErrorIfAnAppAlreadyExistsWhoseNameMatchesTheNameOfTheAppToBeMadeAndREPLACE_EXISTING_APPIsNotSetTo_replace() {
    setup
    testMakeApp
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_css_Directory() {
    setup
    rm -Rf "${test_app_package_path}/css"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_js_Directory() {
    setup
    rm -Rf "${test_app_package_path}/js"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_DynamicOutput_Directory() {
    setup
    rm -Rf "${test_app_package_path}/DynamicOutput"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}


testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Responses_Script() {
    setup
    rm "${test_app_package_path}/Responses.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Requests_Script() {
    setup
    rm "${test_app_package_path}/Requests.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_OutputComponents_Script() {
    setup
    rm "${test_app_package_path}/OutputComponents.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Config_Script() {
    setup
    rm "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_app_name_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" app_name)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}
testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_bug_contact_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" bug_contact)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_config_locked_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" config_locked)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_dependencies_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" dependencies)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_description_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" description)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_developers_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" developers)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_development_port_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" development_port)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_documentation_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" documentation)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_domain_Setting() {
    setup
    sed -i "s,$(dsh -q "${test_app_package_path}" domain),,g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_license_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" license)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_version_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" version)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_version_date_Setting() {
    setup
    sed -i "s/$(dsh -q "${test_app_package_path}" version_date)//g" "${test_app_package_path}/config.sh"
    assertError "dsh --make-app ${test_app_package_path}"
    tearDown
}

testDshMakeAppMakesTheApp() {
    setup
    testMakeApp
    find "${test_app_path}" -type f -exec cat {} \; > "${HOME}/TestDshMakeAppResult1.txt"
    rm -Rf "${test_app_path}"
    dsh -m "${test_app_package_path}"
    find "${test_app_path}" -type f -exec cat {} \; > "${HOME}/TestDshMakeAppResult2.txt"
    assertEquals "$(cat "${HOME}/TestDshMakeAppResult1.txt")" "$(cat "${HOME}/TestDshMakeAppResult2.txt")"
    rm "${HOME}/TestDshMakeAppResult1.txt"
    rm "${HOME}/TestDshMakeAppResult2.txt"
    tearDown
}

#runTest testDshMakeAppRunsWithErrorIfPATH_TO_APP_PACKAGEIsNotSpecified
#runTest testDshMakeAppRunsWithErrorIfAnAppPackageDoesNotExistAtPATH_TO_APP_PACKAGE
#runTest testDshMakeAppRunsWithErrorIfAnAppAlreadyExistsWhoseNameMatchesTheNameOfTheAppToBeMadeAndREPLACE_EXISTING_APPIsNotSetTo_replace
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_css_Directory
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_js_Directory
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_DynamicOutput_Directory
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Responses_Script
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Requests_Script
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_OutputComponents_Script
#runTest testDshMakeAppRunsWithErrorIfTheAppPackageDoesNotContainA_Config_Script
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_app_name_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_bug_contact_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_config_locked_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_dependencies_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_description_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_developers_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_development_port_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_documentation_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_domain_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_license_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_version_Setting
#runTest testDshMakeAppRunsWithErrorIfTheAppPackagesConfigSHDoesNotDefineA_version_date_Setting
runTest testDshMakeAppMakesTheApp

##############
#testDshMakeAppCreatesAHiddenCopyOfTheAppPackagesConfigSHInTheNewAppsDirectory()
#testDshMakeAppMakesAppEvenIfAppAlreadyExistsWhoseNameMatchesTheNameOfTheAppToBeMadeIfREPLACE_EXISTING_APPIsSetTo_replace
#testDshMakeAppMakesAnAppThatCanBeBuiltByDshBuildAppWithoutError

