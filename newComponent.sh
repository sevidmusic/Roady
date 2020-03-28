#!/bin/bash

# OPTIONS=("Foo" "Bar" "Baz");
# RESPONSES=('Bar-Bazzer-Foo' 'Foo-Bazzer-Bar' 'Bazzer-Bar-Foo');
# askUserForSelection $OPTIONS $RESPONSES;

askUserForSelection() {
  local -n _aufs_options=$2
  local -n _aufs_responses=$3
  local _aufs_responseIndex
  local _aufs_response
  showInfoPanel
  printf "\n"
  PS3=$(printf "\n%s\n\n%s" "${1}" "${DSHCOLOR}${DARKTEXTCOLOR}\$dsh: ${USRPRMPTCOLOR}")
  select opt in "${_aufs_options[@]}"; do
    case $opt in
    ${_aufs_options[$(("${REPLY}" - 1))]})
      if [[ -n "${opt}" ]]; then
        _aufs_responseIndex=$(("${REPLY}" - 1))
        _aufs_response=$(echo -e "${_aufs_responses[${_aufs_responseIndex}]}" | sed -E "s,-, ,g;")
        promptUserAndNotify "${_aufs_response}" "One moment please"
        PREVIOUS_USER_INPUT="${opt}"
        break
      fi
      printf "\n%s%s%s%s%s%s is not a valid option.\n\nPlease enter the %s%snumber%s%s that corresponds to your selection.%s\n" "${CLEARCOLOR}" "${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}" "${DARKTEXTCOLOR}" "${REPLY}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}" "${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}"
      ;;
    esac
  done
}

initVars() {
  WARNINGCOLOR=$(setColor 35)
  CLEARCOLOR=$(setColor 0)
  NOTIFYCOLOR=$(setColor 33)
  DSHCOLOR=$(setColor 41)
  USRPRMPTCOLOR=$(setColor 41)
  HIGHLIGHTCOLOR=$(setColor 41)
  HIGHLIGHTCOLOR2=$(setColor 45)
  ATTENTIONEFFECT=$(setColor 5)
  ATTENTIONEFFECTCOLOR=$(setColor 36)
  DARKTEXTCOLOR=$(setColor 30)
}

showInfoPanel() {
    local _sip_userDefinedComponentSubType
    _sip_userDefinedComponentSubType=$(echo "${USER_DEFINED_COMPONENT_SUBTYPE}" | sed "s,DS_NAMESPACE_SEPERATOR,\\\,g")
  printf "\n\n%s----- Info Panel -----%s" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}" "${CLEARCOLOR}"
  printf "\n  %sExtending: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${EXTENDING}${CLEARCOLOR}"
  printf "\n  %sExtension Name: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${EXTENSION_NAME}${CLEARCOLOR}"
  printf "\n  %sTemplate: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${TEMPLATE}${CLEARCOLOR}"
  printf "\n  %sComponent Name: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${USER_DEFINED_COMPONENT_NAME}${CLEARCOLOR}"
  printf "\n  %sComponent Sub-type: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${_sip_userDefinedComponentSubType}${CLEARCOLOR}"
  printf "\n%s----------------------%s\n\n" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}" "${CLEARCOLOR}"
}

askUserIfComponentForCoreOrExtension() {
  local _auicfcoe_options
  local _auicfcoe_responses
  _auicfcoe_options=("Core" "Extension")
  _auicfcoe_responses=("${CLEARCOLOR}${ATTENTIONEFFECT}${ATTENTIONEFFECTCOLOR}WARNING${CLEARCOLOR}${WARNINGCOLOR}: Defining new Components for core should only be done if absolutely necessary, and you should only do so if you are sure you know what you are doing and understand the consequences! ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}It is recommended that you define new Components as part of an Extension. Modifying Core can break Core!${CLEARCOLOR}${WARNINGCOLOR} Are you sure you want to proceed? (Type \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${WARNINGCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${WARNINGCOLOR}\" to continue, press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${WARNINGCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You have chosen to ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}create a new Component for an Extension${CLEARCOLOR}${NOTIFYCOLOR}, if this is not correct press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit, otherwise type \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\".${CLEARCOLOR}")
  askUserForSelection "${CLEARCOLOR}${NOTIFYCOLOR}Is this Component being defined as part of ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Core${CLEARCOLOR}${NOTIFYCOLOR} or as part of an ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Extension${CLEARCOLOR}${NOTIFYCOLOR}?${CLEARCOLOR}" _auicfcoe_options _auicfcoe_responses
  EXTENDING="${PREVIOUS_USER_INPUT}"
}

setDirecotryPaths () {
    if [[ "${EXTENDING}" == "Core" ]]; then
    EXTENSION_NAME=""
    COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR="./Tests/Unit/interfaces/component"
    COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR="./Tests/Unit/abstractions/component"
    COMPONENT_TEST_TARGET_ROOT_DIR="./Tests/Unit/classes/component"
    COMPONENT_INTERFACE_TARGET_ROOT_DIR="./core/interfaces/component"
    COMPONENT_ABSTRACTION_TARGET_ROOT_DIR="./core/abstractions/component"
    COMPONENT_CLASS_TARGET_ROOT_DIR="./core/classes/component"
  fi

  if [[ "${EXTENDING}" == "Extension" ]]; then
    COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/Tests/Unit/interfaces/component"
    COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/Tests/Unit/abstractions/component"
    COMPONENT_TEST_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/Tests/Unit/classes/component"
    COMPONENT_INTERFACE_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/core/interfaces/component"
    COMPONENT_ABSTRACTION_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/core/abstractions/component"
    COMPONENT_CLASS_TARGET_ROOT_DIR="./Extensions/${EXTENSION_NAME}/core/classes/component"
  fi
}

setColor() {
  printf "\e[%sm" "${1}"
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

showLoadingBar() {
  local _slb_inc
  printf "\n"
  sleepWriteWordSleep "${CLEARCOLOR}${ATTENTIONEFFECT}${ATTENTIONEFFECTCOLOR}${1}${CLEARCOLOR}" .3
  setColor 43
  _slb_inc=0
  while [[ ${_slb_inc} -le 27 ]]; do
    sleepWriteWordSleep ":" .009
    _slb_inc=$((_slb_inc + 1))
  done
  echo "${ATTENTIONEFFECTCOLOR}[100%]${CLEARCOLOR}"
  setColor 0
  sleep 1
  if [[ "${2}" != "dontClear" ]]; then
    clear
  fi
}

notifyUser() {
  [[ "${2}" == "showInfo" ]] && showInfoPanel
  printf "\n%s%s%s\n" "${NOTIFYCOLOR}" "${1}" "${CLEARCOLOR}"
}

promptUser() {
  local _pu_promptMessage
  notifyUser "${1}" "${2}"
  _pu_promptMessage=$(printf "%s\n%s\$dsh: %s" "${CLEARCOLOR}" "${DSHCOLOR}${DARKTEXTCOLOR}" "${USRPRMPTCOLOR}")
  PREVIOUS_USER_INPUT="${CURRENT_USER_INPUT}"
  read -p "${_pu_promptMessage}" CURRENT_USER_INPUT
  setColor 0
}

promptUserAndVerifyInput() {
  while :; do
    promptUser "${1}" "${2}"
    notifyUser "You entered \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}${CURRENT_USER_INPUT}${CLEARCOLOR}${NOTIFYCOLOR}\"Is this correct?${CLEARCOLOR}" ""
    promptUser "If so, type ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}\"Y\"${CLEARCOLOR}${NOTIFYCOLOR} and press ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to continue to next step, or just press ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to repeat the last step.${CLEARCOLOR}"
    if [[ "${CURRENT_USER_INPUT}" == "Y" ]]; then
      showLoadingBar "Thank you, one moment please"
      break
    fi
  done
}

promptUserAndNotify() {
  setColor 0
  while :; do
    promptUser "${1}"
    if [[ "${CURRENT_USER_INPUT}" == "Y" ]]; then
      showLoadingBar "${2}"
      break
    fi
  done
}

generatePHPCodeFromTemplate() {
  local _gpcft_template
  local _gpcft_fileRootDirectoryPath
  local _gpcft_fileName
  local _gpcft_filePath
  local _gpcft_phpCode
  local _gpcft_fileSubDirectoryPath
  _gpcft_template="${1}"
  _gpcft_fileRootDirectoryPath="${2}"
  _gpcft_fileName="${3}"
  _gpcft_filePath=$(echo "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g; s,DS_NAMESPACE_SEPERATOR,/,g;")
  if [[ "${_gpcft_fileName}" == "TestTrait" ]]; then
    _gpcft_filePath=$(echo "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/TestTraits/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g; s,DS_NAMESPACE_SEPERATOR,/,g;")
  fi
  if [[ "${EXTENDING}" == "Core" ]]; then
    _gpcft_phpCode=$(sed -E "s/DS_CORE_NAMESPACE_PREFIX/DarlingCms/g; s/DS_TESTS_NAMESPACE_PREFIX/UnitTests/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/DS_NAMESPACE_SEPERATOR/\\\/g; s/\\\;/;/g; s,[\][\],\\\,g;" "${1}")
  fi
  if [[ "${EXTENDING}" == "Extension" ]]; then
    _namespace_seperator='\\'
    _gpcft_phpCode=$(sed -E "s/DS_CORE_NAMESPACE_PREFIX/Extensions${_namespace_seperator}${EXTENSION_NAME}${_namespace_seperator}core/g; s/DS_TESTS_NAMESPACE_PREFIX/Extensions${_namespace_seperator}${EXTENSION_NAME}${_namespace_seperator}Tests${_namespace_seperator}Unit/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/DS_NAMESPACE_SEPERATOR/\\\/g; s/\\\;/;/g; s,[\][\],\\\,g;" "${1}")
  fi
  _gpcft_fileSubDirectoryPath=$(echo "${_gpcft_filePath}" | sed -E "s/\/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php//g")
  if [[ "${CURRENT_USER_INPUT}" != "make" ]]; then
    promptUser "${CLEARCOLOR}${NOTIFYCOLOR}Please review the ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}Info Panel${CLEARCOLOR}${NOTIFYCOLOR} to make sure you entered everything correctly, if everything looks ok type ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}make${CLEARCOLOR}${NOTIFYCOLOR} and press ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to generaate your new Component's Php files, otherwise press ${CLEARCOLOR}${NOTIFYCOLOR}<Ctrl> c${CLEARCOLOR}${NOTIFYCOLOR} to quit and start over." "showInfo"
    showLoadingBar "Preparing to write php files to appropriate directories"
  fi
  if [[ "${CURRENT_USER_INPUT}" == "make" ]]; then
    showLoadingBar "Writing file ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}${_gpcft_filePath}${CLEARCOLOR} " "dontClear"
    mkdir -p "${_gpcft_fileSubDirectoryPath}"
    echo "${_gpcft_phpCode}" >"${_gpcft_filePath}"
  fi
}

askUserForComponentName() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter a ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}name for the new component:${CLEARCOLOR}" "showInfo"
  USER_DEFINED_COMPONENT_NAME="${PREVIOUS_USER_INPUT}"
}

askUserForComponentSubtype() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter the component's ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}sub-type${CLEARCOLOR}${NOTIFYCOLOR}, the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}sub-type${CLEARCOLOR}${NOTIFYCOLOR} is used to construct namespaces for the Component. Example: ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}\\DarlingCms\\*\\component\\SUB\\TYPE\\${USER_DEFINED_COMPONENT_NAME}${CLEARCOLOR}${NOTIFYCOLOR} Note: You must escape backslash characters. Note: Do not include a preceding backslash in the sub-type. ${CLEARCOLOR}${ATTENTIONEFFECTCOLOR}Wrong: \\\\Foo\\\\Bar ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Right: Foo\\\\Bar${CLEARCOLOR}" "showInfo"
  USER_DEFINED_COMPONENT_SUBTYPE=$(echo "${PREVIOUS_USER_INPUT}" | sed -E "s,[\\],DS_NAMESPACE_SEPERATOR,g")
}

showWelcomeMessage() {
  printf "\n"
  setColor 32
  sleepWriteWordSleep "W" .03
  setColor 34
  sleepWriteWordSleep "e" .03
  setColor 36
  sleepWriteWordSleep "l" .03
  setColor 32
  sleepWriteWordSleep "c" .03
  setColor 34
  sleepWriteWordSleep "o" .03
  setColor 36
  sleepWriteWordSleep "m" .03
  setColor 32
  sleepWriteWordSleep "e" .03
  setColor 34
  sleepWriteWordSleep " " .03
  setColor 36
  sleepWriteWordSleep "t" .03
  setColor 32
  sleepWriteWordSleep "o" .03
  setColor 34
  sleepWriteWordSleep " " .03
  setColor 36
  sleepWriteWordSleep "t" .03
  setColor 32
  sleepWriteWordSleep "h" .03
  setColor 34
  sleepWriteWordSleep "e" .03
  setColor 36
  sleepWriteWordSleep " " .03
  setColor 32
  sleepWriteWordSleep "D" .03
  setColor 34
  sleepWriteWordSleep "a" .03
  setColor 36
  sleepWriteWordSleep "r" .03
  setColor 32
  sleepWriteWordSleep "l" .03
  setColor 34
  sleepWriteWordSleep "i" .03
  setColor 36
  sleepWriteWordSleep "n" .03
  setColor 32
  sleepWriteWordSleep "g" .03
  setColor 34
  sleepWriteWordSleep " " .03
  setColor 36
  sleepWriteWordSleep "S" .03
  setColor 32
  sleepWriteWordSleep "h" .03
  setColor 34
  sleepWriteWordSleep "e" .03
  setColor 36
  sleepWriteWordSleep "l" .03
  setColor 32
  sleepWriteWordSleep "l" .03
  setColor 36
  printf "\n"
  printf "\n"
  showLoadingBar "Loading new component module"
}

askUserForTemplateDirectoryName() {
  local _auftdn_options
  local _auftdn_responses
  _auftdn_options=("CoreComponent" "CoreSwitchableComponent")                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       # "CoreOutputComponent" )
  _auftdn_responses=("${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreComponent${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreSwitchableComponent${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}") # "${CLEARCOLOR}${NOTIFYCOLOR}You selected the \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreOutputComponent${CLEARCOLOR}${NOTIFYCOLOR}\" template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" )
  askUserForSelection "${CLEARCOLOR}${NOTIFYCOLOR}Please select the template that should be used to generate the php files.${CLEARCOLOR}" _auftdn_options _auftdn_responses
  TEMPLATE="${PREVIOUS_USER_INPUT}"
}

setTemplatePaths() {
  TEST_TRAIT_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/TestTrait.php"
  ABSTRACT_TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/AbstractTest.php"
  TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Test.php"
  INTERFACE_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Interface.php"
  ABSTRACTION_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Abstraction.php"
  CLASS_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Class.php"
}

askUserForExtensionName() {
    promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}What is the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}name of the Extension${CLEARCOLOR}${NOTIFYCOLOR} this Component will belong to?${CLEARCOLOR}" "showInfo"
    EXTENSION_NAME="${PREVIOUS_USER_INPUT}"
}

clear

initVars
while getopts "x:t:e:c:s:" OPTION
do
    case "${OPTION}" in
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
            USER_DEFINED_COMPONENT_SUBTYPE=$(echo "${OPTARG}" | sed -E "s,[\],DS_NAMESPACE_SEPERATOR,g")
            ;;
        *)
            printf "\n%s%s%sWARNING:%s%s You must porvide a value for any flags you set, and you can't set invalid flags.\nThe following flags are possible:\n    -x <arg> (Set <arg> to \"Core\" if extending \"core\", set to \"Extension\" if extending an Extension)%s\n\n" "${CLEARCOLOR}" "${ATTENTIONEFFECTCOLOR}" "${ATTENTIONEFFECT}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}"
            exit
    esac
done

showWelcomeMessage
[[ -z $EXTENDING ]] && askUserIfComponentForCoreOrExtension
[[ -z $EXTENSION_NAME ]] && [[ "${EXTENDING}" != "Core" ]] && askUserForExtensionName
[[ -z $TEMPLATE ]] && askUserForTemplateDirectoryName
[[ -z $USER_DEFINED_COMPONENT_NAME ]] && askUserForComponentName
# @devNote: The use of "" is intentional here, we want to allow an empty string to be passed to the -s flag and only ask user for subtype if the $USER_DEFINED_SUBTYPE var is truly not set at this point in the script, i.e. -s was not passed, as opppsed to -s "" which should be valid and not require user to be asked for subtype. @see the following stackoverflow post on the difference between using [ -z $VAR ] and [ -z "$VAR" ] : https://stackoverflow.com/questions/3601515/how-to-check-if-a-variable-is-set-in-bash
[[ -z "$USER_DEFINED_COMPONENT_SUBTYPE" ]] && askUserForComponentSubtype
setTemplatePaths
setDirecotryPaths
generatePHPCodeFromTemplate "${TEST_TRAIT_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR}" "TestTrait"
generatePHPCodeFromTemplate "${ABSTRACT_TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${INTERFACE_TEMPLATE_FILE_PATH}" "${COMPONENT_INTERFACE_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${ABSTRACTION_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACTION_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${CLASS_TEMPLATE_FILE_PATH}" "${COMPONENT_CLASS_TARGET_ROOT_DIR}" ""
setColor 0
