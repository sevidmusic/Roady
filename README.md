# Darling Data Management System

Welcome to the Darling Data Management System, a tool designed to aide in the development of well organized PHP applications.


To install the Darling Data Management System, open terminal, navigate to the directory
you want to install the Darling Data Management System in, and then run the following:

```
git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git && cd DarlingDataManagementSystem && composer upgrade && composer update && dsh/dsh -b starterApp && dsh/dsh -s 8080
```

The above will do the following:

1. Download the Darling Data Management System from github into the current directory
2. Move into the Darling Data Management System's directory
3. Upgrade/update Composer
4. Build the starterApp via `dsh -b starterApp`
5. Start a development server at http://localhost:8080

Note: The Darling Data Management System is still in development, an official
      development and production release is expected to be ready by the end of
      January 2021. The Darling Data Management System is currently in a releasable
      state, everything is working, all tests are passing, but I am a bit of a perfectionist
      and there are a few issues I want to solve, and a few features I still want to implement.
      For a roadmap of what needs to be finished before the official release just go to the
      [issues](https://github.com/sevidmusic/DarlingDataManagementSystem/issues) for this Repo.

Note: The Darling Data Management System requires PHP >= 7.4

Note: The Darling Data Managment System requires Composer.

Note: The Darling Data Management System comes with a command line utility called
      `dsh` which can be used aide in development with the Darling Data
      Management System. Once you have downloaded the Darling Data Management System
      you can run `dsh/dsh -h` to get started with `dsh`. If you decide to develop
      with the Darling Data Management System make sure to add `dsh` to your `$PATH`
      as you will use it frequently to develop, build, install, upgrade, configure,
      and remove Darling Data Management System Apps.

More complete documentation is currently being developed.

