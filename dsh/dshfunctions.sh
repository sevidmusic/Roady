#!/bin/bash

set -o posix

clear

disableCtrlC() {
    trap '' 2
    newLine
    notifyUser "${HIGHLIGHTCOLOR}${BLACK_FG_COLOR}CTRL-C${RED_BG_COLOR} has been temporarily disabled until the current dsh process is complete.${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    newLine
}

enableCtrlC() {
    trap 2
    newLine
    notifyUser "${HIGHLIGHTCOLOR}${BLACK_FG_COLOR}CTRL-C${GREEN_BG_COLOR} is enabled again.${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
    newLine
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
}


