  # Roady

  Roady is a tool designed to aid in the development of websites.

  Its design allows the features of a website to be implemented as smaller niche applications called Apps.

  Roady Apps are responsible for implementing one or more related features.

  The features an App provides can be made available to multiple websites running on a single installation of Roady.

  Apps can configure output to show up in response to appropriate requests to a website, and can also provide stylesheets, scripts, and other resources necessary to implement the specific features they provide.

  New documentation is being added to [https://roady.tech](https://roady.tech) regularly.

  Version 1.0 will be out soon.

  # Installation, setup, and Hello World

  ![Installation And Hello World Demo](https://github.com/sevidmusic/roadyAndRigDemos/blob/main/roadyInstallAndHelloWorld.gif)

  # Getting Started

  The following goes over how to install and setup roady and rig, and how to build
  a `HelloWorld` App.

  Note: roady is installed in the user's `home` directory in the following example,
  make sure to adjust the paths used in the example if you install roady at a
  different path:


  ### Installation & Setup

  1. Move into the directory where you wish to install roady and rig:

         `cd /`

  2. Clone roady from https://github.com/sevidmusic/roady.git:

         `git clone https://github.com/sevidmusic/roady.git`

  3. Move into roady's directory:

         `cd /roady`

  4. Update `composer`, this will install rig in `./vendor/darling/rig`:

         `composer update`

  5. Add rig to your path:

         `export PATH="${PATH}:${HOME}/roady/vendor/darling/rig/bin"`

  6. Make sure rig is working:

         `rig --help | more`


  # Hello World

  1. Use rig to create an App named `HelloWorld`


  ```rig --configure-app-output \
     --for-app HelloWorld \
     --name HelloWorld \
     --output '<p>Hello World</p>' \
     --relative-urls '/'```

  2. Build the `HelloWorld` App for the domain `http://localhost:8080`:


  ```php ./Apps/HelloWorld/Components.php 'http://localhost:8080'```

  3. Use rig to start a development server:


  ```rig --start-server --port 8080 --open-in-browser```

  4. Use a text editor or IDE to edit `HelloWorld`'s output:


  ```vim ./Apps/HelloWorld/DynamicOutput/HelloWorld.php```

  NOTE: `HelloWorld/DynamicOutput/HelloWorld.php`'s content should now be:

  ```
  <div class="container">

      <h1>Roady</h1>

      <p>
          <a href="https://github.com/sevidmusic/roady">Roady</a> is a tool designed
          to aid in the development of websites.
      </p>

      <p>
          Its design allows the features of a website to be implemented as
          smaller niche applications called Apps.
      </p>

      <p>
          <a href="https://github.com/sevidmusic/roady">Roady</a> Apps are responsible for implementing one or more related features.
      </p>

      <p>
          The features of an App can be made available to multiple websites running on
          a single installation of the <a href="https://github.com/sevidmusic/roady">Roady</a>.
      </p>

      <p>
          Apps can configure output to show up in response to appropriate requests to a
          website, and can also provide stylesheets, scripts, and other resources
          necessary to implement the specific features they provide.
      </p>

  </div>
  ```

  5. Add some style by creating a global stylesheet for the `HelloWorld` App using a
  text editor or IDE:

  ```
  vim ./Apps/HelloWorld/css/hw-global-styles.css
  ```

  NOTE: `hw-global-styles.css`'s content should now be:

  ```
  body {
      background: #140a09;
      background-image: linear-gradient(45deg, #00bbff 25%, transparent 25%), linear-gradient(-45deg, #020203 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #00bbff 75%), linear-gradient(-45deg, transparent 75%, #020203 75%);
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

  Note: The App Package for the HelloWorld App created in the example above can be
  found on github:

  https://github.com/sevidmusic/roadyAppPackages/tree/main/HelloWorld

  And can be made into an App for a Roady installation via:

  `rig --make-app-package`

