#!/bin/bash

set -o posix

clear

showHelpMsg() {
    showBanner "dsh --help ${1:-''}| dsh -h ${1:-''} | ${HIGHLIGHTCOLOR}Help"
    if [[ -z "${1}" || "${1}" == 'help' || "${1}" == 'h' ]]; then
        notifyUser "${HIGHLIGHTCOLOR}dsh${NOTIFYCOLOR} is a command line utility" 0 'dontClear'
        notifyUser "that provides various utilities to aide in development with" 0 'dontClear'
        notifyUser "the ${HIGHLIGHTCOLOR}Darling Data Management System${NOTIFYCOLOR}." 0 'dontClear'
        notifyUser "Note: To get information about a specific flag supply the" 0 'dontClear'
        notifyUser "      ${HIGHLIGHTCOLOR}-h${NOTIFYCOLOR} flag with either the flag's ${HIGHLIGHTCOLOR}letter name${NOTIFYCOLOR}, or" 0 'dontClear'
        notifyUser "      the flag's ${HIGHLIGHTCOLOR}full name${NOTIFYCOLOR}, excluding the preceding - or --" 0 'dontClear'
        notifyUser "      For example, you could use either of the following to" 0 'dontClear'
        notifyUser "      get help information about the ${HIGHLIGHTCOLOR}--test-ddms" 0 'dontClear'
        notifyUser "      flag:" 0 'dontClear'
        notifyUser "      ${HIGHLIGHTCOLOR}dsh -h test-ddms" 0 'dontClear'
        notifyUser "      ${HIGHLIGHTCOLOR}dsh -h t" 0 'dontClear'
        notifyUser "To get a list of the available flags use:" 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}dsh -h flags" 0 'dontClear'
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
        notifyUser "Finally, if xdg-open is available on the system, the App will open in the user's default web browser." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --run-app AppName" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'flags' || "${1}" == 'f' ]]; then
        notifyUser "${HIGHLIGHTCOLOR}--help FLAGNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-h FLAGNAME${NOTIFYCOLOR}: Show help information. If FLAGNAME is specified show detailed help information about specified flag." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--test-ddms${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-t${NOTIFYCOLOR} : Run the Darling Data Management System's php unit tests." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--build-app APPNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-b APPNAME${NOTIFYCOLOR} : Build the specified app by running the app's Components.php file." 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--start-app-server PORT${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-s PORT${NOTIFYCOLOR} : Start a development server to use for the app @ ${HIGHLIGHTCOLOR}http://localhost:PORT" 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--run-app APPNAME${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-r APPNAME${NOTIFYCOLOR} : Run the specified app. First, phpunit will run, then the app will be built, and an development server will be started for the app using a random PORT, for example: ${HIGHLIGHTCOLOR}http://localhost:RANDOM_PORT" 0 'dontClear'
        notifyUser "${HIGHLIGHTCOLOR}--new MODE ARGS${NOTIFYCOLOR}, ${HIGHLIGHTCOLOR}-n MODE ARGS${NOTIFYCOLOR} : Can be used to create a new App, shared or App specific Dynamic Output files, and Responses for an App. The --new flag is modal, meaning, the argument following the --new, or -n, flag will determine what is to be created. For example: ${HIGHLIGHTCOLOR}dsh --new app Foo https://www.foo.com${NOTIFYCOLOR} would create and setup a new starter app named Foo in the Apps directory, whereas, ${HIGHLIGHTCOLOR}dsh --new response Foo DynamicOutput${NOTIFYCOLOR} would create a new Response for the Foo app that used DynamicOutput components to generate output." 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'active-development-servers' || "${1}" == 'j' ]]; then
        notifyUser "The -j, or --active-development-servers will list all currently running development servers." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -j" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --active-development-servers" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'stop-all-development-servers' || "${1}" == 'k' ]]; then
        notifyUser "The -k, or --stop-all-development-servers will stop all currently running development servers." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -k" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --stop-all-development-servers" 0 'dontClear'
        exit 0
    fi
    if [[ "${1}" == 'new' || "${1}" == 'n' ]]; then
        if [[ -z "${2}" || "${2}" == 'modes' || "${2}" == 'm' ]]; then
            notifyUser "The --new, or -n, flag can be used to create new Apps, define" 0 'dontClear'
            notifyUser "new Responses for existing apps, create new Dynamic Output" 0 'dontClear'
            notifyUser "files for existng Apps, or create new Shared Dynamic Output" 0 'dontClear'
            notifyUser "files." 0 'dontClear'
            notifyUser "The syntax for the --new flag is as follows" 0 'dontClear'
            notifyUser "    ${HIGHLIGHTCOLOR}dsh --new <mode> <args>" 0 'dontClear'
            notifyUser "For information on a specific mode use ${HIGHLIGHTCOLOR}dsh --help --new MODE" 0 'dontClear'
            notifyUser "The following modes are available:" 0 'dontClear'
            notifyUser "    app: Create a new App that can be used as a starting point." 0 'dontClear'
            notifyUser "    Usage: ${HIGHLIGHTCOLOR}dsh --new app APPNAME APPDOMAIN" 0 'dontClear'
            newLine
#            notifyUser "    MODE: Message" 0 'dontClear'
#            notifyUser "    Usage: ${HIGHLIGHTCOLOR}dsh --new MODE ARGS" 0 'dontClear'
#            newLine
            exit 0
        fi
        if [[ "${2}" == 'app' || "${2}" == 'a' ]]; then
            notifyUser "dsh --new app APPNAME APPDOMAIN" 0 'dontClear'
            notifyUser "The ${HIGHLIGHTCOLOR}app${NOTIFYCOLOR} mode can be used to create new Apps for the Darling Data Management System." 0 'dontClear'
            notifyUser "The ${HIGHLIGHTCOLOR}app${NOTIFYCOLOR} mode expects two arguments:" 0 'dontClear'
            notifyUser "1. The name of the App to create" 0 'dontClear'
            notifyUser "2. The Apps ${HIGHLIGHTCOLOR}production${NOTIFYCOLOR} donain." 0 'dontClear'
            notifyUser "${WARNINGCOLOR}It is recomended that you always use the" 0 'dontClear'
            notifyUser "${WARNINGCOLOR}App's production domain, and that you always" 0 'dontClear'
            notifyUser "${WARNINGCOLOR}use dsh to run development tasks." 0 'dontClear'
            notifyUser "${WARNINGCOLOR}This allows you to configure your app so its" 0 'dontClear'
            notifyUser "${WARNINGCOLOR}ready for production, and allows dsh figure" 0 'dontClear'
            notifyUser "${WARNINGCOLOR}out when an isolated develompent enviornment" 0 'dontClear'
            notifyUser "${WARNINGCOLOR}should be setup and used." 0 'dontClear'
            notifyUser "For example, to create a new App named Foo, whose procution domain" 0 'dontClear'
            notifyUser "is https://www.foo.com, either of the following examples could be used:" 0 'dontClear'
            notifyUser "    ${HIGHLIGHTCOLOR}dsh -n app \"Foo\" \"https://www.foo.com/\"" 0 'dontClear'
            notifyUser "    ${HIGHLIGHTCOLOR}dsh --new app \"Foo\" \"https://www.foo.com/\"" 0 'dontClear'
            notifyUser "Note: dsh creates a starter app for you, it will get you going," 0 'dontClear'
            notifyUser "      but it's up to you to implment the App." 0 'dontClear'
            notifyUser "      dsh --new app will specifically create a new App" 0 'dontClear'
            notifyUser "      directory using the specified APPNAME, and will" 0 'dontClear'
            notifyUser "      setup the neccessary subdirectories, files, and your" 0 'dontClear'
            notifyUser "      Apps production domain, giving you a simple starter" 0 'dontClear'
            notifyUser "      starter App to build on." 0 'dontClear'
            exit 0
        fi
    fi
    notifyUser "${ERRORCOLOR}Invalid option supplied to --help flag." 0 'dontClear'
}

runPhpUnit() {
    showBanner "dsh --test-ddms | dsh -t | ${HIGHLIGHTCOLOR}Run Php Unit Tests"
    disableCtrlC
    [ ! -f "$(phpUnitLicenceMsgCache)" ] && showPhpUnitLicenseMsg
    showBanner "dsh --test-ddms | dsh -t | ${HIGHLIGHTCOLOR}Run Php Unit Tests"
    modifyJsonStorageDir
    executePhpUnitTests
    sleep 5
    echo "License message already shown" > "$(phpUnitLicenceMsgCache)"
    restoreJsonStorageDir
    enableCtrlC
}

showPhpUnitLicenseMsg() {
      showBanner 'About PHP UNIT by Sebastian Bergman'
      notifyUser "PhpUnit will start in a moment. Please note, PhpUnit is not" 0 'dontClear'
      notifyUser "apart of the Darling Data Managent System, it is a third party" 0 'dontClear'
      notifyUser "library developed by Sebastian Bergmann." 0 'dontClear'
      notifyUser "PhpUnit is a unit testing framework for Php applications." 0 'dontClear'
      notifyUser "The official PhpUnit source can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}https://github.com/sebastianbergmann/phpunit" 0 'dontClear'
      sleep 5
      showBanner 'About PHP UNIT by Sebastian Bergman'
      notifyUser "A copy of the LICENSE associated with PhpUnit can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DSH_DIR}/PHP_UNIT_LICENSE" 0 'dontClear'
      sleep 4
      showBanner 'About PHP UNIT by Sebastian Bergman'
      notifyUser "Note: Php Unit's license is not associated with the Darling" 0 'dontClear'
      notifyUser "Data Management System, or dsh, which are both licensed under" 0 'dontClear'
      notifyUser "the MIT license." 0 'dontClear'
      notifyUser "The license for both the Darling Data Managemet System and dsh." 0 'dontClear'
      notifyUser "can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
      sleep 4
      showBanner 'About PHP UNIT by Sebastian Bergman'
      notifyUser "This message will not show again unless the relevant dsh cache " 0 'dontClear'
      notifyUser "file is deleted." 0 'dontClear'
      showLoadingBar "Starting PhpUnit"
}

phpUnitLicenceMsgCache() {
    printf "%s" "${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown"
}

executePhpUnitTests() {
    "${PATH_TO_DDMS}vendor/phpunit/phpunit/phpunit" -c "${PATH_TO_DDMS}php.xml"
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
    [ ! -d "${PATH_TO_TEMP_STORAGE_DIRECTORY}" ] && return
    showLoadingBar "Removing temporary storage directory: ${HIGHLIGHTCOLOR}${PATH_TO_TEMP_STORAGE_DIRECTORY}" 'dontClear'
    rm -R "${PATH_TO_TEMP_STORAGE_DIRECTORY}"
}

expectedPathToAppStorageDir() {
    printf "%s" "${PATH_TO_DDMS}.dcmsJsonData/localhost$(determinePort ${1})"
}

showAppDoesNotExistErrorAndExit() {
    notifyUser "${ERRORCOLOR}The specified app,${HIGHLIGHTCOLOR}${1}${ERRORCOLOR}, does not exist" 0 'dontClear'
    notifyUser "Please specify an existing app as follows:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}dsh -b AppName${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    newLine
    notifyUser "${CLEAR_ALL_TEXT_STYLES}${GREEN_BG_COLOR}${BLACK_FG_COLOR}The following apps are available" 0 'dontClear'
    cd "${PATH_TO_DDMS}"
    newLine
    ls --color Apps | sed 's/README.md//g'
    newLine
    exit 1
}

showAppsConponentsPhpDoesNotExistErrorAndExit() {
    notifyUser "${ERRORCOLOR}The specified app,${HIGHLIGHTCOLOR}${1}${ERRORCOLOR}, does not have" 0 'dontClear'
    notifyUser "${ERRORCOLOR}a Components.php file. Please define one at:" 0 'dontClear'
    notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}Apps/${1}/Components.php" 0 'dontClear'
    newLine
    exit 1
}

buildApp() {
   disableCtrlC
   [ -z "${1}" ] && notifyUser "${ERRORCOLOR}You must specify an app to run. For example: ${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear' && exit 1
   MOST_RECENTLY_RUN_APP_PATH="${PATH_TO_DDMS}Apps/${1}"
   [ ! -d "${MOST_RECENTLY_RUN_APP_PATH}" ] && showAppDoesNotExistErrorAndExit "${1}"
   [ ! -f "$(getAppComponentsFilePath ${1})" ] && showAppsConponentsPhpDoesNotExistErrorAndExit "${1}"
   cd "${MOST_RECENTLY_RUN_APP_PATH}"
   [[ -d "$(expectedPathToAppStorageDir ${1})" ]] && notifyUser "${WARNINGCOLOR}The ${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${WARNINGCOLOR} app was already built, to build the app again, please remove the following directory:${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}$(expectedPathToAppStorageDir ${1})${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
   [[ ! -d "$(expectedPathToAppStorageDir ${1})" ]] && /usr/bin/php Components.php
   enableCtrlC
}

getAppComponentsFilePath()
{
    printf "%s" "${PATH_TO_DDMS}/Apps/${1}/Components.php"
}

getCurrentAppDomainName() {
    grep -E "::buildDomain" "$(getAppComponentsFilePath ${1})" | grep -Eo "'.*'" | sed -E "s/'//g"
}

generateRandomAppDomainName() {
    printf "%s" "http://localhost:8${RANDOM: -3}"
}

modifyAppDomain() {
    showBanner "Setting up temporary app domain"
    [ ! -f "$(getAppComponentsFilePath ${1})" ] && showAppsConponentsPhpDoesNotExistErrorAndExit "${1}"
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
    [ ! -d "${PATH_TO_DDMS}Apps/${1}" ] && showAppDoesNotExistErrorAndExit "${1}"
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
    showActiveDevelopmentServers
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

createNewApp() {
    local newAppPath
    if [ "${1}" == 'Foo' ]; then
        showBanner "dsh --new app | Create new App | Error" 'dontClear'
        notifyUser "${ERRORCOLOR}Sorry, \"${1}\" is a reserved App name. Please choose another name." 0 'dontClear'
        exit 1
    fi
    newAppPath="${PATH_TO_DDMS}Apps/${1}"
    showBanner "dsh --new app | Create new App \"${1}\""
    if [[ -d "${newAppPath}" ]]; then
        notifyUser "${ERRORCOLOR}There is already an app named ${1} at ${newAppPath}" 0 'dontClear'
        notifyUser "${ERRORCOLOR}Please specify a unique name for your new App, or" 0 'dontClear'
        notifyUser "${ERRORCOLOR}remove the original App and then re-run ${CLEAR_ALL_TEXT_STYLES}${HIGHLIGHTCOLOR}dsh -r a ${1}" 0 'dontClear'
        exit 1
    fi
    showLoadingBar "Creating new app ${1}" 'dontClear'
    cp -R "${PATH_TO_DDMS}Apps/starterApp/" "${newAppPath}"
    showLoadingBar "Creating Stylesheets.php" 'dontClear'
    cp "${PATH_TO_DDMS}SharedDynamicOutput/Stylesheets.php" "${PATH_TO_DDMS}Apps/${1}/DynamicOutput/Stylesheets.php"
    showLoadingBar "Configuring new app ${1}"
    find "${newAppPath}" -type f | xargs sed -i "s/starterApp/${1}/g"
# [ ! -d new app ] error msg
    notifyUser "New app ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} was created at ${HIGHLIGHTCOLOR}${newAppPath}${NOTIFYCOLOR}" 0 'dontClear'
}

determinePhpVersion() {
    /usr/bin/php -v | grep -E 'PHP [0-9][.][0-9]' | sed 's/[.][0-9][0-9].*//g' | sed 's/[.]//g' | sed 's/PHP//g'
}

showPHPVersionErrorAndExit() {
    notifyUser "${HIGHLIGHTCOLOR}dsh${ERRORCOLOR}, and the ${HIGHLIGHTCOLOR}Darling Data Management System${ERRORCOLOR} require PHP >= 7.4, please install PHP 7.4 or greater.${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    exit 1
}
