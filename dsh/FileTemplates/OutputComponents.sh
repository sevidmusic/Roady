#!/bin/bash
# OutputComponents.sh

# This file is where OutputComponents, and DynamicOutputComponents are defined.
#
# Example OutputComponent
# dsh -n OutputComponent "${app_name}" OCName OCContainer 0 "Output ..."
#
# Example DynamicOutputComponent
# dsh -n DynamicOutputComponent "${app_name}" DOCName DOCContainer 0 "DOCFile.php"
#
# Once defined, make sure to asssign each OutputComponent and each DynamicOutputComponent
# to one of the Responses or GlobalResponses defined in Responses.sh or else it will not
# be visible in the App's user interface.
#
# Elaborating on the examples above:
# dsh -n OutputComponent "${app_name}" OCName OCContainer 0 "Output ..."
# dsh -a "${app_name}" ResponseName OCName OCContainer OutputComponent
#
# dsh -n DynamicOutputComponent "${app_name}" DOCName DOCContainer 0 "DOCFile.php"
# dsh -a "${app_name}" ResponseName DOCName DOCContainer DynamicOutputComponent
#
# For more information about the dsh --assign-to-response flag use: dsh -h -a

########################## DO NOT MODIFY THE FOLLOWING LINE UNLESS YOU KNOW WHAT YOU ARE DOING! ##########################
set -o posix; logErrorMsg() { printf "\n\e[43m\e[30m%s\n\e[0m" "${1}" >> /dev/stderr; }; logErrorMsgAndExit1() { logErrorMsg "${1}"; exit 1; }; determineDirectoryPath() { local CURRENT_FILE_PATH CURRENT_DIRECTORY_PATH; CURRENT_FILE_PATH="${BASH_SOURCE[0]}"; while [ -h "$CURRENT_FILE_PATH" ]; do CURRENT_DIRECTORY_PATH="$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"; CURRENT_FILE_PATH="$(readlink "$CURRENT_FILE_PATH")"; [[ $CURRENT_FILE_PATH != /* ]] && CURRENT_FILE_PATH="$CURRENT_DIRECTORY_PATH/$CURRENT_FILE_PATH"; done; printf "%s" "$(cd -P "$(dirname "$CURRENT_FILE_PATH")" >/dev/null 2>&1 && pwd)"; }; loadLibrary() { [[ ! -x "${1}" ]] && logErrorMsg "Error! Failed to load ${1}!" && logErrorMsgAndExit1 "The script either does not exist, or is not executable."; . ${1} ${2}; }; loadLibrary "$(determineDirectoryPath)/config.sh";

########################################## Please place all dsh calls after this line ####################################


