#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# Finish/Clean up!
#################################################################
if [ $DEBUG -eq 1 ]; then
    # If debugging, don't deploy.
    echo "Aborting deployment in active debugging mode."
    exit 1
else
    # Cleanup
    rm README.md
    rm -rf ocp
    rm -rf php-post-assemble
    # set 404-Page.
    # Make volume writable.
	chmod -R g+w .
fi

# Remove PHP Composer folders - doesn't make any difference in OpenShift.
#if [ -d "$APP_DATA/vender" ]; then rm -Rf $APP_DATA/vender; fi
#if [ -d "$APP_DATA/node_modules" ]; then rm -Rf $APP_DATA/node_modules; fi
