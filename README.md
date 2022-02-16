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

[https://roady.tech/index.php?request=getting-started](https://roady.tech/index.php?request=getting-started)

# Tutorial Videos:
[Quick Installation, Setup, & Hello World](https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm)

[Getting Started](https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm)

# Quick Installation, Setup, & Hello World Example

The following is a quick demonstration of how to install
and setup roady, and how to create a Hello World App.

Note: roady requires `php` >= `8.0`

Note: The `Linux command line` is used heavily in the examples, 
and the `shell` used in the examples is `bash`.

Note: The following examples are brief. For a more detailed 
guide on getting started with roady visit:

[https://roady.tech/index.php?request=getting-started](https://roady.tech/index.php?request=getting-started)

Note: If roady is installed, and `rig` is in your `$PATH`, then
the getting started documentation can be accessed locally via:

```
rig --help getting-started
```
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

The output of the `HelloWorld` App should now be available at 
the following local urls: 

[http://localhost:8080](http://localhost:8080)

[http://localhost:8080/?request=HelloWorld](http://localhost:8080/?request=HelloWorld)

[http://localhost:8080/index.php?request=HelloWorld](http://localhost:8080/index.php?request=HelloWorld)

# Install, setup, and Hello World command summary:

The following is a summary of the commands used in the examples
above to install and setup roady, and create a HelloWorld app:

```
cd ~/

git clone https://github.com/sevidmusic/roady.git

cd ~/roady

composer update

export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"

rig --configure-app-output \
    --for-app HelloWorld \
    --name HelloWorld \
    --output 'Hello World' \
    --relative-urls '/'

php ~/roady/Apps/HelloWorld/Components.php \
    'http://localhost:8080'

rig --start-server --open-in-browser
```

# A note from the developer:
 
I want to emphasize that I developed roady as a tool for myself,
and I share it humbly as an example of my work and learning.

I love coding, I love to learn about coding, and I love to build
things for the experience, and for the knowledge gained from 
that experience.

roady is not a fully-featured framework, nor is it intended to be.

roady is my own personal experiment, and will continue to evolve 
based on my own needs.

roady is ready for use.

https://roady.tech was developed with roady, and is running on roady.

My personal website, https://sevidmusic.com, is being developed with
roady, and is also running on roady.

Roady is still a work in progress, if you have any questions or 
feedback feel free to contact me on Twitter, Reddit, or LinkedIn.

### Links:

Twitter: https://twitter.com/roadyRig

Reddit: https://www.reddit.com/r/roady/

LinkedIn: https://www.linkedin.com/in/sevi-d-foreman-24a62951/

roady on GitHub: https://github.com/sevidmusic/roady

rig on GitHub: https://github.com/sevidmusic/rig

roadyAppPackages on GitHub: https://github.com/sevidmusic/roadyAppPackages



