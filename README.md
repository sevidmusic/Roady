# Darling Data Management System

[About](#about)

[Installation](#installation)
1. [Setup Development Tools](#setup-development-tools)
2. [Installation Demo](#installation-demo)

[Getting Started](#getting-started)
1. [Apps and App Packages](#apps-and-app-packages)
2. [Hello World Example](#hello-world-example)
3. [Hello World Demo](#hello-world-demo)
4. [Single App Website Example](#single-app-website-example)
5. [Single App Website Demo](#single-app-website-demo)


# About

[Back to top](#darling-data-management-system)

Welcome to the Darling Data Management System, a tool designed to aide in the
development of well organized PHP applications.

The Darling Data Management System requires [PHP](https://github.com/php/php-src) >= 7.4

The Darling Data Management System requires [Composer](https://github.com/composer/composer).

A [pre-release](https://github.com/sevidmusic/DarlingDataManagementSystem/releases/tag/v0.0.0-alpha)
of the Darling Data Management System is available now.

The Darling Data Management System version 1.0.0 will be released in the next few days.

For an overview of what needs to be done please see the
[open issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues).

A website is being developed for the Darling Data Management System at [darlingdata.tech](http://darlingdata.tech)

More thorough documentation is in development, and will continue to be added to
this README and [http://darlingdata.tech/](http://darlingdata.tech).

# Installation

[Back to top](#darling-data-management-system) | [Setup Development Tools](#setup-development-tools) | [Installation Demo](#installation-demo)

The Darling Data Management System can be installed from GitHub
and setup via [Composer](https://github.com/composer/composer).

1. Move into directory where you want to install the Darling Data Management System:

   _Adjust path as needed_

   Run: `cd "$HOME/Downloads"`

2. Clone the Darling Data Management System from [GitHub](https://github.com/sevidmusic/DarlingDataManagementSystem):

   Run: `git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git`

3. Move into the `DarlingDataManagementSystem` directory:

   Run: `cd DarlingDataManagementSystem`

4. Run composer to set everything up:

   Run: `composer update && composer upgrade`

# Setup development tools

[Back to top](#darling-data-management-system) | [Installation](#installation) | [Installation Demo](#installation-demo)

The Darling Data Management System comes with three command line utilities:

`dsh`     (required): Used frequently for development with the Darling Data Management System.

`dshUI`   (required): Required by dsh, it is the back end of dsh's user interface.

`dshUnit` (optional) : * Optional bash unit testing framework.

dsh and dshUI MUST be in your `$PATH` or they will not work properly.

* dshUnit is not required for development with the Darling Data Management System,
  or by dsh. dshUnit is a bash unit testing framework that is used to develop and
  test dsh. Unless you are planning on modifying dsh's source code then you don't
  need dshUnit. However, dshUnit can be used on it's own as a bash unit testing
  framework. If you write a lot of bash, you may find dshUnit useful.

Make sure to at least ADD dsh AND dshUI TO YOUR `$PATH`!

If you would like to try dshUnit, add it as well.

### Add dsh, dshUI, and optionally dshUnit to your `$PATH`

Note: Demo uses [vim](https://github.com/vim/vim) to edit `.bash_profile`, this
      is not required, vim is awesome, but unrelated to the Darling Data Management
      System. Any text editor will suffice.

5. Add dsh, dshUI, and optionally dshUnit to your `$PATH`.

   Run: `vim "${HOME}/.bash_profile"`

   _Make sure to adjust the paths in the examples below if the Darling Data_
   _Management System is installed in a different location._

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dsh:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUI:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUnit`

   Run: `source "${HOME}/.bash_profile"`

Finally, please note that dsh, dshUI, and dshUnit are not required on
production installation of the Darling Data Management System, in fact, for
security, they should probably not be included in production installation! They
are intended to be used during development with the Darling Data Management System..

### Installation Demo

[Back to top](#darling-data-management-system) | [Installation](#installation) | [Setup Development Tools](#setup-development-tools)

![DDMSInstallationDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif?raw=true)

# Getting Started

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Example](#hello-world-example) | [Hello World Demo](#hello-world-demo) | [Installation](#installation)

One of the ways the Darling Data Management System helps encourage organization
is by providing an architecture that allows the development of large applications
to be broken up into smaller niche applications that can be used together to fulfill
the requirements of one or more larger applications.

This makes reuse and refactoring much easier, and makes it easier to maintain
larger applications.

# Apps And App Packages

[Back to top](#darling-data-management-system) | [Hello World Example](#hello-world-example) | [Hello World Demo](#hello-world-demo)

Development with the Darling Data Management System always begins with the
creation of a new App Package.

App Packages define the basic configuration of an App.

They are intended to provide a snapshot of an App that can be used
to make instances of the App over and over again.

Developing an App as an App Package makes it easier to maintain, share, develop,
refactor, release, and reuse different versions of an App.

Once an App Package is defined, it can be used to make an instance of an App
based on the App Package's configuration.

Once an App has been made from an App Package it can be built to run on a domain.

Multiple Apps can be built to run on a single domain, and individual Apps can
be built to run on many domains.

To demonstrate, the following is one possible example of how the development of
a "Hello World" App might begin:

# Hello World Example

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Demo](#hello-world-demo)

1. Creatae a new App Package for the HelloWorld App

   Run:`dsh -n AppPackage HelloWorld "$HOME"`

2. Make sure the App Package's scripts are executable

   Run:`chmod -R 0755 $HOME/HelloWorld/*.sh`

3. Define a GlobalResponse for the HelloWorld App

   Run:`vim "$HOME/HelloWorld/Responses.sh"`

   Add: `dsh -n GlobalResponse "${app_name}" HelloWorldResponse 0`

4. Define an OutputComponent for the HelloWorld App

   Run: `vim "$HOME/HelloWorld/OutputComponents.sh"`

   Add: `dsh -n OutputComponent "${app_name}" HelloWorld OutputContainer 0 "Hello World"`

   Add: `dsh -a "${app_name}" HelloWorldResponse HelloWorld OutputContainer OutputComponent`

5. Make the HelloWorld App from the HelloWorld App Package

   Run:`dsh -m "$HOME/HelloWorld"`

6. Build the HelloWorld App to run on http://localhost:8080

   Run:`dsh -b HelloWorld "http://localhost:8080"`

7. Start a development server on local host at port 8080
   Development server will be reachable via http://localhost:8080

   Run:`dsh -s 8080`

8. View the new HelloWorld App running on http://localhost:8080 in a web browser.

   Run:`w3m http://localhost:8080`

   Note: [w3m](https://github.com/acg/w3m) is the browser used in this demo, w3m is awesome, but it is not
         required or related to the Darling Data Management System.

# Hello World Demo

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Example](#hello-world-example)

![DDMSHelloWorldDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif?raw=true)

### Single App Website Example

[Back to top](#darling-data-management-system)

1. [Preface](#preface)
2. [Create a new App Package](#create-a-new-app-package)
3. [Make the new App Package's Scripts Executable](#make-the-new-app-packages-scripts-executable)
4. [App Data](#app-data)
5. [Components](#components)
6. [Responses And Global Responses](#responses-and-global-responses)
7. [Define the App's Responses and Global Responses](#define-the-apps-responses-and-global-responses)
8. []()
9. []()
10. []()
11. []()
12. []()
13. []()
14. []()
15. []()
16. []()
17. []()
18. []()
19. []()
20. []()
21. []()
22. [Single App Website Demo](#single-app-website-demo)

# Preface

PHP is most commonly used to develop websites. The Darling Data Management System
was designed with this in mind, and though it could be used for other purposes,
the most likely use case is web development.

The following example will demonstrate how to use a single App to generate an
entire website. This website will be very simple, just two unique pages, some
css styles, some javascript, and appropriate links to navigate the site.

Single App Site Pages:
1. Homepage: Show a welcome message.
2. Pictures: Show a simple image gallery that uses javascript for image selection.

# Create a new App Package

The first step in the development process with the Darling Data Management System
is always to create a new App Package for the App to be developed.

The purpose of an App Package is to provide a snapshot of an App that can be used
to reproduce an instance of the App for a Darling Data Management System installation.

Step 1. Create a new App Package for the App that will generate output for
        the website, this App will be named "SingleAppWebsite":

        Run: `dsh -n AppPackage SingleAppWebsite "$HOME"`

# Make the new App Package's Scripts Executable

App's are made from App Packages via the dsh --make-app command.

In order for the App Package to be able to be made into an App later via dsh --make-app,
the bash scripts in the App package must be executable.

2. Make sure the App Package's scripts are executable:

   Run: `chmod -R 0755 $HOME/SingleAppWebsite/*.sh`

# App Data

The Darling Data Management System's understanding of an App is based on the App's
data. An App's data consists of the App's source code, and the Darling Data Management
System Components that the App defines.

The Darling Data Management System provides a number of Components that can be used
to to implement an App. Components are objects that conform to niche interfaces
that represent the various parts of an application.

Legos are a good analogy for Components, like Legos, individual Components are
used together to implement a larger design. Also, like Legos, Components can be
reused in various contexts to implement a variety of designs.

In this example a single App is going to generate a website.

To do this the App needs to define appropriate Components to represent the various
parts of the website.

# Components

iThe following Component types will be used in this example:


Request                Represents a url such as `http://DOMAIN/`
                       Note: Requests can be used to represent any url, not just
                             urls relative to the domain the App is running on.

Response               Responses are used to group OutputComponents and
                       DynamicOutputComponents together whose output is
                       intended to be shown in response to a specific
                       Request to the domain the App is running on.

GlobalResponse         GlobalResponses are used to group OutputComponents and
                       DynamicOutputComponents together whose output is intended
                       to be shown in response to a all Requests to the domain
                       the App is running on.

OutputComponent        OutputComponents are used to define an App's static output.

DynamicOutputComponent DynamicOutputComponents are used to define an App's dynamic
                       output, this is output generated by interpreting an assigned
                       file that exists in either the Darling Data Management System's
                       SharedDynamicOutput directory, or the App's DynamicOutput directory.
                       This file can be a plain text file, a PHP file, an html file, a json
                       file, etc.
                       Note: Files that have the `.php` file extension will be
                             interpreted as executable PHP code, all other file
                             types will be interpreted as plain text.

It is usually best to define the App's Responses and GlobalResponses first, this
will help to make the App's larger structure clear before other Components are
defined.

Responses are used to group together OutputComponents and DynamicOutputComponents
whose output should be displayed in response to a specific Request to the domain
the App is running on.

GlobalResponses are Responses, but instead of responding to specific Requests,
a GlobalResponse will respond to all Requests.

Responses and GlobalResponses are organized relative to each other by their positions.

If multiple Responses and GlobalResponses are assigned to the same position, they
will be served in the order that they are loaded from storage.

For example, if Responses Foo, Bar, and Baz are all assigned to position 0, and
Foo is loaded first, Bar is loaded second, and  Baz loaded third, then the
positions will be adjusted as follows:

Foo Position: 0
Bar Position: 0.1
Baz Position: 0.2

Responses and GlobalResponses are defined in the App Package's Responses.sh
configuration script.

5. Define the App's OutputComponents and assign them to the appropriate Responses:

   Run: `vim "$HOME/SingleAppWebsite/OutputComponents.sh"`

   Add: `dsh -n OutputComponent "${app_name}" DoctypeOpenHtmlTag StaticHtml 0 '<!DOCTYPE html><html lang="en">'`
   Add: `dsh -a "${app_name}" OpeningHtml DoctypeOpenHtmlTag StaticHtml OutputComponent`

   Add: `dsh -n DynamicOutputComponent "${app_name}" HtmlHead DynamicOutput 0.1 "HtmlHead.php"`
   Add: `dsh -a "${app_name}" OpeningHtml HtmlHead DynamicOutput DynamicOutputComponent`

   Add: `dsh -n OutputComponent "${app_name}" OpenBodyTag StaticHtml 0.2 '<body>'`
   Add: `dsh -a "${app_name}" OpeningHtml OpenBodyTag StaticHtml OutputComponent`

   Add: `dsh -n DynamicOutputComponent "${app_name}" MainMenu DynamicOutput 0.3 "MainMenu.html"`
   Add: `dsh -a "${app_name}" MainMenu MainMenu DynamicOutput DynamicOutputComponent`

   Add: `dsh -n DynamicOutputComponent "${app_name}" Homepage DynamicOutput 0 "Homepage.php"`
   Add: `dsh -a "${app_name}" Homepage Homepage DynamicOutput DynamicOutputComponent`

   Add: `dsh -n DynamicOutputComponent "${app_name}" Pictures DynamicOutput 0 "Pictures.html"`
   Add: `dsh -a "${app_name}" Pictures Pictures DynamicOutput DynamicOutputComponent`

   Add: `dsh -n OutputComponent "${app_name}" FinalHtml StaticHtml 0 '</body></html>'`
   Add: `dsh -a "${app_name}" ClosingHtml FinalHtml StaticHtml OutputComponent`

The next step is to create any dynamic output files referenced by the
DynamicOutputComponents defined by the App Package.

The Darling Data Management System expects dynamic output files to exist
in either the relevant App's DynamicOutput directory, or the Darling Data
Management System's SharedDynamicOutput directory.

For example:
    /path/to/Darling/Data/Management/System/Apps/APP_NAME/DynamicOutput/DYNAMIC_OUTPUT_FILE
    or
    /path/to/Darling/Data/Management/System/SharedDynamicOutput/DYNAMIC_OUTPUT_FILE

Dynamic output files that are used by a single App should be defined in the
relevant App Package's DynamicOutput directory so that dsh can copy them to the
App's DynamicOutput directory whenever an instance of the App is made from the
App Package via dsh --make-app.

Dynamic output files that are used by multiple App's should be placed in the Darling
Data Management System's SharedDynamicOutput directory. These dynamic output files
must be created and maintained manually since they are not related to a specific
App.

If an App defines a dynamic output file that shares a name with a dynamic output
file defined in the SharedDynamicOutput directory, the  App's dynamic output file
will be used.

The App Package in this example defines a DynamicOutputComponent named HtmlHead
which references a dynamic output file named HtmlHead.php, this file must be created
in the App Package's DynamicOutput directory.

6. Create DynamicOutput/HtmlHead.php:
   Run: vim "$HOME/SingleAppWebsite/DynamicOutput/HtmlHead.php"
   Add:
        <?php
        require str_replace('/Apps/SingleAppWebsite/DynamicOutput','',__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
        use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
        use DarlingDataManagementSystem\classes\primary\Storable;
        use DarlingDataManagementSystem\classes\primary\Switchable;
        $currentRequest = new Request(
            new Storable(
                'CurrentRequest',
                'AppRequests',
                'CurrentRequests'
            ),
            new Switchable()
        );
        $getKeys = array_flip($currentRequest->getGet());
        $pagename = array_pop($getKeys);
        ?>
                <head>
                    <title><?php echo (!empty($pagename) ? $pagename : 'Homepage'); ?>  | Single App Website Demo | <?php echo date('m/d/Y h:m A'); ?></title>
                    <meta charset="UTF-8">
                    <meta name="description" content="Darling Data Management System">
                    <meta name="keywords" content="Darling Data Management System, dsh">
                    <meta name="author" content="Sevi Donnelly Foreman">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="./Apps/SingleAppWebsite/css/styles.css" rel="stylesheet">
                </head>

The HtmlHead.php dynamic output file's content contains a <link> tag that references
a css file, styles.css, this css file must be created in the App Package's css directory.

7. Create css/styles.css:
   Run: vim "$HOME/SingleAppWebsite/css/styles.css"
   Add:
        body {  background: #000000; color: #ddf1ff; font-family: monospace; }

        .selectable-image-container { float: left; margin: .5em 1.2em; }

        .selectable-image { opacity: .5; width: 5em; cursor: pointer; border: 2px double #fafaff; }

        .selectable-image:hover {opacity: 1; width: 5.3em; cursor: pointer; border: 2px solid #fafaff; }

        ul li { display: inline; }

        a { color: #09b278; text-decoration: none; }

        a:hover { color: #fafaff; }

        .selected-image { margin-left: 3em; width: 25em; }

        h1 { margin-left: 1.4em; }

        p { margin-left: 3em; }



The App Package in this example defines a DynamicOutputComponent named MainMenu
which references a dynamic output file named MainMenu.html, this file must be created
in the App Package's DynamicOutput directory.

8. Create MainMenu.html:

    Run: vim "$HOME/SingleAppWebsite/DynamicOutput/MainMenu.html"
    Add:
         <div class="main-menu-container">
             <ul class="main-menu">
                 <li class="main-menu-item"><a class="main-menu-link" href="index.php">Homepage</a></li>
                 <li class="main-menu-item"><a class="main-menu-link" href="index.php?Pictures">Pictures</a></li>
             </ul>
         </div>

# Single App Website Demo

![DDMSSingleAppWebsiteDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSSingleAppWebsiteDemo.gif?raw=true)

