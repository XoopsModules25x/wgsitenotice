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
include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'user/' . $wgsitenotice->getConfig('wgsitenotice_template') . '/wgsitenotice_index_'
                                           . $wgsitenotice->getConfig('wgsitenotice_template') . '.tpl';
include_once XOOPS_ROOT_PATH.'/header.php';

// Define Stylesheet
$xoTheme->addStylesheet( $style );

$breadcrumb ='<a href="' . XOOPS_URL . '">' . _YOURHOME . '</a>  &raquo; ' . $xoopsModule->name();

$version_id = XoopsRequest::getInt('version_id', 0);

$criteriaVersions = new CriteriaCompo();
$criteriaVersions->setSort('version_weight');
$criteriaVersions->setOrder('ASC');
if ($version_id > 0) $criteriaVersions->add(new Criteria('version_id', $version_id));
$criteriaVersions->add(new Criteria('version_current', '1'));
$versions_count = $versionsHandler->getCount($criteriaVersions);
$versions_arr = $versionsHandler->getAll($criteriaVersions);
unset($criteriaVersions);
if ($versions_count > 0) {
    foreach (array_keys($versions_arr) as $v) {
        $breadcrumb_subdir = '';
        if ($version_id > 0) $breadcrumb_subdir = $versions_arr[$v]->getVar('version_name');
        $criteriaContents = new CriteriaCompo();
        $criteriaContents->add(new Criteria('cont_version_id', $versions_arr[$v]->getVar('version_id')));
        $contents_count = $contentsHandler->getCount($criteriaContents);
        $contents_arr = $contentsHandler->getAll($criteriaContents);
        unset($criteriaContents);
        $keywords = array();
        if ($contents_count > 0) {
            foreach (array_keys($contents_arr) as $i) {
                // Get Var cont_id
                $cont['id'] = $contents_arr[$i]->getVar('cont_id');
                // Get Var cont_version_id
                $cont['version_id'] = $contents_arr[$i]->getVar('cont_version_id');
                // Get Var cont_header
                $cont['header'] = $contents_arr[$i]->getVar('cont_header');
                // Get Var cont_text
                $cont['text'] = $contents_arr[$i]->getVar('cont_text', 'n');
                // Get Var cont_weight
                $cont['weight'] = $contents_arr[$i]->getVar('cont_weight');
                $GLOBALS['xoopsTpl']->append('contents', $cont);
                $keywords[] = $contents_arr[$i]->getVar('cont_header', 'n');
                unset($cont);
            }
        }
    }
} else {
    echo _MA_WGSITENOTICE_THEREARENT_VERSIONS;
}    

/* create breadcrumb */
$breadcrumb ='<a href="' . XOOPS_URL . '">' . _YOURHOME . '</a>  &raquo; ';
if ($breadcrumb_subdir == '') {
    $breadcrumb .= $xoopsModule->name();
} else {
    $breadcrumb .='<a href="' . WGSITENOTICE_URL . '">' . $xoopsModule->name() . '</a>  &raquo; ' . $breadcrumb_subdir;
}
$GLOBALS['xoopsTpl']->assign('breadcrumb', $breadcrumb);


// keywords
wgsitenotice_meta_keywords($wgsitenotice->getConfig('keywords').', '. implode(', ', $keywords));
unset($keywords);
// description
wgsitenotice_meta_description(_MA_WGSITENOTICE_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGSITENOTICE_URL.'/contents.php');
//
include_once __DIR__ . '/footer.php';	
