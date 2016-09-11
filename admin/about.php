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
include __DIR__ . '/header.php';
$template_main = 'wgsitenotice_admin_about.tpl'; 
$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(basename(__FILE__)));
$GLOBALS['xoopsTpl']->assign('about', $adminMenu->renderAbout('', false));
include __DIR__ . '/footer.php';  
