#!/bin/bash

set -o posix

# Determine real path to dsh directory
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
  DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
  SOURCE="$(readlink "$SOURCE")"
  [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
done
PATH_TO_DSH_DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"
PATH_TO_DSHUI="${PATH_TO_DSH_DIR}/dshui.sh"
PATH_TO_DDMS="${PATH_TO_DSH_DIR//dsh/}"

# shellcheck source=src/util.sh
. "${PATH_TO_DSHUI}"

if [ ! -f "${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown" ]; then
  clear && showBanner
  notifyUser "PhpUnit will start in a moment. Please note, PhpUnit is not apart of" 0 'dontClear'
  notifyUser "the Darling Data Managent System, it is a third party library developed by" 0 'dontClear'
  notifyUser "Sebastian Bergmann." 0 'dontClear'
  notifyUser "PhpUnit is a unit testing framework for Php applications." 0 'dontClear'
  notifyUser "The official PhpUnit source can be found at:" 0 'dontClear'
  notifyUser "${HIGHLIGHTCOLOR}https://github.com/sebastianbergmann/phpunit" 0 'dontClear'
  sleep 4
  clear && showBanner
  notifyUser "A copy of the LICENSE associated with PhpUnit can be found at:" 0 'dontClear'
  notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DSH_DIR}/PHP_UNIT_LICENSE" 0 'dontClear'
  sleep 4
  clear && showBanner
  notifyUser "Note: The PHP_UNIT_LICENSE is not associated with the Darling Data" 0 'dontClear'
  notifyUser "Management System, or dsh, which both are licensed under the MIT" 0 'dontClear'
  notifyUser "license." 0 'dontClear'
  notifyUser "The Darling Data Managemet System's license can be found at:" 0 'dontClear'
  notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
  notifyUser "dsh is part of the Darling Data Management system, and therfore uses the same license:" 0 'dontClear'
  notifyUser "${HIGHLIGHTCOLOR}${PATH_TO_DDMS}LICENSE" 0 'dontClear'
  sleep 4
  clear && showBanner
  notifyUser "This message will not show again unless the relevant .dsh_* cache file is deleted." 0 'dontClear'
  sleep 4
  showLoadingBar "Starting PhpUnit"
fi

"${PATH_TO_DDMS}vendor/phpunit/phpunit/phpunit" -c "${PATH_TO_DDMS}php.xml"

echo "License message already shown" >"${PATH_TO_DSH_DIR}/.dsh_license_notice_already_shown"
