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

use Xmf\Request;
use XoopsModules\Wgsitenotice\Helper;

include_once __DIR__ . '/header.php';

$helper = Helper::getInstance();

$GLOBALS['xoopsOption']['template_main'] = 'user/' . $helper->getConfig('wgsitenotice_template') . '/wgsitenotice_index_'
                                           . $helper->getConfig('wgsitenotice_template') . '.tpl';
include_once \XOOPS_ROOT_PATH.'/header.php';

// Define Stylesheet
$xoTheme->addStylesheet( $style );

$breadcrumb ='<a href="' . \XOOPS_URL . '">' . \_YOURHOME . '</a>  &raquo; ' . $xoopsModule->name();

$version_id = Request::getInt('version_id');

$criteriaVersions = new \CriteriaCompo();
$criteriaVersions->setSort('version_weight');
$criteriaVersions->setOrder('ASC');
if ($version_id > 0) $criteriaVersions->add(new \Criteria('version_id', $version_id));
$criteriaVersions->add(new \Criteria('version_current', '1'));
$versions_count = $versionsHandler->getCount($criteriaVersions);
$versions_arr = $versionsHandler->getAll($criteriaVersions);
unset($criteriaVersions);

$keywords = [];
$breadcrumb_subdir = '';

if ($versions_count > 0) {
    foreach (\array_keys($versions_arr) as $v) {

        if ($version_id > 0) $breadcrumb_subdir = $versions_arr[$v]->getVar('version_name');
        $criteriaContents = new \CriteriaCompo();
        $criteriaContents->add(new \Criteria('cont_version_id', $versions_arr[$v]->getVar('version_id')));
        $contents_count = $contentsHandler->getCount($criteriaContents);
        $contents_arr = $contentsHandler->getAll($criteriaContents);
        unset($criteriaContents);

        if ($contents_count > 0) {
            foreach (\array_keys($contents_arr) as $i) {
                // Get Var cont_id
                $cont['id'] = $contents_arr[$i]->getVar('cont_id');
                // Get Var cont_version_id
                $cont['version_id'] = $contents_arr[$i]->getVar('cont_version_id');
                // Get Var cont_header
                $cont['header'] = $contents_arr[$i]->getVar('cont_header');
                // Get Var cont_text
                $cont['text'] = $contents_arr[$i]->getVar('cont_text', 'show');
                // Get Var cont_weight
                $cont['weight'] = $contents_arr[$i]->getVar('cont_weight');
                $GLOBALS['xoopsTpl']->append('contents', $cont);
                $keywords[] = $contents_arr[$i]->getVar('cont_header', 'n');
                unset($cont);
            }
        }
    }
} else {
    echo \_MA_WGSITENOTICE_THEREARENT_VERSIONS;
    $GLOBALS['xoopsTpl']->append('contents', []);
}

/* create breadcrumb */
if ('' == $breadcrumb_subdir) {
    $xoBreadcrumbs[] = ['title' => $xoopsModule->name()];
} else {
    $xoBreadcrumbs[] = ['title' => $GLOBALS['xoopsModule']->getVar('name'), 'link' => \WGSITENOTICE_URL . '/'];
    $xoBreadcrumbs[] = ['title' => $breadcrumb_subdir];
}
$GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);


// keywords
wgsitenotice_meta_keywords($helper->getConfig('keywords').', '. \implode(', ', $keywords));
unset($keywords);
// description
wgsitenotice_meta_description(\_MA_WGSITENOTICE_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \WGSITENOTICE_URL.'/contents.php');
//
include_once __DIR__ . '/footer.php';
