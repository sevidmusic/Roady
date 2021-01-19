#!/bin/bash
# queryAppPackageConfigTests.sh

set -o posix

#testDshQueryAppPackageConfigRunsWithErrorIfAppPackageDoesNotExistAtPATH_TO_APP_PACKAGE()
#testDshQueryAppPackageConfigRunsWithErrorIfASettingNamedSETTING_NAMEIsNotDefinedInTheAppPackagesConfigSH()
#testDshQueryAppPackageConfigRunsWithErrorIfSettingNamedSETTING_NAMEHasNoValue()
#testDshQueryAppPackageConfigReturnsValueOfSettingNamedSETTING_NAMEDefinedInAppPackageConfigSHAtPATH_TO_APP_PACKAGE()


#### Pseudo Code ####
# set -o posix
# PATH_TO_APP_PACKAGE="${1}"
# SETTING_NAME="${2}"
# printf "%s" "$(grep -E "^${SETTING_NAME}=.*$" "${PATH_TO_APP_PACKAGE}/config.sh" | sed 's,^.*=,,g' | sed 's/"//g' | sed "s/'//g")"

