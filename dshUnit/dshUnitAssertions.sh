#!/bin/bash

set -o posix

assertError() {
    showLoadingBar "    Testing that an error occurs running: ${HIGHLIGHTCOLOR}${1}" 'dontClear'
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        notifyUser "    ${3}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        ((FAILS++))
    else
        notifyUser "    ${2}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        notifyUser "    ${ERRORCOLOR}${error}" 0 'dontClear'
        ((PASSES++))
    fi
}

assertSuccess() {
    showLoadingBar "    Testing that an error does not occur running: ${HIGHLIGHTCOLOR}${1}" 'dontClear'
    error="$( ${1} 2>&1 1>/dev/null)"
    if [ $? -eq 0 ]; then
        notifyUser "    ${2}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        ((PASSES++))
    else
        notifyUser "    ${3}${CLEAR_ALL_TEXT_STYLES}" 0 'dontClear'
        notifyUser "    ${ERRORCOLOR}${error}" 0 'dontClear'
        ((FAILS++))
    fi
}
