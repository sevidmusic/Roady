# Darling Data Management System

[About](#about)

[Installation](#installation)

1. [Installation Demo](#installation-demo)
2. [Install From GitHub And Setup Via Composer](#install-from-github-and-setup-via-composer)
3. [Setup Development Tools](#setup-development-tools)

[Getting Started](#getting-started)
1. [Apps and App Packages](#apps-and-app-packages)
2. [Hello World Demo](#hello-world-demo)
3. [Hello World Guide](#hello-world-guide)
4. [Single App Website Demo](#single-app-website-demo)
5. [Single App Website Guide](#single-app-website-guide)
6. [dsh](#dsh)


# About

[Back to top](#darling-data-management-system)

Welcome to the Darling Data Management System, a tool designed to aide in the
development of well organized PHP applications.

The Darling Data Management System requires [PHP](https://github.com/php/php-src) >= 7.4

The Darling Data Management System requires [Composer](https://github.com/composer/composer).

A [pre-release](https://github.com/sevidmusic/DarlingDataManagementSystem/releases/tag/v0.0.1-alpha)
of the Darling Data Management System is available now.

The Darling Data Management System version 1.0.0 will be released in the next few days.

For an overview of what needs to be done please see the
[open issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues).

A website is being developed for the Darling Data Management System at [darlingdata.tech](http://darlingdata.tech)

[darlingdata.tech](http://darlingdata.tech) is running on the Darling Data Management System.

More thorough documentation is in development, and will continue to be added to
this README and [http://darlingdata.tech/](http://darlingdata.tech).

# Installation

[Back to top](#darling-data-management-system)

1. [Installation Demo](#installation-demo)
2. [Install From GitHub And Setup Via Composer](#install-from-github-and-setup-via-composer)
3. [Setup Development Tools](#setup-development-tools)

### Installation Demo

[Back to top](#darling-data-management-system) | [Installation](#installation) | [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif)

![DDMSInstallationDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif?raw=true)

### Install From GitHub And Setup Via Composer

[Back to top](#darling-data-management-system) | [Installation](#installation)

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

### Setup Development Tools

[Back to top](#darling-data-management-system) | [Installation](#installation)

Skip explanation and go to: [Add dsh, dshUI, And Optionally dshUnit to your `$PATH`](#add-dsh-dshui-and-optionally-dshunit-to-your-path)

The Darling Data Management System comes with three command line utilities:

`dsh`     (required): Used frequently for development with the Darling Data Management System.

`dshUI`   (required): Required by dsh, it is the back end of dsh's user interface.

`dshUnit` (optional) : % Optional bash unit testing framework.

dsh and dshUI MUST be in your `$PATH` or they will not work properly.

* % dshUnit is not required for development with the Darling Data Management System,
  or by dsh. dshUnit is a bash unit testing framework that is used to develop and
  test dsh. Unless you are planning on modifying dsh's source code then you don't
  need dshUnit. However, dshUnit can be used on it's own as a bash unit testing
  framework. If you write a lot of bash, you may find dshUnit useful.

Make sure to at least add dsh AND dshUI to your `$PATH`!

If you would like to try dshUnit, add it as well.

### Add dsh, dshUI, And Optionally dshUnit To Your `$PATH`

[Back to top](#darling-data-management-system) | [Installation](#installation) | [Setup Development Tools](#setup-development-tools)

Note: The following example uses [vim](https://github.com/vim/vim) to edit `.bash_profile`,
      this is not required, vim is awesome, but unrelated to the Darling Data Management
      System. Any text editor will suffice.

5. Add dsh, dshUI, and optionally dshUnit to your `$PATH`.

   Run: `vim "${HOME}/.bash_profile"`

   _Make sure to adjust the paths in the examples below if the Darling Data_
   _Management System is installed in a different location._

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dsh:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUI:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUnit`

   Run: `source "${HOME}/.bash_profile"`

Finally, please note that dsh, dshUI, and dshUnit are not required on production
installation of the Darling Data Management System, in fact, for security, they
should probably not be included in a production installation! They are intended to
be used during development with the Darling Data Management System.

# Getting Started

[Back to top](#darling-data-management-system)

1. [Apps and App Packages](#apps-and-app-packages)
2. [Hello World Demo](#hello-world-demo)
3. [Hello World Guide](#hello-world-guide)
4. [Single App Website Demo](#single-app-website-demo)
5. [Single App Website Guide](#single-app-website-guide)

### Apps And App Packages

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started)

One of the ways the Darling Data Management System helps encourage organization
is by providing an architecture that allows the development of large applications
to be broken up into smaller niche applications that can be used together to fulfill
the requirements of one or more larger applications.

This makes reuse and refactoring much easier, and makes it easier to maintain
larger applications.

Development with the Darling Data Management System always begins with the
creation of a new App Package.

App Packages define the basic configuration of an App.

The purpose of an App Package is to provide a snapshot of an App that can be used
to reproduce an instance of the App for a Darling Data Management System installation.

Developing an App as an App Package makes it easier to maintain, share, develop,
refactor, release, and reuse different versions of an App.

Once an App Package is defined, it can be used to make an instance of an App
based on the App Package's configuration.

Once an App has been made from an App Package it can be built to run on a domain.

Multiple Apps can be built to run on a single domain, and individual Apps can
be built to run on many domains.

Consequently, multiple Apps can be built to run on many domains all on a single
installation of the Darling Data Management System.

In the context of web development, this means multiple websites can run on a single
installation of the Darling Data Management System.

An App Package has the following structure:

```
AppPackageName/
    DynamicOutput/
    css/
    js/
    config.sh
    Responses.sh
    Requests.sh
    OutputComponents.sh
```

New App Packages can be created via `dsh --new AppPackage [APP_NAME] [PATH_TO_APP_PACKAGE] [DOMAIN]`.

The `[APP_NAME]` parameter is required, it will be used as the name of the App Package
and the App.

The `[PATH_TO_APP_PACKAGE]` parameter is also required, it is used to specify the
path to the directory where the new App Package's directory will be created.

The `[DOMAIN]` parameter is optional, it can be used to specify a default domain
to build and run the App on.

Note: Specifying the `[DOMAIN]` does not tie the App to the specified domain, an
      App can be built for one, or many domains.

### Hello World Demo

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif) | [Hello World Guide](#hello-world-guide)

![DDMSHelloWorldDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif?raw=true)

# Hello World Guide

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo)

The following Hello World guide demonstrates one possible implementation of a
Hello World App. The Hello World guide will also demonstrate the use of dsh,
Components, Apps, and App Packages.

1. [Create An App Package For The HelloWorld App](#create-an-app-package-for-the-helloworld-app)
2. [Make The HelloWorld App Package's Scripts Executable](#make-the-helloworld-app-packages-scripts-executable)
3. [Define A GlobalResponse For The HelloWorld App](#define-a-globalresponse-for-the-helloworld-app)
4. [Define An OutputComponent For The HelloWorld App](#define-an-outputcomponent-for-the-helloworld-app)
5. [Make The HelloWorld App from The HelloWorld App Package](#make-the-helloworld-app-from-the-helloworld-app-package)
6. [Build The HelloWorld App To Run On `http://localhost:8080`](#build-the-helloworld-app-to-run-on-httplocalhost8080)
7. [Start A Development Server On localhost On Port 8080](#start-a-development-server-on-localhost-on-port-8080)
8. [View The New HelloWorld App Running On `http://localhost:8080` In A Web Browser](#view-the-new-helloworld-app-running-on-httplocalhost8080-in-a-web-browser)
9. [Hello World Guide Overview](#hello-world-guide-overview)

### Create An App Package For The HelloWorld App

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The Darling Data Management System's development process always starts with the
creation of an App Package.

New App Packages are created via [`dsh --new AppPackage [APP_NAME] [PATH_TO_APP_PACKAGE] [DOMAIN]`](#dsh---new-apppackage)


Step 1. Create a new App Package for the HelloWorld App

        Run: `dsh -n AppPackage HelloWorld "$HOME"`

### Make The HelloWorld App Package's Scripts Executable

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

App's are made from App Packages via `dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`.

In order for the App Package to be able to be made into an App later via `dsh --make-app`,
the bash scripts in the App package must be executable.

2. Make sure the App Package's scripts are executable

   Run: `chmod -R 0755 $HOME/HelloWorld/*.sh`

# Define A GlobalResponse For The HelloWorld App

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

When a user makes a Request to the domain of a website running on the Darling
Data Management System the first thing that happens is the Darling Data Management
System attempts to determine which Responses and GlobalResponses respond to the
current Request so the appropriate output can be served to the user.

Responses are used to group OutputComponents and DynamicOutputComponents together
whose output is intended to be shown in response to a specific Request to the
domain the App is running on, as opposed to GlobalResponses which are used to group
OutputComponents and DynamicOutputComponents together whose output is intended to
be shown in response to a all Requests to the domain the App is running on.

Once the Darling Data Management System determines which Responses and GlobalResponses
respond to the current Request, the collective output of the OutputComponents and
DynamicOutputComponents assigned to each of the Responses and GlobalResponses that
respond to the current Request is shown to the user.

It is usually best to define the App's Responses and GlobalResponses first, this
will help to make the App's larger structure clear before other Components are
defined.

In this example, only one GlobalResponse will be defined.

GlobalResponses are defined via `dsh --new GlobalResponse [APP_NAME] [GLOBAL_RESPONSE_NAME] [GLOBAL_RESPONSE_POSITION]`

More information about `dsh --new GlobalResponse` can be obtained via `dsh -h -n GlobalResponse`.

3. Define a GlobalResponse for the HelloWorld App

   Run: `vim "$HOME/HelloWorld/Responses.sh"`

   Add: `dsh -n GlobalResponse "${app_name}" HelloWorldResponse 0`

### Define An OutputComponent For The HelloWorld App

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The output of an App is defined using OutputComponents and DynamicOutputComponents.

OutputComponents are used to define an App's static output.

DynamicOutputComponents are used to define an App's dynamic output, this is output
generated by interpreting an assigned file that exists in either the Darling Data
Management System's `SharedDynamicOutput directory`, or the App's `DynamicOutput`
directory.

This file can be a plain text file, a PHP file, an html file, a json file, etc.

Note: Files that have the .php file extension will be interpreted as executable
PHP code, all other file types will be interpreted as plain text.

4. Define an OutputComponent for the HelloWorld App
   Run: `vim "$HOME/HelloWorld/OutputComponents.sh"`

   Add: `dsh -n OutputComponent "${app_name}" HelloWorld OutputContainer 0 "Hello World"`

   Add: `dsh -a "${app_name}" HelloWorldResponse HelloWorld OutputContainer OutputComponent`

### Make The HelloWorld App from The HelloWorld App Package

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

An instance of an App can be made from an App Package via `dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`.

First, `dsh --make-app` will create a new instance of the App, via an internal call
to the `dsh --new App` command.

Then, it will copy the App Package's `css`, `js`, and `DynamicOutput` directories to
the new App.

Finally, it will run the App Package's `Responses.sh`, `Requests.sh`, and `OutputComponents.sh`
configuration scripts to create the PHP configuration files for the App's Components via
the dsh calls defined in the App Package's `Responses.sh`, `Requests.sh`, and `OutputComponents.sh`
configuration scripts.

5. Make the HelloWorld App from the HelloWorld App Package

   Run: `dsh -m "$HOME/HelloWorld"`

### Build The HelloWorld App To Run On `http://localhost:8080`

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

Once an App has been made via dsh --make-app, it can be built for one or more
domains via `dsh --build-app [APP_NAME] [DOMAIN]`.

By default `dsh --build-app` will build an App for the domain defined in the App's
`Components.php` file. This domain will have been set by `dsh --make-app` to the value
assigned to the domain variable defined in the relevant App Packages `config.sh`
configuration script.

It is safe to modify the domain defined in the App's `Components.php` file after
the App has been made, however, `dsh --build-app` takes an optional domain as the
second parameter, so there is really no need to modify the domain set in App's
`Components.php` file, instead just use `dsh --build-app [APP_NAME] [DOMAIN]` to
easily build the App for one or more domains.

6. Build the HelloWorld App to run on `http://localhost:8080`

     Run: `dsh -b HelloWorld "http://localhost:8080"`

### Start A Development Server On localhost On Port 8080

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

App's can be built to run on one, or many domains.

While an App is in development it can be useful to be able to run an App on one
or more local domains.

PHP is a wonderful language, and provides a built in web server that can be used
as a simple local development server. More information about PHP's built in server
can be found at:

    [https://www.php.net/manual/en/features.commandline.webserver.php](https://www.php.net/manual/en/features.commandline.webserver.php)

`dsh --start-development-server [PORT]` can be used to start a development server
via PHP on a specific port on localhost:

Once started, the server can be reached from a web browser via `http://localhost:PORT`

7. Start a development server on local host at port `8080`.
   Development server will be reachable via `http://localhost:8080`

   Run: `dsh -s 8080`

### View The New HelloWorld App Running On `http://localhost:8080` In A Web Browser

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

8. To view the HelloWorld App, open a web browser and go to `http://localhost:8080`

### Hello World Guide Overview

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The following is an overview of the steps taken in this demo:

- The App Package for the HelloWorld App was created via `dsh --new AppPackage`.

- The appropriate HelloWorld App Package files were configured manually using
  a text editor.

- The HelloWorld App was made from the HelloWorld App Package via `dsh --make-app`.

- The HelloWorld App was built via `dsh --build-app`.

- A development server was started at `http://localhost:8080` via `dsh --start-development-server`.

The new HelloWorld App is now running on `http://localhost:8080` and can be accessed
from a web browser.

# Single App Website Demo

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) |  [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSSingleAppWebsiteDemo.gif) | [Single App Website Guide](#single-app-website-guide)

![DDMSSingleAppWebsiteDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSSingleAppWebsiteDemo.gif?raw=true)

# Single App Website Guide

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo)

The following guide demonstrates one possible implementation of an entire
website using a single App. This guide will also demonstrate the use of dsh,
Components, Apps, and App Packages.

1. [Preface](#preface)
2. [Create A New App Package](#create-a-new-app-package)
3. [Make The New App Package's Scripts Executable](#make-the-new-app-packages-scripts-executable)
4. [App Data](#app-data)
5. [Components](#components)
6. [Responses And Global Responses](#responses-and-global-responses)
7. [Define The App's Responses and Global Responses](#define-the-apps-responses-and-global-responses)
8. [Dynamic Output Files](#dynamic-output-files)
9. [Create The HtmlHead.php Dynamic Output File](#create-the-htmlheadphp-dynamic-output-file)
10. [Create The Css File Referenced By HtmlHead.php](#create-the-css-file-referenced-by-htmlheadphp)
11. [Create The MainMenu.html Dynamic Output File](#create-the-mainmenuhtml-dynamic-output-file)

### Preface

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

PHP is most commonly used to develop websites. The Darling Data Management System
was designed with this in mind, and though it could be used for other purposes,
the most likely use case is web development.

The following example will demonstrate how to use a single App to generate an
entire website. This website will be very simple, just two unique pages, some
css styles, some javascript, and appropriate links to navigate the site.

Single App Site Pages:
1. Homepage: Show a welcome message.
2. Pictures: Show a simple image gallery that uses javascript for image selection.

### Create A New App Package

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The first step in the development process with the Darling Data Management System
is always to create a new App Package for the App to be developed.

The purpose of an App Package is to provide a snapshot of an App that can be used
to reproduce an instance of the App for a Darling Data Management System installation.

App Packages can be created via `dsh --new AppPackage [APP_NAME] [PATH_TO_APP_PACKAGE] [DOMAIN]`.

Note: Do not specify a name for the new App Package in the `[PATH_TO_APP_PACKAGE]`
parameter, only specify the path to the directory where the new App Package should
be created. The name of the App Package's directory will be `[APP_NAME]`.

Note: A default domain to run the App on can optionally be specified via the third
`[DOMAIN]` parameter. If the `[DOMAIN]` parameter is not specified the default
domain will be `http://localhost:8080`.

Step 1. Create a new App Package for the App that will generate output for
        the website, this App will be named "SingleAppWebsite":

        Run: `dsh -n AppPackage SingleAppWebsite "$HOME"`

### Make The New App Package's Scripts Executable

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

App's are [made](#making-an-app-from-an-app-package) from App Packages via `dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`.

In order for the App Package to be able to be made into an App later via dsh --make-app,
the bash scripts in the App package must be executable.

Note: Issue [#111](https://github.com/sevidmusic/DarlingDataManagementSystem/issues/111) will make this step unnecessary in future versions of dsh.

2. Make sure the App Package's scripts are executable:

   Run: `chmod -R 0755 $HOME/SingleAppWebsite/*.sh`

### App Data

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

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

### Components

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The following Component types will be used in this example:


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
                       `SharedDynamicOutput` directory, or the App's `DynamicOutput` directory.
                       This file can be a plain text file, a PHP file, an html file, a json
                       file, etc.
                       Note: Files that have the `.php` file extension will be
                             interpreted as executable PHP code, all other file
                             types will be interpreted as plain text.

### Responses And Global Responses

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

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

### Define The App's Responses And Global Responses

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

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

### Dynamic Output Files

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The next step is to create any dynamic output files referenced by the
DynamicOutputComponents defined by the App Package.

The Darling Data Management System expects dynamic output files to exist
in either the relevant App's DynamicOutput directory, or the Darling Data
Management System's SharedDynamicOutput directory.

For example:

`/path/to/Darling/Data/Management/System/Apps/APP_NAME/DynamicOutput/DYNAMIC_OUTPUT_FILE`

Or

`/path/to/Darling/Data/Management/System/SharedDynamicOutput/DYNAMIC_OUTPUT_FILE`

Dynamic output files that are used by a single App should be defined in the
relevant App Package's `DynamicOutput` directory so that dsh can copy them to the
App's `DynamicOutput` directory whenever an instance of the App is made from the
App Package via `dsh --make-app`.

Dynamic output files that are used by multiple App's should be placed in the Darling
Data Management System's `SharedDynamicOutput` directory. These dynamic output files
must be created and maintained manually since they are not related to a specific
App.

If an App defines a dynamic output file that shares a name with a dynamic output
file defined in the `SharedDynamicOutput` directory, the  App's dynamic output file
will be used.

### Create The HtmlHead.php Dynamic Output File

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The App Package in this example defines a DynamicOutputComponent named HtmlHead
which references a dynamic output file named HtmlHead.php, this file must be created
in the App Package's `DynamicOutput` directory.

6. Create DynamicOutput/HtmlHead.php:

   Run: `vim "$HOME/SingleAppWebsite/DynamicOutput/HtmlHead.php"`

   Add:

```
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
```

### Create The Css File Referenced By HtmlHead.php

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The HtmlHead.php dynamic output file's content contains a `<link>` tag that references
a css file, styles.css, this css file must be created in the App Package's css directory.

7. Create css/styles.css:

   Run: `vim "$HOME/SingleAppWebsite/css/styles.css"`

   Add:

```
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
```
### Create The MainMenu.html Dynamic Output File

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The App Package in this example defines a DynamicOutputComponent named MainMenu
which references a dynamic output file named MainMenu.html, this file must be created
in the App Package's DynamicOutput directory.

8. Create MainMenu.html:

    Run: `vim "$HOME/SingleAppWebsite/DynamicOutput/MainMenu.html"`

    Add:

```
<div class="main-menu-container">
    <ul class="main-menu">
        <li class="main-menu-item"><a class="main-menu-link" href="index.php">Homepage</a></li>
        <li class="main-menu-item"><a class="main-menu-link" href="index.php?Pictures">Pictures</a></li>
    </ul>
</div>
```

### Create The Homepage.php Dynamic Output File

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The App Package in this example defines a DynamicOutputComponent named Homepage
which references a dynamic output file named Homepage.html, this file must be created
in the App Package's DynamicOutput directory.

9. Create Homepage.php:

   Run: `vim "$HOME/SingleAppWebsite/DynamicOutput/Homepage.php"`

   Add:
```
<h1>Welcome</h1>
<p>Today is:</p>
<p><?php echo date('l jS \of F Y h:i:s A'); ?></p>
```

### Create The Pictures.html Dynamic Output File

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

10. Create Pictures.html:

    Run: `vim "$HOME/SingleAppWebsite/DynamicOutput/Pictures.html"`

    Add:
```
<div class="selected-image-container">
   <img class="selected-image" src="" id="selectedImage">
</div>

<div class="image-selector">
    <div class="selectable-image-container">
        <img class="selectable-image" src="https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg1.png" alt="Image1" onclick="selectImage(this);">
    </div>
    <div class="selectable-image-container">
        <img class="selectable-image" src="https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg2.png" alt="Image2" onclick="selectImage(this);">
    </div>
    <div class="selectable-image-container">
        <img class="selectable-image" src="https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg3.png" alt="Image3" onclick="selectImage(this);">
    </div>
    <div class="selectable-image-container">
        <img class="selectable-image" src="https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg4.png" alt="Image4" onclick="selectImage(this);">
    </div>
</div>
<script>
    function selectImage(imageToSelect) {
        var selectedImage = document.getElementById("selectedImage");
        selectedImage.src = imageToSelect.src;
        selectedImage.alt = imageToSelect.alt;
    }
</script>
```

### Make the SingleAppWebsite App

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

An instance of an App can be made from an App Package via `dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`.

First, `dsh --make-app` will create a new instance of the App, via an internal call
to the `dsh --new App` command.

Then, it will copy the App Package's `css`, `js`, and `DynamicOutput` directories to
the new App.

Finally, it will run the App Package's `Responses.sh`, `Requests.sh`, and `OutputComponents.sh`
configuration scripts to create the PHP configuration files for the App's Components via
the dsh calls defined in the App Package's `Responses.sh`, `Requests.sh`, and `OutputComponents.sh`
configuration scripts.

11. Make the SingleAppWebsite App from the SingleAppWebsite App Package

    Run: `dsh -m "$HOME/SingleAppWebsite"`

### Build The App

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

Once an App has been made via `dsh --make-app`, it can be built for one or more
domains via the `dsh --build-app [APP_NAME] [DOMAIN]`.

By default `dsh --build-app` will build an App for the domain defined in the App's
`Components.php` file. This domain will have been set by `dsh --make-app` to the value
assigned to the domain variable defined in the relevant App Packages `config.sh`
configuration script.

It is safe to modify the domain defined in the App's `Components.php` file after
the App has been made, however, `dsh --build-app` takes an optional domain as the
second parameter, so there is really no need to modify the domain set in App's
`Components.php` file, instead just use `dsh --build-app [APP_NAME] [DOMAIN]` to
easily build the App for one or more domains.

12. Build the SingleAppWebsite App to run on `http://localhost:8080`

    Run: `dsh -b SingleAppWebsite "http://localhost:8080"`

### Start A Development Server

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

App's can be built to run on one, or many domains.

While an App is in development it can be useful to be able to run an App on one
or more local domains.

PHP is a wonderful language, and provides a built in web server that can be used
as a simple local development server. More information about PHP's built in server
can be found at:

    [https://www.php.net/manual/en/features.commandline.webserver.php](https://www.php.net/manual/en/features.commandline.webserver.php)

`dsh --start-development-server [PORT]` can be used to start a development server
via PHP's built in web server on a specific port on localhost:

Once started, the server can be reached from a web browser via `http://localhost:PORT`

7. Start a development server on localhost at port 8080

    Run: `dsh -s 8080`

The development server will be reachable via `http://localhost:8080`

### Overview Of SingleAppWebsite Guide

[Back to top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo) | [Single App Website Guide](#single-app-website-guide)

The following is an overview of the steps taken in this demo:

- The App Package for the SingleAppWebsite App was created via `dsh --new AppPackage`.

- The appropriate SingleAppWebsite App Package files were configured manually using
  a text editor.

- The SingleAppWebsite App was made from the SingleAppWebsite App Package via `dsh --make-app`.

- The SingleAppWebsite App was built via `dsh --build-app`.

- A development server was started at `http://localhost:8080` via `dsh --start-development-server`.

The new SingleAppWebsite App is now running on `http://localhost:8080` and can be accessed
from a web browser.

### dsh

[Back to top](#darling-data-management-system)

dsh is a command line utility designed to aide in the development process with the
Darling Data Management System. The following is an overview of dsh:

1. [dsh --assign-to-response](#dsh---assign-to-response--dsh--a)
2. [dsh --build-app](#dsh---build-app--dsh--b)
3. [dsh --help FLAG](#dsh---help-flag)
4. [dsh --help --help](#dsh---help---help)
5. [dsh --locate-ddms-directory](#dsh---locate-ddms-directory)
6. [dsh --new AppPackage](#dsh---new-apppackage)
7. [dsh --new App](#dsh---new-app)
8. [dsh --new DynamicOutputComponent](#dsh---new-dynamicoutputcomponent)
9. [dsh --new GlobalResponse](#dsh---new-globalresponse)
10. [dsh --new OutputComponent](#dsh---new-outputcomponent)
11. [dsh --new Request](#dsh---new-request)
12. [dsh --new Response](#dsh---new-response)
13. [dsh --new](#dsh---new)
14. [dsh --query-app-package](#dsh---query-app-package)
15. [dsh --start-development-server](#dsh---start-development-server)


### dsh --assign-to-response | dsh -a

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --assign-to-response [APP_NAME] [RESPONSE_NAME] [COMPONENT_NAME] [COMPONENT_CONTAINER] [COMPONENT_TYPE]`

Description:

Assign the Component named `[COMPONENT_NAME]` whose type is `[COMPONENT_TYPE]` to the
Response or GlobalResponse named `[RESPONSE_NAME]`

Shorthand:

`dsh -a [APP_NAME] [RESPONSE_NAME] [COMPONENT_NAME] [COMPONENT_CONTAINER] [COMPONENT_TYPE]`

Arguments:

`[APP_NAME]`              The name of the App the Response or GlobalResponse and
                        Component are defined for.

                        Note: The Response or GlobalResponse and Component MUST
                              be defined for the same App.

`[RESPONSE_NAME]`         The name of the Response or GlobalResponse the Component
                        will be assigned to.

`[COMPONENT_NAME]`        The name of the Component to assign to the Response or
                        GlobalResponse.

`[COMPONENT_CONTAINER]`   The Component's container.

`[COMPONENT_TYPE]`        The Component's type, will be one of the following:
                        - OutputComponent
                        - DynamicOutputComponent
                        - Request

Examples:

`dsh -a AppName ResponseName ComponentName ComponentContainer Request`

`dsh -a AppName ResponseName ComponentName ComponentContainer OutputComponent`

`dsh -a AppName ResponseName ComponentName ComponentContainer DynamicOutputComponent`

### dsh --build-app | dsh -b

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --build-app [APP_NAME] [DOMAIN]`

Description:

Build an App for a specified `[DOMAIN]` by running the App's
`Components.php` file via php.

Note: A Components.php file MUST be defined for the App at:
      `Apps/[APP_NAME]/Components.php`

Shorthand:

`dsh -b [APP_NAME] [DOMAIN]`

Arguments:

`[APP_NAME]` The name of the App to build.

`[DOMAIN]`   The domain to build the App for.
           If `[DOMAIN]` is not specified then the domain defined
           in the App's `Components.php` file will be used.
Example:

`dsh -b AppName http://localhost:8080/`

WARNING: dsh will not prevent you from building an App multiple times for
         the same `[DOMAIN]`, whether or not this is problematic depends
         on the App being built.

### dsh --help [FLAG]

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --help [FLAG]`

Show detailed help information about the specified flag.

Shorthand:

`dsh -h [FLAG]`

The following options are possible:

```
dsh --help --help
dsh -h -h

dsh --help --new
dsh -h -n

dsh --help --new App
dsh -h -n App

dsh --help --new AppPackage
dsh -h -n AppPackage

dsh --help --new OutputComponent
dsh -h -n OutputComponent

dsh --help --new DynamicOutputComponent
dsh -h -n DynamicOutputComponent

dsh --help --new Request
dsh -h -n Request

dsh --help --new Response
dsh -h -n Response

dsh --help --new GlobalResponse
dsh -h -n GlobalResponse

dsh --help --build-app
dsh -h -b

dsh --help --start-development-server
dsh -h -s

dsh --help --assign-to-response
dsh -h -a

dsh --help --dsh-unit
dsh -h -d

dsh --help --php-unit
dsh -h -p
```

# dsh --help --help

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --help --help`

The following is a brief summary of how to use the --help flag:

To get general information about dsh, use:

    `dsh --help`

To get brief information about all flags use:

    `dsh --help flags`

To get information about a specified flag use:

    `dsh --help [FLAG]`

    Example:

        `dsh --help --new`

To get information about a mode of a modal flag use:

    `dsh --help [FLAG] [MODE]`

    Example:

        `dsh --help --new AppPackage`

### dsh --locate-ddms-directory

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --locate-ddms-directory`

Description:

Returns the path to the Darling Data Management System installation that dsh is acting on.

Shorthand:

`dsh -l`

Example:

`dsh -l`

### dsh --new AppPackage

[Back to top](#darling-data-management-system) | [dsh](#dsh)

Referenced by:
1. [Create An App Package For The HelloWorld App](#create-an-app-package-for-the-helloworld-app)

`dsh --new AppPackage [APP_NAME] [PATH_TO_NEW_APP_PACKAGE] [DOMAIN]`

Description:

Creates a new App Package to begin the development of a new Darling Data Management
System App named `[APP_NAME]`.

Shorthand:

`dsh -n AppPackagpe [APP_NAME] [PATH_TO_NEW_APP_PACKAGE] [DOMAIN]`

Arguments:

`[APP_NAME]` : The name of the App this App Package represents.

`[PATH_TO_NEW_APP_PACKAGE]` : The path to where the new App Package will be created.
                            Do not include the App Package's name in the `[PATH_TO_NEW_APP_PACKAGE]`.
                            For example, to create the new App Package at `$HOME/AppPackageName`:
                            Correct:
                                `dsh -n AppPackage AppPackageName "${HOME}" "http://default.domain/"`
                            Incorrect:
                                `dsh -n AppPackage AppPackageName "${HOME}/AppPackageName" "http://default.domain/"`

`[DOMAIN]` : The domain to assign as the App's default domain.

Example:

`dsh -n AppPackage AppName "${HOME}" "http://localhost:8924"`


# dsh --new App

`dsh --new App [APP_NAME] [DOMAIN]`

Description:

Create a new App at `Apps/[APP_NAME]`

The domain assigned to the new App will be `[DOMAIN]` if specified, or
`http://localhost:8080` by default.

The following will be created for the new App:

1. A directory for the App at `Apps/[APP_NAME]`
2. A Components.php configuration file for the App at `Apps/[APP_NAME]/Components.php`
3. A directory for all of the App's OutputComponent and DynamicOutputComponent
configuration files at `Apps/[APP_NAME]/OutputComponents/`
4. A directory for all of the App's Request configuration files at `Apps/[APP_NAME]/Requests/`
5. A directory for all of the App's Response and GlobalResponse configuration
files at `Apps/[APP_NAME]/Responses/`
6. A directory for the App's unique Dynamic Output files at `Apps/DynamicOutput/`
7. A directory for the App's css at `Apps/[APP_NAME]/css/`
8. A directory for the App's js files `Apps/[APP_NAME]/js`

Shorthand:

`dsh -n App [APP_NAME] [DOMAIN]`

Arguments:

`[APP_NAME]` The name to assign the new App.

`[DOMAIN]`   The domain to assign the new App.

Example:

`dsh -n App AppName http://some.domain`

### dsh --new DynamicOutputComponent

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new DynamicOutputComponent [APP_NAME] [DYNAMIC_OUTPUT_COMPONENT_NAME] [DYNAMIC_OUTPUT_COMPONENT_CONTAINER] [DYNAMIC_OUTPUT_COMPONENT_POSITION] [DYNAMIC_OUTPUT_FILE_NAME]`

Description:

Creates a new DynamicOutputComponent configuration file at:

`Apps/[APP_NAME]/OutputComponents/[DYNAMIC_OUTPUT_COMPONENT_NAME]`

Shorthand:

`dsh -n DynamicOutputComponent [APP_NAME] [DYNAMIC_OUTPUT_COMPONENT_NAME] [DYNAMIC_OUTPUT_COMPONENT_CONTAINER] [DYNAMIC_OUTPUT_COMPONENT_POSITION] [DYNAMIC_OUTPUT_FILE_NAME]`

Arguments:

`[APP_NAME]`                           The name of the App the DynamicOutputComponent will be defined for.

`[DYNAMIC_OUTPUT_COMPONENT_NAME]`      An alphanumeric name to assign to the DynamicOutputComponent.

`[DYNAMIC_OUTPUT_COMPONENT_CONTAINER]` The container to assign to the DynamicOutputComponent.
                                     MUST be alphanumeric.

`[DYNAMIC_OUTPUT_COMPONENT_POSITION]`  The position to assign to the DynamicOutputComponent.
                                     MUST be an number, whole or decimal.

`[DYNAMIC_OUTPUT_FILE_NAME]`           The name of the Dynamic Output file to assign to the
                                     DynamicOutputComponent. This file MUST exist in either:

`DarlingDataManagementSystem/SharedDynamicOutput/[DYNAMIC_OUTPUT_FILE_NAME]`
or
`DarlingDataManagementSystem/Apps/[APP_NAME]/DynamicOutput/[DYNAMIC_OUTPUT_FILE_NAME]`

Example:

`dsh -n DynamicOutputComponent AppName DOCName DOCContainer 0 "DOCFile.html"`

The example above would expect a Dynamic Output file named `DOCFile.html` exists
in either:

    `DarlingDataManagementSystem/SharedDynamicOutput/DOCFile.html`
or
    `DarlingDataManagementSystem/Apps/[APP_NAME]/DOCFile.html`

### dsh --new GlobalResponse

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new GlobalResponse [APP_NAME] [GLOBAL_RESPONSE_NAME] [GLOBAL_RESPONSE_POSITION]`

Description:

Create a new GlobalResponse configuration at `Apps/[APP_NAME]/Responses/[GLOBAL_RESPONSE_NAME].php`

Shorthand:

`dsh -n GlobalResponse [APP_NAME] [GLOBAL_RESPONSE_NAME] [GLOBAL_RESPONSE_POSITION]`

Arguments:

`[APP_NAME]`                 The name of the App the new GlobalResponse will be defined for.

`[GLOBAL_RESPONSE_NAME]`     An alphanumeric name to assign to the new GlobalResponse

`[GLOBAL_RESPONSE_POSITION]` A numeric position to assign to the new GlobalResponse.

Example:

`dsh -n GlobalResponse AppName ResponseName 4.2`


### dsh --new OutputComponent

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new OutputComponent [APP_NAME] [OUTPUT_COMPONENT_NAME] [OUTPUT_COMPONENT_CONTAINER] [OUTPUT_COMPONENT_POSITION] [OUTPUT]`

Description:

Creates a new OutputComponent configuration file at:

`Apps/[APP_NAME]/OutputComponents/[OUTPUT_COMPONENT_NAME].php`

Shorthand:

`dsh -n OutputComponent [APP_NAME] [OUTPUT_COMPONENT_NAME] [OUTPUT_COMPONENT_CONTAINER] [OUTPUT_COMPONENT_POSITION] [OUTPUT]`

Arguments:

`[APP_NAME]`                   The name of the App the OutputComponent will be defined for.

`[OUTPUT_COMPONENT_NAME]`      An alphanumeric name to assign to the OutputComponent.

`[OUTPUT_COMPONENT_CONTAINER]` The container to assign to the OutputComponent.
                             MUST be alphanumeric.

`[OUTPUT_COMPONENT_POSITION]`  The position to assign to the OutputComponent.
                             MUST be a number, whole or decimal.

`[OUTPUT]`                     The output to assign to the OutputComponent

Example:

`dsh -n OutputComponent AppName OCName OCContainer 2.4 "<p>Hello world</p>"`

### dsh --new Request

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new Request [APP_NAME] [REQUEST_NAME] [REQUEST_CONTAINER] [RELATIVE_URL]`

Description:

Creates a new Request configuration file at `Apps/[APP_NAME]/Requests/[REQUEST_NAME].php`

Shorthand:

`dsh -n Request [APP_NAME] [REQUEST_NAME] [REQUEST_CONTAINER] [RELATIVE_URL]`

Arguments:

`[APP_NAME]`          The name of the app the Request will be defined for.

`[REQUEST_NAME]`      An alphanumeric name to assign to the Request.

`[REQUEST_CONTAINER]` The container to assign to the Request.

`[RELATIVE_URL]`      The relative url to assign to the Request.

This is a string that represents the part of the url
following the domain the App was built for.

For example, if an App named Foo is built for the domain
`http://localhost:8080` then a `[RELATIVE_URL]` of `index.php`
would assign `http://localhost:8080/index.php` as the
Request's url.

You MUST only specify the relative url, do not include
the domain!

This will insure that the Request's actual url will be
correct regardless of what domain the App is built for.

Example:

`dsh -n Request AppName RequestName RequestContainer index.php?foo=bare`

### dsh --new Response

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new Response [APP_NAME] [RESPONSE_NAME] [RESPONSE_POSITION]`

Description:

Create a new Response configuration at `Apps/[APP_NAME]/Responses/[RESPONSE_NAME].php`

Shorthand:

`dsh -n Responses [APP_NAME] [RESPONSE_NAME] [RESPONSE_POSITION]`

Arguments:

`[APP_NAME]`          The name of the App the Responses will be defined for.

`[RESPONSE_NAME]`     An alphanumeric name to assign to the Response.

`[RESPONSE_POSITION]` The position to assign to the Response.
                    MUST be a number, whole or decimal.

Example:

`dsh -n Response AppName ResponseName 0.3`


### dsh --new

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --new | -n [MODE] [ARGUMENTS...]`

The new flag is used to create.

The new flag is modal, meaning the specified `[MODE]` determines what is created.

Different modes expect different `[ARGUMENTS...]`, and different modes may
expect different numbers of `[ARGUMENTS...]`.

The following modes are available:

```
dsh --new App
dsh --new AppPackage
dsh --new OutputComponent
dsh --new DynamicOutputComponent
dsh --new Request
dsh --new Response
dsh --new GlobalResponse
```

For more information on the specific modes use:

`dsh --help --new [MODE]`

For example, to get more information about the "App" mode:

`dsh --help --new App`

### dsh --query-app-package

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --query-app-package-config [PATH_TO_APP_PACKAGE] [SETTING_NAME]`

Description:

Returns the value of the configuration setting named `[SETTING_NAME]` defined in
the App Package at `[PATH_TO_APP_PACKAGE]`.

Shorthand:

`dsh -q PATH_TO_APP_PACKAGE] [SETTING_NAME]`

Example:

`dsh -q /path/to/app/package domain`

### dsh --start-development-server

[Back to top](#darling-data-management-system) | [dsh](#dsh)

`dsh --start-development-server [PORT]`

Description:

Start a development server at `http://localhost:[PORT]`.

If `[PORT]` is not specified start a development server at `http://localhost:8080`.

Shorthand:

`dsh -s [PORT]`

Arguments:

`[PORT]` A port number, defaults to 8080

Example:

`dsh -s 8420`


