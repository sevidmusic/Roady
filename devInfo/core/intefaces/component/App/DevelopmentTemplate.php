*************************************************************************
****************************** App **************************************
*************************************************************************

Note: All code in this Component develeopment template is psuedo code,
and is meant to serve as a guide, actual implementation will be
different.

*************************************************************************
************************ Notes about this file **************************
*************************************************************************

  Hint: Hints provide psuedo code that is meant to serve as an
        implementation guide.

        Note: Hint numbers correspond pseudo code steps, NOT line numbers.
              They are merely a formatting feature so the following command
              can be run to get a summary of the DevelopmentTemplate:

        grep -E 'tes[t]|[0-9][.]' /path/to/DevelopmentTemplate.txt | sed -e 's/tes[t]/\ntest/g;'

        In general it is important that the formatting of this document
        be consistent so tools like grep|awk|sed can be used to review
        this file.

*************************************************************************
*************************************************************************
*************************************************************************

*******************
TestTrait propertys
*******************

$mockRequest

*****************
TestTrait methods
*****************

getRandomUrl() : string // produce a random url, urls should be both well formed and malformed

getMockRequest(): Request
{
    if(!isset($mockRequest))
    {
        $this->mockRequest = new Request(...);
        $this->mockRequest->import(['url' => $this->getRandomUrl());
    }
    return $this->mockRequest;
}

*********
Constants
*********

APP_CONTAINER = "APP"

testAPP_CONTAINERIsSetToStringAPP(): void
   Hint:
       1. assertEquals("APP", DarlingCms\abstractions\component\App\App::APP_CONTAINER) // test direct call from abstraction
       2. assertEquals("APP", DarlingCms\classes\component\App\App::APP_CONTAINER) // test direct call from class
       3. assertEquals("APP", TestTrait::getApp()::APP_CONTAINER) // test instance call

*******
Methods
*******

testGetContainerReturnsValueOfAPP_CONTAINERConstant(): void
   Hint:
       1. assertEquals(App::APP_CONTAINER, App->getContainer())
       2. assertEquals(App::APP_CONTAINER, App->export()['storable']->getContainer())

******************* HERE ****************************************************************************************************
testDeriveAppNameLocationReturnsAlphaNumericStringFormOfValueReturnedByParsingSpecifiedRequestsUrlToGetHost(): void
   Hint:
       1. assertEquals(
       1.                 preg_replace("/[^A-Ba-b0-9]/", '', parse_url(TestTrait::getMockRequest()->getUrl(), PHP_URL_HOST)),
       1.                 App::deriveAppNameLocationFromRequest(TestTrait::getMockRequest())
       1.             )
*****************************************************************************************************************************

testGetNameAndGetLocationReturnSameValue()
   Hint:
       1. assertEquals(App->getName(), App->getLocation());
       2. assertEquals(App->export()['storable']->getName(), App->export()['storable']->getLocation());

testNameAndLocationWereSetUsingDeriveAppNameLocationFromRequestMethod()
   Hint:
       1. $expectedNameLocation = App::deriveNameLocationFromRequest(TestTrait::getMockRequest())
       2. assertEquals($expectedNameLocation, App->getName());
       2. assertEquals($expectedNameLocation, App->getLocation());
       2. assertEquals($expectedNameLocation, App->export()['storable']->getName());
       2. assertEquals($expectedNameLocation, App->export()['storable']->getLocation());


