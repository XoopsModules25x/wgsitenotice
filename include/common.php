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
defined('XOOPS_ROOT_PATH') || exit('Restricted access');
if (!defined('WGSITENOTICE_MODULE_PATH')) {
	define('WGSITENOTICE_DIRNAME', basename(dirname(__DIR__)));
	define('WGSITENOTICE_PATH', XOOPS_ROOT_PATH.'/modules/'.WGSITENOTICE_DIRNAME);
	define('WGSITENOTICE_URL', XOOPS_URL.'/modules/'.WGSITENOTICE_DIRNAME);	
	define('WGSITENOTICE_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.WGSITENOTICE_DIRNAME);
	define('WGSITENOTICE_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.WGSITENOTICE_DIRNAME);
	define('WGSITENOTICE_IMAGE_PATH', WGSITENOTICE_PATH.'/assets/images');
	define('WGSITENOTICE_IMAGE_URL', WGSITENOTICE_URL.'/assets/images/');
    define('WGSITENOTICE_ICONS_URL', WGSITENOTICE_URL.'/assets/images/icons/');
	define('WGSITENOTICE_ADMIN', WGSITENOTICE_URL . '/admin/index.php');
	$local_logo = WGSITENOTICE_IMAGE_URL . '/wedega_logo.png';
	/*if(is_dir(WGSITENOTICE_IMAGE_PATH) && file_exists($local_logo)) {
		$logo = $local_logo;
	} else {
		$sysPathIcon32 = $GLOBALS['xoopsModule']->getInfo('icons32');
		$logo = $sysPathIcon32.'/xoopsmicrobutton.gif';
	}*/	
}
// module information
$copyright = "<a href='http://xoops.wedega.com' title='WEDEGA Webdesign Gabor' target='_blank'>
                     <img src='".$local_logo."' alt='WEDEGA Webdesign Gabor' /></a>";
					 
include_once XOOPS_ROOT_PATH.'/class/xoopsrequest.php';
include_once WGSITENOTICE_PATH.'/class/helper.php';
include_once WGSITENOTICE_PATH.'/include/functions.php';
