# Darling Data Management System

Welcome to the Darling Data Management System, a tool designed to aide in the development of well organized PHP applications.


To install the Darling Data Management System, open terminal, navigate to the directory
you want to install the Darling Data Management System in, and then run the following:

       git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git && cd DarlingDataManagementSystem && composer upgrade && composer update && dsh/dsh -b starterApp && dsh -s 8080

The above will do the following:

1. Download the Darling Data Management System from github into the current directory
2. Move into the Darling Data Management System's directory
3. Upgrade Composer (Composer is required!)
4. Update composer.lock
5. Run dsh --new app TestApp (This will create a new TestApp in the Apps directory,
   run PhpUnit tests, build the new App, start a development server for the App, and,
   if xdg-open is installed on the system, the new App will be opened in the default
   web browser.

Note: The Darling Data Management System is still in development, an official
      development and production release will be ready by the end of December 2020.

Note: The Darling Data Management System requires PHP >= 7.4

Note: The Darling Data Managment System requires Composer.

Note: The Darling Data Management System comes with a command line utility called
      dsh which can be used to manage and aide in development with the Darling
      Data Management System.

More complete documentation is currently in development.

Also, a website, darlingdata.tech, is being developed that will be the official
source for documentation and news related to the Darling Data Management System.
