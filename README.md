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

Welcome to the Darling Data Management System, a tool designed to aide in the
development of well organized PHP applications.

The Darling Data Management System requires PHP >= 7.4

The Darling Data Managment System requires Composer.

The Darling Data Management System is on track to be released on
January 31, 2021.

For an overview of what needs to be done please see the
[issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues) for this Repo.

A website is being developed for the Darling Data Management System at [darlingdata.tech](http://darlingdata.tech)

# Installation

[Back to top](#darling-data-management-system) | [Installation Example](#installation-example)

To install the Darling Data Management System, open a terminal, navigate to the
directory you want to install the Darling Data Management System in, and then
run the following:

```
git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git &&
cd DarlingDataManagementSystem &&
composer upgrade && composer update
```

The above will do the following:

1. Download the Darling Data Management System from GitHub into the current directory.
2. Move into the Darling Data Management System's directory.
3. Upgrade/update Composer.

### Installation Example

[Back to top](#darling-data-management-system) | [Installation](#installation)

![DDMSInstallationDemo](https://ddmsmedia.us-east-1.linodeobjects.com/DDMSInstallationExample.gif)

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

![DDMSHelloWorldDemo](https://ddmsmedia.us-east-1.linodeobjects.com/DDMSHelloWorldExample.gif)

