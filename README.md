# roady

![alt text](https://raw.githubusercontent.com/sevidmusic/roady/roady/roadyLogo.png)

Note: This document is still being drafted, and will continue to
evolve over time.

### About

roady is a PHP framework I have been developing for a long time.
At this point it is a passion project. I love coding, working
on roady makes me happy.

The basic idea behind roady is:

- The features of a website are implemented by individual Modules.

  Note: In roady versions 1.1.2 and earlier, Modules were known
        as Apps.

  For example, say my band used roady to build our website, and we
  needed a music player. That music player would be implemented by
  a Module. If we needed a calender to show upcoming gigs, it would
  be implemented by a different Module.

- A Module may utilize javascript files, css files, html files, or php
  files to implement the features it provides.

- Multiple websites can run on a single installation of roady, each
  making use of one or more installed roady Modules.

- roady provides a command line utility that can be used for various
  administrative tasks, including installation and management of
  installed roady Modules.

### Development of roady v2.0

roady v1.1.2 is the current stable version of roady, and can be
found here:

[https://github.com/sevidmusic/roady/releases/tag/v1.1.2](https://github.com/sevidmusic/roady/releases/tag/v1.1.2)

roady v2.0 is a complete re-write of roady that will build upon
roady's original design, though it will not be compatible with previous
versions of roady.

### Goals for roady v2.0

- Code must pass the scrutiny of `phpstan` analysis using `--level 9`.
- A cleaner code base.
- Clearer documentation.
- Better use of `php 8` features where appropriate.
- A better command line utility built into roady.



