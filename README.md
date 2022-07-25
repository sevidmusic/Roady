# roady

Note: This document is still being drafted, and will continue to
evolve over time.

roady is a modular Component driven PHP framework.

roady v1.1.2 is the current stable version of roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

roady v2.0 is a complete re-write of roady that will build upon
roady's original design, though it will not be compatible with previous
versions of roady.

Some of the goals of the re-write:

- A cleaner code base,
- Clearer documentation
- Code must pass the scrutiny of `phpstan` analysis using `--level 9`
- Better use of `php 8` features where appropriate.
- Possibly build the `rig` command line utility into roady instead of
  developing it as a separate project. That will make it possible for
  the command line utility to more easily interact with roady, and
  will also make it easier for the command line utility to utilize
  roady's core interfaces and classes.
- What are now called `App Packages` will replace Apps, and when an
  `App` is built for a domain it's components will be configured in
  storage by `make.sh` directly, instead of by an auto-generated
  `Components.php` file that includes auto-generated `.php` files
  that define Component configurations. The use of `make.sh` and
  `Components.php` is somewhat redundent since they both function
  as configuration files.


