#!/bin/bash

set -o posix

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
        _aufs_response=$(printf "%s" "${_aufs_responses[${_aufs_responseIndex}]}" | sed -E "s,-, ,g;")
        promptUserAndNotify "${_aufs_response}" "One moment please"
        PREVIOUS_USER_INPUT="${opt}"
        break
      fi
      printf "\n%s%s%s%s%s%s is not a valid option.\n\nPlease enter the %s%snumber%s%s that corresponds to your selection.%s\n" "${CLEARCOLOR}" "${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}" "${DARKTEXTCOLOR}" "${REPLY}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}" "${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}" "${CLEARCOLOR}" "${WARNINGCOLOR}" "${CLEARCOLOR}"
      ;;
    esac
  done
}

# MARK FOR REMOVAL, REPLACE WITH DEF IN functions.sh
initColors() {
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
  _sip_userDefinedComponentSubType=$(printf "%s" "${USER_DEFINED_COMPONENT_SUBTYPE}" | sed "s,DS_NAMESPACE_SEPERATOR,\\\,g")
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

setDirecotryPaths() {
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
# MARK FOR REMOVAL, REPLACE WITH DEF IN functions.sh
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
  _gpcft_filePath=$(printf "%s" "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g; s,DS_NAMESPACE_SEPERATOR,/,g;")
  if [[ "${_gpcft_fileName}" == "TestTrait" ]]; then
    _gpcft_filePath=$(printf "%s" "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/TestTraits/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g; s,DS_NAMESPACE_SEPERATOR,/,g;")
  fi
  if [[ "${EXTENDING}" == "Core" ]]; then
    _gpcft_phpCode=$(sed -E "s/DS_CORE_NAMESPACE_PREFIX/DarlingDataManagementSystem/g; s/DS_TESTS_NAMESPACE_PREFIX/UnitTests/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/DS_NAMESPACE_SEPERATOR/\\\/g; s/\\\;/;/g; s,[\][\],\\\,g;" "${1}")
  fi
  if [[ "${EXTENDING}" == "Extension" ]]; then
    _namespace_seperator='\\'
    _gpcft_phpCode=$(sed -E "s/DS_CORE_NAMESPACE_PREFIX/Extensions${_namespace_seperator}${EXTENSION_NAME}${_namespace_seperator}core/g; s/DS_TESTS_NAMESPACE_PREFIX/Extensions${_namespace_seperator}${EXTENSION_NAME}${_namespace_seperator}Tests${_namespace_seperator}Unit/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/DS_NAMESPACE_SEPERATOR/\\\/g; s/\\\;/;/g; s,[\][\],\\\,g;" "${1}")
  fi
  _gpcft_fileSubDirectoryPath=$(printf "%s" "${_gpcft_filePath}" | sed -E "s/\/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php//g")
  if [[ "${CURRENT_USER_INPUT}" != "make" ]] && [[ $FORCE_MAKE -ne 1 ]]; then
    promptUser "${CLEARCOLOR}${NOTIFYCOLOR}Please review the ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}Info Panel${CLEARCOLOR}${NOTIFYCOLOR} to make sure you entered everything correctly, if everything looks ok type ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}make${CLEARCOLOR}${NOTIFYCOLOR} and press ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to generaate your new Component's Php files, otherwise press ${CLEARCOLOR}${NOTIFYCOLOR}<Ctrl> c${CLEARCOLOR}${NOTIFYCOLOR} to quit and start over." "showInfo"
    showLoadingBar "Preparing to write php files to appropriate directories"
  fi
  if [[ "${CURRENT_USER_INPUT}" == "make" ]] || [[ $FORCE_MAKE -eq 1 ]]; then
    showLoadingBar "${CLEARCOLOR}${ATTENTIONEFFECT}${NOTIFYCOLOR}Writing file ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}${_gpcft_filePath}${CLEARCOLOR} " "dontClear"
    mkdir -p "${_gpcft_fileSubDirectoryPath}"
    printf "%s" "${_gpcft_phpCode}" >"${_gpcft_filePath}"
  fi
}

askUserForComponentName() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter a ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}name for the new component:${CLEARCOLOR}" "showInfo"
  USER_DEFINED_COMPONENT_NAME="${PREVIOUS_USER_INPUT}"
}

askUserForComponentSubtype() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter the component's ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}sub-type${CLEARCOLOR}${NOTIFYCOLOR}, the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}sub-type${CLEARCOLOR}${NOTIFYCOLOR} is used to construct namespaces for the Component. Example: ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}\\DarlingDataManagementSystem\\*\\component\\SUB\\TYPE\\${USER_DEFINED_COMPONENT_NAME}${CLEARCOLOR}${NOTIFYCOLOR} Note: You must escape backslash characters. Note: Do not include a preceding backslash in the sub-type. ${CLEARCOLOR}${ATTENTIONEFFECTCOLOR}Wrong: \\\\Foo\\\\Bar ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Right: Foo\\\\Bar${CLEARCOLOR}" "showInfo"
  USER_DEFINED_COMPONENT_SUBTYPE=$(printf "%s" "${PREVIOUS_USER_INPUT}" | sed -E "s,[\\],DS_NAMESPACE_SEPERATOR,g")
}

showWelcomeMessage() {
  printf "%s" "${CLEARCOLOR}${NOTIFYCOLOR}"
  animatedPrint "Welcome to the Darling Shell" .05
  printf "%s" "${CLEARCOLOR}"
  showLoadingBar "One moment please"
}

askUserForTemplateDirectoryName() {
  local _auftdn_options
  local _auftdn_responses
  _auftdn_options=("CoreComponent" "CoreSwitchableComponent" "CoreOutputComponent" "CoreActionComponent")
  _auftdn_responses=("${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreComponent${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreSwitchableComponent${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreOutputComponent${CLEARCOLOR}${NOTIFYCOLOR}\" template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}CoreActionComponent${CLEARCOLOR}${NOTIFYCOLOR}\" template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}")
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
