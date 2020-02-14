#!/bin/bash
#################################################################
# This script will install Moodle, themes and plugins.          #
# Author: Michael Milette - www.tngconsulting.ca                #
#################################################################

#################################################################
# Notes
#################################################################
# Reminder: Use the Origin links for each plugin to check if a there is
#   a specific branch associated with the version of Moodle you are using.

#################################################################
# Set Environment
#################################################################

export DEBUG=0     # Set to 1 to enable debugging, 0 to disable.
if [ $DEBUG -eq 1 ]; then
	set -x  # echo commands as they are executed.
fi
set -e      # break on errorlevel != 0.

export VERSION=38  # Version of Moodle.
if [[ ! -z "${APP_DATA}" ]]; then # If on an OpenShift server.
	# $OPENSHIFT_BUILD_REFERENCE is provided by the OpenShift build invironment.
	echo "OpenShift installation. Using $OPENSHIFT_BUILD_REFERENCE"
    # For GitHub
    export GIT_COMMITTER_NAME=ISED-ISDE
    export GIT_COMMITTER_EMAIL=ised-isde@canada.ca

    # Attempt to make volume writable (TODO: it is currently not too successful).
    echo "Setting umask..."
    echo `umask`
    umask 0002
else # Local build
	if [[ ! -z "$1" ]]; then
		# If a build was specified on the command line.
		OPENSHIFT_BUILD_REFERENCE=$1
		echo "To create that specific build, use the following commands:"
		echo "git checkout $1"
		echo "${BASH_SOURCE[0]}"
		exit /b
	else
		# Otherwise default to Moodle HQ release.
		OPENSHIFT_BUILD_REFERENCE=MOODLE_${VERSION}_STABLE
	fi
	echo "Local installation. Using default version ${VERSION}"
fi

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
		# Create plugin's directory and change into it, saving it in the process.
        mkdir -p $DIRPATH
        pushd $DIRPATH >/dev/null
    fi

    git init

    # Check if a custom branch exists for this site build.
	set +e # Allow exit codes
    git ls-remote --heads --exit-code "$GITURL" "$OPENSHIFT_BUILD_REFERENCE">/dev/null
    if [ $? -eq 0 ]; then
        BRANCH=$OPENSHIFT_BUILD_REFERENCE
    fi
	set -e # Break on exit codes other than 0.

    # Download just the branch we need.
    git remote add -t $BRANCH -f origin $GITURL
    git checkout --quiet origin/$BRANCH

    if [ ! "${DIRPATH}" == "." ]; then
	   # Return back to the origin directory.
       popd >/dev/null
    fi
}

#################################################################
# Install Moodle.
#################################################################

# Installing Moodle
# https://moodle.org/
# Origin: https://github.com/moodle/moodle.git
# Note: Need to clone whole repo in order to include patches.
rm -rf .git
#install_plugin "." "MOODLE_${VERSION}_STABLE" "https://github.com/ised-isde-canada/moodle.git"
#git fetch origin
git clone https://github.com/ised-isde-canada/moodle.git mtemp
(shopt -s dotglob && mv mtemp/* .)
rm mtemp
git checkout "MOODLE_${VERSION}_STABLE"

#################################################################
# Install Moodle plugins - in alphabetical order.
#################################################################

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

#################################################################
# If on OpenShift server, move config.php file into place.
#################################################################
if [[ ! -z "${APP_DATA}" ]]; then # If on an OpenShift server.
    # Copy config.php file into place, .
    cp $APP_DATA/php-post-assemble/config.php $APP_DATA/
else  # Local server
    ROOT="../"
    if [[ ! "${PWD##*/}" =~ ^(www|htdocs|public_html)$ ]]; then ROOT="${ROOT}../" ; fi
    mkdir -p ${ROOT}moodledata/${PWD##*/}
    echo "1) Create a database for the new Moodle site."
    echo "2) Go to your website on http://localhost to begin installation."
fi