#!/bin/bash

set -o posix

assertSuccess() {
    { ${1} &> /dev/null; } && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} ran without error ${SUCCESSCOLOR}:)" 0 'dontClear' && return
    notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting success. An error occured, run ${CLEAR_ALL_TEXT_STYLES}${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${ERRORCOLOR} manually to see error messages." 0 'dontClear'
}

assertError() {
    { ${1} &> /dev/null; } && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting error. An error did not occur even though one was was expected, run ${CLEAR_ALL_TEXT_STYLES}${HIGHLIGHTCOLOR}${1}${CLEAR_ALL_TEXT_STYLES}${ERRORCOLOR} manually to see actual output." 0 'dontClear' && return
    notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} triggered an error as expected ${SUCCESSCOLOR}:)" 0 'dontClear'
}

assertDirectroyExists() {
    [[ ! -d "${1}" ]] && notifyUser "${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR}: ${ERRORCOLOR}Failed asserting that the directory ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} exists" 0 'dontClear' && return
    notifyUser "The ${HIGHLIGHTCOLOR}${1}${NOTIFYCOLOR} directory exists ${SUCCESSCOLOR}:)" 0 'dontClear'
}
