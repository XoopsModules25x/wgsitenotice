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
require_once dirname(dirname(dirname(__FILE__))) . '/mainfile.php';
$dirname = $GLOBALS['xoopsModule']->getVar('dirname');
$pathname = XOOPS_ROOT_PATH. '/modules/'.$dirname;
include_once $pathname . '/include/common.php';
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
$style = WGSITENOTICE_URL . '/assets/css/style.css';
if(file_exists($style)) { return true; }
//
$sysPathIcon16 = $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32 = $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
//
$modPathIcon16 = $xoopsModule->getInfo('modicons16');
$modPathIcon32 = $xoopsModule->getInfo('modicons32');
//
xoops_loadLanguage('modinfo', $dirname);
xoops_loadLanguage('main', $dirname);