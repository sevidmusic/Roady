# roady


roady is a tool designed to aid in the development of websites.


With roady, the features of a website are implemented by
small niche applications called Apps.


roady Apps may provide css stylesheets, utilize javascript, and
may configure output to be served in response to appropriate 
requests to a website's domain.


Multiple websites can run on a single installation of roady, 
each making use of one or more roady Apps.


For a guide on getting started with roady visit:

https://roady.tech/index.php?request=getting-started


# Quick Installation, Setup, & Hello World Video Tutorial


https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm


# Quick Installation, Setup, & Hello World Example


The following is a quick demonstration of how to install
and setup roady, and how to create a Hello World App.


Note: roady requires `php` >= `8.0`


Note: The shell used in the examples is `bash`


Note: The following examples only demonstrate the necessary
commands to run at the command line, they do not provide 
detailed information about the commands being executed.

For a more detailed guide on getting started with roady visit:

https://roady.tech/index.php?request=getting-started

Or, use `rig --help getting-started` to view the getting started
documentation locally from the command line.


Note: The Getting Started documentation is also available below,
after the Quick Installation Setup & Hello World example.


Note: roady must be installed, and `rig` must be in your `$PATH` 
in order to use `rig`.


### 1. Install roady:
```
cd ~/

git clone https://github.com/sevidmusic/roady.git
```

### 2. Setup via composer:
```
cd ~/roady

composer update
```

### 3. Add  the rig command line utility to your `$PATH`:
```
export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"
```

### 4. Use rig to create a roady App named `HelloWorld`:
```
rig --configure-app-output \
--for-app HelloWorld \
--name HelloWorld \
--output 'Hello World' \
--relative-urls '/'
```

### 5. Build the `HelloWorld` App for the local domain: `http://localhost:8080`:
```
php ~/roady/Apps/HelloWorld/Components.php \
'http://localhost:8080'
```

### 6. Start a development server for the local domain `http://localhost:8080`:
```
rig --start-server --open-in-browser
```


The output of the `HelloWorld` App should now be available at the
following local urls: 

http://localhost:8080


http://localhost:8080/?request=HelloWorld


http://localhost:8080/index.php?request=HelloWorld


# A note from the developer:


I want to emphasize that I developed roady as a tool for myself, 
and I share it humbly as an example of my work and learning.


I love coding, I love to learn about coding, and I love to build
things for the experience, and for the knowledge gained from 
that experience.


roady is not a fully-featured framework, nor is it intended 
to be.


roady is my own personal experiment, and will continue to evolve
based on my own needs.


If you need a framework designed to accommodate a large number 
of use cases, that is developed, used, and supported by a 
large community of incredible developers, then please use 
Laravel, Symphony, or any of the other wonderful open source 
PHP projects that have a solid reputation and years of work 
behind them.


However, if you like to tinker and try new things solely out of
curiosity, then I hope you'll give roady a try.


Note: If you have any questions or feedback roady is on twitter
and reddit:

https://twitter.com/RoadyRig


https://www.reddit.com/r/roady/



roady is hosted on github at:

https://github.com/sevidmusic/roady


# Getting Started


The following examples demonstrate how to install and setup roady, 
and how to build a HelloWorld App.


Note: roady requires `php >= 8`


Note: The `Linux command line` is used heavily in the examples, 
and the `shell` used in the examples is `bash`.


Note: In the following examples roady is installed in the user's 
`home` directory. Make sure to adjust the paths used in the 
following examples if you install roady at a different path.


### Getting Started Video Tutorial
https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm


# Installation & Setup


### 1. Move into the directory where you want to install roady:

```cd ~/```


Note: `cd` is used to change the working directory of the
current shell execution environment.
More information about the `cd` command can be found online at:

https://man7.org/linux/man-pages/man1/cd.1p.html


Note: `~/` is shorthand for the path to the current user's `home`
directory.


### 2. Clone roady from https://github.com/sevidmusic/roady.git:

```git clone https://github.com/sevidmusic/roady.git```


Note: git is a version control system, for more information
about git visit:

https://git-scm.com


Note: GitHub is an online development platform where source code 
can be hosted and distributed. More information about GitHub 
can be found online at:

https://github.com/ 


### 3. Move into roady's root directory:

```cd ~/roady```


### 4. Update `composer`:

```composer update```


Note: composer is a dependency manager for PHP, for more 
information about composer visit:

https://getcomposer.org/


Note: Running `composer update` will install rig at the following 
path: 

`~/roady/vendor/darling/rig`

rig is a command line utility designed to aid in the 
development of roady Apps.


Note: Running `composer update` will install the roadyAppPackages
library at the following path:

`~/roady/vendor/darling/roady-app-packages`

The roadyAppPackages library is a collection of roady App Packages
that can be made into roady Apps via:

`rig --make-app-package`.

Once roady is installed and setup, more information about
`rig --make-app-package` can be obtained via:

`rig --help --make-app-package`

Once roady is installed and setup, more information about
App Packages can be obtained via:

`rig --help AppPackages`


### 5. Add rig to your `$PATH`:

```export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"```


Note: This will only add rig to your `$PATH` temporarily, to add 
it permanently you will need to set your `$PATH` in the 
appropriate configuration file for the shell you are using. For 
information on setting your `$PATH` permanently, please consult 
the documentation for the shell you are using.


### 6. Make sure rig is working:

```rig --help | less -R```


Note: The documentation can always be obtained locally via
the command line by using:

`rig --help`


Note: Additional documentation can be obtained by passing a 
topic to `rig --help`. The following is a list of the possible 
help topics available via `rig --help`:

```
rig --help AppPackages
rig --help Apps
rig --help DynamicOutputComponents
rig --help GlobalResponses
rig --help OutputComponents
rig --help Requests
rig --help Responses
rig --help getting-started
rig --help roady
rig --help --assign-to-response
rig --help --configure-app-output
rig --help --debug
rig --help --make-app-package
rig --help --new-app
rig --help --new-app-package
rig --help --new-dynamic-output-component
rig --help --new-global-response
rig --help --new-output-component
rig --help --new-request
rig --help --new-response
rig --help --start-server
rig --help --view-active-servers
rig --help path-to-apps-directory
```

Note: `less` is not associated with roady or rig. The `less` 
command is used in the example to make it easier to view the 
output of `rig --help`. More information about the `less` command 
can be found online at: 
https://man7.org/linux/man-pages/man1/less.1.html


# Installation & Setup Is Finished


roady should now be installed at the path `~/roady`, and rig
should now be in your `$PATH`.


The next step is to start developing roady Apps.


# A Brief Introduction To roady Apps


roady Apps are responsible for implementing the features of a
website. An App may provide css stylesheets, utilize javascript,
or configure output to be served in response to appropriate
requests to any domains the App is built for.


roady App's are just directories that contain the source code
and resources required to implement the features provided by 
an App.


### roady App Directory Overview


The following is an overview of the directory structure of a
roady App.


```
Components.php      css         DynamicOutput    js                
OutputComponents    Requests    resources        Responses
```

### Components.php: 

This file is used to build an App for a domain.


Note: Building an App for a domain makes the features provided by
the App available to the domain the App is built for.

Note: More information about the Components.php file can be
obtained locally at the command line via:

`rig --help Components.php`. 


### css: 

This directory is for an App's css stylesheets.


Note: More information about defining css stylesheets for an App
can be obtained locally at the command line via:

`rig --help css`. 


### DynamicOutput: 

This directory is for files that generate an 
App's output.


Note: More information about DynamicOutput can be
obtained locally at the command line via:

`rig --help DynamicOutput`. 


### js: 

This directory is for an App's javascript files.


Note: More information about utilizing javascript in an App can 
be obtained locally at the command line via:

`rig --help js`. 


### OutputComponents: 

This directory is for files that configure 
an App's output.


Note: More information about OutputComponents can be
obtained locally at the command line via:

`rig --help OutputComponents`. 


### Requests: 

This directory is for files that configure an
App's Requests.


Note: More information about Requests can be
obtained locally at the command line via:

`rig --help Requests`. 


### `resources`: 

This directory is for additional miscellaneous 
files and directories utilized by the App.


Note: More information about the resources directory can be
obtained locally at the command line via:

`rig --help resources`. 


### `Responses`: 

This directory is for files that configure an
App's Responses.


Note: More information about Responses can be
obtained locally at the command line via:

`rig --help Responses`. 


# Creating roady Apps


Apps can be created via `rig --new-app`, or 
`rig --configure-app-output`.


Once created, an App can be built for a domain by executing the 
App's Components.php via `php`. For example:

`php ~/roady/Apps/HelloWorld/Components.php 'http://localhost:8080'`


Note: More information about Apps can be obtained via:

`rig --help Apps`

More information about `rig --new-app` can be obtained via:

`rig --help --new-app`

More information about `rig --configure-app-output` can be 
obtained via: 

`rig --help --configure-app-output`

More information about the Components.php file can be obtained
via:

`rig --help Components.php`


### Hello World


The following example demonstrates how to use rig to begin
developing a roady App named HelloWorld.


Note: In the following examples roady is assumed to be installed
in the user's `home` directory. Make sure to adjust the paths
used in the following examples if you installed roady at a
different path.


1. Use `rig --configure-app-output` to create an App named
HelloWorld, and configure the output `<p>Hello World</p>`
to be served in response to requests to the root of any
domain the HelloWorld App is built for:

```
rig --configure-app-output \
--for-app HelloWorld \
--name HelloWorld \
--output '<p>Hello World</p>' \
--relative-urls '/'
```


Note: More information about `rig --configure-app-output` can
be obtained via:

`rig --help --configure-app-output`


2. Build the HelloWorld App for the local domain 
`http://localhost:8080`:

```
php ~/roady/Apps/HelloWorld/Components.php \
'http://localhost:8080'
```

Note: More information about the Components.php file can be
obtained via:

`rig --help Components.php`


3. Use `rig --start-server` to start a local development server on 
port `8080`: 

```
rig --start-server \
--port 8080 \
--open-in-browser
```


Note: More information about the `rig --start-server` can be
obtained via:

`rig --help --start-server`


Note: The `--open-in-browser` flag should cause rig to open
http://localhost:8080 in a web browser. This flag relies on the
`xdg-open` command, and may not always work. If it fails, you 
can still manually open http://localhost:8080 in a web browser.


Note: `xdg-open` is a command that will open a url in the user's 
default browser, if it is not available on your system then the
`--open-in-broswer` flag will not work. The `xdg-open` command is 
not associated with roady or rig, more information about the 
`xdg-open` command can be found online at:

https://linux.die.net/man/1/xdg-open


4. Use a text editor or IDE to edit HelloWorld's output:
```vim ~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php```

And revise `~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php`'s
content to be:


```
<div class="hw-container">
    <h1>Roady</h1>
    <p>
        roady is a tool designed to aid in the development of 
        websites.
    </p>
    <p>
        With roady, the features of a website are implemented 
        by small niche applications called Apps.
    </p>
    <p>
        roady Apps may provide css stylesheets, utilize 
        javascript, and may configure output to be served in 
        response to appropriate requests to a website's 
        domain.
    </p>
    <p>
        Multiple websites can run on a single installation of 
        roady, each making use of one or more roady Apps. 
    </p>
    <p>
        For a guide on getting started with roady visit:
    </p>
    <p>
        <a href="https://roady.tech/index.php?request=getting-started">
            https://roady.tech/index.php?request=getting-started
        </a>
    </p>
</div>
```


5. Create a stylesheet named `hw-global-styles.css` for the
HelloWorld App using a text editor or IDE:
```vim ~/roady/Apps/HelloWorld/css/hw-global-styles.css```

Define the following styles in
`~/roady/Apps/HelloWorld/css/hw-global-styles.css`:


```
body {
    background: #140a09;
    background-image: linear-gradient(45deg, #00bbff 25%, transparent 25%),
                      linear-gradient(-45deg, #020203 25%, transparent 25%),
                      linear-gradient(45deg, transparent 75%, #00bbff 75%),
                      linear-gradient(-45deg, transparent 75%, #020203 75%);
    background-size: 10rem 10rem;
    background-position: 0 0, 0 10rem, 10rem -10rem, -10rem 0rem;
    color: #00ffc3;
    font-size: 1.2rem;
    font-family: monospace;
    padding: 0;
    margin: 0;
}

.hw-container {
    width: 80%;
    background: #010103;
    opacity: .92;
    margin: 3rem auto;
    padding: 3rem;
    border: .2rem double white;
}

.hw-container h1 {
    color: white;
    text-shadow: -1px 1px #00ffc3;
}

.hw-container a, .hw-container a:link, .hw-container a:visited {
    text-decoration: none;
    color: white;
}

.hw-container a:hover, .hw-container a:active {
    color: #00bbff;
}
```


Note: Apps can define stylesheets that are served in response 
to all requests to the domains an App is built for by including 
the string `global` in the stylesheets name. If the stylesheet's 
name does not contain the string `global` then the stylesheet 
will only be served in response to requests where the value of 
`$_GET['request']` matches the name of the stylesheet.

Note: More information about using css stylesheets in roady Apps
can be obtained via:

`rig --help css`


The HelloWorld App should now exist in roady's Apps directory, 
and it's output should be accessible from a web browser at the 
following local urls:

http://localhost:8080/


http://localhost:8080/index.php?request=HelloWorld


http://localhost:8080?request=HelloWorld


# A Brief Introduction To roady App Packages


It is also possible to develop, and save Apps as App Packages.


roady App Packages can be thought of as blueprints for a roady
App. 


rig is likely to be used frequently during the development of 
a roady App.


Instead of making individual calls to rig manually at the command 
line, the necessary calls to rig can be defined together in 
`make.sh`, and run all at once by making the App Package into an 
App via `rig --make-app-package`.


Note: A hint, `make.sh` is just a bash script, so it is possible
to do more programmatically in `make.sh` than just defining
calls to rig.


# Hello World App Package


The following examples demonstrate how to develop a HelloWorld
App as an App Package, make it into an App, and then save it
by converting it back into an App Package.


Note: The following examples assume that roady is installed at
`~/roady`. If roady is installed at a different path make sure
to adjust the paths used in the examples appropriately.


Note: The following examples assume that rig is in your `$PATH`.
If it is not, you can temporarily add it to your path via:

```
export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"
```


# Create a HelloWorld App Package


### 1. Move in the user's home directory:


```
cd ~/
```


### 2. Create a new App Package via `rig --new-app-package`


```
rig --new-app-package --name HelloWorld
```

Note: This will create the HelloWorld App Package at the
following path:

`~/HelloWorld`


### 3. Edit `make.sh` using a text editor or IDE.


```
vim ~/HelloWorld/make.sh
```


And revise `make.sh`'s content to be:


```
#!/bin/bash

set -o posix

rig --new-app --name HelloWorld --domain 'http://localhost:8080'

rig --configure-app-output \
--for-app HelloWorld \
--name HelloWorld \
--output '<p>Hello World</p>' \
--relative-urls 'index.php' '/' \
--r-position 2

rig --configure-app-output \
--for-app HelloWorld \
--name HelloWorldMenu \
--output '<div><a href="index.php"></a></div>' \
--r-position 1 \
--global
```


# Make the HelloWorld App Package into an App:


### 1. Use `rig --make-app-package` to make the App Package


```
rig --make-app-package --path ~/HelloWorld
```


Note: The newly made HelloWorld App will be located at:

`~/roady/Apps/HelloWorld`


# Build the HelloWorld App and start a development server


### 1. Build the HelloWorld App for http://localhost:8080


```
php ~/roady/Apps/HelloWorld/Components.php 'http://localhost:8080'
```


### 2.Start a development server via `rig --start-server`:


```
rig --start-server --port 8080 --open-in-browser
```


Note: If a development server is already running for 
http://localhost:8080, then this step can be skipeed.

Note: To view the currently active development servers use:

```
rig --view-active-servers
```


Note: If http://localhost:8080 does not open in a browser 
automatically, simply open a browser and navigate to 
http://localhost:8080 manually.


# Modify the HelloWorld App 


### 1. Edit `~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php`:


```
vim ~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php 
```


Revising `HelloWorld.php`'s content to be:


```
<div class="hw-container">
    <h1>Roady</h1>
    <p>
        roady is a tool designed to aid in the development of 
        websites.
    </p>
    <p>
        With roady, the features of a website are implemented 
        by small niche applications called Apps.
    </p>
    <p>
        roady Apps may provide css stylesheets, utilize 
        javascript, and may configure output to be served in 
        response to appropriate requests to a website's 
        domain.
    </p>
    <p>
        Multiple websites can run on a single installation of 
        roady, each making use of one or more roady Apps. 
    </p>
    <p>
        For a guide on getting started with roady visit:
    </p>
    <p>
        <a href="https://roady.tech/index.php?request=getting-started">
            https://roady.tech/index.php?request=getting-started
        </a>
    </p>
</div>
```


### 2. Create a stylesheet named `hw-global-styles.css`

```
vim ~/roady/Apps/HelloWorld/css/hw-global-styles.css
```


Define the following styles in
`~/roady/Apps/HelloWorld/css/hw-global-styles.css`:


```
body {
    background: #140a09;
    background-image: linear-gradient(45deg, #00bbff 25%, transparent 25%),
                      linear-gradient(-45deg, #020203 25%, transparent 25%),
                      linear-gradient(45deg, transparent 75%, #00bbff 75%),
                      linear-gradient(-45deg, transparent 75%, #020203 75%);
    background-size: 10rem 10rem;
    background-position: 0 0, 0 10rem, 10rem -10rem, -10rem 0rem;
    color: #00ffc3;
    font-size: 1.2rem;
    font-family: monospace;
    padding: 0;
    margin: 0;
}

.hw-container {
    width: 80%;
    background: #010103;
    opacity: .92;
    margin: 3rem auto;
    padding: 3rem;
    border: .2rem double white;
}

.hw-container h1 {
    color: white;
    text-shadow: -1px 1px #00ffc3;
}

.hw-container a, .hw-container a:link, .hw-container a:visited {
    text-decoration: none;
    color: white;
}

.hw-container a:hover, .hw-container a:active {
    color: #00bbff;
}
```


# Save the HelloWorld App as an App Package


At this point, the HelloWorld App has been made from the HelloWorld
App Package, built for the local domain http://localhost:8080, and 
modified.


In order to save the modified HelloWorld App as an App Package 
with the modifications reflected, the AppPackager App will be 
needed.


### The AppPackager App


The AppPackager App is a roady App that can be used to convert
roady Apps into App Packages.


The AppPackager App is provided as an App Package as part of the 
roadyAppPackages library. This library is installed in roady's 
vendor directory when composer update is run. 


To use the AppPackager, it first needs to be made via
`rig --make-app-package`:


### 1. Make the AppPackager App Package


```
rig --make-app-package \
--path ~/roady/vendor/darling/roady-app-packages/AppPackager
```


### 2. Build the AppPackager App for http://localhost:8080


Next, the AppPackager needs to be built for the local domain
http://localhost:8080 so that it can be used to package the
HelloWorld App.


WARNING: The App Packager will not work unless it is built for the
same domain as the App that is to be packaged.


```
php ~/roady/Apps/AppPackager/Components.php 'http://localhost:8080'
```


# Use the AppPackager to package the modified HelloWorld App


The AppPackager should now be available locally. To use it,
navigate to the following url:

http://localhost:8080/index.php?page=AppPackager



The AppPackager provides a select form that lists the App's that
are installed in roady's Apps directory.


To save the HelloWorld App as an App Package, select it from the
list of available App's, and click submit.


This will create a App Package for the HelloWorld App at the
following path:

`~/roady/Apps/AppPackager/resources/AppPackages/HelloWorld`


# Final Thoughts


A lot has been covered so far, but there is also a lot that has
not been covered. 


If you are interested in diving deeper into developing with roady,
the next step is to read through more of the documentation, 
review the Apps included in the roadyAppPackages library, and of 
course, to experiment with roady and rig and try to 
develop your own roady Apps.


If roady is installed and rig is in your `$PATH`, the documentation
is always available locally via:

`rig --help`


The documentation is also always available online at:

https://roady.tech


If you have any questions or feedback roady is on twitter
and reddit:

https://twitter.com/RoadyRig


https://www.reddit.com/r/roady/


