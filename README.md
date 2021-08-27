# roady

roady is a tool designed to aid in the development of websites.

Its design allows the features of a website to be implemented as smaller niche
applications called Apps.

The features an App provides can be made available to multiple websites running
on a single installation of roady.

Apps can configure output to show up in response to appropriate requests to a
website, and can also provide stylesheets, scripts, and other resources
necessary to implement the specific features they provide.

Note: For help getting started visit:

[https://roady.tech/index.php?request=getting-started](https://roady.tech/index.php?request=getting-started)

Note: The documentation is still being written, and some sections are not
complete. New documentation will continue to be added regularly.

Note: roady is available on github at:

[https://github.com/sevidmusic/roady.git](https://github.com/sevidmusic/roady.git)


### Installation, Setup, and Hello World Demo

[https://roadydemos.us-east-1.linodeobjects.com/getting-started-2021-08-22_03.31.22.webm](https://roadydemos.us-east-1.linodeobjects.com/getting-started-2021-08-22_03.31.22.webm)


# Getting Started

The following goes over how to install and setup roady and rig, and how to
build a `HelloWorld` App.

Note: In the following examples roady is installed in the user's `home`
directory. Make sure to adjust the paths used in the following examples
if you install roady at a different path:


### Installation, Setup, and Hello World Demo

![Installation, Setup, and HelloWorld](https://github.com/sevidmusic/roadyAndRigDemos/blob/main/getting-started-2021-08-22_03.31.22.gif)


### Installation & Setup Steps

1. Move into the directory where you wish to install roady and rig:

```
cd ~/
```

Note: `~/` is shorthand for the path to the current users `home`
directory.

2. Clone roady from [https://github.com/sevidmusic/roady.git](https://github.com/sevidmusic/roady.git):

```
git clone https://github.com/sevidmusic/roady.git
```

3. Move into roady's directory:

```
cd ~/roady
```

4. Update `composer`, this will install rig at `~/roady/vendor/darling/rig`:

```
composer update
```

Note: This will also install the roadyAppPackages library which provides a
collection of roady App Packages that can be made into roady Apps via
`rig --make-app-package`. In this example, the roadyAppPackages library
will be installed at:

`~/roady/vendor/darling/roady-app-packages`

5. Add rig to your path:

```
export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"
```

6. Make sure rig is working:

```
rig --help | less -R
```

Note: `less` is not related to roady or rig. The `less` command is used in the
example to make it easier to view the output of `rig --help`. More information
about the `less` command can be found online at:

[https://man7.org/linux/man-pages/man1/less.1.html](https://man7.org/linux/man-pages/man1/less.1.html)


### Hello World Steps

Note: In the following examples roady is installed in the user's `home`
directory. Make sure to adjust the paths used in the following examples
if you install roady at a different path:

1. Use `rig --configure-app-output` to create an App named `HelloWorld`

```
rig --configure-app-output \
--for-app HelloWorld \
--name HelloWorld \
--output '<p>Hello World</p>' \
--relative-urls '/'
```

2. Build the `HelloWorld` App for the domain `http://localhost:8080`:

```
php ~/roady/Apps/HelloWorld/Components.php 'http://localhost:8080'
```

3. Use rig to start a development server:

```
rig --start-server --port 8080 --open-in-browser
```

Note: The `--open-in-browser` flag should cause rig to open
http://localhost:8080 in a web browser. This flag relies on the `xdg-open`
command, and may not always work. If it fails, you can still manually open a
web browser and navigate to http://localhost:8080.

Note: `xdg-open` is a command that will open a url in the user's default
browser, if it is not available on your system then the `--open-in-broswer`
flag will not work. The `xdg-open` command is not associated with roady or
rig, more information about the `xdg-open` command can be found at:

    [https://linux.die.net/man/1/xdg-open](https://linux.die.net/man/1/xdg-open)

4. Use a text editor or IDE to edit `HelloWorld`'s DynamicOutput file:

```
vim ~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php
```

And revise `~/roady/Apps/HelloWorld/DynamicOutput/HelloWorld.php`'s content to be:

```
<div class="container">

    <h1>Roady</h1>

    <p>
        <a href="https://github.com/sevidmusic/roady">Roady</a> is a tool
        designed to aid in the development of websites.
    </p>

    <p>
        Its design allows the features of a website to be implemented as
        smaller niche applications called Apps.
    </p>

    <p>
        The features of an App can be made available to multiple websites
        running on a single installation of
        <a href="https://github.com/sevidmusic/roady">Roady</a>.
    </p>

    <p>
        Apps can configure output to show up in response to appropriate
        requests to a
        website, and can also provide stylesheets, scripts, and other
        resources necessary to implement the specific features they provide.
    </p>

</div>
```

5. Add some style by creating a global stylesheet for the `HelloWorld` App
using a text editor or IDE:

Note: Apps can define stylesheets that are loaded in response to specific
requests to the domains an App is built for, or can define stylesheets
that are loaded in response to all requests to the domains an App is
built for.

If the name of a stylesheet defined by an App contains the word `global`,
it will be loaded in response to all requests to the domains that the App
is built for.

If the stylesheet's name does not contain the word `global`, then the
stylesheet will only be loaded in response to requests whose name
matches the name of the stylesheet.

For instance, in this example a stylesheet named `hw-global-styles.css`
is defined by the HelloWorld App, and the HelloWorld App is built for
the domain http://localhost:8080, so `hw-global-styles.css` will
be loaded in response to all requests to http://localhost:8080.

If, in this example, the HelloWorld App also defined a stylesheet named
`homepage.css`, then `homepage.css` would only be loaded in response to
the requests that have the name `homepage`:

[http://localhost:8080?request=homepage](http://localhost:8080?request=homepage)

[http://localhost:8080/index.php?request=homepage](http://localhost:8080/index.php?request=homepage)

```
vim ~/roady/Apps/HelloWorld/css/hw-global-styles.css
```

Define the following styles in `vim ~/roady/Apps/HelloWorld/css/hw-global-styles.css`:

```
body {
    background: #140a09;
    background-image: linear-gradient(45deg, #00bbff 25%, transparent 25%),
                      linear-gradient(-45deg, #020203 25%, transparent 25%),
                      linear-gradient(45deg, transparent 75%, #00bbff 75%),
                      linear-gradient(-45deg, transparent 75%, #020203 75%);
    background-size: 10rem 10rem;
    background-position: 0 0, 0 10rem, 10rem -10rem, -10rem 0rem;
    color: #fa5f11;
    font-size: 1.2rem;
    font-family: monospace;
    padding: 0;
    margin: 0;
}

.container h1 {
    color: white;
}

.container {
    width: 80%;
    background: #010103;
    opacity: .72;
    margin: 3rem auto;
    padding: 3rem;
    border: .2rem double white;
}

.container a, .container a:link, .container a:visited {
    text-decoration: none;
    color: white;
}

.container a:hover, .container a:active {
    color: #00bbff;
}
```

### Hello World App Package

roady Apps can be shared easily in the form of App Packages. You can
create a new App Package with `rig --new-app-package`.

App Packages can be made into roady Apps with `rig --make-app-package`.

The HelloWorld App's App Package is part of a collection of App Packages that
are installed as part of the roadyAppPackages library when `composer update`
is run after installing roady.

If roady is installed in the user's home directory, the HelloWorld App's App
Package will be located at the following path:

`~/roady/vendor/darling/roady-app-packages/HelloWorld`

Note: The examples assume roady is installed in the user's home directory,
if roady is installed somewhere else make sure to adjust the paths used
in the examples appropriately.

To make the HelloWorld App from the HelloWorld App Package, run:

```
rig --make-app-package \
--path ~/roady/vendor/darling/roady-app-packages/HelloWorld
```

The newly made HelloWorld App will be located at the following path:

`~/roady/Apps/HelloWorld`

Warning: Be careful with `--make-app-package`, it will overwrite any directory
whose name matches the name of the App to be made with the newly made App.
For example, if you followed the getting-started documentation and created
a HelloWorld App, running `rig --make-app-package --path
~/roady/vendor/darling/roady-app-packages/HelloWorld` will replace the original
HelloWorld App with the HelloWorld App made from the HelloWorld App Package.

To build the newly made HelloWorld App, run:

```
php ~/roady/Apps/HelloWorld/Components.php 'http://localhost:8080'
```

And if one is not already running, start a development server:

```
rig --start-server --port 8080 --open-in-browser
```

Note: `rig --view-active-servers` can be used to get a list of the
active php built in server instances started via `rig --start-server`.

The HelloWorld App's output should now be accessible from a web browser at
the following url:

[http://localhost:8080](http://localhost:8080)

### The AppPackager

In addition to the HelloWorld App Package, an App Package named AppPackager is
also provided by the roadyAppPackages library. The AppPackager is an App that
can be used to convert existing Apps into AppPackages. To use it, first
make the AppPackager App Package into an App:

```
rig --make-app-package \
--path ~/roady/vendor/darling/roady-app-packages/AppPackager
```

Then build the AppPackager App for the domain http://localhost:8080

```
php ~/roady/Apps/AppPackager/Components.php 'http://localhost:8080'
```

If you haven't already, start a development server:

`rig --start-server --port 8080`

Then visit the following url in a web browser:

[http://localhost:8080/index.php?page=AppPackager](http://localhost:8080/index.php?page=AppPackager)

Use the select form provided to select an App to package, for example, select
the AppPackager, and click submit.

This will create an App Package for the AppPackager App at the following path:

`~/roady/Apps/AppPackager/resources/AppPackages/AppPackager`

This App Package can be shared, used as a backup, used as a base for a new
version of the App, or used to re-make the AppPackager App in the future.

Note: The documentation is still being worked on, and will continue to be
updated regularly.
