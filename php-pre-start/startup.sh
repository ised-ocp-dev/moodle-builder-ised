#!bin/bash
#################################################################
# This script will perform some docker container startup tasks. #
# Author: Michael Milette - www.tngconsulting.ca                #
#################################################################

# Set-up error page in .htaccess.
echo "ErrorDocument 404 ${MOODLE_URL}/theme/gcweb/layout/404.php">>.htaccess
# If URL is on dev-openshift, add robot.txt to discourage search engine crawlers.
if [[ $MOODLE_URL =~ ".ocp-dev." ]]; then
  cp php-pre-start/robots.txt .
fi