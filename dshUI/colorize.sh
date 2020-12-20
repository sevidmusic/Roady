#!/bin/bash
# colorize <FILE_PATH_OR_STRING> <COLOR_CODE> <REGEX>...

set -o posix

setTextStyleCode() {
  printf "\e[%sm" "${1}"
}

[[ -z "${1}" ]] && printf "\n\e[033mdshUI <FILE_PATH_OR_STRING> <COLOR_CODE> <REGEX>... You must specify a valid file path or string\e[0m\n" && exit 1
[[ -z "${2}" ]] && printf "\n\e[033mdshUI <FILE_PATH_OR_STRING> <COLOR_CODE> <REGEX>... You must specify a color code\e[0m\n" && exit 1

file_path_or_string="${1}"
color_code="${2}"
clear_color="$(setTextStyleCode 0)"

colorize() {
    local text color_code
    [[ -f "${file_path_or_string}" ]] && text="$(cat "${1}")"
    text="${text:-${1}}"
    color_code="${2}"
    for var in "$@"
    do
        [[ "${var}" == "${1}" ]] && continue
        [[ "${var}" == "${2}" ]] && continue
        text="$( printf "%s" "${text}" | sed "s/${var}/$(setTextStyleCode "${color_code}")&${clear_color}/g")"
    done
    printf "%s" "${text}"
}

colorize "${file_path_or_string}" "${color_code}" "$@"
