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
 * @author          Goffy (wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

use XoopsModules\Wgsitenotice\Helper;

include_once \XOOPS_ROOT_PATH.'/modules/wgsitenotice/include/common.php';

// Function show block
function b_wgsitenotice_versions_show($options)
{

    $version_id = XoopsRequest::getInt('version_id');
	
    $version = [];
    $nb_versions = $options[0];
    $lenght_title = $options[1];
    $helper = Helper::getInstance();
    $versionsHandler = $helper->getHandler('versions');
    $criteria = new \CriteriaCompo();
    \array_shift($options);
    \array_shift($options);
    $criteria->add(new \Criteria('version_current', 1));
    $criteria->setSort('version_weight');
    $criteria->setOrder('ASC');
    $version_count = $versionsHandler->getCount($criteria);

    $criteria->setLimit($nb_versions);
    $versions_arr = $versionsHandler->getAll($criteria);
    $j = 0;
    foreach (\array_keys($versions_arr) as $i)
    {
        $version[$i]['version_id'] = $versions_arr[$i]->getVar('version_id');
        $version_name = $versions_arr[$i]->getVar('version_name');
        if ($lenght_title > 0 && \strlen($version_name) > $lenght_title) {
            $version_name = \substr($version_name, 0, $lenght_title) . '...';
        }
        $version[$i]['version_name'] = $version_name;
		$version[$i]['highlight'] = ($versions_arr[$i]->getVar('version_id') == $version_id);
        $j++;
        if ($j < $version_count) {
            $version[$i]['show_more'] = $version_count;
        }
    }
    return $version;
}

// Function edit block
function b_wgsitenotice_versions_edit($options)
{

    $form = \_MB_WGSITENOTICE_DISPLAY;
    $form .= "<input name='options[0]' size='5' maxlength='255' value='".$options[0]."' type='text' />&nbsp;<br />";
    $form .= \_MB_WGSITENOTICE_TITLELENGTH." : <input name='options[1]' size='5' maxlength='255' value='".$options[1]."' type='text' /><br /><br />";
    \array_shift($options);
    \array_shift($options);

    return $form;

}
