#!/bin/bash
#################################################################
# Author: Michael Milette - www.tngconsulting.ca                #
# This script will install patches for Moodle, themes, plugins. #
#################################################################

#################################################################
# Instructions
#################################################################
# Do not run this file directly. See 01-install-moodle.sh

# Parse the major version number from Moodle's own version.php.
export VERSION=$(grep -oE 'branch .* = .*;' version.php | awk -F \' '{print $2}')

echo "Applying patches to ISED's Moodle."
case "$VERSION" in   # Determine branch based on version of Moodle.
    35) # MOODLE 3.5 - Bug fixes until May 2019. Security patches until May 2021.
    ;;
    37) # MOODLE 3.7 - Bug fixes until May 2020. Security patches until November 2020.
		#DONE git cherry-pick origin/MDL-66849-M37 # OutputComponents: Remove custom menu title when not specified.
		#DONE git cherry-pick origin/MDL-68253-M37 # MDL-68253 mod_book: Remove prev arrow on the firstmost page.
		git cherry-pick origin/MDL-63219-M37 # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-66856-M37 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M37 # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-M37 # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-M37 # m37-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-M37 # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-M37 # auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-64969-M37 # auth: Disable autocomplete if rememberusername disabled.
		git cherry-pick origin/MDL-68257-M37 # book: Fix for overlapping text in book table-of-contents.
		git cherry-pick origin/MDL-68337-M37 # theme_boost: Add manual completion checkbox focus indicator.
		git cherry-pick origin/MDL-68765-M37 # auth: Login form has DIV tag with 2 CLASS attributes.
    ;;
    38) # MOODLE 3.8 - Bug fixes until November 2020. Security patches until May 2021.
		#DONE git cherry-pick origin/MDL-66849-M38 # OutputComponents: Remove custom menu title when not specified.
		#DONE git cherry-pick origin/MDL-68253-M38 # MDL-68253 mod_book: Remove prev arrow on the firstmost page.
		git cherry-pick origin/MDL-63219-M38 # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-66856-M38 # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-M38 # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-M38 # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-M38 # m38-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-M38 # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-M38 # auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-64969-M38 # auth: Disable autocomplete if rememberusername disabled.
		git cherry-pick origin/MDL-68257-M38 # book: Fix for overlapping text in book table-of-contents.
		git cherry-pick origin/MDL-68337-M38 # theme_boost: Add manual completion checkbox focus indicator.
		git cherry-pick origin/MDL-68765-M38 # auth: Login form has DIV tag with 2 CLASS attributes.
    ;;
    39) # MOODLE 3.9 X-LTS (master) - Bug fixes until May 2021. Security patches until May 2024. (to be confirmed when launched)
		#DONE git cherry-pick origin/MDL-66849-master # OutputComponents: Remove custom menu title when not specified.
		#DONE git cherry-pick origin/MDL-68253-master # MDL-68253 mod_book: Remove prev arrow on the firstmost page.
		git cherry-pick origin/MDL-63219-master # Add support for filtering in Moodle Custom Menus.
		git cherry-pick origin/MDL-66856-master # Output components: Enable HTML in custom menu.
		git cherry-pick origin/MDL-67554-master # OAuth2: Filtering to Parameters Included in a Login Request.
		git cherry-pick origin/MDL-67802-master # Revert "MDL-66598 tool_oauth2: Make account confirmation required by default.
		git cherry-pick origin/MDL-52810-master # master-MDL-52810 search: Prevent including courses in hidden categories.
		#NOT-READY git cherry-pick origin/MDL-61789-master # MDL-61789 auth_oauth2: Allow admin to choose profile fields for mapping.
		git cherry-pick origin/MDL-61880-master # auth_oauth2: User field mappings, endpoints updated separetely.
		git cherry-pick origin/MDL-64969-master # auth: Disable autocomplete if rememberusername disabled.
		git cherry-pick origin/MDL-68257-master # book: Fix for overlapping text in book table-of-contents.
		git cherry-pick origin/MDL-68337-master # theme_boost: Add manual completion checkbox focus indicator.
		git cherry-pick origin/MDL-68765-master # auth: Login form has DIV tag with 2 CLASS attributes.
    ;;
	# 40) # MOODLE 4.0 (master) - Launch November 2021. (to be confirmed) - Bug fixes until ???. Security patches until ???.
	# ;;
    *) # Unknown branch
		echo "Unknown branch. Create new feature branches or export the VERSION variable first. Exiting without patching..."
        exit 1
    ;;
esac
