#!/bin/bash

set -o posix


app_name="HelloWorld"
development_port="8420"
production_domain="http://somesite.com"
development_domain="http://localhost:${development_port}"

dsh --new App "${app_name}" "${production_domain}"

dsh --new Response "${app_name}" Homepage 0

dsh --new Request "${app_name}" HelloWorldRootRequest RootRequests "\/"

dsh --new Request "${app_name}" HelloWorldIndexRequest IndexRequests "index.php"

dsh --new OutputComponent "${app_name}" HelloWorld HelloWorldOutput 1 "Hello World"

dsh --assign-to-response "${app_name}" Homepage HelloWorldRootRequest RootRequests Request

dsh --assign-to-response "${app_name}" Homepage HelloWorldIndexRequest IndexRequests Request

dsh --assign-to-response "${app_name}" Homepage HelloWorld HelloWorldOutput OutputComponent

dsh --build-app "${app_name}" "${development_domain}"

dsh --start-development-server "${development_port}" "${development_domain}"



