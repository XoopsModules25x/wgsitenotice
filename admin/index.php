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
 * @version         $Id: 1.0 index.php 1 Fri 2015/02/20 12:43:29Z Goffy / wedega.com / XOOPS Development Team $
 */
include_once __DIR__ . '/header.php';
// Count elements
$count_versions = $versionsHandler->getCount();
$count_contents = $contentsHandler->getCount();
// Template Index
$template_main = 'wgsitenotice_admin_index.tpl';
// InfoBox Statistics
$adminMenu->addInfoBox(_AM_WGSITENOTICE_STATISTICS);
// Info elements
$adminMenu->addInfoBoxLine(_AM_WGSITENOTICE_STATISTICS, '<label>'._AM_WGSITENOTICE_THEREARE_VERSIONS.'</label>', $count_versions);
$adminMenu->addInfoBoxLine(_AM_WGSITENOTICE_STATISTICS, '<label>'._AM_WGSITENOTICE_THEREARE_CONTENTS.'</label>', $count_contents);
// Render Index
echo $adminMenu->addNavigation('index.php');
echo $adminMenu->renderIndex();
include_once __DIR__ . '/footer.php';