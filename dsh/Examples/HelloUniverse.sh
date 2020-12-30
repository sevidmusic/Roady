#!/bin/bash

set -o posix

# Define the HelloWorld App
app1_name="HelloWorld"
app1_development_port="8420"
app1_production_domain="http://somesite.com"
app1_development_domain="http://localhost:${app1_development_port}"

dsh --new App "${app1_name}" "${app1_production_domain}"

dsh --new Response "${app1_name}" Homepage 0

dsh --new Request "${app1_name}" HelloWorldRootRequest RootRequests "\/"

dsh --new Request "${app1_name}" HelloWorldIndexRequest IndexRequests "index.php"

dsh --new OutputComponent "${app1_name}" HelloWorld HelloWorldOutput 1 "Hello World"

dsh --assign-to-response "${app1_name}" Homepage HelloWorldRootRequest RootRequests Request

dsh --assign-to-response "${app1_name}" Homepage HelloWorldIndexRequest IndexRequests Request

dsh --assign-to-response "${app1_name}" Homepage HelloWorld HelloWorldOutput OutputComponent

# Define the HelloUniverse App
app2_name="HelloUniverse"
app2_development_port="8420"
app2_production_domain="http://somesite.com"
app2_development_domain="http://localhost:${app2_development_port}"

dsh --new App "${app2_name}" "${app2_production_domain}"

dsh --new Response "${app2_name}" Homepage 0

dsh --new Response "${app2_name}" About 0

dsh --new GlobalResponse "${app2_name}" Menu 1

dsh --new Request "${app2_name}" HelloUniverseRootRequest RootRequests "\/"

dsh --new Request "${app2_name}" HelloUniverseIndexRequest IndexRequests "index.php"

dsh --new Request "${app2_name}" HelloUniverseAboutRequest IndexRequests "index.php?page=about"

dsh --new OutputComponent "${app2_name}" HelloUniverse HelloUniverseOutput 1 "Hello Universe"

dsh --new OutputComponent "${app2_name}" HelloUniverseAbout HelloUniverseOutput 1 "About Hello Universe"

dsh --new OutputComponent "${app2_name}" MainMenu Menus 0 "<div><ul><li><a href='/index.php'>Homepage</a></li><li><a href='/index.php?page=about'>About</a></li></ul></div>"

dsh --assign-to-response "${app2_name}" Homepage HelloUniverseRootRequest RootRequests Request

dsh --assign-to-response "${app2_name}" Homepage HelloUniverseIndexRequest IndexRequests Request

dsh --assign-to-response "${app2_name}" About HelloUniverseAboutRequest IndexRequests Request

dsh --assign-to-response "${app2_name}" Homepage HelloUniverse HelloUniverseOutput OutputComponent

dsh --assign-to-response "${app2_name}" About HelloUniverseAbout HelloUniverseOutput OutputComponent

dsh --assign-to-response "${app2_name}" Menu MainMenu Menus OutputComponent

# Build the Apps
dsh --build-app "${app1_name}" "${app1_development_domain}"

# Start a development server for the Apps
dsh --build-app "${app2_name}" "${app2_development_domain}"

dsh --start-development-server "${app2_development_port}" "${app2_development_domain}"

