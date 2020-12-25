#!/bin/bash
# dshTestsConfig.sh

set -o posix

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshHelp' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/helpTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshHelpFLAG' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/helpFLAGTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshStartDevelopmentServer' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/startDevelopmentServerTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshBuildApp' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/buildAppTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshNew' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/newTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshNewApp' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/newAppTests.sh"
fi

if [[ "$(getSpecifiedTestGroup)" == 'all' || "$(getSpecifiedTestGroup)" == 'TestDshNewOutputComponent' ]]; then
    loadLibrary "$(determineDshUnitDirectoryPath | sed 's/dshUnit/dsh/g')/Tests/newOutputComponentTests.sh"
fi

