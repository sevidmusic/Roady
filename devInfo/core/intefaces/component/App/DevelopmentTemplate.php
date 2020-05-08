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
- The only method that needs to be overwritten is the __construct() method.

  The following pseudeo definition is a rough outline of what an App component's abstract definition should look like:

<?php
abstract class App extends SwitchableComponent
{
    // Important: like Responses, the container of App components MUST be predictable, so a constant MUST be defined for this value.
    // @todo testAPP_CONTAINERConstantIsSetToStringAPP(): void
    public const APP_CONTAINER = "APP"

    private $request;

    __construct(Request*, Switchable) {
        $this->request = Request;
        $storable = new Storable(
                        $this->deriveAppNameFromRequest(Request), // ***make a public method, though tempting to keep private this could be useful say for dunamicaly determining an App's name, which may also be necessary outside of this class.
                        $this->deriveAppLocationFromRequest(), // ***make a public method, though tempting to keep private this could be useful say for dunamicaly determining an App's name, which may also be necessary outside of this class.
                        self::APP_CONTAINER
                    );
        parent::__construct($storable, Switchable)
    }
    // *** Note: derive method should be public also because it would allow Apps to be "Installed", i.e., index would not create a new App instance
    //           to determine which app was being requested, instead it would use the derive methods to tell a crud which App component should be
    //           used
    //
    //           so index.php could be as simple as:
    //
    //           $crud = new ComponentCrud(...);
    //           $currentRequest = new Request(...);
    //           $app = $crud->readAll(App::deriverLocation(Request), Appp::deriveContainer(Request))[0]; // there should only ever be one App installed in an Apps storage location.
    //           $router = new Router(...);
    //           $ui = new StandardUI(
    //                     new Storable(...)
    //                     new Switchable(),
    //                     new Positionable(),
    //                     $app->getLocation(),
    //                     Response::RESPONSE_CONTAINER
    //                 );
}
?>
*Note: An App component is a SwitchableComponent, the SwitchableComponent A.P.I. is
       new SwitchableComponent(Storable, Switchable)
       An App component changes the constructors signature to expect a Request as the
       first argument, this does not conflict with the SwitchableComponent's A.P.I.
       because all Components are Storables, i.e., Requests are Storables.


