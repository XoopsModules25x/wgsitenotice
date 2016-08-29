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
 * @version         $Id: 1.0 header.php 1 Fri 2015/02/20 12:43:29Z Goffy / wedega.com / XOOPS Development Team $
 */

require_once dirname(dirname(dirname(__DIR__))). '/include/cp_header.php';
$thisPath = dirname(__DIR__);
include_once $thisPath.'/include/common.php';
$sysPathIcon16 = '../' . $xoopsModule->getInfo('sysicons16');
$sysPathIcon32 = '../' . $xoopsModule->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
//
$modPathIcon16 = $xoopsModule->getInfo('modicons16');
$modPathIcon32 = $xoopsModule->getInfo('modicons32');
// Get instance of module
$wgsitenotice = WgsitenoticeHelper::getInstance();
// versions
$versionsHandler = $wgsitenotice->getHandler('versions');
// contents
$contentsHandler = $wgsitenotice->getHandler('contents');
// checkonline
$checkonlineHandler = $wgsitenotice->getHandler('checkonline');
//
$myts = MyTextSanitizer::getInstance();
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
	include_once XOOPS_ROOT_PATH . '/class/template.php';
	$xoopsTpl = new XoopsTpl();
}
// System icons path
$xoopsTpl->assign('sysPathIcon16', $sysPathIcon16);
$xoopsTpl->assign('sysPathIcon32', $sysPathIcon32);
// Local icons path
$xoopsTpl->assign('modPathIcon16', $modPathIcon16);
$xoopsTpl->assign('modPathIcon32', $modPathIcon32);

//Load languages
xoops_loadLanguage('admin');
xoops_loadLanguage('modinfo');
// Local admin menu class
include_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');

xoops_cp_header();
$adminMenu = new ModuleAdmin();	

//load stylesheets and jquery for sortable
$GLOBALS['xoTheme']->addStylesheet(WGSITENOTICE_URL . '/assets/css/admin/style.css');
$GLOBALS['xoTheme']->addScript(WGSITENOTICE_URL . '/assets/js/jquery.js');
$GLOBALS['xoTheme']->addScript(WGSITENOTICE_URL . '/assets/js/jquery-ui.js');
$GLOBALS['xoTheme']->addScript(WGSITENOTICE_URL . '/assets/js/sortable.js');
