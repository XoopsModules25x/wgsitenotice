<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * wgSitenotice module for xoops
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GPL 2.0 or later
 * @package         wgsitenotice
 * @since           1.0
 * @min_xoops       2.5.7
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<http://xoops.wedega.com>
 */
// ---------------- Admin Index ----------------
define('_AM_WGSITENOTICE_STATISTICS', 'Statistics');
// There are
define('_AM_WGSITENOTICE_THEREARE_VERSIONS', "There are <span class='bold'>%s</span> versions in the database");
define('_AM_WGSITENOTICE_THEREARE_CONTENTS', "There are <span class='bold'>%s</span> contents in the database");
// ---------------- Admin Files ----------------
// There aren't
define('_AM_WGSITENOTICE_THEREARENT_VERSIONS', "There aren't versions");
define('_AM_WGSITENOTICE_THEREARENT_CONTENTS', "There aren't contents");
// Save/Delete
define('_AM_WGSITENOTICE_FORMOK', 'Successfully saved');
define('_AM_WGSITENOTICE_FORMDELOK', 'Successfully deleted');
define('_AM_WGSITENOTICE_FORMSUREDEL', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
define('_AM_WGSITENOTICE_FORMSURERENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Lists
define('_AM_WGSITENOTICE_VERSIONS_LIST', 'List of Versions');
define('_AM_WGSITENOTICE_CONTENTS_LIST', 'List of Contents');
// ---------------- Admin Classes ----------------
// Versions add/edit
define('_AM_WGSITENOTICE_VERSION_ADD', 'Add versions');
define('_AM_WGSITENOTICE_VERSION_EDIT', 'Edit versions');
// Elements of Versions
define('_AM_WGSITENOTICE_VERSION_ID', 'Version-Id');
define('_AM_WGSITENOTICE_VERSION_NAME', 'Name');
define('_AM_WGSITENOTICE_VERSION_LANG', 'Language / Country');
define('_AM_WGSITENOTICE_VERSION_DESCR', 'Description');
define('_AM_WGSITENOTICE_VERSION_AUTHOR', 'Author');
define('_AM_WGSITENOTICE_VERSION_WEIGHT', 'Weight');
define('_AM_WGSITENOTICE_VERSION_CURRENT', 'Show this version');
define('_AM_WGSITENOTICE_VERSION_ONLINE', 'Allow download');
define('_AM_WGSITENOTICE_VERSION_DATE', 'Date');
// Contents add/edit
define('_AM_WGSITENOTICE_CONTENT_ADD', 'Add contents');
define('_AM_WGSITENOTICE_CONTENT_EDIT', 'Edit contents');
// Elements of Contents
define('_AM_WGSITENOTICE_CONT_ID', 'Id');
define('_AM_WGSITENOTICE_CONT_VERSION_ID', 'Version');
define('_AM_WGSITENOTICE_CONT_HEADER', 'Header');
define('_AM_WGSITENOTICE_CONT_TEXT', 'Text');
define('_AM_WGSITENOTICE_CONT_WEIGHT', 'Weight');
define('_AM_WGSITENOTICE_CONT_DATE', 'Date');
//Check online versions
define('_AM_WGSITENOTICE_OC', 'Online Versions');
define('_AM_WGSITENOTICE_OC_DISCLAIMER', 'Disclaimer');
define('_AM_WGSITENOTICE_OC_DISCLAIMER_DESCR',
       'There is no warranty for the downloaded legal notices or of parts of them. The text of the legal versions are only a suggestion.<br/>Please check before you use them, whether this suggestions comply with the legal regulations and fulfil the relevant legal requirements, instructions and guidelines.<br/>You use them at your own risk.');
define('_AM_WGSITENOTICE_OC_FORM', 'Check for available online versions');
define('_AM_WGSITENOTICE_OC_SERVER', 'Standard server for online check');
define('_AM_WGSITENOTICE_OC_START', 'Start check for available online versions');
define('_AM_WGSITENOTICE_OC_RESULT', 'On the named server available versions of legal notices');
define('_AM_WGSITENOTICE_OC_ERR_FORBIDDEN',
       'Sorry, but the named server does not allow download of his versions of legal notices');
define('_AM_WGSITENOTICE_OC_ERR_NO_VERSIONS',
       'Sorry, but on the named server are no versions of legal notices for download available');
define('_AM_WGSITENOTICE_OC_ERR_INVALID_PARAM', 'Sorry, request failed caused by an invalid parameter');
define('_AM_WGSITENOTICE_OC_ERR_CONNECT', "Sorry, request to named server '%s' failed.<br/>Please check standard server in module settings");
define('_AM_WGSITENOTICE_OC_ERR_READ_XML', 'Sorry, an error occured when reading/parsing the xml-code');
define('_AM_WGSITENOTICE_OC_ERR_ADDCONT', '%e error(s) occured when adding the content to your database');
// General
define('_AM_WGSITENOTICE_FORMACTION', 'Action');
define('_AM_WGSITENOTICE_FORMDOWNLOAD', 'Download');
// ---------------- Admin Others ----------------
define('_AM_WGSITENOTICE_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------
