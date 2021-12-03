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
//
\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');
// Copy base file
$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
// Making of "uploads/wgsitenotice" folder
$helper = XOOPS_UPLOAD_PATH.'/wgsitenotice';
if(!\is_dir($wgsitenotice))
    \mkdir($wgsitenotice, 0777);
    chmod($wgsitenotice, 0777);
\copy($indexFile, $helper.'/index.html');
// ---------- Install Footer ---------- //
