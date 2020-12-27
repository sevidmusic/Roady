[1mdiff --git a/dsh/Tests/newRequestTests.sh b/dsh/Tests/newRequestTests.sh[m
[1mindex 79fce75..585aac4 100755[m
[1m--- a/dsh/Tests/newRequestTests.sh[m
[1m+++ b/dsh/Tests/newRequestTests.sh[m
[36m@@ -61,13 +61,13 @@[m [mtestNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatch[m
     dsh --new Request ${test_app_name} ${request_name} REQContainer index.php[m
     assertEquals "$(expectedRequestFileContent ${test_app_name} ${request_name} REQContainer index.php)" "$(cat "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}/Requests/${request_name}.php")"[m
 }[m
[31m-#runTest testNewRequestRunsWithErrorIfAPP_NAMEIsNotSpecified[m
[31m-#runTest testNewRequestRunsWithErrorIfSpecifiedAppDoesNotExist[m
[31m-#runTest testNewRequestRunsWithErrorIfAnRequestNamedREQUEST_NAMEAlreadyExists[m
[31m-#runTest testNewRequestRunsWithErrorIfREQUEST_NAMEIsNotSpecified[m
[31m-#runTest testNewRequestRunsWithErrorIfREQUEST_CONTAINERIsNotSpecified[m
[31m-#runTest testNewRequestRunsWithErrorIfRELATIVE_URLIsNotSpecified[m
[31m-#runTest testNewRequestCreatesNewRequestConfigurationFileForSpecifiedApp[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfAPP_NAMEIsNotSpecified[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfSpecifiedAppDoesNotExist[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfAnRequestNamedREQUEST_NAMEAlreadyExists[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfREQUEST_NAMEIsNotSpecified[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfREQUEST_CONTAINERIsNotSpecified[m
[32m+[m[32mrunTest testNewRequestRunsWithErrorIfRELATIVE_URLIsNotSpecified[m
[32m+[m[32mrunTest testNewRequestCreatesNewRequestConfigurationFileForSpecifiedApp[m
 runTest testNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent[m
 [m
 [[ -d "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}" ]] && rm -R "$(determineDshUnitDirectoryPath | sed 's/dshUnit/Apps/g')/${test_app_name}"[m
[1mdiff --git a/dshUnit/dshUnitTests.log b/dshUnit/dshUnitTests.log[m
[1mindex f3ad589..e11ab03 100644[m
[1m--- a/dshUnit/dshUnitTests.log[m
[1m+++ b/dshUnit/dshUnitTests.log[m
[36m@@ -1,278 +1,236 @@[m
 [m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpRunsWithoutError     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:37:26 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:37:29 PM EST 2020 testDshHelpRunsWithoutError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:22:41 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:22:44 AM EST 2020 testDshHelpRunsWithoutError Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpCreatesSystemManPageForDsh     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:37:37 PM EST 2020 assertFileExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:37:40 PM EST 2020 testDshHelpCreatesSystemManPageForDsh Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:22:51 AM EST 2020 assertFileExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:22:54 AM EST 2020 testDshHelpCreatesSystemManPageForDsh Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpOutputMatchesManDshOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:37:50 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:37:53 PM EST 2020 testDshHelpOutputMatchesManDshOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:04 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:23:07 AM EST 2020 testDshHelpOutputMatchesManDshOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:03 PM EST 2020 assertError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:11 PM EST 2020 assertError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:20 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:38:23 PM EST 2020 testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:17 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:26 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:34 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:23:37 AM EST 2020 testDshHelpFLAGRunsWithAnErrorIfSpecifiedFlagIsNotValid Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:30 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:34 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:39 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:43 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:48 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:52 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:38:57 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:01 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:06 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:11 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:15 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:20 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:24 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:29 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:33 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:38 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:42 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:46 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:51 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:55 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:39:59 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:04 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:08 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:13 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:17 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:22 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:26 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:31 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:35 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:39 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:40:43 PM EST 2020 testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:44 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:48 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:52 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:23:57 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:01 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:06 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:10 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:14 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:19 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:24 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:28 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:32 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:36 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:41 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:45 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:50 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:24:55 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:00 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:04 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:09 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:13 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:17 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:22 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:26 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:30 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:35 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:39 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:43 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:47 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:25:51 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:25:55 AM EST 2020 testDshHelpFLAGRunsWithoutErrorIfSpecifiedFlagIsValid Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpHelpOutputMatchesDshUIColorized_Help_HelpFileContent     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:40:50 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:40:54 PM EST 2020 testDshHelpHelpOutputMatchesDshUIColorized_Help_HelpFileContent Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:26:02 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:26:06 AM EST 2020 testDshHelpHelpOutputMatchesDshUIColorized_Help_HelpFileContent Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpFLAGOutputMatchesDshUIColorized_HelpFLAG_HelpFileContent     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:41:04 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:41:08 PM EST 2020 testDshHelpFLAGOutputMatchesDshUIColorized_HelpFLAG_HelpFileContent Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:26:16 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:26:20 AM EST 2020 testDshHelpFLAGOutputMatchesDshUIColorized_HelpFLAG_HelpFileContent Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpFlagsOutputMatchesDshUIColorized_HelpFlags_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:41:15 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:41:19 PM EST 2020 testDshHelpFlagsOutputMatchesDshUIColorized_HelpFlags_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:26:27 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:26:31 AM EST 2020 testDshHelpFlagsOutputMatchesDshUIColorized_HelpFlags_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpStartDevelopmentServerOutputMatchesDshUIColorized_StartDevelopmentServer_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:41:30 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:41:36 PM EST 2020 testDshHelpStartDevelopmentServerOutputMatchesDshUIColorized_StartDevelopmentServer_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:26:42 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:26:47 AM EST 2020 testDshHelpStartDevelopmentServerOutputMatchesDshUIColorized_StartDevelopmentServer_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpBuildAppOutputMatchesDshUIColorized_BuildApp_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:41:50 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:41:54 PM EST 2020 testDshHelpBuildAppOutputMatchesDshUIColorized_BuildApp_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:27:01 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:27:05 AM EST 2020 testDshHelpBuildAppOutputMatchesDshUIColorized_BuildApp_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewOutputMatchesDshUIColorized_New_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:42:12 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:42:16 PM EST 2020 testDshHelpNewOutputMatchesDshUIColorized_New_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:27:22 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:27:26 AM EST 2020 testDshHelpNewOutputMatchesDshUIColorized_New_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewAppOutputMatchesDshUIColorized_NewApp_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:43:06 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:43:10 PM EST 2020 testDshHelpNewAppOutputMatchesDshUIColorized_NewApp_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:28:15 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:28:19 AM EST 2020 testDshHelpNewAppOutputMatchesDshUIColorized_NewApp_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewOutputComponentOutputMatchesDshUIColorized_NewOutputComponent_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:43:31 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:43:36 PM EST 2020 testDshHelpNewOutputComponentOutputMatchesDshUIColorized_NewOutputComponent_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:28:40 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:28:45 AM EST 2020 testDshHelpNewOutputComponentOutputMatchesDshUIColorized_NewOutputComponent_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewDynamicOutputComponentOutputMatchesDshUIColorized_NewDynamicOutputComponent_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:44:02 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:44:07 PM EST 2020 testDshHelpNewDynamicOutputComponentOutputMatchesDshUIColorized_NewDynamicOutputComponent_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:29:11 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:29:17 AM EST 2020 testDshHelpNewDynamicOutputComponentOutputMatchesDshUIColorized_NewDynamicOutputComponent_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewRequestOutputMatchesDshUIColorized_NewRequest_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:44:27 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:44:32 PM EST 2020 testDshHelpNewRequestOutputMatchesDshUIColorized_NewRequest_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:29:37 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:29:41 AM EST 2020 testDshHelpNewRequestOutputMatchesDshUIColorized_NewRequest_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewResponseOutputMatchesDshUIColorized_NewResponse_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:45:22 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:45:26 PM EST 2020 testDshHelpNewResponseOutputMatchesDshUIColorized_NewResponse_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:30:33 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:30:38 AM EST 2020 testDshHelpNewResponseOutputMatchesDshUIColorized_NewResponse_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpNewGlobalResponseOutputMatchesDshUIColorized_NewGlobalResponse_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:46:04 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:46:09 PM EST 2020 testDshHelpNewGlobalResponseOutputMatchesDshUIColorized_NewGlobalResponse_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:31:16 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:31:21 AM EST 2020 testDshHelpNewGlobalResponseOutputMatchesDshUIColorized_NewGlobalResponse_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpAssignToResponseOutputMatchesDshUIColorized_AssignToResponse_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:46:42 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:46:46 PM EST 2020 testDshHelpAssignToResponseOutputMatchesDshUIColorized_AssignToResponse_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:31:54 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:31:59 AM EST 2020 testDshHelpAssignToResponseOutputMatchesDshUIColorized_AssignToResponse_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpPhpUnitOutputMatchesDshUIColorized_PhpUnit_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:46:56 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:47:00 PM EST 2020 testDshHelpPhpUnitOutputMatchesDshUIColorized_PhpUnit_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:32:09 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:32:13 AM EST 2020 testDshHelpPhpUnitOutputMatchesDshUIColorized_PhpUnit_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshHelpDshUnitOutputMatchesDshUIColorized_DshUnit_HelpFileOutput     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:47:13 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:47:17 PM EST 2020 testDshHelpDshUnitOutputMatchesDshUIColorized_DshUnit_HelpFileOutput Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:32:26 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:32:30 AM EST 2020 testDshHelpDshUnitOutputMatchesDshUIColorized_DshUnit_HelpFileOutput Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshStartDevelopmentServerStartsADevelopmentServerWithoutError     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:47:26 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 07:47:30 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:47:34 PM EST 2020 testDshStartDevelopmentServerStartsADevelopmentServerWithoutError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:32:39 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:32:44 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:32:48 AM EST 2020 testDshStartDevelopmentServerStartsADevelopmentServerWithoutError Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshStartDevelopmentServerUsesPort8080IfPORTIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:47:45 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:47:49 PM EST 2020 testDshStartDevelopmentServerUsesPort8080IfPORTIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:32:58 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:33:02 AM EST 2020 testDshStartDevelopmentServerUsesPort8080IfPORTIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshStartDevelopmentServerUsesSpecifiedPORTIfPORTIsSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:47:59 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:48:03 PM EST 2020 testDshStartDevelopmentServerUsesSpecifiedPORTIfPORTIsSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:33:12 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:33:16 AM EST 2020 testDshStartDevelopmentServerUsesSpecifiedPORTIfPORTIsSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:48:13 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:48:16 PM EST 2020 testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:33:27 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:33:30 AM EST 2020 testDshBuildAppRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppRunsWithErrorIfSpecifiedAppsDirectoryDoesNotExist     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 07:48:28 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 07:48:32 PM EST 2020 testDshBuildAppRunsWithErrorIfSpecifiedAppsDirectoryDoesNotExist Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:33:42 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:33:46 AM EST 2020 testDshBuildAppRunsWithErrorIfSpecifiedAppsDirectoryDoesNotExist Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:29:44 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:29:49 PM EST 2020 testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:34:17 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:34:21 AM EST 2020 testDshBuildAppRunsWithErrorIfSpecifiedAppsComponentsPhpFileDoesNotExist Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppBuildsSpecifiedApp     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:31:35 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:31:42 PM EST 2020 testDshBuildAppBuildsSpecifiedApp Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:34:59 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:35:05 AM EST 2020 testDshBuildAppBuildsSpecifiedApp Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:34:12 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:34:20 PM EST 2020 testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:35:47 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:35:54 AM EST 2020 testDshBuildAppBuildsAppForDomainLocalhost8080IfDomainIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:36:25 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:36:32 PM EST 2020 testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:44:16 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:44:23 AM EST 2020 testDshBuildAppBuildsAppForSpecifiedDomainIfDomainIsSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewRunsWithErrorIfMODEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:36:43 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:36:46 PM EST 2020 testDshNewRunsWithErrorIfMODEIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:44:33 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:44:37 AM EST 2020 testDshNewRunsWithErrorIfMODEIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewRunsWithErrorIfMODEIsNotValid     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:37:02 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:37:05 PM EST 2020 testDshNewRunsWithErrorIfMODEIsNotValid Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:44:52 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:44:55 AM EST 2020 testDshNewRunsWithErrorIfMODEIsNotValid Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:37:19 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:37:22 PM EST 2020 testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:45:08 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:45:12 AM EST 2020 testDshNewAppRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:37:59 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:38:03 PM EST 2020 testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:45:47 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:45:51 AM EST 2020 testDshNewAppRunsWithErrorIfAnAppAlreadyExistsNamedAPP_NAME Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:38:34 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:38:37 PM EST 2020 testDshNewAppCreatesNewAppsDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:46:21 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:46:24 AM EST 2020 testDshNewAppCreatesNewAppsDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsOutputComponentsDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:39:09 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:39:13 PM EST 2020 testDshNewAppCreatesNewAppsOutputComponentsDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:46:55 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:46:59 AM EST 2020 testDshNewAppCreatesNewAppsOutputComponentsDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsRequestsDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:39:44 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:39:47 PM EST 2020 testDshNewAppCreatesNewAppsRequestsDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:47:29 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:47:33 AM EST 2020 testDshNewAppCreatesNewAppsRequestsDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsResponsesDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:40:19 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:40:22 PM EST 2020 testDshNewAppCreatesNewAppsResponsesDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:48:03 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:48:06 AM EST 2020 testDshNewAppCreatesNewAppsResponsesDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsDynamicOutputDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:40:54 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:40:58 PM EST 2020 testDshNewAppCreatesNewAppsDynamicOutputDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:48:37 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:48:40 AM EST 2020 testDshNewAppCreatesNewAppsDynamicOutputDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsCssDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:41:29 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:41:32 PM EST 2020 testDshNewAppCreatesNewAppsCssDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:49:11 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:49:14 AM EST 2020 testDshNewAppCreatesNewAppsCssDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsJsDirectory     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:42:04 PM EST 2020 assertDirectoryExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:42:07 PM EST 2020 testDshNewAppCreatesNewAppsJsDirectory Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:49:44 AM EST 2020 assertDirectoryExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:49:47 AM EST 2020 testDshNewAppCreatesNewAppsJsDirectory Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsComponentsPhpFile     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:42:38 PM EST 2020 assertFileExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:42:42 PM EST 2020 testDshNewAppCreatesNewAppsComponentsPhpFile Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:50:18 AM EST 2020 assertFileExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:50:21 AM EST 2020 testDshNewAppCreatesNewAppsComponentsPhpFile Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testDshNewAppCreatesNewAppsComponentsPhpFileWhoseContentMatchesComponentsPhpFileTemplate     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:43:15 PM EST 2020 assertNoError Passed[0m[m
[31m-[0m[44m[30mSat Dec 26 09:43:43 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:43:48 PM EST 2020 testDshNewAppCreatesNewAppsComponentsPhpFileWhoseContentMatchesComponentsPhpFileTemplate Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:50:53 AM EST 2020 assertNoError Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:51:21 AM EST 2020 assertEquals Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:51:25 AM EST 2020 testDshNewAppCreatesNewAppsComponentsPhpFileWhoseContentMatchesComponentsPhpFileTemplate Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:44:26 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:44:30 PM EST 2020 testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:52:02 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:52:05 AM EST 2020 testNewOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:44:45 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:44:49 PM EST 2020 testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:52:20 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:52:24 AM EST 2020 testNewOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:45:15 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:45:20 PM EST 2020 testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:52:49 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:52:54 AM EST 2020 testNewOutputComponentRunsWithErrorIfAnOutputComponentNamedOUTPUT_COMPONENT_NAMEAlreadyExists Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:45:32 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:45:36 PM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:53:06 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:53:10 AM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_NAMEIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:45:48 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:45:53 PM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:53:22 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:53:26 AM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_CONTAINERIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:46:05 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:46:09 PM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:53:38 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:53:42 AM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUT_COMPONENT_POSITIONIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:46:21 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:46:25 PM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:53:54 AM EST 2020 assertError Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:53:57 AM EST 2020 testNewOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified Passed[0m[m
 [m
 [0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:46:45 PM EST 2020 assertFileExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:46:49 PM EST 2020 testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp Passed[0m[m
[32m+[m[32m[0m[44m[30mSun Dec 27 11:54:16 AM EST 2020 assertFileExists Passed[0m[m
[32m+[m[32m[0m[104m[30mSun Dec 27 11:54:21 AM EST 2020 testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp Passed[0m[m
 [m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:47:08 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:47:13 PM EST 2020 testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:47:52 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:47:56 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfAPP_NAMEIsNotSpecified Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:48:12 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:48:16 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfSpecifiedAppDoesNotExist Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:48:44 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:48:50 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfAnDynamicOutputComponentNamedDYNAMIC_OUTPUT_COMPONENT_NAMEAlreadyExists Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_NAMEIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:49:03 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:49:07 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_NAMEIsNotSpecified Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_CONTAINERIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:49:21 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:49:26 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_CONTAINERIsNotSpecified Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_POSITIONIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:49:39 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:49:44 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfDYNAMIC_OUTPUT_COMPONENT_POSITIONIsNotSpecified Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:49:56 PM EST 2020 assertError Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:50:01 PM EST 2020 testNewDynamicOutputComponentRunsWithErrorIfOUTPUTIsNotSpecified Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:50:21 PM EST 2020 assertFileExists Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:50:26 PM EST 2020 testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedApp Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:50:45 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:50:51 PM EST 2020 testNewDynamicOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent Passed[0m[m
[31m-[m
[31m-[0m[44m[30m[0m[7m[90m-=-=     Running testNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent     =-=-[0m[m
[31m-[0m[44m[30mSat Dec 26 09:51:36 PM EST 2020 assertEquals Passed[0m[m
[31m-[0m[104m[30mSat Dec 26 09:51:41 PM EST 2020 testNewRequestCreatesNewRequestConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent Passed[0m[m
[32m+[m[32m[0m[44m[30m[0m[7m[90m-=-=     Running testNewOutputComponentCreatesNewOutputComponentConfigurationFileForSpecifiedAppWhoseContentMatchesExpectedContent     =-=-[0m[m
\ No newline at end of file[m
[1mdiff --git a/dshUnit/dshUnitUI.sh b/dshUnit/dshUnitUI.sh[m
[1mindex 61809f7..d8fe9b9 100755[m
[1m--- a/dshUnit/dshUnitUI.sh[m
[1m+++ b/dshUnit/dshUnitUI.sh[m
[36m@@ -5,7 +5,7 @@[m [mset -o posix[m
 [m
 showAssertionMsg() {[m
     notifyUser "    ${3}" 0 'dontClear'[m
[31m-    showLoadingBar "    ${CLEAR_ALL_STYLES}${COLOR_3}Asserting: ${CLEAR_ALL_STYLES}${COLOR_19}${1} \"${CLEAR_ALL_STYLES}${COLOR_21}${2}${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'[m
[32m+[m[32m    showLoadingBar "    ${CLEAR_ALL_STYLES}${COLOR_3}Asserting: ${CLEAR_ALL_STYLES}${COLOR_19}${1} \"${CLEAR_ALL_STYLES}${COLOR_21}$(printf "%s" "${2}" | sed "s/==/${CLEAR_ALL_STYLES}${COLOR_12}    ==    ${CLEAR_ALL_STYLES}${COLOR_21}/g")${CLEAR_ALL_STYLES}${COLOR_19}\"" 'dontClear'[m
 }[m
 [m
 showAssertionPassedMsg() {[m
