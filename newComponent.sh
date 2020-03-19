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
  clear
}

initVars() {
  WARNINGCOLOR=$(setColor 35)
  CLEARCOLOR=$(setColor 0)
  NOTIFYCOLOR=$(setColor 33)
  DSHCOLOR=$(setColor 41)
  USRPRMPTCOLOR=$(setColor 41)
  #PHPCODECOLOR=$(setColor 42)
  HIGHLIGHTCOLOR=$(setColor 41)
  HIGHLIGHTCOLOR2=$(setColor 45)
  ATTENTIONEFFECT=$(setColor 5)
  ATTENTIONEFFECTCOLOR=$(setColor 36)
  DARKTEXTCOLOR=$(setColor 30)
}

showInfoPanel() {
  printf "\n\n%s----- Info Panel -----%s" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}" "${CLEARCOLOR}"
  printf "\n  %sExtending: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${EXTENDING}${CLEARCOLOR}"
  printf "\n  %sExtension Name: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${EXTENSION_NAME}${CLEARCOLOR}"
  printf "\n  %sTemplate: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${TEMPLATE}${CLEARCOLOR}"
  printf "\n  %sParent Component Name: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${USER_DEFINED_PARENT_COMPONENT_NAME}${CLEARCOLOR}"
  printf "\n  %sParent Component Sub-type: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${USER_DEFINED_PARENT_COMPONENT_SUBTYPE}${CLEARCOLOR}"
  printf "\n  %sComponent Name: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${USER_DEFINED_COMPONENT_NAME}${CLEARCOLOR}"
  printf "\n  %sComponent Sub-type: %s" "${CLEARCOLOR}${NOTIFYCOLOR}" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${USER_DEFINED_COMPONENT_SUBTYPE}${CLEARCOLOR}"
  printf "\n%s----------------------%s\n\n" "${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}" "${CLEARCOLOR}"
}

askUserIfComponentForCoreOrExtension() {
  local _auicfcoe_componentExtends
  local _auicfcoe_options
  local _auicfcoe_responses
  _auicfcoe_options=("Core" "Extension")
  _auicfcoe_responses=("${CLEARCOLOR}${ATTENTIONEFFECT}${ATTENTIONEFFECTCOLOR}WARNING${CLEARCOLOR}${WARNINGCOLOR}: Defining new Components for core should only be done if absolutely necessary, and you should only do so if you are sure you know what you are doing and understand the consequences! ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}${DARKTEXTCOLOR}It is recommended that you define new Components as part of an Extension. Modifying Core can break Core!${CLEARCOLOR}${WARNINGCOLOR} Are you sure you want to proceed? (Type \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${WARNINGCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${WARNINGCOLOR}\" to continue, press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${WARNINGCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You have chosen to ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}create a new Component for an Extension${CLEARCOLOR}${NOTIFYCOLOR}, if this is not correct press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit, otherwise type \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\".${CLEARCOLOR}")
  askUserForSelection "${CLEARCOLOR}${NOTIFYCOLOR}Is this Component being defined as part of ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Core${CLEARCOLOR}${NOTIFYCOLOR} or as part of an ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Extension${CLEARCOLOR}${NOTIFYCOLOR}?${CLEARCOLOR}" _auicfcoe_options _auicfcoe_responses
  _auicfcoe_componentExtends="${PREVIOUS_USER_INPUT}"
  EXTENDING="${PREVIOUS_USER_INPUT}"
  if [[ "${_auicfcoe_componentExtends}" == "Core" ]]; then
    EXTENSION_NAME=""
    COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR="./Tests/Unit/interfaces/component"
    COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR="./Tests/Unit/abstractions/component"
    COMPONENT_TEST_TARGET_ROOT_DIR="./Tests/Unit/classes/component"
    COMPONENT_INTERFACE_TARGET_ROOT_DIR="./core/interfaces/component"
    COMPONENT_ABSTRACTION_TARGET_ROOT_DIR="./core/abstractions/component"
    COMPONENT_CLASS_TARGET_ROOT_DIR="./core/classes/component"
  fi

  if [[ "${_auicfcoe_componentExtends}" == "Extension" ]]; then
    promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}What is the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}name of the Extension${CLEARCOLOR}${NOTIFYCOLOR} this Component will belong to?${CLEARCOLOR}" "showInfo"
    EXTENSION_NAME="${PREVIOUS_USER_INPUT}"
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
    clear
    promptUser "${1}" "${2}"
    #    clear
    notifyUser "You entered \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}${CURRENT_USER_INPUT}${CLEARCOLOR}${NOTIFYCOLOR}\"Is this correct?${CLEARCOLOR}" ""
    if [[ "${CURRENT_USER_INPUT}" == "Y" ]]; then
      break
    fi
    promptUser "If so, type ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}\"Y\"${CLEARCOLOR}${NOTIFYCOLOR} and press ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to continue to next step, or just press ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to repeat the last step.${CLEARCOLOR}"
    if [[ "${CURRENT_USER_INPUT}" == "Y" ]]; then
      break
    fi
  done
  clear
}

promptUserAndNotify() {
  setColor 0
  while :; do
    #    clear
    promptUser "${1}"
    #    clear
    if [[ "${CURRENT_USER_INPUT}" == "Y" ]]; then
      showLoadingBar "${2}"
      #      clear
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
  _gpcft_filePath=$(echo "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g;")
  if [[ "${_gpcft_fileName}" == "TestTrait" ]]; then
    _gpcft_filePath=$(echo "${_gpcft_fileRootDirectoryPath}/${USER_DEFINED_COMPONENT_SUBTYPE}/TestTraits/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php" | sed -E "s,\\\,/,g; s,//,/,g;")
  fi
  _gpcft_phpCode=$(sed -E "s/DS_EXTENSION_NAME/${EXTENSION_NAME}/g; s/DS_PARENT_COMPONENT_SUBTYPE/${USER_DEFINED_PARENT_COMPONENT_SUBTYPE}/g; s/DS_PARENT_COMPONENT_NAME/${USER_DEFINED_PARENT_COMPONENT_NAME}/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/\\\\\\\/\\\/g; s/\\\;/;/g;" "${1}")
  _gpcft_fileSubDirectoryPath=$(echo "${_gpcft_filePath}" | sed -E "s/\/${USER_DEFINED_COMPONENT_NAME}${_gpcft_fileName}.php//g")
  #  printf "%s\n\n%sThe following code was generated using the %s%s%s%s%s template, please review it to make sure there are not any errors:%s\n\n" "${CLEARCOLOR}" "${NOTIFYCOLOR}" "${CLEARCOLOR}" "${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}" "${_gpcft_template}" "${CLEARCOLOR}" "${NOTIFYCOLOR}" "${CLEARCOLOR}"
  # Showing the code is problematic in terminals that dont support scrolling, keep this line for reference, and in case you want to use in the future, though if you do you will want to refactor to insure code is viewable without scrolling...tricky..., echo "${PHPCODECOLOR}${_gpcft_phpCode}"
  if [[ "${CURRENT_USER_INPUT}" != "make" ]]; then
    promptUser "${CLEARCOLOR}${NOTIFYCOLOR}Please review the ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}Info Panel${CLEARCOLOR}${NOTIFYCOLOR} to make sure you entered everything correctly, if everything looks ok type ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}make${CLEARCOLOR}$NOTIFYCOLOR} and press ${CLEARCOLOR}${HIGHLIGHTCOLOR2}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR} to generaate your new Component's Php files, otherwise press ${CLEARCOLOR}${NOTIFYCOLOR}<Ctrl> c${CLEARCOLOR}${NOTIFYCOLOR} to quit and start over." "showInfo"
    clear
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
  #USER_DEFINED_COMPONENT_SUBTYPE=$(echo "${PREVIOUS_USER_INPUT}" | sed 's,\\,\\\\,g')
  USER_DEFINED_COMPONENT_SUBTYPE=${PREVIOUS_USER_INPUT/\\/\\\\}
}

askUserForParentComponentName() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}name of the component this component extends${CLEARCOLOR}${NOTIFYCOLOR}:${CLEARCOLOR}" "showInfo"
  USER_DEFINED_PARENT_COMPONENT_NAME="${PREVIOUS_USER_INPUT}"
}

askUserForParentComponentSubtype() {
  promptUserAndVerifyInput "${CLEARCOLOR}${NOTIFYCOLOR}Please enter the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}subtype of the component this component extends:${CLEARCOLOR}" "showInfo"
  USER_DEFINED_PARENT_COMPONENT_SUBTYPE=${PREVIOUS_USER_INPUT/\\/\\\\}
}

showWelcomeMessage() {
  clear
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
  printf "\n\n\n\n%s" "${EXTENDING}"
  # @todo make a case statement so script exists if not core or extension...
  if [[ "${EXTENDING}" == "Core" ]]; then
      _auftdn_options=("Component" "OutputComponent" "SwitchableComponent")
      _auftdn_responses=("${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Component${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}OutputComponent${CLEARCOLOR}${NOTIFYCOLOR}\" template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}" "${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}SwitchableComponent${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}")
  fi
  if [[ "${EXTENDING}" == "Extension" ]]; then
      _auftdn_options=("ExtensionComponent")
      _auftdn_responses=("${CLEARCOLOR}${NOTIFYCOLOR}You selected the ${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Extension Component${CLEARCOLOR}${NOTIFYCOLOR} template, if this is correct enter \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}Y${CLEARCOLOR}${NOTIFYCOLOR}\" and press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<enter>${CLEARCOLOR}${NOTIFYCOLOR}\", otherwise press \"${CLEARCOLOR}${HIGHLIGHTCOLOR}${DARKTEXTCOLOR}<ctrl> c${CLEARCOLOR}${NOTIFYCOLOR}\" to quit and start over.${CLEARCOLOR}")
  fi
  askUserForSelection "${CLEARCOLOR}${NOTIFYCOLOR}Please select the template that should be used to generate the php files.${CLEARCOLOR}" _auftdn_options _auftdn_responses
  TEMPLATE="${PREVIOUS_USER_INPUT}"
  TEST_TRAIT_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/TestTrait.php"
  ABSTRACT_TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/AbstractTest.php"
  TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Test.php"
  INTERFACE_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Interface.php"
  ABSTRACTION_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Abstraction.php"
  CLASS_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Class.php"
}

clear
initVars
showWelcomeMessage
askUserIfComponentForCoreOrExtension
askUserForTemplateDirectoryName
askUserForParentComponentName
askUserForParentComponentSubtype
askUserForComponentName
askUserForComponentSubtype
generatePHPCodeFromTemplate "${TEST_TRAIT_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR}" "TestTrait"
generatePHPCodeFromTemplate "${ABSTRACT_TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TARGET_ROOT_DIR}" "Test"
generatePHPCodeFromTemplate "${INTERFACE_TEMPLATE_FILE_PATH}" "${COMPONENT_INTERFACE_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${ABSTRACTION_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACTION_TARGET_ROOT_DIR}" ""
generatePHPCodeFromTemplate "${CLASS_TEMPLATE_FILE_PATH}" "${COMPONENT_CLASS_TARGET_ROOT_DIR}" ""
setColor 0
