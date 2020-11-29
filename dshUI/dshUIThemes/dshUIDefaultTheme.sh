#!/bin/bash

set -o posix

# NOTE: Some text styles may not work on some terminals, for a good compatibility
#       overview @see:
# https://misc.flogisoft.com/bash/tip_colors_and_formatting#terminals_compatibility

# Formatting | Just styles, no color
CLEAR_TEXT_STYLES="$(setTextStyleCode 0)"
DIM_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 2)"
BOLD_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 1)"
UNDERLINED_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 4)"
BLINKING_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 5)"
REVERSE_FGBG="$(setTextStyleCode 0)$(setTextStyleCode 7)"
HIDDEN_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 8)"

# Basic Colors
COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 30)"
COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 31)"
COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 32)"
COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 33)"
COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 34)"
COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 35)"
COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 36)"
COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 37)"
COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 40)"
COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 41)"
COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 42)"
COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 43)"
COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 44)"
COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 45)"
COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 46)"
COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 47)"
COLOR_17="$(setTextStyleCode 0)$(setTextStyleCode 90)"
COLOR_18="$(setTextStyleCode 0)$(setTextStyleCode 91)"
COLOR_19="$(setTextStyleCode 0)$(setTextStyleCode 92)"
COLOR_20="$(setTextStyleCode 0)$(setTextStyleCode 93)"
COLOR_21="$(setTextStyleCode 0)$(setTextStyleCode 94)"
COLOR_22="$(setTextStyleCode 0)$(setTextStyleCode 95)"
COLOR_23="$(setTextStyleCode 0)$(setTextStyleCode 96)"
COLOR_24="$(setTextStyleCode 0)$(setTextStyleCode 97)"
COLOR_25="$(setTextStyleCode 0)$(setTextStyleCode 100)"
COLOR_26="$(setTextStyleCode 0)$(setTextStyleCode 101)"
COLOR_27="$(setTextStyleCode 0)$(setTextStyleCode 102)"
COLOR_28="$(setTextStyleCode 0)$(setTextStyleCode 103)"
COLOR_29="$(setTextStyleCode 0)$(setTextStyleCode 104)"
COLOR_30="$(setTextStyleCode 0)$(setTextStyleCode 105)"
COLOR_31="$(setTextStyleCode 0)$(setTextStyleCode 106)"
COLOR_32="$(setTextStyleCode 0)$(setTextStyleCode 107)"

# Niche colors
HIGHLIGHTCOLOR="${CLEAR_TEXT_STYLES}${COLOR_25}${COLOR_31}"

