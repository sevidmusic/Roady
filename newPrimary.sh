#!/bin/bash

initVars() {
    COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR="./Tests/Unit/interfaces/primary";
    COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR="./Tests/Unit/abstractions/primary";
    COMPONENT_TEST_TARGET_ROOT_DIR="./Tests/Unit/classes/primary";
    COMPONENT_INTERFACE_TARGET_ROOT_DIR="./core/interfaces/primary";
    COMPONENT_ABSTRACTION_TARGET_ROOT_DIR="./core/abstractions/primary";
    COMPONENT_CLASS_TARGET_ROOT_DIR="./core/classes/primary";
    CLEARCOLOR=$(setColor 0);
    NOTIFYCOLOR=$(setColor 33);
    DSHCOLOR=$(setColor 36);
    USRPRMPTCOLOR=$(setColor 44);
    INPUTCOLOR=$(setColor 34);
    PHPCODECOLOR=$(setColor 35);
}

setColor() {
    COLOR="\e[${1}m";
    printf "${COLOR}";
}

writeWordSleep() {
    printf "${1}";
    sleep "${2}";
}

sleepWriteWord() {
    sleep "${2}";
    printf "${1}";
}

sleepWriteWordSleep() {
    sleep "${2}";
    printf "${1}";
    sleep "${2}";
}

showLoadingBar() {
    sleepWriteWordSleep "${1}" .3;
    setColor 44;
    INC=0;
    while [ $INC -le 42 ]
    do
        sleepWriteWordSleep ":" .009;
        INC=$(($INC + 1));
    done;
    echo "[100%]";
    setColor 0;
    sleep 0.42;
    clear;
}

notifyUser() {
    printf "\n${NOTIFYCOLOR}${1}${CLEARCOLOR}\n";
}

promptUser() {
    notifyUser "${1}";
    PROMPT_MSG=$(printf "\n${DSHCOLOR}\$dsh: ${USRPRMPTCOLOR}");
    PREVIOUS_USER_INPUT="${USER_INPUT}";
    read -p "${PROMPT_MSG}" USER_INPUT;
    setColor 0;
}

promptUserAndVerifyInput() {
    while :
    do
        clear;
        promptUser "${1}";
        clear;
        notifyUser  "You entered \"${INPUTCOLOR}${USER_INPUT}${NOTIFYCOLOR}\"\n\nIs this correct?";
        if [ "${USER_INPUT}" = "Y" ]; then
            clear;
            break;
        fi
        promptUser "If so, type ${INPUTCOLOR}\"Y\"${NOTIFYCOLOR} and press ${INPUTCOLOR}<enter>${NOTIFYCOLOR} to continue to next step,\nor just press ${INPUTCOLOR}<enter>${NOTIFYCOLOR} to repeat the last step.";
        if [ "${USER_INPUT}" = "Y" ]; then
            clear;
            break;
        fi
    done;
}

promptUserAndNotify() {
    while :
    do
        clear;
        promptUser "${1}";
        clear;
        if [ "${USER_INPUT}" = "Y" ]; then
            showLoadingBar "${2}";
            clear;
            break;
        fi
    done;
}

generatePHPCodeFromTemplate() {
    TEMPLATE="${1}";
    GENERATED_FILE_ROOT_DIR_PATH="${2}";
    FILE_NAME_SUFFIX="${3}";
    GENERATED_FILE_PATH=$(echo "${GENERATED_FILE_ROOT_DIR_PATH}/${USER_DEFINED_COMPONENT_SUBTYPE}/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php" | sed -E "s,\\\,/,g; s,//,/,g;");
    if [ "${FILE_NAME_SUFFIX}" = "TestTrait" ]; then
        GENERATED_FILE_PATH=$(echo "${GENERATED_FILE_ROOT_DIR_PATH}/${USER_DEFINED_COMPONENT_SUBTYPE}/TestTraits/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php" | sed -E "s,\\\,/,g; s,//,/,g;");
    fi;
    PHP_CODE=$(sed -E "s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/\\\\\\\/\\\/g; s/\\\;/;/g;" "${1}");
    GENERATED_FILE_SUB_DIR_PATH=$(echo "${GENERATED_FILE_PATH}" | sed -E "s/\/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php//g");
    printf "${NOTIFYCOLOR}The following code was generated using the ${INPUTCOLOR}${TEMPLATE}${NOTIFYCOLOR} template, please review it to make sure there are not any errors:${CLEARCOLOR}\n\n";
    echo "${PHPCODECOLOR}${PHP_CODE}";
    promptUser "\n\nIf everything looks ok press <enter>";
    showLoadingBar "Writing file ${GENERATED_FILE_PATH} ";
    mkdir -p "${GENERATED_FILE_SUB_DIR_PATH}";
    echo "${PHP_CODE}" > "${GENERATED_FILE_PATH}";
}

askUserForPrimaryName() {
    promptUserAndVerifyInput "Please enter a name for the primary";
    USER_DEFINED_COMPONENT_NAME="${PREVIOUS_USER_INPUT}";
}

showWelcomeMessage() {
    clear;
    setColor 32;
    sleepWriteWordSleep "\nW" .03;
    setColor 34;
    sleepWriteWordSleep "e" .03;
    setColor 36;
    sleepWriteWordSleep "l" .03;
    setColor 32;
    sleepWriteWordSleep "c" .03;
    setColor 34;
    sleepWriteWordSleep "o" .03;
    setColor 36;
    sleepWriteWordSleep "m" .03;
    setColor 32;
    sleepWriteWordSleep "e" .03;
    setColor 34;
    sleepWriteWordSleep " " .03;
    setColor 36;
    sleepWriteWordSleep "t" .03;
    setColor 32;
    sleepWriteWordSleep "h" .03;
    setColor 34;
    sleepWriteWordSleep "e" .03;
    setColor 36;
    sleepWriteWordSleep " " .03;
    setColor 32;
    sleepWriteWordSleep "D" .03;
    setColor 34;
    sleepWriteWordSleep "a" .03;
    setColor 36;
    sleepWriteWordSleep "r" .03;
    setColor 32;
    sleepWriteWordSleep "l" .03;
    setColor 34;
    sleepWriteWordSleep "i" .03;
    setColor 36;
    sleepWriteWordSleep "n" .03;
    setColor 32;
    sleepWriteWordSleep "g" .03;
    setColor 34;
    sleepWriteWordSleep " " .03;
    setColor 36;
    sleepWriteWordSleep "S" .03;
    setColor 32;
    sleepWriteWordSleep "h" .03;
    setColor 34;
    sleepWriteWordSleep "e" .03;
    setColor 36;
    sleepWriteWordSleep "l" .03;
    setColor 32;
    sleepWriteWordSleep "l\n" .03;
    setColor 36;
    showLoadingBar "Loading New Primary Module";
}

setOrAskUserForTemplateDirectoryName() {
    # promptUserAndVerifyInput "Please enter the name of the directory where the appropriate php code templates are located:";
    TEMPLATE="Primary";

    while [ ! -d "./templates/${TEMPLATE}" ]
    do
        promptUserAndVerifyInput "The specified template directory does not exist, please enter an existing template directory's name";
        TEMPLATE="${PREVIOUS_USER_INPUT}";
    done;

    TEST_TRAIT_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/TestTrait.php";
    ABSTRACT_TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/AbstractTest.php";
    TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Test.php";
    INTERFACE_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Interface.php";
    ABSTRACTION_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Abstraction.php";
    CLASS_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Class.php";
}
while :
do
    initVars;
    showWelcomeMessage;
    setOrAskUserForTemplateDirectoryName;
    askUserForPrimaryName;
    generatePHPCodeFromTemplate "${TEST_TRAIT_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR}" "TestTrait";
    generatePHPCodeFromTemplate "${ABSTRACT_TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR}" "Test";
    generatePHPCodeFromTemplate "${TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TARGET_ROOT_DIR}" "Test";
    generatePHPCodeFromTemplate "${INTERFACE_TEMPLATE_FILE_PATH}" "${COMPONENT_INTERFACE_TARGET_ROOT_DIR}" "";
    generatePHPCodeFromTemplate "${ABSTRACTION_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACTION_TARGET_ROOT_DIR}" "";
    generatePHPCodeFromTemplate "${CLASS_TEMPLATE_FILE_PATH}" "${COMPONENT_CLASS_TARGET_ROOT_DIR}" "";
    setColor 0;
    break;

done;


