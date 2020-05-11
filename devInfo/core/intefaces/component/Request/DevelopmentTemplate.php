*************************************************************************
************************ StoredComponentRegistry ************************
*************************************************************************

Note: All code in this Component develeopment template is psuedo code,
and is meant to serve as a guide, actual implementation will be
different.

*************************************************************************
************************ Notes about this file **************************
*************************************************************************

  Hint: Hints provide psuedo code that is meant to serve as an
        implementation guide.

        Note: Hint numbers correspond pseudo code steps, NOT line numbers.
              They are merely a formatting feature so the following command
              can be run to get a summary of the DevelopmentTemplate:

        grep -E 'tes[t]|[0-9][.]' /path/to/DevelopmentTemplate.txt | sed -e 's/tes[t]/\ntest/g;'

        In general it is important that the formatting of this document
        be consistent so tools like grep|awk|sed can be used to review
        this file.

*************************************************************************
*************************************************************************
*************************************************************************

This is the development template for the refactor of the Request component.

New Methods: As an example, the expected return values are shown, return
            values are based on example Request url:
            https://www.foobarbaz123.com:80/index.php?foo=bar&baz=bazzer

getRootUrl()     | https://www.foobarbaz123.com

getProtocol()    | https:

getSubDomain()   | www.

getDomain()      | foobarbaz123.com

getPort()        | :80

getPath()        | /index.php

getQueryString() | ?foo=bar&baz=bazzer


