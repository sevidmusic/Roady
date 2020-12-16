#!/bin/bash
# dshTestsConfig.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestAssertNoError' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/helpTests.sh"
fi

