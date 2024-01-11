
This directory is where layouts should be located.

It is also where the `layouts.json` layout configuration file
should be located.

# `layouts.json`

The `layouts.json` defines which layouts are used by which
websites.

For example, the Authority for a website with the Domain
`https://sub.example.com` is `sub.example.com`.

So to use a layout named `foo-layout` for the `sub.example.com`
website the following `layouts.json` file would be defined:

```json
{"sub.example.com":"foo-layout"}
```

# Layouts

Layouts define the order of Roady's UI sections for specific
websites.

A layout is a directory of `html` files that each define the following
named Positions that are used by Roady's UI to structure a web page:

```
<section-a></section-a>
<section-b></section-b>
<section-c></section-c>
<section-d></section-d>
<section-e></section-e>
<section-f></section-f>
<section-g></section-g>

```

All of these sections must exist in each `html` file defined by the
layout, though the order of the sections does not matter.

A layout must define at least one `html` file to be useful.

If a `html` named `default.html` exists, it will define the default
structure of a web page for Roady's UI. This file is not required,
if it does not exist the default `layout` will be defined internally
by Roady's UI.

All other files will correspond to a Request with the same name.

For example, a `html` file named `hompeage.html` would be used to
structure web pages served in Response to Requests to the
`homepage`.


