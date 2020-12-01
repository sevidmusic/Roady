#!/bin/bash
# dshUnitConfig.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertSuccess' ]]; then
    . "$(determineDshUnitDirectoryPath)/AssertSuccessTests.sh"
fi
