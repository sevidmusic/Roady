#!/bin/bash

set -o posix

. "$(determineThemeFilePath "dshUIDefaultTheme.sh")"

COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 33)"
COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 33)"
COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 93)"
COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 102)"
COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 45)"
COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 96)"
COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 93)"
COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 44)"
COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 46)"
COLOR_10="$(setTextStyleCode 4)$(setTextStyleCode 94)"
COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 104)"
COLOR_12="$(setTextStyleCode 1)$(setTextStyleCode 44)"
COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 97)"
COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 103)"
COLOR_15="$(setTextStyleCode 1)$(setTextStyleCode 34)"
COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 44)"
COLOR_17="$(setTextStyleCode 0)$(setTextStyleCode 4)"
COLOR_18="$(setTextStyleCode 0)$(setTextStyleCode 1)"
COLOR_19="$(setTextStyleCode 0)$(setTextStyleCode 5)"
COLOR_20="$(setTextStyleCode 0)$(setTextStyleCode 34)"

HIGHLIGHTCOLOR="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 45)"
