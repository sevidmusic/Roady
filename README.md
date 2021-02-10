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

[Back To Top](#darling-data-management-system)

Welcome to the Darling Data Management System, a tool designed to aide in the
development of well organized PHP applications.

The Darling Data Management System requires [PHP](https://github.com/php/php-src) >= 7.4

The Darling Data Management System requires [Composer](https://github.com/composer/composer).

A [pre-release](https://github.com/sevidmusic/DarlingDataManagementSystem/releases/tag/v0.0.2-alpha)
of the Darling Data Management System is available now.

The Darling Data Management System version 1.0.0 will be released in the next few days.

For an overview of what needs to be done please see the
[open issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues).

A website is being developed for the Darling Data Management System at [darlingdata.tech](http://darlingdata.tech)

[darlingdata.tech](http://darlingdata.tech) is running on the Darling Data Management System.

More thorough documentation is in development, and will continue to be added to
this README and [http://darlingdata.tech/](http://darlingdata.tech).

# Installation

[Back To Top](#darling-data-management-system)

1. [Installation Demo](#installation-demo)
2. [Install From GitHub And Setup Via Composer](#install-from-github-and-setup-via-composer)
3. [Setup Development Tools](#setup-development-tools)

### Installation Demo

[Back To Top](#darling-data-management-system) | [Installation](#installation) | [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif)

![DDMSInstallationDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif?raw=true)

### Install From GitHub And Setup Via Composer

[Back To Top](#darling-data-management-system) | [Installation](#installation)

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

[Back To Top](#darling-data-management-system) | [Installation](#installation)

Skip explanation and go to: [Add dsh, dshUI, And Optionally dshUnit to your `$PATH`](#add-dsh-dshui-and-optionally-dshunit-to-your-path)

The Darling Data Management System comes with three command line utilities:

[`dsh`](#dsh)     (required): Used frequently for development with the Darling Data Management System.

`dshUI`   (required): Required by dsh, it is the back end of dsh's user interface.

`dshUnit` (optional) : % Optional bash unit testing framework.

dsh and dshUI MUST be in your `$PATH` or they will not work properly.

* % dshUnit is not required for development with the Darling Data Management System,
  or by dsh. dshUnit is a bash unit testing framework that is used to develop and
  test dsh. Unless you are planning on modifying dsh's source code then you don't
  need dshUnit. However, dshUnit can be used on it's own as a bash unit testing
  framework. If you write a lot of bash, you may find dshUnit useful.

  Note: Documentation for dshUnit is in development, the plan is to release dshUnit
        as a standalone tool with it's own GitHub repository.

Make sure to at least [add dsh, and dshUI to your `$PATH`](#add-dsh-dshui-and-optionally-dshunit-to-your-path).

If you would like to try dshUnit, add it as well.

### Add dsh, dshUI, And Optionally dshUnit To Your `$PATH`

[Back To Top](#darling-data-management-system) | [Installation](#installation) | [Setup Development Tools](#setup-development-tools)

Note: The following example uses [vim](https://github.com/vim/vim) to edit `.bash_profile`,
      this is not required, vim is awesome, but unrelated to the Darling Data Management
      System. Any text editor will suffice.

5. Add dsh, dshUI, and optionally dshUnit to your `$PATH`.

   Go to example [`.bash_profile`](#example-bash_profile)

   Run: `vim "$HOME/.bash_profile"`

   _Make sure to adjust the paths in the examples below if the Darling Data_
   _Management System is installed in a different location._

   Add to `$PATH`: `$HOME/Downloads/DarlingDataManagementSystem/dsh:`

   Add to `$PATH`: `$HOME/Downloads/DarlingDataManagementSystem/dshUI:`

   Add to `$PATH`: `$HOME/Downloads/DarlingDataManagementSystem/dshUnit`

   Run: `source "$HOME/.bash_profile"`

### Example `.bash_profile`

[Back to Add dsh, dshUI to `$PATH`](#add-dsh-dshui-and-optionally-dshunit-to-your-path)

Your `.bash_profile` should now resemble:

```
#
# ~/.bash_profile
#

PATH="${PATH}:$HOME/Downloads/DarlingDataManagementSystem/dsh:$HOME/Downloads/DarlingDataManagementSystem/dshUI:$HOME/Downloads/DarlingDataManagementSystem/dshUnit"

PS1="\e[44m\e[36m\w\e[0m\e[32m\n\$\e[34m "

[[ -f ~/.bashrc ]] && . ~/.bashrc
```

Finally, please note that dsh, dshUI, and dshUnit are not required on production
installation of the Darling Data Management System, in fact, for security, they
should probably not be included in a production installation! They are intended to
be used during development with the Darling Data Management System.

# Getting Started

[Back To Top](#darling-data-management-system)

1. [Apps and App Packages](#apps-and-app-packages)
2. [Hello World Demo](#hello-world-demo)
3. [Hello World Guide](#hello-world-guide)
4. [Single App Website Demo](#single-app-website-demo)
5. [Single App Website Guide](#single-app-website-guide)

### Apps And App Packages

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started)

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

New App Packages can be created via [`dsh --new AppPackage [APP_NAME] [PATH_TO_APP_PACKAGE] [DOMAIN]`](#dsh---new-apppackage).

The Darling Data Management System's understanding of an App is based on the App's
data. An App's data consists of the App's source code, and the Darling Data Management
System [Components](https://github.com/sevidmusic/DarlingDataManagementSystem/tree/DarlingDataManagementSystem-0.0.1/core/interfaces/component) that the App defines.

The Darling Data Management System provides a number of [Components](https://github.com/sevidmusic/DarlingDataManagementSystem/tree/DarlingDataManagementSystem-0.0.1/core/interfaces/component) that can be used
to to implement an App. Components are objects that conform to niche interfaces
that represent the various parts of an application.

Legos are a good analogy for Components, like Legos, individual Components are
used together to implement a larger design. Also, like Legos, Components can be
reused in various contexts to implement a variety of designs.

An App's Components are defined in the relevant App Packages configuration scripts.
These configuration scripts are just bash scripts that make appropriate calls to
dsh that will be executed whenever [`dsh --make-app`](#dsh---make-app--dsh--m) is run.

An App Package will always have at least four configuration scripts:

1. `Responses.sh`:
   This file is where an App's Responses and GlobalResponse are defined.

2. `Requests.sh`:
   This file is where an App's Requests are defined and assigned to
   appropriate Responses.

3. `OutputComponents.sh`:
   This file is where an App's OutputComponents and DynamicOutputComponents are
   defined and assigned to the appropriate Responses and GlobalResponses.

4. `config.sh`:
   This file is where an App Package's configuration variables are defined.
   All `config.sh` configuration scripts must have at least the following variables
   defined:

```
app_name         The name of the App

bug_contact      A reference to where bugs can be submitted, this should be an email,
                 or a url to a online resource where bugs can be submitted.

config_locked     The use of this variable has not been implemented yet, but in the
                 future it will be used to prevent dsh from modyfing an App Package's
                 `config.sh`.

dependencies     Associative array of dependencies, whose indexes are App names,
                 and values are version numbers.

description      A plain text description of the App the App Package represents.

developers       Array of the names of the developers of the App.

development_port The default port to use when running the App on http://localhost:PORT

documentation    A url to an online resource where documentation for the App can
                 be found, or the string self-documented if the App provides
                 documentation.

domain           The default domain to build the App for when dsh --build-app is
                 called.

license          The type of licesne the App uses, for example: MIT

version          The App's version number, for example: 1.0.3

version_date     The date this version of the App was released.

```

The following is an example of a `config.sh` configuration script:

```
#!/bin/bash
# HelloWorld | config.sh

set -o posix

# This file was generated by dsh.
# This file defines the HelloWorld App Package's configuration variables.

######################## Configuration Settings ########################

app_name="HelloWorld"

bug_contact="sdmwebsdm@gmail.com"

config_locked="0"

declare -A dependencies
dependencies=(["HelloWorldUI"]="0.2.4")

description="The HelloWorld App was developed for the Darling Data Management System."

developers=("Sevi Donnelly Foreman")

development_port="8080"

documentation="self-documented"

domain="http://localhost:8080"

license="MIT"

version="0.9.17"

version_date="Tue Feb  9 12:12:53 AM EST 2021"
```

Additional variables may also be defined in `config.sh`, though they will not be
used by dsh. A practical example of defining additional variables could be to
define variables for the names of Responses that are going to have many Requests,
OutputComponents, and DynamicOutputComponents assigned to them.

For example:

```
#!/bin/bash
# HelloWorld | config.sh

set -o posix

# This file was generated by dsh.
# This file defines the HelloWorld App Package's configuration variables.

######################## Configuration Settings ########################

app_name="HelloWorld"

bug_contact="sdmwebsdm@gmail.com"

config_locked="0"

declare -A dependencies
dependencies=(["HelloWorldUI"]="0.2.4")

description="The HelloWorld App was developed for the Darling Data Management System."

developers=("Sevi Donnelly Foreman")

development_port="8080"

documentation="self-documented"

domain="http://localhost:8080"

license="MIT"

version="0.9.17"

version_date="Tue Feb  9 12:12:53 AM EST 2021"

# Custom Variables

homepage_response_name="Homepage"

pictures_response_name="Pictures"
```

Any variables defined in `config.sh` can be referenced within `Responses.sh`, `Requests.sh`,
or `OutputComponents.sh`.

For example, the Custom Variables in the example `config.sh` above could be
referenced in an App Package's Responses.sh as follows:

```
#!/bin/bash
# Responses.sh

# ...

dsh -n GlobalResponse "${app_name}" "${homepage_response_name}" 0

dsh -n GlobalResponse "${app_name}" "${pictures_response_name}" 0

```

Also note the use of the `"${app_name}"` variable, it is good practice to use the
`"${app_name}"` variable to reference the name of the App the App Package represents
in the App Package's configuration scripts, this will help avoid typos that could
cause [`dsh --make-app`](#dsh---make-app--dsh--m) to fail. In general use variables defined in `config.sh`
whenever it is appropriate to reduce the risk of introducing bugs into an App
Package.

Always make sure that an App Package's configuration scripts are executable or
`dsh --make-app` will fail when it is called to make the App.

It is good practice to set the App Package's script's permissions immediately
after creating a new App Package.

For example:

Run: `dsh -n AppPackage HelloWorld $HOME`

Then run: `chmod -R 0755 $HOME/HelloWorld/*.sh`

### Hello World Demo

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif) | [Hello World Guide](#hello-world-guide)

![DDMSHelloWorldDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif?raw=true)

### Hello World Guide

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo)

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

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The Darling Data Management System's development process always starts with the
creation of an App Package.

New App Packages are created via [`dsh --new AppPackage [APP_NAME] [PATH_TO_APP_PACKAGE] [DOMAIN]`](#dsh---new-apppackage)


1. Create a new App Package for the HelloWorld App

   Run: `dsh -n AppPackage HelloWorld "$HOME"`

If the HelloWorld App package was created successfully the output of `ls "$HOME/HelloWorld"`
should be:

```
config.sh
css
DynamicOutput
js
OutputComponents.sh
Requests.sh
Responses.sh
```

### Make The HelloWorld App Package's Scripts Executable

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

App's are made from App Packages via [`dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`](#dsh---make-app--dsh--m).

In order for the App Package to be able to be made into an App later via `dsh --make-app`,
the bash scripts in the App package must be executable.

2. Make sure the App Package's scripts are executable

   Run: `chmod -R 0755 $HOME/HelloWorld/*.sh`

# Define A GlobalResponse For The HelloWorld App

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

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

GlobalResponses can be created for an App via [`dsh --new GlobalResponse [APP_NAME] [GLOBAL_RESPONSE_NAME] [GLOBAL_RESPONSE_POSITION]`](#dsh---new-globalresponse)

Responses and GlobalResponses are defined in the App Package's `Responses.sh` script.

3. Define a GlobalResponse for the HelloWorld App.

   Run: `vim "$HOME/HelloWorld/Responses.sh"`

   Add: `dsh -n GlobalResponse "${app_name}" HelloWorldResponse 0`

### Define An OutputComponent For The HelloWorld App

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The output of an App is defined using OutputComponents and DynamicOutputComponents.

OutputComponents are used to define an App's static output.

DynamicOutputComponents are used to define an App's dynamic output, this is output
generated by interpreting an assigned file that exists in either the Darling Data
Management System's `SharedDynamicOutput` directory, or the App's `DynamicOutput`
directory.

This file can be a plain text file, a PHP file, an html file, a json file, etc.

Note: Files that have the .php file extension will be interpreted as executable
PHP code, all other file types will be interpreted as plain text.

In this example one OutputComponent will be defined whose output will be "Hello World".

OutputComponents are defined via [`dsh --new OutputComponent [APP_NAME] [OUTPUT_COMPONENT_NAME] [OUTPUT_COMPONENT_CONTAINER] [OUTPUT_COMPONENT_POSITION] [OUTPUT]`](#dsh---new-outputcomponent)

4. Define an OutputComponent for the HelloWorld App

   Note: OutputComponents and DynamicOutputComponents defined in `OutputComponents.sh`
         should always use the `"${app_name}"` variable to indicate the `[APP_NAME]`.
         This only applies to calls made to dsh from within an App Package's
         `OutputComponents.sh`, always specify the App's actual alphanumeric name
         when calling dsh from the command line.

   Run: `vim "$HOME/HelloWorld/OutputComponents.sh"`

   Add: `dsh -n OutputComponent "${app_name}" HelloWorld OutputContainer 0 "Hello World"`

   Add: `dsh -a "${app_name}" HelloWorldResponse HelloWorld OutputContainer OutputComponent`

### Make The HelloWorld App from The HelloWorld App Package

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

An instance of an App can be made from an App Package via [`dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`](#dsh---make-app--dsh--m).

First, [`dsh --make-app`](#dsh---make-app--dsh--m) will create a new instance of the App, via an internal call
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

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

Once an App has been made via dsh --make-app, it can be built for one or more
domains via [`dsh --build-app [APP_NAME] [DOMAIN]`](#dsh---build-app--dsh--b).

6. Build the HelloWorld App to run on `http://localhost:8080`

     Run: `dsh -b HelloWorld "http://localhost:8080"`

### Start A Development Server On localhost On Port 8080

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

App's can be built to run on one, or many domains.

While an App is in development it can be useful to be able to run an App on one
or more local domains.

PHP is a wonderful language, and provides a built in web server that can be used
as a simple local development server. More information about PHP's built in server
can be found at:

[https://www.php.net/manual/en/features.commandline.webserver.php](https://www.php.net/manual/en/features.commandline.webserver.php)

`dsh --start-development-server [PORT]` can be used to start a development server
via PHP on a specific port on localhost:

Once started, the server can be reached from a web browser via [http://localhost:8080](http://localhost:8080)

7. Start a development server on local host at port `8080`.

   Development server will be reachable via [http://localhost:8080](http://localhost:8080)

   Run: `dsh -s 8080`

### View The New HelloWorld App Running On `http://localhost:8080` In A Web Browser

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

8. To view the HelloWorld App, open a web browser and go to [http://localhost:8080](http://localhost:8080)

### Hello World Guide Overview

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Hello World Demo](#hello-world-demo) | [Hello World Guide](#hello-world-guide)

The following is an overview of the steps taken in this demo:

- The App Package for the HelloWorld App was created via `dsh --new AppPackage`.

- The appropriate HelloWorld App Package files were configured manually using
  a text editor.

- The HelloWorld App was made from the HelloWorld App Package via `dsh --make-app`.

- The HelloWorld App was built via `dsh --build-app`.

- A development server was started at `http://localhost:8080` via `dsh --start-development-server`.

The new HelloWorld App is now running on [http://localhost:8080](http://localhost:8080) and can be accessed
from a web browser.

# Single App Website Demo

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) |  [View Full Size Demo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSSingleAppWebsiteDemo.gif) | [Single App Website Guide](#single-app-website-guide)

![DDMSSingleAppWebsiteDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSSingleAppWebsiteDemo.gif?raw=true)

# Single App Website Guide

[Back To Top](#darling-data-management-system) | [Getting Started](#getting-started) | [Single App Website Demo](#single-app-website-demo)

PHP is most commonly used to develop websites. The Darling Data Management System was designed with this in mind, and though it could be used for other purposes, the most likely use case is web development.

The following example will demonstrate how to use a single App to generate an entire website. This website will be very simple, just two unique pages, some css styles, some javascript, and appropriate links to navigate the site.

Single App Site Pages:

    Homepage: Show a welcome message.
    Pictures: Show a simple image gallery that uses javascript for image selection.

Note: Written documentation for the Single App Website demo is still in development...
The [Single App Website Demo](#single-app-website-demo) can be followed on it's
own in the meantime.

### dsh

[Back To Top](#darling-data-management-system) | [Back to Setup Development Tools](#setup-development-tools)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh) | [Back to dsh --new AppPackage](#dsh---new-apppackage) | [Back to HelloWorld Guide](#build-the-helloworld-app-to-run-on-httplocalhost8080)

`dsh --build-app [APP_NAME] [DOMAIN]`

Description:

Build an App for a specified `[DOMAIN]` by running the App's
`Components.php` file via php.

Note: A Components.php file MUST be defined for the App at:

`DarlingDataManagementSystem/Apps/[APP_NAME]/Components.php`

If [`dsh --make-app`](#dsh---make-app--dsh--m) was used to create the App
from an App Package then Components.php will have been created by dsh.

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

`dsh --locate-ddms-directory`

Description:

Returns the path to the Darling Data Management System installation that dsh is acting on.

Shorthand:

`dsh -l`

Example:

`dsh -l`

### dsh --new AppPackage

[Back To Top](#darling-data-management-system) | [dsh](#dsh) | [Back to Apps And App Packages](#apps-and-app-packages) | [Back to HelloWorld Guide](#create-an-app-package-for-the-helloworld-app)


`dsh --new AppPackage [APP_NAME] [PATH_TO_NEW_APP_PACKAGE] [DOMAIN]`

Description:

Creates a new App Package to begin the development of a new Darling Data Management
System App named `[APP_NAME]`.

Shorthand:

`dsh -n AppPackagpe [APP_NAME] [PATH_TO_NEW_APP_PACKAGE] [DOMAIN]`

Arguments:

`[APP_NAME]` : The name of the App this App Package represents.

`[PATH_TO_NEW_APP_PACKAGE]` : The path to the directory where the new App Package
                              will be created.

Note: Do not include the App Package's name in the `[PATH_TO_NEW_APP_PACKAGE]`.

For example, to create the new App Package at `$HOME/AppPackageName`:

Correct:

`dsh -n AppPackage AppPackageName "$HOME" "http://default.domain/"`

Incorrect:

`dsh -n AppPackage AppPackageName "$HOME/AppPackageName" "http://default.domain/"`

`[DOMAIN]` : The domain to assign as the App's default domain.

Note: Specifying the `[DOMAIN]` does not tie the App to the specified domain, an
      App can always be built for a different domain than it's default by specifying
      an alternative domain when [`dsh --build-app`](#dsh---build-app--dsh--b) is called.

Example:

`dsh -n AppPackage AppName "$HOME" "http://localhost:8924"`


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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh) | [Back to Hello World Guide](#define-a-globalresponse-for-the-helloworld-app)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh) | [Back to Hello World Guide](#define-an-outputcomponent-for-the-helloworld-app)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

`dsh --query-app-package-config [PATH_TO_APP_PACKAGE] [SETTING_NAME]`

Description:

Returns the value of the configuration setting named `[SETTING_NAME]` defined in
the App Package at `[PATH_TO_APP_PACKAGE]`.

Shorthand:

`dsh -q PATH_TO_APP_PACKAGE] [SETTING_NAME]`

Example:

`dsh -q /path/to/app/package domain`

### dsh --start-development-server

[Back To Top](#darling-data-management-system) | [dsh](#dsh)

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

### dsh --make-app | dsh -m

[Back To Top]() | [Back to Hello World Guide Make Executable](#make-the-helloworld-app-packages-scripts-executable) | [Back to Hello World Guide Make App](#make-the-helloworld-app-from-the-helloworld-app-package)


Warning: This flag is still being developed. It is working as intended with
the exception of the `[REPLACE_EXISTING_APP]` argument. Apps can be made via
`dsh --make-app`, but it is not yet possible to force dsh to replace an existing
App that shares the same name as the App to be made via `dsh --make-app AppPackage replace`
This is being addressed as part of the completion of [issue #95](https://github.com/sevidmusic/DarlingDataManagementSystem/issues/95).


`dsh --make-app [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`

Description:

Makes an instance of an App for the Darling Data Management System from an App
Package. If an App with the same name already exists, then the App will not be
made unless the string `replace` is passed to the `[REPLACE_EXISTING_APP]` argument.

Shorthand:

`dsh -m [PATH_TO_APP_PACKAGE] [REPLACE_EXISTING_APP]`

Arguments:

`[PATH_TO_APP_PACKAGE]` The path to the App Package that will be used to make the App.

`[REPLACE_EXISTING_APP]` By default, [`dsh --make-app`](#dsh---make-app--dsh--m) will not replace an existing
                         App that shares the same name as the App to be made. To
                         force dsh to replace an existing App, pass the string
                         `replace` to the `[REPLACE_EXISTING_APP]` argument.

Note: `[REPLACE_EXISTING_APP]` has not been properly implemented yet, this is being
      addressed as part of the completion of [issue #95](https://github.com/sevidmusic/DarlingDataManagementSystem/issues/95)

Examples:

`dsh -m "$HOME/Downloads/AppPackages/HelloWorld"

`dsh -m "$HOME/Downloads/AppPackages/HelloWorld" 'replace'

