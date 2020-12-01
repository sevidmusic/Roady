#!/bin/bash
# dshUnitTests.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'testsCanRun' ]]; then
    . "$(determineDshUnitDirectoryPath)/dshUnitTests.sh"
fi
