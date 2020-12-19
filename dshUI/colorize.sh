#!/bin/bash
# colorizeHelpFile.sh
# colorizeHelpFile <FILE_NAME> <COLOR_CODE> <REGEX>

set -o posix

setTextStyleCode() {
  printf "\e[%sm" "${1}"
}

[[ -z "${1}" ]] && printf "\n\e[033mArgument 1 must specify the name of a help file.\e[0m\n" && exit 1
[[ -z "${3}" ]] && printf "\n\e[033mAt least one regular expression must be specified.\e[0m\n" && exit 1

dsh_helpFiles_directory_path="${HOME}/Downloads/DarlingDataManagementSystem/dsh/helpFiles"
help_file_path="${1}"
color_code="${2}"
clear_color="$(setTextStyleCode 0)"

[[ ! -f "${help_file_path}" ]] && printf "\n\e[033mError:\n${help_file_path} does not exist.\nYou must specify the name of an existing help file.\nThe following files are available:\e[0m\n" && ls && exit 1
colorize() {
    local text color_code
    text="$(cat "${1}")"
    color_code="${2}"
    for var in "$@"
    do
        [[ "${var}" == "${1}" ]] && continue
        [[ "${var}" == "${2}" ]] && continue
        text="$( printf "%s" "${text}" | sed "s/${var}/$(setTextStyleCode "${color_code}")&${clear_color}/g")"
    done
    printf "%s" "${text}"
}

colorize "${help_file_path}" "${color_code}" "$@"
