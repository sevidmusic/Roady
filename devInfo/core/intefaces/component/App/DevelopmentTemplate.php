*************************************************************************
************************ StoredComponentRegistry ************************
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

General Notes:

  The following pseudeo definition is a rough outline of what an App component's definition might look like:

<?php
abstract class App extends SwitchableComponent
{
    // Important: like Responses, the container of App components MUST be predictable, so a constant MUST be defined for this value.
    public const APP_CONTAINER = "APP"
    private $appDomain;
    __construct(Request*, Switchable) {
        $this->appDomain = self::deriveAppDomainFromRequest(Request);
        $storable = new Storable(
                        self::deriveAppNameFromRequest(Request), // ***make a public static method, though tempting to keep private this could be useful say for dunamicaly determining an App's name, which may also be necessary outside of this class.
                        self::deriveAppLocationFromRequest(Request), // ***make a public static method, though tempting to keep private this could be useful say for dunamicaly determining an App's name, which may also be necessary outside of this class.
                        self::APP_CONTAINER
                    );
        parent::__construct($storable, Switchable)
    }

}
    public static function deriveAppDomainFromRequest(Request $request): string;   // url http://www.foo-bar.baz.123.com/index.php?foo=bar&baz should produce value: http://www.foo-bar.baz.123.com/
    public static function deriveAppNameFromRequest(Request $request): string;     // url http://www.foo-bar.baz.123.com/index.php?foo=bar&baz should produce value: foobarbaz123
    public static function deriveAppLocationFromRequest(Request $request): string; // url http://www.foo-bar.baz.123.com/index.php?foo=bar&baz should produce value: wwwfoobarbaz123com

?>
*Note: An App component is a SwitchableComponent, the SwitchableComponent A.P.I. is
       new SwitchableComponent(Storable, Switchable)
       An App component changes the constructors signature to expect a Request as the
       first argument, this does not conflict with the SwitchableComponent's A.P.I.
       because all Components are Storables, i.e., Requests are Storables.
       So all an App is doing is limiting the type of Storable it's __construct method
       accepts to DarlingCms\interfaces\component\Web\Routing\Response.

*************************
******* Constants *******
*************************

APP_CONTAINER

testAppContainerConstantIsSetToStringAPP(): void

**************************
******* Properties *******
**************************

*********
appDomain
*********
