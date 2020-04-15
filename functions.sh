#!/bin/bash


### Functions ###

setColor() {
  printf "\e[%sm" "${1}"
}

animatedPrint()
{
  local _charsToAnimate _speed _currentChar
  # For some reason spacd get mangled using ${VAR:POS:LIMIT}. so replace spaces with _ here,
  # then add spaces back when needed.
  _charsToAnimate=$( printf "%s" "${1}" | sed -E "s/ /_/g;")
  _speed="${2}"
  for (( i=0; i< ${#_charsToAnimate}; i++ )); do
      # Replace placeholder _ with space | i.e., fix spaces that were replaced
      _currentChar=$(printf "%s" "${_charsToAnimate:$i:1}" | sed -E "s/_/ /g;")
      printf "%s" "${_currentChar}"
      sleep $_speed
  done
}


# @todo May be error, though this is working, currently referenceing $2, thinking it should be $1...test later
setTextColor() {
  printf "\e[%sm" "${2}"
}

writeWordSleep() {
  printf "%s" "${1}"
  sleep "${2}"
}

sleepWriteWord() {
  sleep "${2}"
  printf "%s" "${1}"
}

sleepWriteWordSleep() {
  sleep "${2}"
  printf "%s" "${1}"
  sleep "${2}"
}


initColors() {
  WARNINGCOLOR=$(setTextColor 35)
  CLEARCOLOR=$(setTextColor 0)
  NOTIFYCOLOR=$(setTextColor 33)
  DSHCOLOR=$(setTextColor 41)
  USRPRMPTCOLOR=$(setTextColor 41)
  HIGHLIGHTCOLOR=$(setTextColor 41)
  HIGHLIGHTCOLOR2=$(setTextColor 45)
  ATTENTIONEFFECT=$(setTextColor 5)
  ATTENTIONEFFECTCOLOR=$(setTextColor 36)
  DARKTEXTCOLOR=$(setTextColor 30)
}

#

showLoadingBar() {
    local _slb_inc _slb_windowWidth _slb_numChars _slb_adjustedNumChars _slb_loadingBarLimit
  printf "\n"
  animatedPrint "${1}" .05
  setColor 43
  _slb_inc=0
  _slb_windowWidth=$(tput cols)
  _slb_numChars="${#1}"
  _slb_adjustedNumChars=$((_slb_windowWidth - _slb_numChars))
  _slb_loadingBarLimit=$((_slb_adjustedNumChars - 10))
  while [[ ${_slb_inc} -le "${_slb_loadingBarLimit}" ]]; do
    animatedPrint ":" .009
    _slb_inc=$((_slb_inc + 1))
  done
  printf " %s\n" "${CLEARCOLOR}${ATTENTIONEFFECT}${ATTENTIONEFFECTCOLOR}[100%]${CLEARCOLOR}"
  setColor 0
  sleep 1
  if [[ $FORCE_MAKE -ne 1 ]] && [[ "${2}" != "dontClear" ]]; then
    clear
  fi
}

