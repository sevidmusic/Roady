#!/bin/bash

set -o posix

showBanner() {
  [[ ! "${2}" == 'dontClear' ]] && clear
  if [ -n "$(command -v figlet)" ]; then
      figlet DSH
  else
      printf "\n%sD S H%s" "${HIGHLIGHTCOLOR}" "${CLEAR_ALL_STYLES}"
  fi
  [[ -n "${1}" ]] && notifyUser "${HIGHLIGHTCOLOR}${1}" 0 'dontClear'
}

animatedPrint() {
  local _charsToAnimate _speed _currentChar _charCount
  # For some reason spaces get mangled using ${VAR:POS:LIMIT}. so replace spaces with _ here,
  # then add spaces back when needed.
  _charsToAnimate=$(printf "%s" "${1}" | sed -E "s/ /*/g;")
  _speed="${2:-0.0242}"
  _charCount=0
  for ((i = 0; i < ${#_charsToAnimate}; i++)); do
    ((_charCount++))
    [[ $_charCount == $((_slb_adjustedNumChars - 10)) ]] && _charCount=0 && printf "\n\n "
    # Replace placeholder _ with space | i.e., fix spaces that were replaced
    _currentChar=$(printf "%s" "${_charsToAnimate:$i:1}" | sed -E "s/[*]/ /g;")
    printf "%s" "${_currentChar}"
    sleep "${_speed}"
  done
}

showLoadingBar() {
  [[ "${DISABLE_ANIMATION}" == 1 ]] && printf "\n\e[0m\e[103m%s\e[0m | \e[102m%s\e[0m\n" "Animations Disabled" "${1:0:57}" && return
  local _slb_inc _slb_windowWidth _slb_numChars _slb_adjustedNumChars _slb_loadingBarLimit
  printf "\n"
  animatedPrint "${1}" .00242
  printf " %s" "${CLEAR_ALL_STYLES}${HIGHLIGHTCOLOR}"
  _slb_inc=0
  _slb_windowWidth=$(tput cols)
  _slb_numChars="${#1}"
  _slb_adjustedNumChars=$((_slb_windowWidth - _slb_numChars))
  _slb_loadingBarLimit=$((_slb_adjustedNumChars - 10))
  while [[ ${_slb_inc} -le "${_slb_loadingBarLimit}" ]]; do
    animatedPrint ":" .000242
    _slb_inc=$((_slb_inc + 1))
  done
  printf " %s\n" "${CLEAR_ALL_STYLES}${BLINKING_TEXT}${SUCCESS_COLOR}[100%]${CLEAR_ALL_STYLES}"
  sleep 0.23
  [[ "${2}" != "dontClear" ]] && clear
}

exitOrContinue() {
  [[ "${2}" == "forceExit" ]] && exit "${1:-0}"
  [[ -n "${CONTINUE}" ]] && return
  exit "${1:-0}"
}

notifyUser() {
  [[ "${DISABLE_ANIMATION}" == 1 ]] && printf "\n\e[0m\e[103m%s\e[0m | \e[102m%s\e[0m\n" "Animations Disabled" "${1:0:57}" && return
  [[ "${4}" != 'no_newline' ]] && printf "\n"
  printf "%s" "${NOTIFY_COLOR}"
  animatedPrint "${1}" 0.009
  sleep "${2:-2}"
  [[ "${3}" == "dontClear" ]] || clear
  printf "%s\n" "${CLEAR_ALL_STYLES}"
}

notifyUserAndExit() {
  notifyUser "${1}" "${2:-1}" "${3:-CLEAR}"
  exitOrContinue "${4:-0}" "${5:-default}"
}

newLine() {
    printf "\n"
}

