#!/bin/bash

set -o posix

. "$(determineThemeFilePath "dshUIDefaultTheme.sh")"

NORMAL_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 32)"
NORMAL_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 33)"
NORMAL_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 35)"
NORMAL_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 32)"
NORMAL_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 33)"
