#!/bin/bash

set -o posix

clear

showPhpUnitLicenseMsg() {
      showBanner 'PHP UNIT License Message'
      notifyUser "PhpUnit will start in a moment. Please note, PhpUnit is not apart of" 0 'dontClear'
      notifyUser "the Darling Data Managent System, it is a third party library developed by" 0 'dontClear'
      notifyUser "Sebastian Bergmann." 0 'dontClear'
      notifyUser "PhpUnit is a unit testing framework for Php applications." 0 'dontClear'
      notifyUser "The official PhpUnit source can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}https://github.com/sebastianbergmann/phpunit" 0 'dontClear'
      sleep 4
      showBanner 'PHP UNIT License Message'
      notifyUser "A copy of the LICENSE associated with PhpUnit can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DSH_DIR}/PHP_UNIT_LICENSE" 0 'dontClear'
      sleep 4
      showBanner 'PHP UNIT License Message'
      notifyUser "Note: The PHP_UNIT_LICENSE is not associated with the Darling Data" 0 'dontClear'
      notifyUser "Management System, or dsh, which both are licensed under the MIT" 0 'dontClear'
      notifyUser "license." 0 'dontClear'
      notifyUser "The Darling Data Managemet System's license can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
      notifyUser "dsh is part of the Darling Data Management system, and therfore uses the same license:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
      sleep 4
      showBanner 'PHP UNIT License Message'
      notifyUser "This message will not show again unless the relevant .dsh_* cache file is deleted." 0 'dontClear'
      sleep 4
      showLoadingBar "Starting PhpUnit"
}

runPhpUnit() {
    showBanner "dsh --test-ddms | Run Php Unit Tests"
    disableCtrlC
    modifyJsonStorageDir
    [ ! -f "${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown" ] && showPhpUnitLicenseMsg
    "${PATH_TO_DDMS}vendor/phpunit/phpunit/phpunit" -c "${PATH_TO_DDMS}php.xml"
    echo "License message already shown" >"${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown"
    restoreJsonStorageDir
    enableCtrlC
}

showHelpMsg() {
    showBanner "dsh --help | Help"
    if [[ -z "${1}" || "${1}" == 'help' || "${1}" == 'h' ]]; then
        notifyUser "${HIGHLIGHTCOLOR}dsh${NOTIFYCOLOR} is a command line utility that provides various utilities to aide in development with the ${HIGHLIGHTCOLOR}Darling Data Management System${NOTIFYCOLOR}." 0 'dontClear'
        notifyUser "Note: To get information about a specific flag supply the ${HIGHLIGHTCOLOR}-h${NOTIFYCOLOR}" 0 'dontClear'
        notifyUser "      flag with either the flag's ${HIGHLIGHTCOLOR}letter name${NOTIFYCOLOR}, or the flag's ${HIGHLIGHTCOLOR}full name${NOTIFYCOLOR}," 0 'dontClear'
        notifyUser "      excluding the preceding - or --" 0 'dontClear'
        notifyUser "      For example, you could use either of the following to get help information about the ${HIGHLIGHTCOLOR}--test-ddms${NOTIFYCOLOR} flag:" 0 'dontClear'
        notifyUser "      ${HIGHLIGHTCOLOR}dsh -h test-ddms" 0 'dontClear'
        notifyUser "      ${HIGHLIGHTCOLOR}dsh -h t" 0 'dontClear'
        notifyUser "To get a list of the available flags use ${HIGHLIGHTCOLOR} dsh -h flags" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'start-app-server' || "${1}" == 's' ]]; then
        notifyUser "The -s, or --start-app-server flag will start a local server" 0 'dontClear'
        notifyUser "for you to use while in development." 0 'dontClear'
        notifyUser "The -s flag expects one argument, a port number." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -s 8080" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --start-app-server 8888" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'test-ddms' || "${1}" == 't' ]]; then
        notifyUser "The -t, or --test-ddms flag will run phpunit using ${HIGHLIGHTCOLOR}${PATH_TO_DDMS}php.xml${NOTIFYCOLOR} for configuration." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -t" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --test-ddms" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'build-app' || "${1}" == 'b' ]]; then
        notifyUser "The -b, or --build-app flag will run the specified app's Components.php to build the app's components." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -b AppName" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --build-app AppName" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'run-app' || "${1}" == 'r' ]]; then
        notifyUser "The -r, or --run-app flag will run PhpUnit, build the specified app, and start an development server for the specified app." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --run-app AppName" 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}Note: --run-app runs the app in isolation. Temporary storage and a temporary app domain will be used while the app is running in order to protect any existing app data from being harmed." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}Note: Once the development server that was started for the app instance is stopped, the app instance, and it's data, will no longer be available." 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'flags' ]]; then
        notifyUser "${HIGHLIGHTCOLOR}--help FLAGNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-h FLAGNAME${NOTIFYCOLOR}: Show help information. If FLAGNAME is specified show detailed help information about specified flag." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--test-ddms${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-t${NOTIFYCOLOR} : Run the Darling Data Management System's php unit tests." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--build-app APPNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-b APPNAME${NOTIFYCOLOR} : Build the specified app by running the app's Components.php file." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--start-app-server PORT${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-s PORT${NOTIFYCOLOR} : Start a development server to use for the app @ ${HIGHLIGHTCOLOR}http://localhost:PORT" 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--run-app APPNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-r APPNAME${NOTIFYCOLOR} : Run the specified app. First, phpunit will run, then the app will be built, and an development server will be started for the app using a random PORT, for example: ${HIGHLIGHTCOLOR}http://localhost:RANDOM_PORT" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == '--active-development-servers' || "${1}" == 'j' ]]; then
        notifyUser "The -j, or --active-development-servers will list all currently running development servers." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -j" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --active-development-servers" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == '--stop-all-development-servers' || "${1}" == 'k' ]]; then
        notifyUser "The -k, or --stop-all-development-servers will stop all currently running development servers." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -k" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --stop-all-development-servers" 0 'dontClear'
        exit 0
    fi
    notifyUser "${ERRORCOLOR}Invalid option supplied to -help flag." 0 'dontClear'
    notifyUser "Options:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}dsh --help${CLEAR_ALL_TEXT_STYLES}  ${HIGHLIGHTCOLOR}dsh --help app${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}dsh --help apps${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
}

startAppServer() {
    showBanner "dsh --start-app-server ${1} | Start development server on port ${1}"
    disableCtrlC
    showLoadingBar "Starting local development server at localhost:${1}" 'dontClear'
    newLine
    notifyUser "Server is running @ ${HIGHLIGHTCOLOR}${BLACK_FG_COLOR}http://localhost:${1}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    sleep 2
    newLine
    /usr/bin/php -S "localhost:${1}" -t "${PATH_TO_DDMS}" &> /dev/null & xdg-open "http://localhost:${1}" &>/dev/null & disown
    enableCtrlC
}

disableCtrlC() {
    trap '' 2
    newLine
    notifyUser "${HIGHLIGHTCOLOR}${BLACK_FG_COLOR}CTRL-C${RED_BG_COLOR} has been temporarily disabled until the current dsh process is complete.${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    newLine
}

enableCtrlC() {
    trap 2
}

getJsonStorageDriverInterfacePath()
{
    printf "%s" "${PATH_TO_DDMS}/core/interfaces/component/Driver/Storage/FileSystem/JsonStorageDriver.php"
}

getCurrentJsonStorageDirectoryName() {
    grep -Eo "NAME = '.*';" "$(getJsonStorageDriverInterfacePath)" | grep -Eo "'.*'" | sed -E "s/'//g"
}

generateRandomStorageDirectoryName() {
    printf "%s" "$(getCurrentJsonStorageDirectoryName)${RANDOM}${RANDOM}"
}

modifyJsonStorageDir() {
    ORIGINAL_STORAGE_DIRECTORY_NAME="$(getCurrentJsonStorageDirectoryName)"
    NEW_STORAGE_DIRECTORY_NAME="$(generateRandomStorageDirectoryName)"
    PATH_TO_TEMP_STORAGE_DIRECTORY="${PATH_TO_DDMS}.${NEW_STORAGE_DIRECTORY_NAME}"
    showLoadingBar "Configuring temporary Storage Directory Name" 'dontClear'
    notifyUser "Original Storage directory Name:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}${ORIGINAL_STORAGE_DIRECTORY_NAME}" 0 'dontClear'
    notifyUser "Temporary Storage Directory Name:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}${NEW_STORAGE_DIRECTORY_NAME}" 0 'dontClear'
    newLine
    sed -i "s/${ORIGINAL_STORAGE_DIRECTORY_NAME}/${NEW_STORAGE_DIRECTORY_NAME}/g" "$(getJsonStorageDriverInterfacePath)"
}

restoreJsonStorageDir() {
    sed -i "s/${NEW_STORAGE_DIRECTORY_NAME}/${ORIGINAL_STORAGE_DIRECTORY_NAME}/g" "$(getJsonStorageDriverInterfacePath)"
    [ "${1}" == "keepDir" ] && return
    showLoadingBar "Removing temporary storage directory: ${HIGHLIGHTCOLOR}${PATH_TO_TEMP_STORAGE_DIRECTORY}" 'dontClear'
    rm -R "${PATH_TO_TEMP_STORAGE_DIRECTORY}"
}

expectedPathToAppStorageDir() {
    printf "%s" "${PATH_TO_DDMS}.dcmsJsonData/localhost$(determinePort ${1})"
}

buildApp() {
   disableCtrlC
   [ -z "${1}" ] && notifyUser "${ERRORCOLOR}You must specify an app to run. For example: ${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear' && exit 1
   MOST_RECENTLY_RUN_APP_PATH="${PATH_TO_DDMS}Apps/${1}"
   [ ! -d "${MOST_RECENTLY_RUN_APP_PATH}" ] && notifyUser "${ERRORCOLOR}The specified app,${HIGHLIGHTCOLOR}${1}${ERRORCOLOR}, does not exist. Please specify an existing app as follows:" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}dsh -b AppName${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear' && newLine && notifyUser "${CLEAR_ALL_TEXT_STYLES}${GREEN_BG_COLOR}${BLACK_FG_COLOR}The following apps are available" 0 'dontClear' && cd "${PATH_TO_DDMS}" && newLine && ls --color Apps && newLine && exit 1
   cd "${MOST_RECENTLY_RUN_APP_PATH}"
   [[ -d "$(expectedPathToAppStorageDir ${1})" ]] && notifyUser "${WARNINGCOLOR}The ${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${WARNINGCOLOR} app was already built, to build the app again, please remove the following directory:${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}$(expectedPathToAppStorageDir ${1})${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
   [[ ! -d "$(expectedPathToAppStorageDir ${1})" ]] && /usr/bin/php Components.php
   enableCtrlC
}

getAppComponentsFilePath()
{
    printf "%s" "${PATH_TO_DDMS}/Apps/${1}/Components.php"
    # @todo printf "%s" "${PATH_TO_DDMS}/Apps/${1}/Components.php"
}

getCurrentAppDomainName() {
    grep -E "::buildDomain" "$(getAppComponentsFilePath ${1})" | grep -Eo "'.*'" | sed -E "s/'//g"
}

generateRandomAppDomainName() {
    printf "%s" "http://localhost:8${RANDOM: -3}"
}

modifyAppDomain() {
    showBanner "Setting up temporary app domain"
    ORIGINAL_APP_DOMAIN_NAME="$(getCurrentAppDomainName ${1})"
    NEW_APP_DOMAIN_NAME="$(generateRandomAppDomainName)"
    showLoadingBar "Configuring temporary App Domain Name" 'dontClear'
    notifyUser "Original App Domain Name:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}${ORIGINAL_APP_DOMAIN_NAME}" 0 'dontClear'
    notifyUser "Temporary App Domain Name:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}${NEW_APP_DOMAIN_NAME}" 0 'dontClear'
    newLine
    sed -i "s,${ORIGINAL_APP_DOMAIN_NAME},${NEW_APP_DOMAIN_NAME},g" "$(getAppComponentsFilePath ${1})"
}

restoreAppDomain() {
    sed -i "s,${NEW_APP_DOMAIN_NAME},${ORIGINAL_APP_DOMAIN_NAME},g" "$(getAppComponentsFilePath ${1})"
}

determinePort() {
    printf "$(getCurrentAppDomainName ${1} | grep -Eo '[0-9][0-9][0-9][0-9]')"
}

runApp() {
    showBanner " dsh --run-app ${1} | Running app ${1}"
    [ -z "${1}" ] && notifyUser "${ERRORCOLOR}The dsh --run-app flag expects you to specify the name of the app to run." 0 'dontClear' && notifyUser "For example:" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}dsh --run-app AppName" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear' && exit 1
    showLoadingBar "Running tests before starting the ${1} app"
    runPhpUnit
    showLoadingBar "Starting up the ${1} app"
    modifyAppDomain "${1}"
    if [ ! -d "${PATH_TO_DDMS}.dcmsJsonData/$(getCurrentAppDomainName ${1}) | sed 's,:,,g')" ]; then
        showLoadingBar "Preparing to build the ${1} app"
        buildApp "${1}"
    fi
    startAppServer "$(determinePort ${1})"
    restoreAppDomain "${1}"
}

activeServers() {
    printf "%s" "$(ps -aux | grep -Eo 'php -S localhost:[0-9][0-9][0-9][0-9]' | sed 's,php -S localhost,http://localhost,g')"
}

showActiveDevelopmentServers() {
    showBanner "dsh --active-development-servers | Active development servers"
    local numberOfActiveServers
    numberOfActiveServers="$(activeServers | wc -w)"
    notifyUser "There are ${numberOfActiveServers} active development servers." 0 'dontClear'
    [[ "${numberOfActiveServers}" == '0' ]] && exit 0
    notifyUser "To determine which app is running on which server just open one of the urls from the list below in your browser." 0 'dontClear'
    printf "%s" "$(activeServers | column)"
}

stopAllDevelopmentServers() {
    showBanner "dsh --stop-all-development-servers | Shutting down all development servers"
    showLoadingBar "Stopping all active development servers"
    killall php &> /dev/null
    showActiveDevelopmentServers
    exit 0
}
