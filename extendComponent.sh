#!/bin/bash

set -o posix
source ./functions.sh
# use the testFunc function to test functions.sh was loaded: testFunc

[[ $FORCE_MAKE -ne 1 ]] && clear
initColors
while getopts "hx:t:e:c:s:f" OPTION; do
  case "${OPTION}" in
  h)
      printf "\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n" "${CLEARCOLOR}${NOTIFYCOLOR}extendComponent.sh can be used to generate the PHP files required to define a new compoonent for the DDMS that extends a component defined in Core, or in an Extension." "If you call this script without any flags you will be guided through the process of creating a new component from within a user interface." "You can also specify flags if you already know any of the values you wish to use. You can also specify a few flags, and then finish from within the user interface." "The following flags are available:" "    -x <arg> The -x flag determines whether the new component extends a Core component, or a component defined in an Extension." "    -t <arg> The -t flag determines which Component template is used to genereate the new Component\'s .php files. Options: CoreComponent, CoreSwitchableComponent, CoreOutputComponent, CoreAction" "    -e <arg> The -e flag determines the name of the Extension the new Component will belong to. The -e flag should only be used when creating a new Component for an extension." "    -c <arg> The -c flag determines the name of the new Component" "    -s <arg> The -s flag determines the sub-type of the new Component, the sub-type is used to configure an appropriate namespace for the new Component relative to the root component namespace (i.e., DarlingCms\\*\\component\\SUBTYPE\\COMPONENT)" "    -f The -f flag takes no arguments, and can be used to force the creation of the new Component without being prompted to verify the values specified by each flag. Note: ALL flags MUST be set for the -f flag to apply. (USE THIS OPTION WITH CAUTION)"
    exit
    ;;
  x)
    EXTENDING="${OPTARG}"
    ;;
  t)
    TEMPLATE="${OPTARG}"
    ;;
  e)
    EXTENSION_NAME="${OPTARG}"
    ;;
  c)
    USER_DEFINED_COMPONENT_NAME="${OPTARG}"
    ;;
  s)
    USER_DEFINED_COMPONENT_SUBTYPE=$(printf "%s" "${OPTARG}" | sed -E "s,[\],DS_NAMESPACE_SEPERATOR,g")
    # To allow an empty string be passed to the -s , use var to determine if this flag is set instead of [[ -z "${USER_DEFINED_COMPONENT_SUBTYPE}" ]]
    USER_SUBTYPE_SET_WITH_FLAG=1
    ;;
  f)
    [[ "${EXTENDING}" != "Core" ]] && [[ -n "${EXTENDING}" ]] && [[ -n "${TEMPLATE}" ]] && [[ -n "${EXTENSION_NAME}" ]] && [[ -n "${USER_DEFINED_COMPONENT_NAME}" ]] && [[ $USER_SUBTYPE_SET_WITH_FLAG -eq 1 ]] && FORCE_MAKE=1 || USER_ERROR=1
    [[ $USER_ERROR -eq 1 ]] && printf "\n%sWarning:%s You must set all flags (-x -e -t -c -s) to use the -f flag, the -f flag MUST be the LAST flag, and you cannot use the -f flag to extend Core!\n\n%s" "${CLEARCOLOR}${ATTENTIONEFFECTCOLOR}${ATTENTIONEFFECT}" "${CLEARCOLOR}${WARNINGCOLOR}" "${CLEARCOLOR}" && exit
    ;;
  *)
    printf "\n%s%s%sWARNING:%s%s You must porvide a value for any flags you set, and you can't set invalid flags.\nThe following flags are possible:\n    -x <arg> (Set <arg> to \"Core\" if extending \"core\", set to \"Extension\" if extending an Extension)%s\n\n" "${CLEARCOLOR}" "${ATTENTIONEFFECTCOLOR}" "${ATTENTIONEFFECT}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}"
    exit
    ;;
  esac
done

[[ $FORCE_MAKE -ne 1 ]] && showWelcomeMessage
[[ -z $EXTENDING ]] && askUserIfComponentForCoreOrExtension
[[ -z $EXTENSION_NAME ]] && [[ "${EXTENDING}" != "Core" ]] && askUserForExtensionName
[[ -z $TEMPLATE ]] && askUserForTemplateDirectoryName
[[ -z $USER_DEFINED_COMPONENT_NAME ]] && askUserForComponentName
# To allow an empty string be passed to the -s , use var to determine if this flag is set instead of [[ -z "${USER_DEFINED_COMPONENT_SUBTYPE}" ]]
[[ $USER_SUBTYPE_SET_WITH_FLAG -eq 1 ]] || askUserForComponentSubtype
setTemplatePaths
setDirecotryPaths
generatePHPCodeFromTemplate "${TEST_TRAIT_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR}" "TestTrait"
generatePHPCodeFromTemplate "${ABSTRACT_TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${INTERFACE_TEMPLATE_FILE_PATH}" "${COMPONENT_INTERFACE_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${ABSTRACTION_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACTION_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${CLASS_TEMPLATE_FILE_PATH}" "${COMPONENT_CLASS_TARGET_ROOT_DIR}" ""
setColor 0
