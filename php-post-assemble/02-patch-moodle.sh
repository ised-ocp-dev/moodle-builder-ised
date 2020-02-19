#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# This script will install patches for Moodle, themes, plugins. #
#################################################################

echo "Applying ISED's Moodle Patches."
case "$VERSION" in   # Determine branch based on version of Moodle.
    37) # MOODLE 3.7
		git cherry-pick 81e426c # MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick 7a35d5a # MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick a469773 # MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    38) # MOODLE 3.8
		git cherry-pick 21524b6 # MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick 4eddce1 # MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick 72a6db5 # MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    39) # MOODLE 3.9 (master)
		git cherry-pick b2701cf # MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick 06cfd4d # MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick e1b71c7 # MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    *) # Unknown branch
		echo "Unknown branch. Export the BRANCH variable first. Exiting without patching..."
        exit 0
    ;;
esac
