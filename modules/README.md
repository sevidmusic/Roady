
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

# Roady UI's Named Positions

Modules may target the Named Positions provided by Roady's UI to
determine where a Route's output will be rendered relative the
the output of other Routes.

The following table is an overview of the the Named Positions provided
by Roady's UI's:

| Named Position                              | Purpose                                                                              |
|---------------------------------------------|--------------------------------------------------------------------------------------|
| `<roady-ui-css-stylesheet-link-tags>`       | For `<link>` tags rendered for Routes to css stylesheets.                            |
| `<roady-ui-js-script-tags-for-html-head>`   | For `<script>` tags rendered for Routes to javascropt files.                         |
| `<roady-ui-named-position-a>`               | For `html` output rendered for Routes to `php` or `html` files.                      |
| `<roady-ui-named-position-b>`               | For `html` output rendered for Routes to `php` or `html` files.                      |
| `<roady-ui-named-position-c>`               | For Routes to `php` or `html` files.                                                 |
| `<roady-ui-named-position-d>`               | For `html` output rendered for Routes to `php` or `html` files.                      |
| `<roady-ui-named-position-e>`               | For Routes to `php` or `html` files.                                                 |
| `<roady-ui-named-position-f>`               | For `html` output rendered for Routes to `php` or `html` files.                      |
| `<roady-ui-named-position-g>`               | For `html` output rendered for Routes to `php` or `html` files.                      |
| `<roady-ui-js-script-tags-for-end-of-html>` | For Routes to javascript files that should be loaded after the closing `<body>` tag. |
