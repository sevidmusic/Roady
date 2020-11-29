#!/bin/bash

set -o posix

reset
printf "\nTesting dshUI: There should not be any output\n"
sleep 3 && reset
dshUI
sleep 5 && reset

printf "\nTesting dshUI --help\n"
sleep 3 && reset
dshUI --help
sleep 5 && reset

printf "\nTesting dshUI --theme\n"
sleep 3 && reset
dshUI --theme
sleep 5 && reset

printf "\nTesting dshUI --theme Foo\n"
sleep 3 && reset
dshUI --theme Foo
sleep 5 && reset

printf "\nTesting dshUI --theme CustomTheme.sh. There should not be any output.\n"
sleep 3 && reset
dshUI --theme CustomTheme.sh
sleep 5 && reset

printf "\nTesting dshUI --demo-theme\n"
sleep 3 && reset
dshUI --demo-theme
sleep 5 && reset

printf "\nTesting dshUI --theme CustomTheme.sh --demo-theme\n"
sleep 3 && reset
dshUI --theme CustomTheme.sh --demo-theme
sleep 5 && reset

printf "\nTesting dshUI --demo-theme --theme CustomTheme.sh\n"
sleep 3 && reset
dshUI --demo-theme --theme CustomTheme.sh
sleep 5 && reset
