#!/bin/bash

set -o posix

captureError() {
    showLoadingBar "    Testing: ${HIGHLIGHTCOLOR}${1}" 'dontClear'
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        notifyUser "${2}"
    else
        notifyUser "${3}" 0 'dontClear'
        notifyUser "${ERRORCOLOR}${error}" 0 'dontClear'
    fi
}

assertSuccess() {
    captureError "${1}" "${SUCCESSCOLOR}No errors occurred running ${HIGHLIGHTCOLOR}${1}" "${ERRORCOLOR}An error occured running ${HIGHLIGHTCOLOR}${1}"
}

assertError() {
    captureError "${1}" "${ERRORCOLOR}An error was expected, no errors occurred running ${HIGHLIGHTCOLOR}${1}" "${SUCCESSCOLOR}As expected, an error occured running ${HIGHLIGHTCOLOR}${1}"
}

assertDirectroyExists() {
    [[ ! -d "${1}" ]] && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting that the directory ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} exists" 0 'dontClear' && return
    notifyUser "The ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} directory exists ${SUCCESSCOLOR}:)" 0 'dontClear'
}
