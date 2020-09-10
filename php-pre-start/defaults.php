<?php

// This file is part of the WET-BOEW-Moodle (defaults) for Moodle - http://moodle.org/
//
// WET-BOEW-Moodle (defaults) is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// WET-BOEW-Moodle (defaults) is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Default settings for WET-BOEW-Moodle based site.
 *
 * @package   gcweb_defaults
 * @copyright 2016-2020 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

if (is_major_upgrade_required()) {

    echo 'Applying custom defaults to Moodle...<br>' . PHP_EOL;

    // Multi-Language (v2) and FilterCodes filters.
    $filterlist = ['multilang2', 'filtercodes'];

    // GCWeb theme.
    $themename = 'gcweb';

    // French, French Canadian - TODO (for eval?): Install French inclusive and French Workplace language packs.
    $pack = ['fr', 'fr_ca']; //, 'fr_incl', 'fr_wp'];
    $custommenu = '
{fa fa-home} {getstring}home{/getstring}|/?redirect=0
{fa fa-th} {mlang en}Course catalogue{mlang}{mlang fr}Répertoire des cours{mlang}
{categories0menu}
    -###
    -{getstring}fulllistofcourses{/getstring}|/course/
{ifloggedin}
{fa fa-tachometer} {getstring}myhome{/getstring}|/my/
{fa fa-graduation-cap} {getstring}mycourses{/getstring}
{mycoursesmenu}
{/ifloggedin}
{fa fa-question} {getstring}help{/getstring}|/mod/page/view.php?id=97
{ifminteacher}
{fa fa-wrench} {getstring}admin{/getstring}
{/ifminteacher}
{ifmincreator}
-{getstring}administrationsite{/getstring}|/admin/search.php
-{toggleeditingmenu}
-###
{/ifmincreator}
{ifminmanager}
-{getstring}user{/getstring}: {mlang en}Management{mlang}{mlang fr}Gestion{mlang}|/admin/user.php
{ifadmin}
-{getstring}user{/getstring}: {getstring:mnet}profilefields{/getstring}|/user/profile/index.php
-###
{/ifadmin}
-{getstring}course{/getstring}: {mlang en}Management{mlang}{mlang fr}Gestion{mlang}|/course/management.php
-{getstring}course{/getstring}: {getstring}createnew{/getstring}|/course/edit.php?category={categoryid}&returnto=topcat
{/ifminmanager}
{ifminteacher}
-{getstring}course{/getstring}: {getstring}restore{/getstring}|/backup/restorefile.php?contextid={coursecontextid}
{ifincourse}
-{getstring}course{/getstring}: {getstring}backup{/getstring}|/backup/backup.php?id={courseid}
-{getstring}course{/getstring}: {getstring}participants{/getstring}|/user/index.php?id={courseid}
-{getstring}course{/getstring}: {getstring:badges}badges{/getstring}|/badges/index.php?type={courseid}
-{getstring}course{/getstring}: {getstring}reset{/getstring}|/course/reset.php?id={courseid}
-Course: Layoutit|https://www.layoutit.com/build" target="popup" onclick="window.open(\'https://www.layoutit.com/build\',\'popup\',\'width=1340,height=700\'); return false;|Bootstrap Page Builder
{/ifincourse}
{/ifminteacher}
{ifminmanager}
-###
-{getstring}site{/getstring}: System reports|/admin/category.php?category=reports
{/ifminmanager}
{ifadmin}
-{getstring}site{/getstring}: {getstring:admin}additionalhtml{/getstring}|/admin/settings.php?section=additionalhtml
-{getstring}site{/getstring}: {getstring:admin}frontpage{/getstring}|/admin/settings.php?section=frontpagesettings|Including site name
-{getstring}site{/getstring}: {getstring:admin}plugins{/getstring}|/admin/plugins.php
-{getstring}site{/getstring}: {getstring:admin}supportcontact{/getstring}|/admin/settings.php?section=supportcontact
-{getstring}site{/getstring}: {getstring:admin}themesettings{/getstring}|/admin/settings.php?section=themesettings|Including custom menus, designer mode, theme in URL
-{getstring}site{/getstring}: {mlang en}WET-BOEW Theme (GCWeb){mlang}{mlang fr}Theme de la WET-BOEW (GCWeb){mlang}|/admin/settings.php?section=themesettinggcweb
-{getstring}site{/getstring}: {getstring}notifications{/getstring} ({getstring}admin{/getstring})|/admin/index.php
{/ifadmin}
';

    $defaults['moodle']['additionalhtmlfooter'] = '';
    $defaults['moodle']['additionalhtmlhead'] = '';
    $defaults['moodle']['additionalhtmltopofbody'] = '';
    $defaults['moodle']['agedigitalconsentverification'] = '0';
    $defaults['moodle']['allowaccountssameemail'] = '0';
    $defaults['moodle']['allowattachments'] = '1';
    $defaults['moodle']['allowbeforeblock'] = '0';
    $defaults['moodle']['allowblockstodock'] = '0';     // Disbaled.
    $defaults['moodle']['allowcategorythemes'] = '0';   // Disabled.
    $defaults['moodle']['allowcohortthemes'] = '0';
    $defaults['moodle']['allowcoursethemes'] = '0';     // Disabled.
    $defaults['moodle']['allowemojipicker'] = '1';
    $defaults['moodle']['allowframembedding'] = '0';
    $defaults['moodle']['allowguestmymoodle'] = '0';    // Disabled.
    $defaults['moodle']['allowindexing'] = '0';
    $defaults['moodle']['allowobjectembed'] = '0';
    $defaults['moodle']['allowstealth'] = '0';
    $defaults['moodle']['allowthemechangeonurl'] = '0'; // Disabled.
    $defaults['moodle']['allowuserblockhiding'] = '0';  // Disabled.
    $defaults['moodle']['allowusermailcharset'] = '0';
    $defaults['moodle']['allowuserthemes'] = '0';
    $defaults['moodle']['alternateloginurl'] = '/local/isedisde/';
    $defaults['moodle']['alternativefullnameformat'] = 'language';
    $defaults['moodle']['aspellpath'] = '';
    $defaults['moodle']['auth'] = 'oauth2';
    $defaults['moodle']['auth_instructions'] = '';
    $defaults['moodle']['authloginviaemail'] = '1';
    $defaults['moodle']['authpreventaccountcreation'] = '0';
    $defaults['moodle']['autolang'] = '1';
    $defaults['moodle']['autologinguests'] = '1';
    $defaults['moodle']['backup_version'] = '2019111800';
    $defaults['moodle']['badges_allowcoursebadges'] = '1';
    $defaults['moodle']['badges_allowexternalbackpack'] = '1';
    $defaults['moodle']['badges_site_backpack'] = '2';
    $defaults['moodle']['block_course_list_adminview'] = 'all';
    $defaults['moodle']['block_course_list_hideallcourseslink'] = '0';
    $defaults['moodle']['block_html_allowcssclasses'] = '0';
    $defaults['moodle']['block_online_users_onlinestatushiding'] = '1';
    $defaults['moodle']['block_online_users_timetosee'] = '5';
    $defaults['moodle']['block_rss_client_num_entries'] = '5';
    $defaults['moodle']['block_rss_client_timeout'] = '30';
    $defaults['moodle']['blockedip'] = '';
    $defaults['moodle']['bloglevel'] = '4';
    $defaults['moodle']['blogshowcommentscount'] = '1';
    $defaults['moodle']['blogusecomments'] = '1';
    $defaults['moodle']['cachejs'] = '1';
    $defaults['moodle']['cachetemplates'] = '1';
    $defaults['moodle']['calendar_adminseesall'] = '1';
    $defaults['moodle']['calendar_customexport'] = '1';
    $defaults['moodle']['calendar_exportlookahead'] = '365'; // 365 days. Valid values: 365, 180, 150, 120, 90, 60, 30, 5.
    $defaults['moodle']['calendar_exportlookback'] = '5';    // 5 days. Valid values: 365, 180, 150, 120, 90, 60, 30, 5.
    $defaults['moodle']['calendar_lookahead'] = '21';
    $defaults['moodle']['calendar_maxevents'] = '10';
    $defaults['moodle']['calendar_showicalsource'] = '1';
    $defaults['moodle']['calendar_site_timeformat'] = '0';   // Default.
    $defaults['moodle']['calendar_startwday'] = '0';         // Sunday.
    $defaults['moodle']['calendar_weekend'] = '65';
    $defaults['moodle']['calendartype'] = 'gregorian';
    $defaults['moodle']['chat_method'] = 'ajax';
    $defaults['moodle']['chat_normal_updatemode'] = 'jsupdate';
    $defaults['moodle']['chat_old_ping'] = '35';
    $defaults['moodle']['chat_refresh_room'] = '5';
    $defaults['moodle']['chat_refresh_userlist'] = '10';
    $defaults['moodle']['chat_serverip'] = '127.0.0.1';
    $defaults['moodle']['chat_servermax'] = '100';
    $defaults['moodle']['chat_serverport'] = '9111';
    $defaults['moodle']['commentsperpage'] = '15';
    $defaults['moodle']['completiondefault'] = '1';
    $defaults['moodle']['contextlockappliestoadmin'] = '1';
    $defaults['moodle']['contextlocking'] = '0';
    $defaults['moodle']['cookiehttponly'] = '0';
    $defaults['moodle']['cookiesecure'] = '1';
    $defaults['moodle']['country'] = '0';
    $defaults['moodle']['coursecontact'] = '3';
    $defaults['moodle']['coursecontactduplicates'] = '0';
    $defaults['moodle']['coursegraceperiodafter'] = '0';
    $defaults['moodle']['coursegraceperiodbefore'] = '0';
    $defaults['moodle']['courselistshortnames'] = '0';
    $defaults['moodle']['courseoverviewfileslimit'] = '1';
    $defaults['moodle']['courserequestnotify'] = '';
    $defaults['moodle']['coursesperpage'] = '20';
    $defaults['moodle']['courseswithsummarieslimit'] = '10';
    $defaults['moodle']['creatornewroleid'] = '3';
    $defaults['moodle']['cronclionly'] = '0';
    $defaults['moodle']['curlcache'] = '120';
    $defaults['moodle']['curlsecurityallowedport'] = '';
    $defaults['moodle']['curlsecurityblockedhosts'] = '';
    $defaults['moodle']['curltimeoutkbitrate'] = '56';
    $defaults['moodle']['data_enablerssfeeds'] = '0';
    $defaults['moodle']['dbsessions'] = '0';
    $defaults['moodle']['debug'] = '0';
    $defaults['moodle']['debugdisplay'] = '0';
    $defaults['moodle']['debugpageinfo'] = '0';
    $defaults['moodle']['debugstringids'] = '0';
    $defaults['moodle']['debugvalidators'] = '0';
    $defaults['moodle']['defaultcity'] = '';
    $defaults['moodle']['defaultfrontpageroleid'] = '8';
    $defaults['moodle']['defaulthomepage'] = '0';  // 0=Site, 1=My home, 2=User preference
    $defaults['moodle']['defaultpreference_autosubscribe'] = '1';
    $defaults['moodle']['defaultpreference_maildigest'] = '1';
    $defaults['moodle']['defaultpreference_maildisplay'] = '0';
    $defaults['moodle']['defaultpreference_mailformat'] = '1';
    $defaults['moodle']['defaultpreference_trackforums'] = '0';
    $defaults['moodle']['defaultrequestcategory'] = '6';
    $defaults['moodle']['defaultuserroleid'] = '7';
    $defaults['moodle']['deleteincompleteusers'] = '0';
    $defaults['moodle']['deleteunconfirmed'] = '168';
    $defaults['moodle']['denyemailaddresses'] = '';
    $defaults['moodle']['digestmailtime'] = '0';
    $defaults['moodle']['disablegradehistory'] = '0';
    $defaults['moodle']['disableuserimages'] = '1';
    $defaults['moodle']['displayloginfailures'] = '1';
    $defaults['moodle']['dndallowtextandlinks'] = '0';
    $defaults['moodle']['doclang'] = '';
    $defaults['moodle']['docroot'] = 'https://docs.moodle.org';
    $defaults['moodle']['doctonewwindow'] = '1';
    $defaults['moodle']['emailchangeconfirmation'] = '1';
    $defaults['moodle']['emailfromvia'] = '1';
    $defaults['moodle']['emailsubjectprefix'] = '';
    $defaults['moodle']['enableanalytics'] = '1';
    $defaults['moodle']['enableasyncbackup'] = '0';
    $defaults['moodle']['enableavailability'] = '1';
    $defaults['moodle']['enablebadges'] = '0';
    $defaults['moodle']['enableblogs'] = '0';
    $defaults['moodle']['enablecalendarexport'] = '1';
    $defaults['moodle']['enablecompletion'] = '1';
    $defaults['moodle']['enablecourserelativedates'] = '0';
    $defaults['moodle']['enablecourserequests'] = '0';
    $defaults['moodle']['enabledevicedetection'] = '1'; // Enabled.
    $defaults['moodle']['enableglobalsearch'] = '0';
    $defaults['moodle']['enablegravatar'] = '0';
    $defaults['moodle']['enablemobilewebservice'] = '0';
    $defaults['moodle']['enablenotes'] = '0';
    $defaults['moodle']['enableoutcomes'] = '0';        // Disabled.
    $defaults['moodle']['enableplagiarism'] = '0';
    $defaults['moodle']['enableportfolios'] = '0';
    $defaults['moodle']['enablerssfeeds'] = '0';
    $defaults['moodle']['enablesafebrowserintegration'] = '0';
    $defaults['moodle']['enablestats'] = '0';
    $defaults['moodle']['enabletrusttext'] = '0';
    $defaults['moodle']['enablewebservices'] = '0';
    $defaults['moodle']['enablewsdocumentation'] = '0';
    $defaults['moodle']['extendedusernamechars'] = '0';
    $defaults['moodle']['externalblogcrontime'] = '86400';
    $defaults['moodle']['feedback_allowfullanonymous'] = '0';
    $defaults['moodle']['filescleanupperiod'] = '86400';
    $defaults['moodle']['filter_censor_badwords'] = '';
    $defaults['moodle']['filter_multilang_force_old'] = '0';
    $defaults['moodle']['filterall'] = '1';
    $defaults['moodle']['filtermatchoneperpage'] = '0';
    $defaults['moodle']['filtermatchonepertext'] = '0';
    $defaults['moodle']['filteruploadedfiles'] = '0';
    $defaults['moodle']['forceclean'] = '0';
    $defaults['moodle']['forcelogin'] = '0';
    $defaults['moodle']['forceloginforprofileimage'] = '1';
    $defaults['moodle']['forceloginforprofiles'] = '1';
    $defaults['moodle']['forcetimezone'] = '99';
    $defaults['moodle']['forgottenpasswordurl'] = '';
    $defaults['moodle']['formatstringstriptags'] = '1';
    $defaults['moodle']['forum_allowforcedreadtracking'] = '0';
    $defaults['moodle']['forum_cleanreadtime'] = '2';
    $defaults['moodle']['forum_displaymode'] = '3';
    $defaults['moodle']['forum_enablerssfeeds'] = '0';
    $defaults['moodle']['forum_enabletimedposts'] = '1';
    $defaults['moodle']['forum_longpost'] = '600';
    $defaults['moodle']['forum_manydiscussions'] = '100';
    $defaults['moodle']['forum_maxattachments'] = '9';
    $defaults['moodle']['forum_maxbytes'] = '512000';
    $defaults['moodle']['forum_oldpostdays'] = '14';
    $defaults['moodle']['forum_shortpost'] = '300';
    $defaults['moodle']['forum_subscription'] = '0';
    $defaults['moodle']['forum_trackingtype'] = '1';
    $defaults['moodle']['forum_trackreadposts'] = '1';
    $defaults['moodle']['forum_usermarksread'] = '0';
    $defaults['moodle']['frontpage'] = '2,6';
    $defaults['moodle']['frontpagecourselimit'] = '200';
    $defaults['moodle']['frontpageloggedin'] = '2,6';
    $defaults['moodle']['fullnamedisplay'] = 'language';
    $defaults['moodle']['getremoteaddrconf'] = '0';
    $defaults['moodle']['gravatardefaulturl'] = 'mm';
    $defaults['moodle']['groupenrolmentkeypolicy'] = '1';
    $defaults['moodle']['guestloginbutton'] = '1';
    $defaults['moodle']['guestroleid'] = '6';
    $defaults['moodle']['keeptagnamecase'] = '1';
    $defaults['moodle']['lang'] = 'en';
    $defaults['moodle']['langcache'] = '1';
    $defaults['moodle']['langlist'] = 'en,fr_ca';
    $defaults['moodle']['langmenu'] = '1';
    $defaults['moodle']['langstringcache'] = '1';
    $defaults['moodle']['latinexcelexport'] = '1';
    $defaults['moodle']['limitconcurrentlogins'] = '0';
    $defaults['moodle']['linkadmincategories'] = '1';
    $defaults['moodle']['linkcoursesections'] = '1';
    $defaults['moodle']['locale'] = '';
    $defaults['moodle']['lockoutduration'] = '1800';
    $defaults['moodle']['lockoutthreshold'] = '0';
    $defaults['moodle']['lockoutwindow'] = '1800';
    $defaults['moodle']['lockrequestcategory'] = '1';
    $defaults['moodle']['logguests'] = '1';
    $defaults['moodle']['loginpageautofocus'] = '0';
    $defaults['moodle']['loglifetime'] = '0';
    $defaults['moodle']['mailnewline'] = 'LF';
    $defaults['moodle']['maintenance_enabled'] = '0';
    $defaults['moodle']['maintenance_message'] = '<h2 lang="fr"></h2><h2 lang="fr">Ce site est actuellement en maintenance et n\'est donc pas disponible présentement.</h2>';
    $defaults['moodle']['maxbytes'] = '0';
    $defaults['moodle']['maxcategorydepth'] = '2';
    $defaults['moodle']['maxconsecutiveidentchars'] = '0';
    $defaults['moodle']['maxeditingtime'] = '1800';
    $defaults['moodle']['maxexternalblogsperuser'] = '1';
    $defaults['moodle']['maxtimelimit'] = '0';
    $defaults['moodle']['maxusersperpage'] = '100';
    $defaults['moodle']['media_default_height'] = '480';
    $defaults['moodle']['media_default_width'] = '640';
    $defaults['moodle']['media_plugins_sortorder'] = 'videojs,youtube';
    $defaults['moodle']['messageinbound_domain'] = '';
    $defaults['moodle']['messageinbound_enabled'] = '0';
    $defaults['moodle']['messageinbound_host'] = '';
    $defaults['moodle']['messageinbound_hostpass'] = '';
    $defaults['moodle']['messageinbound_hostssl'] = 'ssl';
    $defaults['moodle']['messageinbound_hostuser'] = '';
    $defaults['moodle']['messageinbound_mailbox'] = '';
    $defaults['moodle']['messaging'] = '0';
    $defaults['moodle']['messagingallowemailoverride'] = '0';
    $defaults['moodle']['messagingallusers'] = '0';
    $defaults['moodle']['messagingdefaultpressenter'] = '0';
    $defaults['moodle']['messagingdeleteallnotificationsdelay'] = '2620800';
    $defaults['moodle']['messagingdeletereadnotificationsdelay'] = '604800';
    $defaults['moodle']['minpassworddigits'] = '1';
    $defaults['moodle']['minpasswordlength'] = '8';
    $defaults['moodle']['minpasswordlower'] = '1';
    $defaults['moodle']['minpasswordnonalphanum'] = '1';
    $defaults['moodle']['minpasswordupper'] = '1';
    $defaults['moodle']['mobilecssurl'] = '';
    $defaults['moodle']['modchooserdefault'] = '1';
    $defaults['moodle']['navadduserpostslinks'] = '1';
    $defaults['moodle']['navcourselimit'] = '20';   // 20 courses listed when not enrolled in any courses.
    $defaults['moodle']['navshowallcourses'] = '0'; // Disabled.
    $defaults['moodle']['navshowcategories'] = '1';
    $defaults['moodle']['navshowfrontpagemods'] = '0'; // Show front page activities in the navigation.
    $defaults['moodle']['navshowfullcoursenames'] = '0';
    $defaults['moodle']['navshowmycoursecategories'] = '0';
    $defaults['moodle']['navsortmycourseshiddenlast'] = '1';
    $defaults['moodle']['navsortmycoursessort'] = 'sortorder'; // sortorder, fullname, shortname, idnumber.
    $defaults['moodle']['notifyloginfailures'] = '';
    $defaults['moodle']['notifyloginthreshold'] = '10';
    $defaults['moodle']['notloggedinroleid'] = '6';
    $defaults['moodle']['opentowebcrawlers'] = '0';
    $defaults['moodle']['passwordchangelogout'] = '0';
    $defaults['moodle']['passwordchangetokendeletion'] = '0';
    $defaults['moodle']['passwordpolicy'] = '1';
    $defaults['moodle']['passwordreuselimit'] = '0';
    $defaults['moodle']['pathtodot'] = '';
    $defaults['moodle']['pathtodu'] = '/usr/bin/du';
    $defaults['moodle']['pathtogs'] = '';
    $defaults['moodle']['pathtopython'] = '/usr/bin/python';
    $defaults['moodle']['pathtosassc'] = '';
    $defaults['moodle']['pathtounoconv'] = '/usr/bin/unoconv';
    $defaults['moodle']['perfdebug'] = '7';
    $defaults['moodle']['profilesforenrolledusersonly'] = '1';
    $defaults['moodle']['protectusernames'] = '1';
    $defaults['moodle']['pwresettime'] = '1800';
    $defaults['moodle']['recaptchaprivatekey'] = '';
    $defaults['moodle']['recaptchapublickey'] = '';
    $defaults['moodle']['recovergradesdefault'] = '0';
    $defaults['moodle']['registerauth'] = '';
    $defaults['moodle']['registrationpending'] = '0';
    $defaults['moodle']['rememberusername'] = '0';
    $defaults['moodle']['requestcategoryselection'] = '0';
    $defaults['moodle']['requiremodintro'] = '0';
    $defaults['moodle']['restorernewroleid'] = '3';
    $defaults['moodle']['reverseproxyignore'] = '';
    $defaults['moodle']['rolesactive'] = '1';
    $defaults['moodle']['searchallavailablecourses'] = '0';
    $defaults['moodle']['searchdefaultcategory'] = 'core-all';
    $defaults['moodle']['searchenablecategories'] = '0';
    $defaults['moodle']['searchengine'] = 'simpledb';
    $defaults['moodle']['searchhideallcategory'] = '0';
    $defaults['moodle']['searchincludeallcourses'] = '0';
    $defaults['moodle']['searchindextime'] = '600';
    $defaults['moodle']['searchindexwhendisabled'] = '0';
    $defaults['moodle']['sessioncookie'] = '';
    $defaults['moodle']['sessioncookiedomain'] = '';
    $defaults['moodle']['sessioncookiepath'] = '/';
    $defaults['moodle']['sessiontimeout'] = '14400';
    $defaults['moodle']['showuseridentity'] = 'email';
    $defaults['moodle']['sitedefaultlicense'] = 'allrightsreserved';
    $defaults['moodle']['siteguest'] = '1';
    $defaults['moodle']['sitemailcharset'] = '0';
    $defaults['moodle']['sitepolicy'] = '';
    $defaults['moodle']['sitepolicyguest'] = '';
    $defaults['moodle']['sitepolicyhandler'] = '';
    $defaults['moodle']['slasharguments'] = '1';
    $defaults['moodle']['smtpauthtype'] = 'LOGIN';
    $defaults['moodle']['smtpmaxbulk'] = '2';
    $defaults['moodle']['smtpsecure'] = 'tls';
    $defaults['moodle']['statsfirstrun'] = 'none';
    $defaults['moodle']['statsmaxruntime'] = '0';
    $defaults['moodle']['statsruntimedays'] = '31';
    $defaults['moodle']['statsuserthreshold'] = '0';
    $defaults['moodle']['strictformsrequired'] = '0';
    $defaults['moodle']['supportpage'] = '';
    $defaults['moodle']['task_adhoc_concurrency_limit'] = '3';
    $defaults['moodle']['task_adhoc_max_runtime'] = '1800';
    $defaults['moodle']['task_logmode'] = '1';
    $defaults['moodle']['task_logretainruns'] = '20';
    $defaults['moodle']['task_logretention'] = '2419200';
    $defaults['moodle']['task_logtostdout'] = '1';
    $defaults['moodle']['task_scheduled_concurrency_limit'] = '3';
    $defaults['moodle']['task_scheduled_max_runtime'] = '1800';
    $defaults['moodle']['tempdatafoldercleanup'] = '168';
    $defaults['moodle']['texteditors'] = 'atto,tinymce,textarea';
    $defaults['moodle']['theme'] = 'gcweb';
    $defaults['moodle']['themedesignermode'] = '0';
    $defaults['moodle']['themelist'] = 'gcweb';
    $defaults['moodle']['timezone'] = 'America/Toronto';
    $defaults['moodle']['tokenduration'] = '7257600';
    $defaults['moodle']['unlimitedgrades'] = '0';
    $defaults['moodle']['updateautocheck'] = '0';
    $defaults['moodle']['updatecronoffset'] = '7677';
    $defaults['moodle']['updateminmaturity'] = '200';
    $defaults['moodle']['updatenotifybuilds'] = '0';
    $defaults['moodle']['useblogassociations'] = '1';
    $defaults['moodle']['usecomments'] = '0';
    $defaults['moodle']['useexternalblogs'] = '1';
    $defaults['moodle']['useexternalyui'] = '0';
    $defaults['moodle']['userfiltersdefault'] = 'realname';
    $defaults['moodle']['usesitenameforsitepages'] = '1'; // Enabled.
    $defaults['moodle']['usetags'] = '0';
    $defaults['moodle']['verifychangedemail'] = '1';
    $defaults['moodle']['webserviceprotocols'] = '';
    $defaults['moodle']['yuicomboloading'] = '1';
    $defaults['moodle']['custommenuitems'] = $custommenu; // Moodle custom menu.

    // =================================================================================================
    // =================================================================================================
    // =================================================================================================

    $defaults['analytics']['levelinstitution'] = '';
    $defaults['analytics']['logstore'] = 'logstore_standard';
    $defaults['analytics']['modeinstruction'] = '';
    $defaults['analytics']['modeloutputdir'] = '/data/moodle/models';
    $defaults['analytics']['modeltimelimit'] = '1200';
    $defaults['analytics']['onlycli'] = '1';
    $defaults['analytics']['percentonline'] = '0';
    $defaults['analytics']['predictionsprocessor'] = '\mlbackend_php\processor';
    $defaults['analytics']['typeinstitution'] = '';
    $defaults['areafiles']['enablecourseinstances'] = '0';
    $defaults['areafiles']['enableuserinstances'] = '0';
    $defaults['assign']['allowsubmissionsfromdate'] = '0';
    $defaults['assign']['allowsubmissionsfromdate_adv'] = '';
    $defaults['assign']['allowsubmissionsfromdate_enabled'] = '1';
    $defaults['assign']['alwaysshowdescription'] = '1';
    $defaults['assign']['alwaysshowdescription_adv'] = '';
    $defaults['assign']['alwaysshowdescription_locked'] = '';
    $defaults['assign']['attemptreopenmethod'] = 'none';
    $defaults['assign']['attemptreopenmethod_adv'] = '';
    $defaults['assign']['attemptreopenmethod_locked'] = '';
    $defaults['assign']['blindmarking'] = '0';
    $defaults['assign']['blindmarking_adv'] = '';
    $defaults['assign']['blindmarking_locked'] = '';
    $defaults['assign']['cutoffdate'] = '1209600';
    $defaults['assign']['cutoffdate_adv'] = '';
    $defaults['assign']['cutoffdate_enabled'] = '';
    $defaults['assign']['duedate'] = '604800';
    $defaults['assign']['duedate_adv'] = '';
    $defaults['assign']['duedate_enabled'] = '1';
    $defaults['assign']['feedback_plugin_for_gradebook'] = 'assignfeedback_comments';
    $defaults['assign']['gradingduedate'] = '1209600';
    $defaults['assign']['gradingduedate_adv'] = '';
    $defaults['assign']['gradingduedate_enabled'] = '1';
    $defaults['assign']['hidegrader'] = '0';
    $defaults['assign']['markingallocation'] = '0';
    $defaults['assign']['markingallocation_adv'] = '';
    $defaults['assign']['markingallocation_locked'] = '';
    $defaults['assign']['markingworkflow'] = '0';
    $defaults['assign']['markingworkflow_adv'] = '';
    $defaults['assign']['markingworkflow_locked'] = '';
    $defaults['assign']['maxattempts'] = '-1';
    $defaults['assign']['maxattempts_adv'] = '';
    $defaults['assign']['maxattempts_locked'] = '';
    $defaults['assign']['maxperpage'] = '-1';
    $defaults['assign']['preventsubmissionnotingroup'] = '0';
    $defaults['assign']['preventsubmissionnotingroup_adv'] = '';
    $defaults['assign']['preventsubmissionnotingroup_locked'] = '';
    $defaults['assign']['requireallteammemberssubmit'] = '0';
    $defaults['assign']['requireallteammemberssubmit_adv'] = '';
    $defaults['assign']['requireallteammemberssubmit_locked'] = '';
    $defaults['assign']['requiresubmissionstatement'] = '0';
    $defaults['assign']['requiresubmissionstatement_adv'] = '';
    $defaults['assign']['requiresubmissionstatement_locked'] = '';
    $defaults['assign']['sendlatenotifications'] = '0';
    $defaults['assign']['sendlatenotifications_adv'] = '';
    $defaults['assign']['sendlatenotifications_locked'] = '';
    $defaults['assign']['sendnotifications'] = '0';
    $defaults['assign']['sendnotifications_adv'] = '';
    $defaults['assign']['sendnotifications_locked'] = '';
    $defaults['assign']['sendstudentnotifications'] = '1';
    $defaults['assign']['sendstudentnotifications_adv'] = '';
    $defaults['assign']['sendstudentnotifications_locked'] = '';
    $defaults['assign']['showrecentsubmissions'] = '0';
    $defaults['assign']['submissiondrafts'] = '0';
    $defaults['assign']['submissiondrafts_adv'] = '';
    $defaults['assign']['submissiondrafts_locked'] = '';
    $defaults['assign']['submissionreceipts'] = '1';
    $defaults['assign']['submissionstatement'] = 'This assignment is my own work, except where I have acknowledged the use of the works of other people.';
    $defaults['assign']['submissionstatementteamsubmission'] = 'This submission is the work of my group, except where we have acknowledged the use of the works of other people.';
    $defaults['assign']['submissionstatementteamsubmissionallsubmit'] = 'This submission is my own work as a group member, except where I have acknowledged the use of the works of other people.';
    $defaults['assign']['teamsubmission'] = '0';
    $defaults['assign']['teamsubmission_adv'] = '';
    $defaults['assign']['teamsubmission_locked'] = '';
    $defaults['assign']['teamsubmissiongroupingid'] = '';
    $defaults['assign']['teamsubmissiongroupingid_adv'] = '';
    $defaults['assignfeedback_comments']['default'] = '1';
    $defaults['assignfeedback_comments']['inline'] = '0';
    $defaults['assignfeedback_comments']['inline_adv'] = '';
    $defaults['assignfeedback_comments']['inline_locked'] = '';
    $defaults['assignfeedback_comments']['sortorder'] = '0';
    $defaults['assignfeedback_editpdf']['default'] = '1';
    $defaults['assignfeedback_editpdf']['sortorder'] = '1';
    $defaults['assignfeedback_editpdf']['stamps'] = '';
    $defaults['assignfeedback_file']['default'] = '0';
    $defaults['assignfeedback_file']['sortorder'] = '3';
    $defaults['assignfeedback_offline']['default'] = '0';
    $defaults['assignfeedback_offline']['sortorder'] = '2';
    $defaults['assignsubmission_comments']['sortorder'] = '2';
    $defaults['assignsubmission_file']['default'] = '1';
    $defaults['assignsubmission_file']['filetypes'] = '';
    $defaults['assignsubmission_file']['maxbytes'] = '0';
    $defaults['assignsubmission_file']['maxfiles'] = '20';
    $defaults['assignsubmission_file']['sortorder'] = '1';
    $defaults['assignsubmission_onlinetext']['default'] = '0';
    $defaults['assignsubmission_onlinetext']['sortorder'] = '0';
    $defaults['atto_collapse']['showgroups'] = '5';
    $defaults['atto_recordrtc']['allowedtypes'] = 'both';
    $defaults['atto_recordrtc']['audiobitrate'] = '128000';
    $defaults['atto_recordrtc']['timelimit'] = '120';
    $defaults['atto_recordrtc']['videobitrate'] = '2500000';
    $defaults['atto_table']['allowbackgroundcolour'] = '0';
    $defaults['atto_table']['allowborders'] = '0';
    $defaults['atto_table']['allowwidth'] = '0';
    $defaults['auth_email']['field_lock_address'] = 'unlocked';
    $defaults['auth_email']['field_lock_alternatename'] = 'unlocked';
    $defaults['auth_email']['field_lock_city'] = 'unlocked';
    $defaults['auth_email']['field_lock_country'] = 'unlocked';
    $defaults['auth_email']['field_lock_department'] = 'unlocked';
    $defaults['auth_email']['field_lock_description'] = 'unlocked';
    $defaults['auth_email']['field_lock_email'] = 'unlocked';
    $defaults['auth_email']['field_lock_firstname'] = 'unlocked';
    $defaults['auth_email']['field_lock_firstnamephonetic'] = 'unlocked';
    $defaults['auth_email']['field_lock_idnumber'] = 'unlocked';
    $defaults['auth_email']['field_lock_institution'] = 'unlocked';
    $defaults['auth_email']['field_lock_lang'] = 'unlocked';
    $defaults['auth_email']['field_lock_lastname'] = 'unlocked';
    $defaults['auth_email']['field_lock_lastnamephonetic'] = 'unlocked';
    $defaults['auth_email']['field_lock_middlename'] = 'unlocked';
    $defaults['auth_email']['field_lock_phone1'] = 'unlocked';
    $defaults['auth_email']['field_lock_phone2'] = 'unlocked';
    $defaults['auth_email']['field_lock_url'] = 'unlocked';
    $defaults['auth_email']['recaptcha'] = '0';
    $defaults['auth_manual']['expiration'] = '0';
    $defaults['auth_manual']['expiration_warning'] = '0';
    $defaults['auth_manual']['expirationtime'] = '30';
    $defaults['auth_manual']['field_lock_address'] = 'unlocked';
    $defaults['auth_manual']['field_lock_alternatename'] = 'unlocked';
    $defaults['auth_manual']['field_lock_city'] = 'unlocked';
    $defaults['auth_manual']['field_lock_country'] = 'unlocked';
    $defaults['auth_manual']['field_lock_department'] = 'unlocked';
    $defaults['auth_manual']['field_lock_description'] = 'unlocked';
    $defaults['auth_manual']['field_lock_email'] = 'unlocked';
    $defaults['auth_manual']['field_lock_firstname'] = 'unlocked';
    $defaults['auth_manual']['field_lock_firstnamephonetic'] = 'unlocked';
    $defaults['auth_manual']['field_lock_idnumber'] = 'unlocked';
    $defaults['auth_manual']['field_lock_institution'] = 'unlocked';
    $defaults['auth_manual']['field_lock_lang'] = 'unlocked';
    $defaults['auth_manual']['field_lock_lastname'] = 'unlocked';
    $defaults['auth_manual']['field_lock_lastnamephonetic'] = 'unlocked';
    $defaults['auth_manual']['field_lock_middlename'] = 'unlocked';
    $defaults['auth_manual']['field_lock_phone1'] = 'unlocked';
    $defaults['auth_manual']['field_lock_phone2'] = 'unlocked';
    $defaults['auth_manual']['field_lock_url'] = 'unlocked';
    $defaults['auth_none']['field_lock_address'] = 'unlocked';
    $defaults['auth_none']['field_lock_alternatename'] = 'unlocked';
    $defaults['auth_none']['field_lock_city'] = 'unlocked';
    $defaults['auth_none']['field_lock_country'] = 'unlocked';
    $defaults['auth_none']['field_lock_department'] = 'unlocked';
    $defaults['auth_none']['field_lock_description'] = 'unlocked';
    $defaults['auth_none']['field_lock_email'] = 'unlocked';
    $defaults['auth_none']['field_lock_firstname'] = 'unlocked';
    $defaults['auth_none']['field_lock_firstnamephonetic'] = 'unlocked';
    $defaults['auth_none']['field_lock_idnumber'] = 'unlocked';
    $defaults['auth_none']['field_lock_institution'] = 'unlocked';
    $defaults['auth_none']['field_lock_lang'] = 'unlocked';
    $defaults['auth_none']['field_lock_lastname'] = 'unlocked';
    $defaults['auth_none']['field_lock_lastnamephonetic'] = 'unlocked';
    $defaults['auth_none']['field_lock_middlename'] = 'unlocked';
    $defaults['auth_none']['field_lock_phone1'] = 'unlocked';
    $defaults['auth_none']['field_lock_phone2'] = 'unlocked';
    $defaults['auth_none']['field_lock_url'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_address'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_alternatename'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_city'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_country'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_department'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_description'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_email'] = 'locked';
    $defaults['auth_oauth2']['field_lock_firstname'] = 'locked';
    $defaults['auth_oauth2']['field_lock_firstnamephonetic'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_idnumber'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_institution'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_lang'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_lastname'] = 'locked';
    $defaults['auth_oauth2']['field_lock_lastnamephonetic'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_middlename'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_phone1'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_phone2'] = 'unlocked';
    $defaults['auth_oauth2']['field_lock_url'] = 'unlocked';
    $defaults['backup']['backup_async_message'] = 'Hi {user_firstname},<br/> Your {operation} (ID: {backupid}) has completed successfully. <br/><br/>You can access it here: {link}.';
    $defaults['backup']['backup_async_message_subject'] = 'Moodle {operation} completed successfully';
    $defaults['backup']['backup_async_message_users'] = '0';
    $defaults['backup']['backup_auto_active'] = '1';
    $defaults['backup']['backup_auto_activities'] = '1';
    $defaults['backup']['backup_auto_badges'] = '1';
    $defaults['backup']['backup_auto_blocks'] = '1';
    $defaults['backup']['backup_auto_calendarevents'] = '1';
    $defaults['backup']['backup_auto_comments'] = '1';
    $defaults['backup']['backup_auto_competencies'] = '1';
    $defaults['backup']['backup_auto_delete_days'] = '0';
    $defaults['backup']['backup_auto_destination'] = '/data/moodle/mbackups';
    $defaults['backup']['backup_auto_files'] = '1';
    $defaults['backup']['backup_auto_filters'] = '1';
    $defaults['backup']['backup_auto_groups'] = '1';
    $defaults['backup']['backup_auto_histories'] = '1';
    $defaults['backup']['backup_auto_hour'] = '3';
    $defaults['backup']['backup_auto_logs'] = '1';
    $defaults['backup']['backup_auto_max_kept'] = '30';
    $defaults['backup']['backup_auto_min_kept'] = '0';
    $defaults['backup']['backup_auto_minute'] = '0';
    $defaults['backup']['backup_auto_questionbank'] = '1';
    $defaults['backup']['backup_auto_role_assignments'] = '1';
    $defaults['backup']['backup_auto_skip_hidden'] = '0';
    $defaults['backup']['backup_auto_skip_modif_days'] = '30';
    $defaults['backup']['backup_auto_skip_modif_prev'] = '1';
    $defaults['backup']['backup_auto_storage'] = '2';
    $defaults['backup']['backup_auto_users'] = '1';
    $defaults['backup']['backup_auto_userscompletion'] = '1';
    $defaults['backup']['backup_auto_weekdays'] = '1111111';
    $defaults['backup']['backup_general_activities'] = '1';
    $defaults['backup']['backup_general_activities_locked'] = '';
    $defaults['backup']['backup_general_anonymize'] = '0';
    $defaults['backup']['backup_general_anonymize_locked'] = '';
    $defaults['backup']['backup_general_badges'] = '1';
    $defaults['backup']['backup_general_badges_locked'] = '';
    $defaults['backup']['backup_general_blocks'] = '1';
    $defaults['backup']['backup_general_blocks_locked'] = '';
    $defaults['backup']['backup_general_calendarevents'] = '1';
    $defaults['backup']['backup_general_calendarevents_locked'] = '';
    $defaults['backup']['backup_general_comments'] = '1';
    $defaults['backup']['backup_general_comments_locked'] = '';
    $defaults['backup']['backup_general_competencies'] = '1';
    $defaults['backup']['backup_general_competencies_locked'] = '';
    $defaults['backup']['backup_general_files'] = '1';
    $defaults['backup']['backup_general_files_locked'] = '';
    $defaults['backup']['backup_general_filters'] = '1';
    $defaults['backup']['backup_general_filters_locked'] = '';
    $defaults['backup']['backup_general_groups'] = '1';
    $defaults['backup']['backup_general_groups_locked'] = '';
    $defaults['backup']['backup_general_histories'] = '0';
    $defaults['backup']['backup_general_histories_locked'] = '';
    $defaults['backup']['backup_general_logs'] = '0';
    $defaults['backup']['backup_general_logs_locked'] = '';
    $defaults['backup']['backup_general_questionbank'] = '1';
    $defaults['backup']['backup_general_questionbank_locked'] = '';
    $defaults['backup']['backup_general_role_assignments'] = '1';
    $defaults['backup']['backup_general_role_assignments_locked'] = '';
    $defaults['backup']['backup_general_users'] = '1';
    $defaults['backup']['backup_general_users_locked'] = '';
    $defaults['backup']['backup_general_userscompletion'] = '1';
    $defaults['backup']['backup_general_userscompletion_locked'] = '';
    $defaults['backup']['backup_import_activities'] = '1';
    $defaults['backup']['backup_import_activities_locked'] = '';
    $defaults['backup']['backup_import_blocks'] = '1';
    $defaults['backup']['backup_import_blocks_locked'] = '';
    $defaults['backup']['backup_import_calendarevents'] = '1';
    $defaults['backup']['backup_import_calendarevents_locked'] = '';
    $defaults['backup']['backup_import_competencies'] = '1';
    $defaults['backup']['backup_import_competencies_locked'] = '';
    $defaults['backup']['backup_import_filters'] = '1';
    $defaults['backup']['backup_import_filters_locked'] = '';
    $defaults['backup']['backup_import_groups'] = '1';
    $defaults['backup']['backup_import_groups_locked'] = '';
    $defaults['backup']['backup_import_questionbank'] = '1';
    $defaults['backup']['backup_import_questionbank_locked'] = '';
    $defaults['backup']['backup_shortname'] = '1';
    $defaults['backup']['import_general_duplicate_admin_allowed'] = '0';
    $defaults['backup']['import_general_maxresults'] = '10';
    $defaults['backup']['loglifetime'] = '30';
    $defaults['block_activity_results']['config_decimalpoints'] = '2';
    $defaults['block_activity_results']['config_decimalpoints_locked'] = '';
    $defaults['block_activity_results']['config_gradeformat'] = '1';
    $defaults['block_activity_results']['config_gradeformat_locked'] = '';
    $defaults['block_activity_results']['config_nameformat'] = '1';
    $defaults['block_activity_results']['config_nameformat_locked'] = '';
    $defaults['block_activity_results']['config_showbest'] = '3';
    $defaults['block_activity_results']['config_showbest_locked'] = '';
    $defaults['block_activity_results']['config_showworst'] = '0';
    $defaults['block_activity_results']['config_showworst_locked'] = '';
    $defaults['block_activity_results']['config_usegroups'] = '0';
    $defaults['block_activity_results']['config_usegroups_locked'] = '';
    $defaults['block_configurable_reports']['cron_hour'] = '0';
    $defaults['block_configurable_reports']['cron_minute'] = '0';
    $defaults['block_configurable_reports']['crrepository'] = 'jleyva/moodle-configurable_reports_repository';
    $defaults['block_configurable_reports']['dbhost'] = '';
    $defaults['block_configurable_reports']['dbname'] = '';
    $defaults['block_configurable_reports']['dbpass'] = '';
    $defaults['block_configurable_reports']['dbuser'] = '';
    $defaults['block_configurable_reports']['reportlimit'] = '5000';
    $defaults['block_configurable_reports']['reporttableui'] = 'datatables';
    $defaults['block_configurable_reports']['sharedsqlrepository'] = 'jleyva/moodle-custom_sql_report_queries';
    $defaults['block_configurable_reports']['sqlsecurity'] = '1';
    $defaults['block_configurable_reports']['sqlsyntaxhighlight'] = '1';
    $defaults['block_myoverview']['customfiltergrouping'] = '';
    $defaults['block_myoverview']['displaycategories'] = '1';
    $defaults['block_myoverview']['displaygroupingall'] = '1';
    $defaults['block_myoverview']['displaygroupingallincludinghidden'] = '0';
    $defaults['block_myoverview']['displaygroupingcustomfield'] = '0';
    $defaults['block_myoverview']['displaygroupingfuture'] = '1';
    $defaults['block_myoverview']['displaygroupinghidden'] = '1';
    $defaults['block_myoverview']['displaygroupinginprogress'] = '1';
    $defaults['block_myoverview']['displaygroupingpast'] = '1';
    $defaults['block_myoverview']['displaygroupingstarred'] = '1';
    $defaults['block_myoverview']['layouts'] = 'card,list,summary';
    $defaults['block_recentlyaccessedcourses']['displaycategories'] = '1';
    $defaults['block_starredcourses']['displaycategories'] = '1';
    $defaults['core_admin']['logo'] = '';
    $defaults['core_admin']['logocompact'] = '';
    $defaults['core_competency']['enabled'] = '0';
    $defaults['core_competency']['pushcourseratingstouserplans'] = '1';
    $defaults['editor_atto']['autosavefrequency'] = '60';
    $defaults['editor_atto']['toolbar'] = 'collapse = collapse
style1 = title, bold, italic
list = unorderedlist, orderedlist
links = link
files = image, media, recordrtc, managefiles, h5p
style2 = underline, strike, subscript, superscript
align = align
indent = indent
insert = equation, charmap, table, clear
undo = undo
accessibility = accessibilitychecker, accessibilityhelper
other = html';
    $defaults['enrol_guest']['requirepassword'] = '0';
    $defaults['enrol_guest']['showhint'] = '0';
    $defaults['enrol_guest']['status'] = '1';
    $defaults['enrol_guest']['status_adv'] = '';
    $defaults['enrol_guest']['usepasswordpolicy'] = '0';
    $defaults['enrol_self']['sendcoursewelcomemessage'] = '3';
    $defaults['filter_displayh5p']['allowedsources'] = '';
    $defaults['filter_filtercodes']['disabled_customnav'] = '0';
    $defaults['filter_filtercodes']['enable_customnav'] = '0';
    $defaults['filter_filtercodes']['enable_scrape'] = '0';
    $defaults['filter_filtercodes']['escapebraces'] = '1';
    $defaults['filter_urltolink']['embedimages'] = '1';
    $defaults['filter_urltolink']['formats'] = '0';
    $defaults['folder']['maxsizetodownload'] = '0';
    $defaults['folder']['showexpanded'] = '1';
    $defaults['format_singleactivity']['activitytype'] = 'page';
    $defaults['local_adminer']['startwithdb'] = '0';
    $defaults['local_contact']['loginrequired'] = '0';
    $defaults['local_contact']['nosubjectsitename'] = '0';
    $defaults['local_contact']['senderaddress'] = '';
    $defaults['logstore_standard']['loglifetime'] = '60';
    $defaults['media_videojs']['audiocssclass'] = 'video-js';
    $defaults['media_videojs']['limitsize'] = '1';
    $defaults['media_videojs']['rtmp'] = '0';
    $defaults['media_videojs']['useflash'] = '0';
    $defaults['media_videojs']['videocssclass'] = 'video-js';
    $defaults['media_videojs']['youtube'] = '1';
    $defaults['mod_lesson']['activitylink'] = '';
    $defaults['mod_lesson']['activitylink_adv'] = '1';
    $defaults['mod_lesson']['customscoring'] = '1';
    $defaults['mod_lesson']['customscoring_adv'] = '1';
    $defaults['mod_lesson']['defaultfeedback'] = '0';
    $defaults['mod_lesson']['defaultfeedback_adv'] = '1';
    $defaults['mod_lesson']['defaultnextpage'] = '0';
    $defaults['mod_lesson']['defaultnextpage_adv'] = '1';
    $defaults['mod_lesson']['displayleftif'] = '0';
    $defaults['mod_lesson']['displayleftif_adv'] = '1';
    $defaults['mod_lesson']['displayleftmenu'] = '0';
    $defaults['mod_lesson']['displayleftmenu_adv'] = '';
    $defaults['mod_lesson']['displayreview'] = '0';
    $defaults['mod_lesson']['displayreview_adv'] = '';
    $defaults['mod_lesson']['handlingofretakes'] = '0';
    $defaults['mod_lesson']['handlingofretakes_adv'] = '1';
    $defaults['mod_lesson']['maxanswers'] = '5';
    $defaults['mod_lesson']['maxanswers_adv'] = '1';
    $defaults['mod_lesson']['maximumnumberofattempts'] = '1';
    $defaults['mod_lesson']['maximumnumberofattempts_adv'] = '';
    $defaults['mod_lesson']['mediaclose'] = '0';
    $defaults['mod_lesson']['mediafile'] = '';
    $defaults['mod_lesson']['mediafile_adv'] = '1';
    $defaults['mod_lesson']['mediaheight'] = '480';
    $defaults['mod_lesson']['mediawidth'] = '640';
    $defaults['mod_lesson']['minimumnumberofquestions'] = '0';
    $defaults['mod_lesson']['minimumnumberofquestions_adv'] = '1';
    $defaults['mod_lesson']['modattempts'] = '0';
    $defaults['mod_lesson']['modattempts_adv'] = '';
    $defaults['mod_lesson']['numberofpagestoshow'] = '1';
    $defaults['mod_lesson']['numberofpagestoshow_adv'] = '1';
    $defaults['mod_lesson']['ongoing'] = '0';
    $defaults['mod_lesson']['ongoing_adv'] = '1';
    $defaults['mod_lesson']['password'] = '0';
    $defaults['mod_lesson']['password_adv'] = '1';
    $defaults['mod_lesson']['practice'] = '0';
    $defaults['mod_lesson']['practice_adv'] = '';
    $defaults['mod_lesson']['progressbar'] = '0';
    $defaults['mod_lesson']['progressbar_adv'] = '';
    $defaults['mod_lesson']['retakesallowed'] = '0';
    $defaults['mod_lesson']['retakesallowed_adv'] = '';
    $defaults['mod_lesson']['slideshow'] = '0';
    $defaults['mod_lesson']['slideshow_adv'] = '1';
    $defaults['mod_lesson']['slideshowbgcolor'] = '#FFFFFF';
    $defaults['mod_lesson']['slideshowheight'] = '480';
    $defaults['mod_lesson']['slideshowwidth'] = '640';
    $defaults['mod_lesson']['timelimit'] = '0';
    $defaults['mod_lesson']['timelimit_adv'] = '';
    $defaults['moodlecourse']['coursedisplay'] = '0';
    $defaults['moodlecourse']['courseduration'] = '31536000';
    $defaults['moodlecourse']['courseenddateenabled'] = '0';
    $defaults['moodlecourse']['enablecompletion'] = '1';
    $defaults['moodlecourse']['format'] = 'topics';
    $defaults['moodlecourse']['groupmode'] = '0';
    $defaults['moodlecourse']['groupmodeforce'] = '0';
    $defaults['moodlecourse']['hiddensections'] = '1';
    $defaults['moodlecourse']['lang'] = '';
    $defaults['moodlecourse']['maxbytes'] = '0';
    $defaults['moodlecourse']['maxsections'] = '52';
    $defaults['moodlecourse']['newsitems'] = '5';
    $defaults['moodlecourse']['numsections'] = '4';
    $defaults['moodlecourse']['showgrades'] = '0';
    $defaults['moodlecourse']['showreports'] = '0';
    $defaults['moodlecourse']['visible'] = '0';
    $defaults['page']['display'] = '5';
    $defaults['page']['displayoptions'] = '5';
    $defaults['page']['popupheight'] = '450';
    $defaults['page']['popupwidth'] = '620';
    $defaults['page']['printheading'] = '1';
    $defaults['page']['printintro'] = '0';
    $defaults['page']['printlastmodified'] = '1';
    $defaults['question']['ddimageortext_disabled'] = '1';
    $defaults['question']['disabledbehaviours'] = 'manualgraded';
    $defaults['question_preview']['behaviour'] = 'deferredfeedback';
    $defaults['question_preview']['correctness'] = '1';
    $defaults['question_preview']['feedback'] = '1';
    $defaults['question_preview']['generalfeedback'] = '1';
    $defaults['question_preview']['history'] = '0';
    $defaults['question_preview']['markdp'] = '2';
    $defaults['question_preview']['marks'] = '2';
    $defaults['question_preview']['rightanswer'] = '1';
    $defaults['quiz']['attemptonlast'] = '0';
    $defaults['quiz']['attemptonlast_adv'] = '1';
    $defaults['quiz']['attempts'] = '0';
    $defaults['quiz']['attempts_adv'] = '';
    $defaults['quiz']['autosaveperiod'] = '60';
    $defaults['quiz']['browsersecurity'] = '-';
    $defaults['quiz']['browsersecurity_adv'] = '1';
    $defaults['quiz']['canredoquestions'] = '0';
    $defaults['quiz']['canredoquestions_adv'] = '1';
    $defaults['quiz']['decimalpoints'] = '2';
    $defaults['quiz']['decimalpoints_adv'] = '';
    $defaults['quiz']['delay1'] = '0';
    $defaults['quiz']['delay1_adv'] = '1';
    $defaults['quiz']['delay2'] = '0';
    $defaults['quiz']['delay2_adv'] = '1';
    $defaults['quiz']['graceperiod'] = '86400';
    $defaults['quiz']['graceperiod_adv'] = '';
    $defaults['quiz']['graceperiodmin'] = '60';
    $defaults['quiz']['grademethod'] = '1';
    $defaults['quiz']['grademethod_adv'] = '';
    $defaults['quiz']['initialnumfeedbacks'] = '2';
    $defaults['quiz']['maximumgrade'] = '10';
    $defaults['quiz']['navmethod'] = 'free';
    $defaults['quiz']['navmethod_adv'] = '1';
    $defaults['quiz']['overduehandling'] = 'autosubmit';
    $defaults['quiz']['overduehandling_adv'] = '';
    $defaults['quiz']['password'] = '';
    $defaults['quiz']['password_adv'] = '';
    $defaults['quiz']['preferredbehaviour'] = 'deferredfeedback';
    $defaults['quiz']['questiondecimalpoints'] = '-1';
    $defaults['quiz']['questiondecimalpoints_adv'] = '1';
    $defaults['quiz']['questionsperpage'] = '1';
    $defaults['quiz']['questionsperpage_adv'] = '';
    $defaults['quiz']['reviewattempt'] = '69904';
    $defaults['quiz']['reviewcorrectness'] = '69904';
    $defaults['quiz']['reviewgeneralfeedback'] = '69904';
    $defaults['quiz']['reviewmarks'] = '69904';
    $defaults['quiz']['reviewoverallfeedback'] = '4368';
    $defaults['quiz']['reviewrightanswer'] = '69904';
    $defaults['quiz']['reviewspecificfeedback'] = '69904';
    $defaults['quiz']['showblocks'] = '0';
    $defaults['quiz']['showblocks_adv'] = '1';
    $defaults['quiz']['showuserpicture'] = '0';
    $defaults['quiz']['showuserpicture_adv'] = '';
    $defaults['quiz']['shuffleanswers'] = '1';
    $defaults['quiz']['shuffleanswers_adv'] = '';
    $defaults['quiz']['subnet'] = '';
    $defaults['quiz']['subnet_adv'] = '1';
    $defaults['quiz']['timelimit'] = '0';
    $defaults['quiz']['timelimit_adv'] = '';
    $defaults['scorm']['allowaicchacp'] = '0';
    $defaults['scorm']['allowapidebug'] = '0';
    $defaults['scorm']['allowtypeexternal'] = '0';
    $defaults['scorm']['allowtypeexternalaicc'] = '0';
    $defaults['scorm']['allowtypelocalsync'] = '0';
    $defaults['scorm']['apidebugmask'] = '.*';
    $defaults['scorm']['auto'] = '0';
    $defaults['scorm']['autocommit'] = '0';
    $defaults['scorm']['collapsetocwinsize'] = '767';
    $defaults['scorm']['collapsetocwinsize_adv'] = '1';
    $defaults['scorm']['directories'] = '0';
    $defaults['scorm']['displayactivityname'] = '1';
    $defaults['scorm']['displayattemptstatus'] = '1';
    $defaults['scorm']['displayattemptstatus_adv'] = '';
    $defaults['scorm']['displaycoursestructure'] = '0';
    $defaults['scorm']['displaycoursestructure_adv'] = '';
    $defaults['scorm']['forcecompleted'] = '0';
    $defaults['scorm']['forcejavascript'] = '1';
    $defaults['scorm']['forcenewattempt'] = '0';
    $defaults['scorm']['frameheight'] = '500';
    $defaults['scorm']['frameheight_adv'] = '1';
    $defaults['scorm']['framewidth'] = '100';
    $defaults['scorm']['framewidth_adv'] = '1';
    $defaults['scorm']['grademethod'] = '1';
    $defaults['scorm']['hidebrowse'] = '0';
    $defaults['scorm']['hidebrowse_adv'] = '1';
    $defaults['scorm']['hidetoc'] = '0';
    $defaults['scorm']['hidetoc_adv'] = '1';
    $defaults['scorm']['lastattemptlock'] = '0';
    $defaults['scorm']['location'] = '0';
    $defaults['scorm']['masteryoverride'] = '1';
    $defaults['scorm']['maxattempt'] = '0';
    $defaults['scorm']['maxgrade'] = '100';
    $defaults['scorm']['menubar'] = '0';
    $defaults['scorm']['nav'] = '1';
    $defaults['scorm']['nav_adv'] = '1';
    $defaults['scorm']['navpositionleft'] = '-100';
    $defaults['scorm']['navpositionleft_adv'] = '1';
    $defaults['scorm']['navpositiontop'] = '-100';
    $defaults['scorm']['navpositiontop_adv'] = '1';
    $defaults['scorm']['popup'] = '0';
    $defaults['scorm']['popup_adv'] = '';
    $defaults['scorm']['protectpackagedownloads'] = '0';
    $defaults['scorm']['scormstandard'] = '0';
    $defaults['scorm']['scrollbars'] = '0';
    $defaults['scorm']['skipview'] = '0';
    $defaults['scorm']['skipview_adv'] = '1';
    $defaults['scorm']['status'] = '0';
    $defaults['scorm']['toolbar'] = '0';
    $defaults['scorm']['updatefreq'] = '0';
    $defaults['scorm']['whatgrade'] = '0';
    $defaults['scorm']['winoptgrp_adv'] = '1';
    $defaults['theme_gcweb']['cardaspect'] = '0.5';
    $defaults['theme_gcweb']['cardbutton'] = 'btn-link';
    $defaults['theme_gcweb']['cardcategory'] = '1';
    $defaults['theme_gcweb']['cardcontacts'] = '1';
    $defaults['theme_gcweb']['cardcustomfields'] = '1';
    $defaults['theme_gcweb']['cardfooter'] = '0';
    $defaults['theme_gcweb']['cardheader'] = '0';
    $defaults['theme_gcweb']['cardimage'] = '1';
    $defaults['theme_gcweb']['cardprogress'] = '1';
    $defaults['theme_gcweb']['cardsummary'] = '0';
    $defaults['theme_gcweb']['confirmlogout'] = '0';
    $defaults['theme_gcweb']['courselistcolumns'] = '3';
    $defaults['theme_gcweb']['courselistlayout'] = '1';
    $defaults['theme_gcweb']['filtercoursesbylang'] = '0';
    $defaults['theme_gcweb']['filtercoursesbytag'] = '';
    $defaults['theme_gcweb']['footershowhomelink'] = '0';
    $defaults['theme_gcweb']['footershowlogininfo'] = '0';
    $defaults['theme_gcweb']['footershowmoodledocs'] = '1';
    $defaults['theme_gcweb']['footershowmoodlelogo'] = '0';
    $defaults['theme_gcweb']['footershowresetusertours'] = '0';
    $defaults['theme_gcweb']['footnote'] = '{mlang en}<li><a href="https://www.canada.ca/en/contact.html">Contact us</a></li><li><a href="https://www.canada.ca/en/transparency/terms.html">Terms and conditions</a></li><li><a href="https://www.canada.ca/en/transparency/privacy.html">Privacy</a></li>{mlang}{mlang fr}<li><a href="https://www.canada.ca/fr/contact.html">Contactez-nous</a></li><li><a href="https://www.canada.ca/fr/transparence/avis.html">Avis</a></li><li><a href="https://www.canada.ca/fr/transparence/confidentialite.html">Confidentialité</a></li>{mlang}';
    $defaults['theme_gcweb']['hideconditionallyhidden'] = '1';
    $defaults['theme_gcweb']['hidefrontpagelinkstopages'] = '1';
    $defaults['theme_gcweb']['hidelocallogin'] = '1';
    $defaults['theme_gcweb']['hometitle'] = '';
    $defaults['theme_gcweb']['init'] = '1';
    $defaults['theme_gcweb']['navdraweropen'] = '';
    $defaults['theme_gcweb']['prebreadcrumbs'] = '';
    $defaults['theme_gcweb']['problembuttonurl'] = 'https://learning-apprentissage.ised-isde.canada.ca/mod/page/view.php?id=100';
    $defaults['theme_gcweb']['scsspre'] = '';
    $defaults['theme_gcweb']['showaccountsettings'] = '1';
    $defaults['theme_gcweb']['showhomebreadcrumbs'] = '0';
    $defaults['theme_gcweb']['showhometitle'] = '0';
    $defaults['theme_gcweb']['shownavdrawer'] = '1';
    $defaults['theme_gcweb']['showproblem'] = '1';
    $defaults['theme_gcweb']['showprofileadditionalnames'] = '0';
    $defaults['theme_gcweb']['showprofileaddress'] = '0';
    $defaults['theme_gcweb']['showprofileaimid'] = '0';
    $defaults['theme_gcweb']['showprofilecity'] = '1';
    $defaults['theme_gcweb']['showprofilecountry'] = '1';
    $defaults['theme_gcweb']['showprofiledepartment'] = '0';
    $defaults['theme_gcweb']['showprofiledescription'] = '1';
    $defaults['theme_gcweb']['showprofileemaildisplay'] = '1';
    $defaults['theme_gcweb']['showprofileicqnumber'] = '0';
    $defaults['theme_gcweb']['showprofileidnumber'] = '0';
    $defaults['theme_gcweb']['showprofileinstitution'] = '0';
    $defaults['theme_gcweb']['showprofileinterests'] = '0';
    $defaults['theme_gcweb']['showprofilemsnid'] = '0';
    $defaults['theme_gcweb']['showprofileoptional'] = '0';
    $defaults['theme_gcweb']['showprofilephone1'] = '0';
    $defaults['theme_gcweb']['showprofilephone2'] = '0';
    $defaults['theme_gcweb']['showprofilepictureofuser'] = '0';
    $defaults['theme_gcweb']['showprofileskypeid'] = '0';
    $defaults['theme_gcweb']['showprofiletimezone'] = '1';
    $defaults['theme_gcweb']['showprofilewebpage'] = '0';
    $defaults['theme_gcweb']['showprofileyahooid'] = '0';
    $defaults['theme_gcweb']['showregister'] = '0';
    $defaults['theme_gcweb']['showsearch'] = '1';
    $defaults['theme_gcweb']['showshare'] = '0';
    $defaults['theme_gcweb']['showsignon'] = '1';
    $defaults['theme_gcweb']['showumlogoutlink'] = '0';
    $defaults['theme_gcweb']['showumprofilelink'] = '0';
    $defaults['theme_gcweb']['titlesitename'] = '1';
    $defaults['theme_gcweb']['wraprecentlyaccessedcourses'] = '1';
    $defaults['theme_gcweb']['scss'] = '/* New link boxes on Front Page */
.linkboxes {
    border-radius: 5px !important;
    margin:10px;
}
.linkboxes h3 {
    margin-top:0px;
}
.linkboxes .well:hover {
    background-color: #C0C0C0;
}
.linkboxes a, .linkbox a:link, .linkbox a:visited {
    text-decoration: none;
    color: #2572b4;
}
.linkboxes p {
    font-size: 15px;
    margin-bottom: 20px;
    margin-top: 10px;
    line-height: 15px;
}';
    $defaults['tool_dataprivacy']['automaticdeletionrequests'] = '1';
    $defaults['tool_dataprivacy']['contactdataprotectionofficer'] = '1';
    $defaults['tool_dataprivacy']['privacyrequestexpiry'] = '604800';
    $defaults['tool_dataprivacy']['requireallenddatesforuserdeletion'] = '1';
    $defaults['tool_dataprivacy']['showdataretentionsummary'] = '1';
    $defaults['tool_log']['enabled_stores'] = 'logstore_standard';
    $defaults['tool_log']['exportlog'] = '1';
    $defaults['tool_mobile']['disabledfeatures'] = '';
    $defaults['tool_recyclebin']['autohide'] = '0';
    $defaults['tool_recyclebin']['categorybinenable'] = '1';
    $defaults['tool_recyclebin']['categorybinexpiry'] = '604800';
    $defaults['tool_recyclebin']['coursebinenable'] = '1';
    $defaults['tool_recyclebin']['coursebinexpiry'] = '604800';
    $defaults['user']['enablecourseinstances'] = '0';
    $defaults['user']['enableuserinstances'] = '0';
    $defaults['workshop']['examplesmode'] = '0';
    $defaults['workshop']['grade'] = '80';
    $defaults['workshop']['gradedecimals'] = '0';
    $defaults['workshop']['gradinggrade'] = '20';
    $defaults['workshop']['maxbytes'] = '0';
    $defaults['workshop']['strategy'] = 'accumulative';
    $defaults['workshopallocation_random']['numofreviews'] = '5';
    $defaults['workshopeval_best']['comparison'] = '5';
    $defaults['workshopform_numerrors']['grade0'] = 'No';
    $defaults['workshopform_numerrors']['grade1'] = 'Yes';

    $defaults['moodle']['courseoverviewfilesext'] = '.jpg,.gif,.png';
    $defaults['moodle']['enrol_plugins_enabled'] = 'manual,guest,self';
    $defaults['moodle']['hiddenuserfields'] = 'description,email,city,country,timezone,webpage,icqnumber,skypeid,yahooid,aimid,msnid,firstaccess,lastaccess,lastip,mycourses,groups,suspended';
    $defaults['moodle']['profileroles'] = '3,4,5';
    $defaults['admin_presets']['sensiblesettings'] = 'recaptchapublickey@@none, recaptchaprivatekey@@none, googlemapkey@@none, secretphrase@@none, cronremotepassword@@none, smtpuser@@none, smtppass@none, proxypassword@@none, password@@quiz, enrolpassword@@moodlecourse, allowedip@@none, blockedip@@none';
    $defaults['analytics']['defaulttimesplittingsevaluation'] = '\core\analytics\time_splitting\quarters_accum,\core\analytics\time_splitting\quarters,\core\analytics\time_splitting\single_range';
    $defaults['book']['numberingoptions'] = '0,1,2,3';
    $defaults['book']['navoptions'] = '0,1,2';
    $defaults['book']['navstyle'] = '1';
    $defaults['book']['numbering'] = '1';
    $defaults['media_videojs']['audioextensions'] = 'html_audio,.mp3,.ogg';
    $defaults['media_videojs']['videoextensions'] = 'html_video,.mp4,.webm';

    // Create folder for backups.
    if (!is_dir($CFG->dataroot . '/mbackups')) {
        mkdir($CFG->dataroot . '/mbackups', $CFG->directorypermissions);
    }

    // Enable filters.
    require_once($CFG->libdir . "/filterlib.php");
    foreach ($filterlist as $key => $filtername) {
        if (is_dir($CFG->dirroot . '/filter/' . $filtername)) {
            filter_set_global_state($filtername, TEXTFILTER_ON, 1);
        } else {
            unset($filterlist[$key]);
        }
    }
    $defaults['moodle']['stringfilters'] = implode(',', $filterlist);

    // Set default theme.
    if (file_exists($CFG->dirroot . '/theme/' . $themename)) {
        // Set the default theme.
        // Load the theme to make sure it is valid.
        $theme = theme_config::load($themename);
        // Get the config argument for the chosen device.
        $themename = core_useragent::get_device_type_cfg_var_name('default');
        set_config($themename, $theme->name);
    }

    // Install language packs.
    get_string_manager()->reset_caches();
    $controller = new tool_langimport\controller();
    core_php_time_limit::raise();
    $controller->install_languagepacks($pack);
    get_string_manager()->reset_caches();
}