#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# This script will install patches for Moodle, themes, plugins. #
#################################################################

echo "Applying ISED's Moodle Patches."
case "$VERSION" in   # Determine branch based on version of Moodle.
    37) # MOODLE 3.7
		# MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick 06f49fd

		# MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick 7a35d5a

		# MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick a469773
    ;;
    38) # MOODLE 3.8
		# MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick cd11548

		# MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick 4eddce1

		# MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick 72a6db5
    ;;
    39) # MOODLE 3.9
		# MDL-66849 OutputComponents: Remove custom menu title when not specified
		git cherry-pick d166054

		# MDL-66856 Output components: Enable HTML in custom menu.
		git cherry-pick 06cfd4d

		# MDL-67554 OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick e1b71c7
    ;;
    *) # Unknown branch
		echo "Unknown branch. Export the BRANCH variable first. Exiting without patching..."
        exit 0
    ;;
esac
