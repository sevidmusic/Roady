#!/bin/bash
# startDevelopmentServerTests.sh

set -o posix

activeServers() {
    printf "%s" "$(ps -aux | grep -Eo 'php -S localhost:[0-9][0-9][0-9][0-9]' | sed 's,php -S localhost,http://localhost,g')"
}

numberOfActiveServers() {
    printf "%s" "$(activeServers | wc -w)"
}

testDshStartDevelopmentServerRunsWithoutError() {
    assertNoError "dsh --start-development-server" "dsh --start-development-server MUST run without error."
}

testDshStartDevelopmentServerStartsDevelopmentServer() {
    killall php &> /dev/null
    dsh --start-development-server
    assertEquals "1" "$(numberOfActiveServers)" "dsh --start-development-server MUST start a development server."
    killall php &> /dev/null
}

runTest testDshStartDevelopmentServerRunsWithoutError
runTest testDshStartDevelopmentServerStartsDevelopmentServer

