#!/bin/bash

set -o posix

clear

[[ ! -f ./darlingui.sh ]] && printf '\n\n\e[33mError! Failed to load user interface!\e[0m\n\n'

. ./darlingui.sh

####### Process flags #######
while test $# -gt 0; do
  case "$1" in
    -h|--help)
      showBanner
      shift
      if [[ "${1}" == 'app' ]]
      then
          notifyUser "dsh provides various flags for working with apps." 0 'dontClear'
          notifyUser "The -s, or --start-app-server will start a local server for you to use while in development." 0 'dontClear'
          exit 0
      fi
      notifyUser "-h was not supplied any arguments" && exit 0
      ;;
    -s|--start-app-server*)
      shift
      if [[ -n "${1}" ]]
      then
          notifyUser "Starting local development server at localhost:${1}"
          /usr/bin/php -S "localhost:${1}" -t "$(pwd)"
          exit 0
      fi
      notifyUser "Error! You must specify a port when using the -s flag. For example: ${HIGHLIGHTCOLOR}dsh -s 8888${CLEAR_ALL_TEXT_STYLES}"
      ;;
    *)
      notifyUser "${WARNING_COLOR}Invalid flag ${1}"
      break
      ;;
  esac
done

showLoadingBar "Exiting"
