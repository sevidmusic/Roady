#!/bin/bash
# dshUnitConfig.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertNoError' ]]; then
    . "$(determineDshUnitDirectoryPath)/AssertNoErrorTests.sh"
fi
