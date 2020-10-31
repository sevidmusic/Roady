This directory is where Dynamic Output that is used by all Apps should be defined.

Dynamic Output can be defined in either a php, or non-php file.

For example:

If a file exists at SharedDynamicOutput/foo.php the file will be compiled as php.

If a file exists at SharedDynamicOutput/foo.txt the fill will be treated as plain text.

All file formats are valid, only php files will be compiled, all other file formats will
be treated as plain text.
