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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GPL 2.0 or later
 * @package         wgsitenotice
 * @since           1.0
 * @min_xoops       2.5.11
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

$dirname = \basename( \dirname(__DIR__) ) ;
$moduleDirNameUpper = \mb_strtoupper($dirname);
$moduleHandler = \xoops_getHandler('module');
$xoopsModule = \XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => $sysPathIcon32.'/dashboard.png'
];
$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU2,
    'link'  => 'admin/versions.php',
    'icon'  => 'assets/icons/32/sn_versions.png'
];
$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU3,
    'link'  => 'admin/contents.php',
    'icon'  => 'assets/icons/32/sn_contents.png'
];
$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU4,
    'link'  => 'admin/checkonline.php',
    'icon'  => 'assets/icons/32/sn_checkonline.png'
];
//Feedback
$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU6,
    'link'  => 'admin/feedback.php',
    'icon'  => $sysPathIcon32 . '/mail_foward.png',
];
$adminmenu[] = [
    'title' => \_MI_WGSITENOTICE_ADMENU5,
    'link'  => 'admin/about.php',
    'icon'  => $sysPathIcon32 . '/about.png',
];
