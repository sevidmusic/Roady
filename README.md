```
    ____                  __
   / __ \____  ____ _____/ /_  __
  / /_/ / __ \/ __ `/ __  / / / /
 / _, _/ /_/ / /_/ / /_/ / /_/ /
/_/ |_|\____/\__,_/\__,_/\__, /
                        /____/
```

![roady logo](https://raw.githubusercontent.com/sevidmusic/roady/roady/roadyLogo.png)

# Development of Roady v2.0

Roady is a `php` framework I have been developing for a long time.
At this point it is a passion project. I love coding, working
on Roady makes me happy.

Roady `v1.1.2` is the current stable version of Roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

Roady v2.0 is a complete re-write of Roady that will be influenced by
roady's original design, but will not be compatible with previous
versions of roady.

NOTE: At the moment I am using this file to plan the rest of
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

Modules may define `output` to be displayed via Roady's UI in the form
of `html` or `php` files.

Modules may define `css` stylesheets and `javascript` files to define
styles and implement additional functionality for a website.

| Anatomy of a Module | |
| --- | --- |
| Directory | Description |
| --- | --- |
| `css` | This is where CSS stylesheets should be located. |
| `js` | This is where JavaScript files should be located. |
| `output` | This is where PHP and HTML files should be located. |
| `APPROPRIATE.SITE.AUTHORITY.json` | This file defines routes for a specific website. |

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

 - A collection of Names that correspond to the Names of the Requests
   that a Route should be served in response to.

 - A collection of Named Positions that correspond to the Named
   Positions provided by Roady's UI which are used to structure
   the collective output of all of the Route's that respond to
   the same Request.

 - A Relative Path to a `php` file, `html` file, `css` file, or
   `javascript` file.

For example, the following `json` defines a single Route:

```json
{
    "module-name": "module-name",
    "responds-to": [
        "name-of-a-request-this-route-responds-to"
    ],
    "named-positions": [
        {
            "position-name": "section-a",
            "position": 1.7
        }
    ],
    "relative-path": "path\/to\/output-file.html"
}

```

# Roady's User Interface (UI)

Roady's UI uses the Routes defined by installed Modules to determine
the `<html>` that should be rendered in Response to a Request.

To structure the rendered `<html>`, Roady's UI uses a layout.

### Layouts

Layouts define the order of Roady's UI sections for specific
websites.

Layouts do not define styles, just structure.

Layouts are not required, if none exist Roady will use it's own
internally defined layout.

Layouts should be installed in Roady's `layouts` directory.

Installed layouts may be used by any website running on Roady, but
each website may only use one layout.

To configure layouts for specific websites, a file named
`layouts.json` must exist in the directory where all
layouts are located that contains json that defines an array
of `(string) key` `=>` `(string) value` pairs where the `key`
is the website Domain's Authority and the value is the name of
the layout to use for the website. For example:

```
{
    "localhost": "layout-1",
    "sub.example.com": "layout-2",
    "localhost:8080": "layout-1"
}

```

Layouts must define at least one `html` file named `default.html`
which defines the layout's default ordering of Roady's UI sections.

For example, the default layout defined by Roady is:

```html
<section-a></section-a>

<section-b></section-b>

<section-c></section-c>

<section-d></section-d>

<section-e></section-e>

<section-f></section-f>

<section-g></section-g>

```

Layouts may also define additional `html` files which are named after
specific Requests to order Roady's UI sections differently for
different Requests.

For example, to define a custom layout for a Request named `hompeage`,
a layout file named `homepage.html` would be defined.

Layout files must define the following sections. They do not need to
be in a particular order, but they must be defined:

```
section-a
section-b
section-c
section-d
section-e
section-f
section-g
```

Layouts may also define additional sections that are unique to
the Layout. For example, the following layout defines a custom
section named `foo`, also, notice the required sections are in
a different order.

```html
<foo></foo>

<section-e></section-e>

<section-c></section-c>

<section-d></section-d>

<section-b></section-b>

<section-f></section-f>

<section-g></section-g>

<section-a></section-a>

```

If Roady's UI determines that there are no modules that define output
for a section then the section will not be included in Roady's UI
output.
```
roady-page-title-placeholder

roady-stylesheet-link-tags

roady-head-javascript-tags

section-a

section-b

section-c

section-d

section-e

section-f

section-g

roady-footer-javascript-tags

```

The Named Position `roady-page-title-placeholder` is reserved and
cannot be used by Modules.

The Named Position `roady-stylesheet-link-tags` can be used by
Routes that define a Relative Path to a `css` stylesheet.

Routes to stylesheets that are assigned the
`roady-stylesheet-link-tags` Named Position will
have `<link>` tags automatically generated for
them at the `roady-stylesheet-link-tags` position
in Roady's UI's `output`.

For example if a Route defined by a module named `Foo` for the
Authority `localhost:8080` was assigned the following Relative Path:

    css/homepage.css

And was also assign to the Named Position:

    roady-stylesheet-link-tags

Then the following `<link>` tag would be generated for the `Foo`
module's `homepage.css` stylesheet in Roady's UI's output at the
`roady-stylesheet-link-tags` position when the appropriate Request
was made.

```html
<link rel="stylesheet" href="http://localhost:8080/Foo/css/homepage.css">
```

The Named Positions `roady-head-javascript-tags` and
`roady-footer-javascript-tags` can be used by Routes that define
a Relative Path to a `javascript` file.

Routes to `javascript` files that are assigned to the
`roady-head-javascript-tags` Named Position will have `<script>`
tags automatically generated for them at the
`roady-head-javascript-tags` position in Roady's UI's output.

Routes to `javascript` files that are assigned to the
`roady-footer-javascript-tags` Named Position will have `<script>`
tags automatically generated for them at the
`roady-footer-javascript-tags` position in Roady's UI's output.

For example if a Route defined by a module named Foo for the
Authority `localhost:8080` was assigned the Relative Path:

    js/homepage.js

And was also assigned to the Named Position:

    roady-head-javascript-tags

Then the following `<script>` tag would be generated for the `Foo`
module's `homepage.js` javascript file in Roady's UI's output at the
`roady-head-javascript-tags` position when the appropriate Request
was made.

```html
<script rel="stylesheet" href="http://localhost:8080/Foo/js/homepage.js"></script>
```

