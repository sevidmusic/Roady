#!/bin/bash
# newAppTests.sh

set -o posix

determineAppsDirectoryPath() {
    printf "%s" "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${1}"
}

testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified() {
    assertError "dsh --new App" "dsh --new App <APP_NAME> <DOMAIN> MUST run with an error if the name to assign to the new App is not specified via the first parameter."
}

testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME() {
    local test_app_name
    test_app_name="AppName${RANDOM}"
    showLoadingBar "Creating test App ${test_app_name} for testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME()" 'dontClear'
    dsh --new App "${test_app_name}" &> /dev/null
    assertError "dsh --new App ${test_app_name}" "dsh --new App <APP_NAME> <DOMAIN> MUST run with an error if the name to assign to the new App is not specified via the first parameter."
    [[ -d "$(determineAppsDirectoryPath "${test_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${test_app_name}")"
}

testDshNewAppCreatesNewAppsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App at $(determineAppsDirectoryPath '<APP_NAME>')."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsOutputComponentsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/OutputComponents" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's OutputComponents at $(determineAppsDirectoryPath '<APP_NAME>')/OutputComponents."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsRequestsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/Requests" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's Requests at $(determineAppsDirectoryPath '<APP_NAME>')/Requests."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsResponsesDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/Responses" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's Responses at $(determineAppsDirectoryPath '<APP_NAME>')/Responses."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsDynamicOutputDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/DynamicOutput" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's DynamicOutput at $(determineAppsDirectoryPath '<APP_NAME>')/DynamicOutput."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsCssDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/css" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's css at $(determineAppsDirectoryPath '<APP_NAME>')/css."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsJsDirectory() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertDirectoryExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/js" "dsh --new App <APP_NAME> <DOMAIN> MUST create a directory for the new App's js at $(determineAppsDirectoryPath '<APP_NAME>')/js."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsComponentsPhpFile() {
    local random_app_name
    random_app_name="Foo${RANDOM}"
    assertFileExists "dsh --new App "${random_app_name}"" "$(determineAppsDirectoryPath "${random_app_name}")/Components.php" "dsh --new App <APP_NAME> <DOMAIN> MUST create a Components.php file for the new App at $(determineAppsDirectoryPath '<APP_NAME>')/Components.php."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

testDshNewAppCreatesNewAppsComponentsPhpFileWhoseContentMatchesComponentsPhpFileTemplate() {
    local random_app_name components_php_file_template_path created_components_php_file_path
    random_app_name="Foo${RANDOM}"
    components_php_file_template_path="$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/FileTemplates/Components.php"
    created_components_php_file_path="$(determineAppsDirectoryPath "${random_app_name}")/Components.php"
    assertNoError "dsh --new App ${random_app_name}" "Running dsh --new App ${random_app_name} to test that dsh --new App <APP_NAME> <DOMAIN> creates a Components.php file at Apps/<APP_NAME>/Components.php whose content matches the content of the Components.php file template at dsh/FileTemplates/Components.php"
    assertEquals "$(cat ${components_php_file_template_path})" "$(cat ${created_components_php_file_path})" "dsh --new <APP_NAME> <DOMAIN> MUST create a Components.php file for the new App whose content matches the Components.php template file at ${components_php_file_template_path}."
    [[ -d "$(determineAppsDirectoryPath "${random_app_name}")" ]] && rm -R "$(determineAppsDirectoryPath "${random_app_name}")"
}

actualDomain() {
    local test_app_name
    test_app_name="${1}"
    printf "%s" "$(grep -o "http.*[']" "$(dsh -l)/Apps/${test_app_name}/Components.php" | sed "s/'//g")"
}

testDshNewAppAssignsSpecifiedDOMAINAsNewAppsDefaultDomainIfDOMAINIsSpecified() {
     local test_app_name expected_domain
     test_app_name="App${RANDOM}"
     expected_domain="http://testdomain${RANDOM}.example/"
     dsh -n App "${test_app_name}" "${expected_domain}"
     assertEquals "${expected_domain}" "$(actualDomain "${test_app_name}")"
}

testDshNewAppRunsWithErrorIfSpecifiedDOMAINIsNotAValidDomain() {
    assertError "dsh -n App AppName${RANDOM} fooBarBaz"
    assertError "dsh -n App AppName${RANDOM} 'http:mistypedurl'"
    assertError "dsh -n App AppName${RANDOM} 'http/:mistypedurl'"
    assertError "dsh -n App AppName${RANDOM} 'mistypedurl.com'"
}

runTest testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified
runTest testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME
runTest testDshNewAppCreatesNewAppsDirectory
runTest testDshNewAppCreatesNewAppsOutputComponentsDirectory
runTest testDshNewAppCreatesNewAppsRequestsDirectory
runTest testDshNewAppCreatesNewAppsResponsesDirectory
runTest testDshNewAppCreatesNewAppsDynamicOutputDirectory
runTest testDshNewAppCreatesNewAppsCssDirectory
runTest testDshNewAppCreatesNewAppsJsDirectory
runTest testDshNewAppCreatesNewAppsComponentsPhpFile
runTest testDshNewAppCreatesNewAppsComponentsPhpFileWhoseContentMatchesComponentsPhpFileTemplate 2
runTest testDshNewAppAssignsSpecifiedDOMAINAsNewAppsDefaultDomainIfDOMAINIsSpecified
runTest testDshNewAppRunsWithErrorIfSpecifiedDOMAINIsNotAValidDomain 4
