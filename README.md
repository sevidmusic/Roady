```
    ____                  __
   / __ \____  ____ _____/ /_  __
  / /_/ / __ \/ __ `/ __  / / / /
 / _, _/ /_/ / /_/ / /_/ / /_/ /
/_/ |_|\____/\__,_/\__,_/\__, /
                        /____/
```

![Roady logo](https://raw.githubusercontent.com/sevidmusic/roady/roady/roadyLogo.png)

# Development of Roady v2.0

Roady is a `php` framework I have been developing for a long time.
At this point it is a passion project. I love coding, working
on Roady makes me happy.

Roady `v1.1.2` is the current stable version of Roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

Roady v2.0 is a complete re-write of Roady that will be influenced by
Roady's original design, but will not be compatible with previous
versions of Roady.

Note: At the moment I am using this file to plan the rest of
the re-write of `Roady2.0`. This file will be revised to document
`Roady2.0` before `Roady2.0` is released.

Note: This document is still being drafted, and will continue to
evolve over time.

# About

Roady is a modular `php` framework.

With Roady the features and functionality of a website are implemented
by individual Modules.

For example, say my band used Roady to build our website, and we
needed a music player, that music player would be implemented by
a Module.

If we needed a calender to show upcoming gigs, it would be implemented
by a different Module.

Multiple websites can run on a single installation of Roady, each
making use of one or more installed Roady Modules.

# Modules

### Anatomy of a Module

| Directory                         | Description                                                  |
|-----------------------------------|--------------------------------------------------------------|
| `css`                             | This is where `css` stylesheets should be located.           |
| `js`                              | This is where `javascript` files should be located.          |
| `output`                          | This is where `php` and `html` files should be located.      |
| `APPROPRIATE.SITE.AUTHORITY.json` | This file defines hard-coded Routes for a specific website.  |

# How a Module Works

Modules should be located in Roady's `modules` directory.

```
/path/to/Roady/modules
```

Modules may define `output` to be displayed via Roady's UI in the form
of `html` or `php` files.

Modules may define `css` stylesheets and `javascript` files to define
styles and implement additional functionality for a website.

Modules may serve `php`, `html`, `css`, and `javascript`, in Response
to a Request to a website via the Routes defined in a `json`
file which is named after the website's Domain's Authority.

For example, `sub.example.com.8080.json` would be the name of the
`json` file used to define Routes for a website with the following
Domain:

```
 https://sub.example.com:8080/
 |       \__________________/|
 |               |           |
 |           AUTHORITY       |
  \_________________________/
               |
            Domain

```

Using a website's Domain's Authority to name Route configuration files
allows Modules to define unique Routes for each website.

### Routes

A Route defines the following:

 - The Name of the Module the Route is configured for.
   Note: It is possible for a Module to define a Route
   for another Module by setting the Route's Module name
   to the name of the relevant Module.

 - A collection of Names that correspond to the Names of the Requests
   that a Route should be served in response to.

 - A collection of Named Positions that correspond to the Named
   Positions provided by Roady's UI. These Named Positions are used
   to structure the collective output of all of the Route's that
   respond to the same Request.

 - A Relative Path to a `php` file, `html` file, `css` file, or
   `javascript` file.

For example, the following `json` defines a single Route to a `html`
file named `output-file.html`:

```json
{
    "module-name": "module-name",
    "responds-to": [
        "name-of-a-request-this-route-responds-to"
    ],
    "named-positions": [
        {
            "position-name": "roady-ui-named-position-c",
            "position": 1.7
        }
    ],
    "relative-path": "path\/to\/output-file.html"
}

```

# Roady's User Interface (UI)

Roady's UI uses the Routes defined by installed Modules to determine
the `html` that should be rendered in Response to a Request.

Roady's UI uses the Named Positions provided by an internally defined
`html` layout to structure the collective output of Routes that
respond to the same Request:

```html
<!DOCTYPE html>

<html>

    <head>

        <title><roady-ui-page-title-placeholder></roady-ui-page-title-placeholder></title>

        <meta charset="UTF-8">

        <meta name="description" content="<roady-ui-meta-description></roady-ui-meta-description>">

        <meta name="keywords" content="<roady-ui-meta-keywords></roady-ui-meta-keywords>">

        <meta name="author" content="<roady-ui-meta-author></roady-ui-meta-author>">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <roady-ui-css-stylesheet-link-tags></roady-ui-css-stylesheet-link-tags>

        <roady-ui-js-script-tags-for-html-head></roady-ui-js-script-tags-for-html-head>

    </head>

    <body>

        <roady-ui-pre-header></roady-ui-pre-header>

        <header class="roady-ui-header">

            <roady-ui-header></roady-ui-header>

        </header>


        <main class="roady-ui-main-content">

            <roady-ui-main-content></roady-ui-main-content>

        </main>

        <footer class="roady-ui-footer">

            <roady-ui-footer></roady-ui-footer>

        </footer>


    </body>

</html>

<roady-ui-js-script-tags-for-end-of-html></roady-ui-js-script-tags-for-end-of-html>

<!-- Powered by Roady (https://github.com/sevidmusic/roady) -->

```

The following table is an overview of the purpose of each of the Named
Positions provided by Roady's UI's internally defined `html` layout:

| Named Position                                      | Purpose                                                                                                                                                        |
|-----------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `<roady-ui-page-title-placeholder>`                 | This position name is reserved for internal use, Roady's UI determine the page title based on the Request that was made.                                       |
| `<roady-ui-meta-description>`                       | For `description` meta data that should be rendered in the value attribute of a `<meta> ` tag in the `<head>` section of the output Rendered by Roady's UI.    |
| `<roady-ui-meta-keywords>`                          | For `keyword` meta data that should be rendered in the value attribute of a `<meta> ` tag in the `<head>` section of the output Rendered by Roady's UI.        |
| `<roady-ui-meta-author>`                            | For `author` meta data that should be rendered in the value attribute of a `<meta> ` tag in the `<head>` section of the output Rendered by Roady's UI.         |
| `<roady-ui-css-stylesheet-link-tags>`               | For `<link>` tags rendered for Routes to css stylesheets.                                                                                                      |
| `<roady-ui-js-script-tags-for-html-head>`           | For `<script>` tags rendered for Routes to javascropt files.                                                                                                   |
| `<roady-ui-pre-header>`                             | For output that shoud be rendered before the `<header>`.                                                                                                       |
| `<roady-ui-header>`                                 | For output that should be rendered within the `<header>`.                                                                                                      |
| `<roady-ui-main-content>`                           | For output that should be rendered within `<main>`.                                                                                                            |
| `<roady-ui-footer>`                                 | For output that should be rendered within the `<footer>`.                                                                                                      |
| `<roady-ui-js-script-tags-for-end-of-html>`         | For Routes to javascript files that should be loaded after the closing `<body>` tag.                                                                           |

