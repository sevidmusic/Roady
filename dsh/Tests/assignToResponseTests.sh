#!/bin/bash
# draftAssignSed.sh

set -o posix

expectedResponseConfiguration() {
    local target_response_name target_response_path component_name component_container component_type
    [[ -z "${1}" ]] && logErrorAndExit1 "expectedResponseConfiguration() expects the name of the test App the target Response is defined for be specified as the first parameter"
    [[ -z "${2}" ]] && logErrorAndExit1 "expectedResponseConfiguration() expects the name of the Response be specified as the second parameter"
    [[ -z "${3}" ]] && logErrorAndExit1 "expectedResponseConfiguration() expects the name of the Component be specified as the third parameter"
    [[ -z "${4}" ]] && logErrorAndExit1 "expectedResponseConfiguration() expects the Component's container be specified as the fourth parameter"
    [[ -z "${5}" ]] && logErrorAndExit1 "expectedResponseConfiguration() expects the Components type be specified as the fith parameter"
    target_response_name="${2}"
    target_response_path="$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${1}/Responses/${target_response_name}.php"
    component_name="${3}"
    component_container="${4}"
    component_type="${5}"
    sed "s/);/    \$appComponentsFactory->getComponentCrud()->readByNameAndType(@        '${component_name}',@        ${component_type}::class,@        \$appComponentsFactory->getLocation(),@        '${component_container}',@    ),@);/g" "${target_response_path}" | tr '@' '\n'
}

test_app_name="AppName${RANDOM}"
showLoadingBar "Creating test App ${test_app_name} for use by tests defined in assignToResponseTests.sh" 'dontClear'
dsh -n App "${test_app_name}"
dsh -n Response "${test_app_name}" ResponseName 0

testDshAssignToResponseRunsWithErrorIfAppNameIsNotSpecified() {
    assertError "dsh --assign-to-response" "dsh assign-to-response MUST run with an error if the name of the App the target Response is defined for is not specified as the first parameter"
}

testDshAssignToResponseRunsWithErrorIfResponseNameIsNotSpecified() {
    assertError "dsh --assign-to-response ${test_app_name}" "dsh assign-to-response MUST run with an error if the name of the Response is not specified as the second parameter"
}

testDshAssignToResponseRunsWithErrorIfComponentNameIsNotSpecified() {
    assertError "dsh --assign-to-response ${test_app_name} ResponseName" "dsh assign-to-response MUST run with an error if the name of the Component to assign to the Response is not specified as the third parameter"
}

testDshAssignToResponseRunsWithErrorIfComponentContainerIsNotSpecified() {
    assertError "dsh --assign-to-response ${test_app_name} ResponseName ComponentName" "dsh assign-to-response MUST run with an error if the Component's container is not specified as the fourth parameter"
}

testDshAssignToResponseRunsWithErrorIfComponentTypeIsNotSpecified() {
    assertError "dsh --assign-to-response ${test_app_name} ResponseName ComponentName ComponentContainer" "dsh assign-to-response MUST run with an error if the Component's type is not specified as the fith parameter"
}

testDshAssignToResponseRunsWithErrorIfSpecifiedAppDoesNotExist() {
    assertError "dsh --assign-to-response AppName${RANDOM}${RANDOM} ResponseName ComponentName ComponentContainer ComponentType" "dsh --assign-to-response MUST run with an error if the specified App does not exist."
}

testDshAssignToResponseRunsWithErrorIfSpecifiedResponseIsNotDefinedForSpecifiedApp() {
    assertError "dsh --assign-to-response ${test_app_name} ResponseName${RANDOM} ComponentName ComponentContainer ComponentType" "dsh --assign-to-response MUST run with an error if the specified Response is not defined for the specified App."
}

testDshAssignToResponseRunsWithErrorIfSpecifiedComponentIsNotDefinedForTheSpecifiedApp() {
    assertError "dsh --assign-to-response ${test_app_name} ResponseName ComponentName${RANDOM} ComponentContainer OutputComponent" "dsh --assign-to-response MUST run with an error if the specified Component is not defined for the specified App."
    assertError "dsh --assign-to-response ${test_app_name} ResponseName ComponentName${RANDOM} ComponentContainer DynamicOutputComponent" "dsh --assign-to-response MUST run with an error if the specified Component is not defined for the specified App."
    assertError "dsh --assign-to-response ${test_app_name} ResponseName ComponentName${RANDOM} ComponentContainer Request" "dsh --assign-to-response MUST run with an error if the specified Component is not defined for the specified App."
}

testDshAssignToResponseProducesExpectedResponseConfiguration() {
    local expectedConfiguration responseName componentName componentContainer
    responseName="TestAssignToResponse"
    componentName="ComponentNameOC"
    componentContainer="ComponentContainer"
    dsh -n Response "${test_app_name}" ${responseName} 0
    dsh -n OutputComponent "${test_app_name}" "${componentName}" "${componentContainer}" 4 "Output..."
    expectedConfiguration="$(expectedResponseConfiguration "${test_app_name}" "${responseName}" "${componentName}" "${componentContainer}" OutputComponent)"
    dsh --assign-to-response "${test_app_name}" "${responseName}" "${componentName}" "${componentContainer}" OutputComponent
    assertEquals "${expectedConfiguration}" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Responses/${responseName}.php")" "dsh --assign-to-response MUST correctly assign the specified Component to the specified Response."
}



# @todo testDshAssignToResponseRunsWithErrorIfSpecifiedComponentIsAlreadyAssignedToSpecifiedRespnse()

runTest testDshAssignToResponseRunsWithErrorIfAppNameIsNotSpecified
runTest testDshAssignToResponseRunsWithErrorIfResponseNameIsNotSpecified
runTest testDshAssignToResponseRunsWithErrorIfComponentNameIsNotSpecified
runTest testDshAssignToResponseRunsWithErrorIfComponentContainerIsNotSpecified
runTest testDshAssignToResponseRunsWithErrorIfComponentTypeIsNotSpecified
runTest testDshAssignToResponseRunsWithErrorIfSpecifiedAppDoesNotExist
runTest testDshAssignToResponseRunsWithErrorIfSpecifiedResponseIsNotDefinedForSpecifiedApp
runTest testDshAssignToResponseRunsWithErrorIfSpecifiedComponentIsNotDefinedForTheSpecifiedApp 3
runTest testDshAssignToResponseProducesExpectedResponseConfiguration

[[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"

