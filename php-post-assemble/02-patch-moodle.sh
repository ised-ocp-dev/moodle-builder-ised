#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# This script will install patches for Moodle, themes, plugins. #
#################################################################

echo "Applying patches to ISED's Moodle."
case "$VERSION" in   # Determine branch based on version of Moodle.
    37) # MOODLE 3.7
		git cherry-pick origin/MDL-63219-M37 # Add Moodle filters support to Custom Menus.
		git cherry-pick origin/MDL-66849-M37 # OutputComponents: Remove custom menu title when not specified.
		git cherry-pick origin/MDL-66856-M37 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M37 # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-M37 # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-M37 # m37-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-M37 # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-M37 # MDL-61880 auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-63219-M37 # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-68257-M37 # MDL-68257 book: Fix for overlapping text in book table-of-contents.
    ;;
    38) # MOODLE 3.8
		git cherry-pick origin/MDL-63219-M38 # Add Moodle filters support to Custom Menus.
		git cherry-pick origin/MDL-66849-M38 # OutputComponents: Remove custom menu title when not specified.
		git cherry-pick origin/MDL-66856-M38 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M38 # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-M38 # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-M38 # m38-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-M38 # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-M38 # MDL-61880 auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-63219-M38 # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-68257-M38 # MDL-68257 book: Fix for overlapping text in book table-of-contents.
    ;;
    39) # MOODLE 3.9 (master)
		git cherry-pick origin/MDL-63219-master # Add Moodle filters support to Custom Menus.
		git cherry-pick origin/MDL-66849-master # OutputComponents: Remove custom menu title when not specified.
		git cherry-pick origin/MDL-66856-master # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-master # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-master # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-master # master-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-master # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-master # MDL-61880 auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-63219-master # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-68257-master # MDL-68257 book: Fix for overlapping text in book table-of-contents.
    ;;
    *) # Unknown branch
		echo "Unknown branch. Export the VERSION variable first. Exiting without patching..."
        exit 1
    ;;
esac
