#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# If on OpenShift copy webtrends_moodle.js files into place.
#################################################################

if [[ ! -z "${APP_DATA}" ]]; then # If on an OpenShift server.
    # Install WebTrends JavaScript file into place.
    cp php-post-assemble/webtrends_moodle.js $APP_DATA/
fi
