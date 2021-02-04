# Darling Data Management System

[About](#about)
[Installation](#installation)
1. [Installation Example](#installation-example)

[Getting Started](#getting-started)
1. [Apps and App Packages](#apps-and-app-packages)
2. [Hello World Guide](#hello-world-guide)
3. [Hello World Example](#hello-world-example)

# About

[Back to top](#darling-data-management-system)

Welcome to the **Darling Data Management System**, a tool designed to aide in the
development of well organized **PHP** applications.

The **Darling Data Management System** requires [PHP](https://github.com/php/php-src) >= 7.4

The **Darling Data Management System** requires [Composer](https://github.com/composer/composer).

A [pre-release](https://github.com/sevidmusic/DarlingDataManagementSystem/releases/tag/v0.0.0-alpha) of the **Darling Data Management System** is available now.

The **Darling Data Management System** version 1.0.0 will be released in the next few days.

For an overview of what needs to be done please see the
[open issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues).

A website is being developed for the Darling Data Management System at [darlingdata.tech](http://darlingdata.tech)

# Installation

[Back to top](#darling-data-management-system) | [Installation Example](#installation-example)

The **Darling Data Management System** can be installed from GitHub
and setup via [Composer](https://github.com/composer/composer).

1. Move into directory where you want to install the **Darling Data Management System**:

   Run: `cd "$HOME/Downloads"`

2. Clone the **Darling Data Management System** from [GitHub](https://github.com/sevidmusic/DarlingDataManagementSystem):

   Run: `git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git`

3. Move into the `DarlingDataManagementSystem` directory:

   Run: `cd DarlingDataManagementSystem`

4. Run composer to set everything up:

   Run: `composer update && composer upgrade`

### Add dsh, dshUI, and optionally dshUnit to your `$PATH`

The **Darling Data Management System** comes with three command line utilities:

`dsh`     (required): Used frequently for development with the **Darling Data Management System**.
`dshUI`   (required): Required by **dsh**, it is the back end of **dsh**'s user interface.
`dshUnit` (optional) : *

**dsh** and **dshUI** **MUST** be in your `$PATH` or they will not work properly.

* **dshUnit** is not required for development with the **Darling Data Management System**,
  or by **dsh**. **dshUnit** is a bash unit testing framework that is used to develop and
  test **dsh**. Unless you are planning on modifying **dsh**'s source code then you don't
  need **dshUnit**. However, **dshUnit** can be used on it's own as a bash unit testing
  framework. If you write a lot of bash, you may find **dshUnit** useful.

Make sure to at least ADD **dsh** AND **dshUI** TO YOUR `$PATH`! If you would like to try
**dshUnit**, add it as well.

Note: Examples use [vim](https://github.com/vim/vim) to edit files, this is not required, vim is awesome, but
      unrelated to the **Darling Data Management System**. Any text editor will suffice.

5. Add **dsh**, **dshUI**, and optionally **dshUnit** to your `$PATH`.

   Run: `vim "${HOME}/.bash_profile"`

   _Make sure to adjust the paths in the examples below if the Darling Data_

   _Management System is installed in a different location._

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dsh:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUI:`

   Add: `${HOME}/Downloads/DarlingDataManagementSystem/dshUnit`

   Run: `source "${HOME}/.bash_profile"`

Finally, please note that **dsh**, **dshUI**, and **dshUnit** are not required on
production installation of the **Darling Data Management System**, in fact, for
security, they should probably not be included in production installation! They
are intended to be used during development with the Darling Data Management System..

### Installation Example

[Back to top](#darling-data-management-system) | [Installation](#installation)

![DDMSInstallationDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSInstallationDemo.gif?raw=true)

# Getting Started

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Guide](#hello-world-guide) | [Hello World Example](#hello-world-example) | [Installation](#installation)

One of the ways the Darling Data Management System helps encourage organization
is by providing an architecture that allows the development of large applications
to be broken up into smaller niche applications that can be used together to fulfill
the requirements of one or more larger applications.

This makes reuse and refactoring much easier, and makes it easier to maintain
larger applications.

# Apps And App Packages

[Back to top](#darling-data-management-system) | [Hello World Guide](#hello-world-guide) | [Hello World Example](#hello-world-example)

Development with the Darling Data Management System always begins with the
creation of a new **App Package**.

App Packages define the basic configuration of an **App**.

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

# Hello World Guide

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Example](#hello-world-example)

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

   Note: "w3m" is the browser used in this demo, w3m is awesome, but it is not
         required or related to the Darling Data Management System.

# Hello World Example

[Back to top](#darling-data-management-system) | [Apps and App Packages](#apps-and-app-packages) | [Hello World Guide](#hello-world-guide)

![DDMSHelloWorldDemo](https://github.com/sevidmusic/DDMSDocsAndDemos/blob/main/DDMSDemoGifs/DDMSHelloWorldAppDemo.gif?raw=true)

