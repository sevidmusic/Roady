#!/bin/bash
# Requests.sh

# This file is where Requests are defined.
# Example Request:
# dsh -n Request "${app_name}" REQName REQContainer "index.php?foo=bar"
# For more information about this file use dsh -h -n AppPackage Requests.shs

########################## DO NOT MODIFY THE FOLLOWING LINE UNLESS YOU KNOW WHAT YOU ARE DOING! ##########################
set -o posix; logErrorMsg() { printf "\n\e[43m\e[30m%s\n\e[0m" "${1}" >> /dev/stderr; }; logErrorMsgAndExit1() { logErrorMsg "${1}"; exit 1; }; determineDirectoryPath() { local CURRENT_FILE_PATH CURRENT_DIRECTORY_PATH; CURRENT_FILE_PATH="${BASH_SOURCE[0]}"; while [ -h "$CURRENT_FILE_PATH" ]; do CURRENT_DIRECTORY_PATH="$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"; CURRENT_FILE_PATH="$(readlink "$CURRENT_FILE_PATH")"; [[ $CURRENT_FILE_PATH != /* ]] && CURRENT_FILE_PATH="$CURRENT_DIRECTORY_PATH/$CURRENT_FILE_PATH"; done; printf "%s" "$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"; }; loadLibrary() { [[ ! -x "${1}" ]] && logErrorMsg "Error! Failed to load ${1}!" && logErrorMsgAndExit1 "The script either does not exist, or is not executable."; . ${1} ${2}; }; loadLibrary "$(determineDirectoryPath)/config.sh";

########################################## Please place all dsh calls after this line ####################################

