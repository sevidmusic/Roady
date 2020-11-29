#!/bin/bash

set -o posix

printf "\nTesting dshUI: There should not be any output\n"
sleep 3 && clear
dshUI
sleep 5 && clear

printf "\nTesting dshUI --help\n"
sleep 3 && clear
dshUI --help
sleep 5 && clear

printf "\nTesting dshUI --theme\n"
sleep 3 && clear
dshUI --theme
sleep 5 && clear

printf "\nTesting dshUI --theme Foo\n"
sleep 3 && clear
dshUI --theme Foo
sleep 5 && clear

printf "\nTesting dshUI --theme CustomTheme.sh\n"
sleep 3 && clear
dshUI --theme CustomTheme.sh
sleep 5 && clear

printf "\nTesting dshUI --demo-theme\n"
sleep 3 && clear
dshUI --demo-theme
sleep 5 && clear

printf "\nTesting dshUI --theme CustomTheme.sh --demo-theme\n"
sleep 3 && clear
dshUI --theme CustomTheme.sh --demo-theme
sleep 5 && clear

printf "\nTesting dshUI --demo-theme --theme CustomTheme.sh\n"
sleep 3 && clear
dshUI --demo-theme --theme CustomTheme.sh
sleep 5 && clear
