#!bin/bash
#################################################################
# This script will install Moodle themes and plugins into       #
# Openshift or to a local webserver such as XAMPP.              #
# Author: Michael Milette - www.tngconsulting.ca                #
#################################################################

#################################################################
# Instructions
#################################################################
# Do not run this file directly. See 01-install-moodle.sh

#################################################################
# Supporting functions
#################################################################

# Function: install_plugin()
# Purpose: Download and install Moodle plugin files from GitHub repository.
# Syntax: install_plugin directory-path "branch" "GitURL"
install_plugin() {
    # Required arameters
    local DIRPATH="${1}" # Directory path of the plugin. Use "." to install in the current directory.
    local BRANCH="${2}"  # Branch to checkout. Will be overridden if a build branch exists.
    local GITURL="${3}"  # URL of the upstream repo on GitHub.

    if [ ! "${DIRPATH}" == "." ]; then
		# Create plugin's directory and change into it, saving the previous one in the process.
        mkdir -p $DIRPATH
        pushd $DIRPATH >/dev/null
    fi

    # Clone the repo into the current directory.
    # Note: Need to clone whole repo in order to include patches.
    git clone $GITURL .

    # Check if a custom branch exists for this site build.
    if [ -n "$(git branch --list "$OPENSHIFT_BUILD_REFERENCE")" ]; then
        BRANCH=$OPENSHIFT_BUILD_REFERENCE
    fi

    # Checkout the branch we need.
    git checkout $BRANCH

    if [ ! "${DIRPATH}" == "." ]; then
	   # Return back to the origin directory.
       popd >/dev/null
    fi
}

#################################################################
# Install plugins - in alphabetical order.
#################################################################

# Parse the major version number from Moodle's own version.php.
export VERSION=$(grep -oE 'branch .* = .*;' version.php | awk -F \' '{print $2}')

# Activity: Custom certificate
# https://moodle.org/plugins/mod_customcert
# Origin: https://github.com/markn86/moodle-mod_customcert
# Note: Branch based on version of Moodle.
install_plugin "mod/customcert" "MOODLE_${VERSION}_STABLE" "https://github.com/ised-isde-canada/moodle-mod_customcert.git"

# Activity: Sub-Course
# https://moodle.org/plugins/mod_subcourse
# Origin: https://github.com/mudrd8mz/moodle-mod_subcourse
install_plugin "mod/subcourse" "master" "https://github.com/ised-isde-canada/moodle-mod_subcourse.git"

# Availability condition: Restriction by language
# https://moodle.org/plugins/availability_language
# Origin: https://github.com/ewallah/moodle-availability_language
install_plugin "availability/condition/language" "MOODLE_37_STABLE" "https://github.com/ised-isde-canada/moodle-availability_language.git"

# Block: Admin Presets
# https://github.com/DigiDago/moodle-block_admin_presets
# Origin: https://github.com/DigiDago/moodle-block_admin_presets
install_plugin "blocks/admin_presets" "MOODLE_${VERSION}_STABLE" "https://github.com/DigiDago/moodle-block_admin_presets.git"

# Block: Completion Progress
# https://moodle.org/plugins/block_completion_progress
# Origin: https://github.com/deraadt/moodle-block_completion_progress
#install_plugin "blocks/completion_progress" "master" "https://github.com/ised-isde-canada/moodle-block_completion_progress.git"

# Block: Configurable Reports
# https://moodle.org/plugins/block_configurable_reports
# Origin: https://github.com/jleyva/moodle-block_configurablereports
install_plugin "blocks/configurable_reports" "MOODLE_36_STABLE" "https://github.com/ised-isde-canada/moodle-block_configurablereports.git"

# Filters: FilterCodes
# https://moodle.org/plugins/filter_filtercodes
# Origin: https://github.com/michael-milette/moodle-filter_filtercodes
install_plugin "filter/filtercodes" "master" "https://github.com/ised-isde-canada/moodle-filter_filtercodes.git"

# Filters: Multi-Language Content (v2)
# https://moodle.org/plugins/filter_multilang2
# Origin: https://github.com/iarenaza/moodle-filter_multilang2
install_plugin "filter/multilang2" "master" "https://github.com/ised-isde-canada/moodle-filter_multilang2.git"

# Local: Adminer
# https://moodle.org/plugins/local_adminer
# Origin: https://github.com/grabs/moodle-local_adminer
# Note: Branch based on version of Moodle.
case "$VERSION" in   # Determine branch based on version of Moodle.
    35|36|37)
        BRANCH=MOODLE_35_STABLE
    ;;
    *)
        BRANCH=MOODLE_38_STABLE
    ;;
esac
install_plugin "local/adminer" "${BRANCH}" "https://github.com/ised-isde-canada/moodle-local_adminer.git"

# Local: Contact Form
# https://moodle.org/plugins/local_contact
# Origin: https://github.com/michael-milette/moodle-local_contact
install_plugin "local/contact" "master" "https://github.com/ised-isde-canada/moodle-local_contact.git"

# Local: eMail Test
# https://moodle.org/plugins/local_mailtest
# Origin: https://github.com/michael-milette/moodle-local_mailtest
install_plugin "local/mailtest" "master" "https://github.com/ised-isde-canada/moodle-local_mailtest.git"

# Local: ISED-ISDE
# https://github.com/michael-milette/moodle-local_isedisde
# Origin: https://github.com/michael-milette/moodle-local_isedisde
install_plugin "local/isedisde" "master" "https://github.com/ised-isde-canada/moodle-local_isedisde.git"

# Local: Local Login
# https://github.com/michael-milette/moodle-local_login
# Origin: https://github.com/michael-milette/moodle-local_login
install_plugin "local/login" "master" "https://github.com/ised-isde-canada/moodle-local_login.git"

# Report: Ad-hoc database queries
# https://moodle.org/plugins/report_customsql
# Origin: https://github.com/moodleou/moodle-report_customsql
#install_plugin "report/customsql" "master" "https://github.com/ised-isde-canada/moodle-report_customsql.git"

# Theme: WET-BOEW-MOODLE-GCWeb
# https://github.com/michael-milette/moodle-theme_gcweb
# Origin: https://github.com/michael-milette/moodle-theme_gcweb
install_plugin "theme/gcweb" "master" "https://github.com/ised-isde-canada/moodle-theme_gcweb.git"

# Theme: WET-BOEW-MOODLE-GCIntranet
# https://github.com/michael-milette/moodle-theme_gcintranet
# Origin: https://github.com/michael-milette/moodle-theme_gcintranet
#install_plugin "theme/gcintranet" "master" "https://github.com/ised-isde-canada/moodle-theme_gcintranet.git"
