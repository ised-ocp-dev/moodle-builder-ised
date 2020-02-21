#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# This script will install patches for Moodle, themes, plugins. #
#################################################################

echo "Applying ISED's Moodle Patches."
case "$VERSION" in   # Determine branch based on version of Moodle.
    37) # MOODLE 3.7
		git cherry-pick origin/MDL-66849-M37 # OutputComponents: Remove custom menu title when not specified
		git cherry-pick origin/MDL-66856-M37 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M37 # OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    38) # MOODLE 3.8
		git cherry-pick origin/MDL-66849-M38 # OutputComponents: Remove custom menu title when not specified
		git cherry-pick origin/MDL-66856-M38 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M38 # OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    39) # MOODLE 3.9 (master)
		git cherry-pick origin/MDL-66849-master # OutputComponents: Remove custom menu title when not specified
		git cherry-pick origin/MDL-66856-master # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-master # OAuth2: Filtering to Parameters Included in a Login Request.
    ;;
    *) # Unknown branch
		echo "Unknown branch. Export the VERSION variable first. Exiting without patching..."
        exit 1
    ;;
esac
