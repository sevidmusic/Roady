# Darling Data Management System

New documentation is being added to [https://darlingdata.tech](https://darlingdata.tech) regularly.

Version 1.0 will be out soon.

For now:

# Hello World

1. Run `git clone https://github.com/sevidmusic/DarlingDataManagementSystem.git && cd ./DarlingDataManagementSystem && composer update`.
2. Add `/full/path/to/DarlingDataManagementSystem/vendor/darling/ddms/bin` to your `$PATH`. (Adjust path accordingly)
3. Run `ddms --configure-app-output --name HelloWorld --output '<h1>Hello World</h1>' --for-app HelloWorld --relative-urls '/'`.
4. Run `php ./Apps/HelloWorld/Components.php`.
5. Run `ddms --start-server`.
6. Open `http://localhost:8080` in a web browser.

![Hello World Demo](https://github.com/sevidmusic/ddmsDemos/blob/main/gifs/HelloWorld_ForReadme.gif)


