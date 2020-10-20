#!/bin/bash

set -o posix

clear

showPhpUnitLicenseMsg() {
      clear && showBanner
      notifyUser "PhpUnit will start in a moment. Please note, PhpUnit is not apart of" 0 'dontClear'
      notifyUser "the Darling Data Managent System, it is a third party library developed by" 0 'dontClear'
      notifyUser "Sebastian Bergmann." 0 'dontClear'
      notifyUser "PhpUnit is a unit testing framework for Php applications." 0 'dontClear'
      notifyUser "The official PhpUnit source can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}https://github.com/sebastianbergmann/phpunit" 0 'dontClear'
      sleep 4
      clear && showBanner
      notifyUser "A copy of the LICENSE associated with PhpUnit can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DSH_DIR}/PHP_UNIT_LICENSE" 0 'dontClear'
      sleep 4
      clear && showBanner
      notifyUser "Note: The PHP_UNIT_LICENSE is not associated with the Darling Data" 0 'dontClear'
      notifyUser "Management System, or dsh, which both are licensed under the MIT" 0 'dontClear'
      notifyUser "license." 0 'dontClear'
      notifyUser "The Darling Data Managemet System's license can be found at:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
      notifyUser "dsh is part of the Darling Data Management system, and therfore uses the same license:" 0 'dontClear'
      notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
      sleep 4
      clear && showBanner
      notifyUser "This message will not show again unless the relevant .dsh_* cache file is deleted." 0 'dontClear'
      sleep 4
      showLoadingBar "Starting PhpUnit"
}

runPhpUnit() {
    disableCtrlC
    modifyJsonStorageDir
    [ ! -f "${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown" ] && showPhpUnitLicenseMsg
    "${PATH_TO_DDMS}vendor/phpunit/phpunit/phpunit" -c "${PATH_TO_DDMS}php.xml"
    echo "License message already shown" >"${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown"
    restoreJsonStorageDir
    enableCtrlC
}

showHelpMsg() {
    showBanner
    if [[ -z "${1}" || "${1}" == 'app' || "${1}" == 'apps' ]]; then
        notifyUser "${HIGHLIGHTCOLOR}dsh${NOTIFYCOLOR} is a command line utility" 0 'dontClear'
        notifyUser "that provides various utilities to aide in development with" 0 'dontClear'
        notifyUser "the ${HIGHLIGHTCOLOR}Darling Data Management System${NOTIFYCOLOR}." 0 'dontClear'
        notifyUser "The -s, or --start-app-server flag will start a local server" 0 'dontClear'
        notifyUser "for you to use while in development." 0 'dontClear'
        notifyUser "The -s flag expects one argument, a port number." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -s 8080" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --start-app-server 8888" 0 'dontClear'
        notifyUser "The -t, or --test-ddms flag will run phpunit using ${HIGHLIGHTCOLOR}${PATH_TO_DDMS}php.xml${NOTIFYCOLOR} for configuration." 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh -t" 0 'dontClear'
        notifyUser "    For example: ${HIGHLIGHTCOLOR}dsh --test-ddms" 0 'dontClear'
        exit 0
   fi
   notifyUser "${ERRORCOLOR}Invalid option supplied to -help flag." 0 'dontClear'
   notifyUser "Options:" 0 'dontClear'
   notifyUser "${HIGHLIGHTCOLOR}dsh --help${CLEAR_ALL_TEXT_STYLES}  ${HIGHLIGHTCOLOR}dsh --help app${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
   notifyUser "${HIGHLIGHTCOLOR}dsh --help apps${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
}

startAppServer() {
    disableCtrlC
    showLoadingBar "Starting local development server at localhost:${1}"
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

# todo change to buildApp
buildApp() {
   disableCtrlC
   [ -z "${1}" ] && notifyUser "${ERRORCOLOR}You must specify an app to run. For example: ${HIGHLIGHTCOLOR}dsh -r AppName" 0 'dontClear' && exit 1
   MOST_RECENTLY_RUN_APP_PATH="${PATH_TO_DDMS}Apps/${1}"
   [ ! -d "${MOST_RECENTLY_RUN_APP_PATH}" ] && notifyUser "${ERRORCOLOR}The specified app,${HIGHLIGHTCOLOR}${1}${ERRORCOLOR}, does not exist. Please specify an existing app as follows:" 0 'dontClear' && notifyUser "${HIGHLIGHTCOLOR}dsh -b AppName${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear' && newLine && notifyUser "${CLEAR_ALL_TEXT_STYLES}${GREEN_BG_COLOR}${BLACK_FG_COLOR}The following apps are available" 0 'dontClear' && cd "${PATH_TO_DDMS}" && newLine && ls --color Apps && newLine && exit 1
   cd "${MOST_RECENTLY_RUN_APP_PATH}"
   /usr/bin/php Components.php
   enableCtrlC
}

