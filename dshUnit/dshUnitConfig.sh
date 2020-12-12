#!/bin/bash
# dshUnitConfig.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertNoError' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertNoErrorTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertError' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertErrorIfDirectoryExists' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorIfDirectoryExistsTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertErrorIfFileExists' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorIfFileExistsTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertErrorIfDirectoryDoesNotExist' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorIfDirectoryDoesNotExistTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertErrorIfFileDoesNotExist' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorIfFileDoesNotExistTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertErrorIfFileIsNotExecutable' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertErrorIfFileIsNotExecutable.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertDirectoryExists' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertDirectoryExistsTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertDirectoryDoesNotExist' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertDirectoryDoesNotExistTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertFileExists' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertFileExistsTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertFileDoesNotExist' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertFileDoesNotExistTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertEquals' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertEqualsTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertNotEquals' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath)/AssertNotEqualsTests.sh"
fi


