#!/bin/bash
# Requests.sh

# This file is where Requests are defined.
# Example Request:
# dsh -n Request "${app_name}" REQName REQContainer "index.php?foo=bar"
# For more information about this file use dsh -h -n AppPackage Requests.shs

set -o posix

########################## DO NOT REMOVE OR MODIFY THESE FUNCTIONS UNLESS YOU KNOW WHAT YOU ARE DOING! ##########################
##########################             Please place all dsh calls at the end of this file              ##########################

# logErrorMsg [ERROR_MESSAGE] : Log the specified [ERROR_MESSAGE] to stderr with some color to highlight the error message.
logErrorMsg() {
    printf "\n\e[43m\e[30m%s\n\e[0m" "${1}" >> /dev/stderr
}

# logErrorMsgAndExit1 [ERROR_MESSAGE] : Call logErrorMsg and exit.
logErrorMsgAndExit1() {
    logErrorMsg "${1}"
    exit 1
}

# determineDirectoryPath : Determines the actual path to the directory this script is in.
determineDirectoryPath() {
    local CURRENT_FILE_PATH CURRENT_DIRECTORY_PATH
    CURRENT_FILE_PATH="${BASH_SOURCE[0]}"
    while [ -h "$CURRENT_FILE_PATH" ]; do # resolve $CURRENT_FILE_PATH until the file is no longer a symlink | -h is true if file exists and is a symlink
      CURRENT_DIRECTORY_PATH="$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"
      CURRENT_FILE_PATH="$(readlink "$CURRENT_FILE_PATH")"
      [[ $CURRENT_FILE_PATH != /* ]] && CURRENT_FILE_PATH="$CURRENT_DIRECTORY_PATH/$CURRENT_FILE_PATH" # if $CURRENT_FILE_PATH was a relative symlink, we need to resolve it relative to the path where the symlink file was located
    done
    printf "%s" "$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"
}

# loadLibrary [PATH_TO_SCRIPT] [ARGUMENTS...] : Load the specified bash script at [PATH_TO_SCRIPT], or exit with an error.
#                                                If any parameters are specifed after the first parameter they will be passed
#                                                as arguments to the script.
loadLibrary() {
    [[ ! -x "${1}" ]] && logErrorMsg "Error! Failed to load ${1}!" && logErrorMsgAndExit1 "The script either does not exist, or is not executable."
    . ${1} ${2}
}

# Load the App Package's config.sh to get the configuration variables defined for this App Package
loadLibrary "$(determineDirectoryPath)/config.sh"

##########################          Please place all dsh calls after this line         ##########################

