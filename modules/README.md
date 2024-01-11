# Modules

This directory is where Roady modules should be located.

# Anatomy of a Module:

```
css                              This is where css stylesheets should
                                 be located.

js                               This is where javascript files should
                                 be located.

output                           This is where php and html files
                                 should be located.

APPROPRIATE.SITE.AUTHORITY.json  This file defines Routes for a
                                 specific website.

Note: Modules may also define custom files and directories if needed.

```

# Typical Module Files and Directories:

### APPROPRIATE.SITE.AUTHORITY.json

Manually configured Routes must be defined for a specific website in a
`json` file named after the website's Domain's Authority.

For example, the following `json` defines two Routes for a
website whose Authority is 'localhost:8080' in a file named
`localhost.8080.json`:

```json
[
    {
        "module-name": "module-name",
        "responds-to": [
            "name-of-a-request-this-route-responds-to",
            "name-of-another-request-this-route-responds-to"
        ],
        "named-positions": [
            {
                "position-name": "section-a",
                "position": 0.0
            },
            {
                "position-name": "section-d",
                "position": -72.26
            },
            {
                "position-name": "section-f",
                "position": 0.0
            }
        ],
        "relative-path": "path\/to\/output-file.html"
    },
    {
        "module-name": "module-name",
        "responds-to": [
            "name-of-a-request-this-route-responds-to",
            "name-of-another-request-this-route-responds-to"
        ],
        "named-positions": [
            {
                "position-name": "section-g",
                "position": 0.002
            },
            {
                "position-name": "section-a",
                "position": 2.6
            },
            {
                "position-name": "section-c",
                "position": 0.001
            }
        ],
        "relative-path": "path\/to\/output-file.php"
    }
]

```

### CSS:

The `css` directory is where a module's `css` stylesheets should be
located.

The `css` directory is not required, but if it exists a Route will be
dynamically defined for each file it contains that responds to a
Request whose name matches the name of the `css` stylesheet excluding
the `.css` extension. Any additional Routes will have to be configured
manually in a `APPROPRIATE.SITE.AUTHORITY.json` file.

For example, a file named:

    homepage.css

would be served in response to a Request named:

    homepage

Files whose name contains the string:

    global

will be served in response to all Requests.

### JS:

The `js` directory is where a module's javascript files should be
located.

The `js` directory is not required, but if it exists a Route will be
dynamically defined for each file it contains that responds to a
Request whose name matches the name of the javascript file excluding
the `.js` extension. Any additional Routes will have to be configured
manually in a `APPROPRIATE.SITE.AUTHORITY.json` file.

For example, a file named:

    homepage.js

would be served in response to a Request named:

    homepage

Files whose name contains the string:

    global

will be served in response to all Requests.

### OUTPUT:

The `output` directory is where a module's `php` and `html` files
should be located.

The `output` directory is not required, but if it exists a Route will
be dynamically defined for each file it contains that responds to a
Request whose name matches the name of the `php` or `html` file
excluding the `.php` or `.html` extension. Any additional Routes will
have to be configured manually in a `APPROPRIATE.SITE.AUTHORITY.json`
file.

For example, a file named:

    homepage.php

would be served in response to a Request named:

    homepage

Files whose name contains the string:

    global

will be served in response to all Requests.
