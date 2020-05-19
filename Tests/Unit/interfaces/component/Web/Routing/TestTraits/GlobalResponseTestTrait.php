<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\classes\component\Web\App;
use DarlingCms\interfaces\component\Web\Routing\GlobalResponse;

trait GlobalResponseTestTrait
{

    private $globalResponse;

    public function testRespondsToRequestReturnsTrueForAssignedRequest(): void
    {
        $this->insteadTestRespondsToRequestReturnsTrueIfValueReturnedByPassingSuppliedRequestToAnAppImplementationsDeriveNameLocationFromRequestMethodMatchesResponsesLocation();
    }

    private function insteadTestRespondsToRequestReturnsTrueIfValueReturnedByPassingSuppliedRequestToAnAppImplementationsDeriveNameLocationFromRequestMethodMatchesResponsesLocation(): void
    {
        $request = $this->getMockRequest();
        if ($this->getGlobalResponse()->getLocation() === App::deriveNameLocationFromRequest($request)) {
            $this->assertTrue(
                $this->getGlobalResponse()->respondsToRequest(
                    $request,
                    $this->getMockCrud()
                ),
                'respondsToRequest() must return true for any Request made to the App the GlobalResponse belongs to, i.e. if the return value of App::deriveNameLocationFromRequest(Request) is equal to Response->getLocation() then Response->respondsToRequest(Request) MUST return true.'
            );
        }
        /*
        $this->getMockCrud()->create($request);
        $this->getGlobalResponse()->addRequestStorageInfo($request);
         */
    }

    protected function getGlobalResponse(): GlobalResponse
    {
        return $this->globalResponse;
    }

    protected function setGlobalResponse(GlobalResponse $globalResponse): void
    {
        $this->globalResponse = $globalResponse;
    }

    public function testRespondsToRequestReturnsFalseForUnknownRequest(): void
    {
        $this->insteadTestRespondsToRequestReturnsFalseIfValueReturnedByPassingSuppliedRequestToAnAppImplementationsDeriveNameLocationFromRequestMethodDoesNotMatchResponsesLocation();
    }

    private function insteadTestRespondsToRequestReturnsFalseIfValueReturnedByPassingSuppliedRequestToAnAppImplementationsDeriveNameLocationFromRequestMethodDoesNotMatchResponsesLocation(): void
    {
        $request = $this->getMockRequest();
        $request->import(['url' => 'http://www.someOtherAppsUrl.com']);
        $this->assertFalse(
            $this->getGlobalResponse()->respondsToRequest(
                $request,
                $this->getMockCrud()
            ),
            'respondsToRequest() must return false for any Request made to an App other than the App the GlobalResponse belongs to, i.e. if the return value of App::deriveNameLocationFromRequest(Request) is NOT equal to Response->getLocation() then Response->respondsToRequest(Request) MUST return false'
        );
    }

    protected function setGlobalResponseParentTestInstances(): void
    {
        $this->setResponse($this->getGlobalResponse());
        $this->setResponseParentTestInstances();
    }

}
