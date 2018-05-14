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
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */
$dirname = basename( dirname(__DIR__) ) ;
$moduleHandler = xoops_getHandler('module');
$xoopsModule = XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');
$i = 1;
$adminmenu[$i]['title'] = _MI_WGSITENOTICE_ADMENU1;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/dashboard.png';
$i++;
$adminmenu[$i]['title'] = _MI_WGSITENOTICE_ADMENU2;
$adminmenu[$i]['link'] = 'admin/versions.php';
$adminmenu[$i]['icon'] = 'assets/images/icons/32/sn_versions.png';
$i++;
$adminmenu[$i]['title'] = _MI_WGSITENOTICE_ADMENU3;
$adminmenu[$i]['link'] = 'admin/contents.php';
$adminmenu[$i]['icon'] = 'assets/images/icons/32/sn_contents.png';
$i++;
$adminmenu[$i]['title'] = _MI_WGSITENOTICE_ADMENU4;
$adminmenu[$i]['link'] = 'admin/checkonline.php';
$adminmenu[$i]['icon'] = 'assets/images/icons/32/sn_checkonline.png';
$i++;
$adminmenu[$i]['title'] = _MI_WGSITENOTICE_ADMENU5;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/about.png';
unset( $i );
