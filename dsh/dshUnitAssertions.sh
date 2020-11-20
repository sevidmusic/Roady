#!/bin/bash

set -o posix

captureError() {
    error=$( ${1} 2>&1 1>/dev/null)
    if [ $? -eq 0 ]; then
        notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} ran without error ${SUCCESSCOLOR}:)" 0 'dontClear'
    else
        notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting success. An error occured:" 0 'dontClear'
        notifyUser "${error}" 0 'dontClear'
    fi
}

assertSuccess() {
    captureError "{$1}"
}

assertError() {
    captureError "${1}"
}

assertDirectroyExists() {
    [[ ! -d "${1}" ]] && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting that the directory ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} exists" 0 'dontClear' && return
    notifyUser "The ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} directory exists ${SUCCESSCOLOR}:)" 0 'dontClear'
}
