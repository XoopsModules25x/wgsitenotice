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
 * @author          Goffy (wedega.com) - Email:<webmaster@wedega.com> - Website:<http://wedega.com>
 */
include_once XOOPS_ROOT_PATH.'/modules/wgsitenotice/include/common.php';
// Function show block
function b_wgsitenotice_cookie_reg_show($options) 
{
	include_once XOOPS_ROOT_PATH.'/modules/wgsitenotice/class/versions.php';
	$myts = MyTextSanitizer::getInstance();
	$block = array();

    $block['unique_id'] = $options[0];
    $dataprotect_id = $options[1];
    $cookie_reg_id = $options[2];
    if ('top' == $options[3]) {
        $block['position'] = 'top:0px;';
    } else {
        $block['position'] = 'bottom:0px;';
    }
    $block['opacity'] = $options[4];
    $block['bg_from'] = $options[5];
    $block['bg_to'] = $options[6];
    $block['color'] = $options[7];
    $block['height'] = $options[8];
    
	$wgsitenotice = WgsitenoticeHelper::getInstance();
	$versionsHandler = $wgsitenotice->getHandler('versions');
	$criteria = new CriteriaCompo();
	array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $block['infotext'] = _MB_WGSITENOTICE_COOKIE_REG_INFO;
    
    if ( $dataprotect_id > 0 || $cookie_reg_id > 0 ) {
        $dataprotect_obj = $versionsHandler->get($dataprotect_id);
        if (is_object($dataprotect_obj)) {
            $block['dataprotect_id'] = $dataprotect_id;
            $block['dataprotect_text'] = $dataprotect_obj->getVar('version_name');
        }
        $cookie_reg_obj = $versionsHandler->get($cookie_reg_id);
        if (is_object($cookie_reg_obj)) {
            $block['cookie_reg_id'] = $cookie_reg_id;
            $block['cookie_reg_text'] = $cookie_reg_obj->getVar('version_name');
        }
        $block['seperator'] = "";
        if ( $dataprotect_id > 0 && $cookie_reg_id > 0 ) {
            $block['seperator'] = "|";
        }
    }

	return $block;
}

// Function edit block
function b_wgsitenotice_cookie_reg_edit($options) 
{	
    include_once XOOPS_ROOT_PATH.'/modules/wgsitenotice/class/versions.php';		
	$wgsitenotice = WgsitenoticeHelper::getInstance();
	$versionsHandler = $wgsitenotice->getHandler('versions');
    
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('version_current', 1));
    $criteria->setSort('version_weight');
    $criteria->setOrder('ASC');
    $versionsAll = $versionsHandler->getAll($criteria);
    unset($criteria);
    
    $unique_id = new XoopsFormText('', 'options[0]', 100, 255, $options[0]);
    $form .= _MB_WGSITENOTICE_COOKIE_REG_NAME . ': ' . $unique_id->render() . '<br />';
    
    $data_sel = new XoopsFormSelect("", 'options[1]', $options[1]);
    $data_sel->addOption('no-data', _MB_WGSITENOTICE_COOKIE_REG_NONE);
    foreach (array_keys($versionsAll) as $i) {
        $version_id = $versionsAll[$i]->getVar('version_id');
        $data_sel->addOption($versionsAll[$i]->getVar('version_id'), $versionsAll[$i]->getVar('version_name'));
    }
    $form .= _MB_WGSITENOTICE_COOKIE_REG_DATA . ': ' . $data_sel->render() . '<br />';
    
    $cookie_reg_sel = new XoopsFormSelect("", 'options[2]', $options[2]);
    $cookie_reg_sel->addOption('no-cookiereg', _MB_WGSITENOTICE_COOKIE_REG_NONE);
    foreach (array_keys($versionsAll) as $i) {
        $version_id = $versionsAll[$i]->getVar('version_id');
        $cookie_reg_sel->addOption($versionsAll[$i]->getVar('version_id'), $versionsAll[$i]->getVar('version_name'));
    }
    $form .= _MB_WGSITENOTICE_COOKIE_REG_BASE . ': ' . $cookie_reg_sel->render() . '<br />';
    
    $position_sel = new XoopsFormSelect("", 'options[3]', $options[3]);
    $position_sel->addOption('top', _MB_WGSITENOTICE_COOKIE_REG_POSITION_TOP);
    $position_sel->addOption('bottom', _MB_WGSITENOTICE_COOKIE_REG_POSITION_BOTTOM);
    $form .= _MB_WGSITENOTICE_COOKIE_REG_POSITION . ': ' . $position_sel->render() . '<br />';
   
    $opacity_sel = new XoopsFormSelect("", 'options[4]', $options[4]);
    $opacity_sel->addOption('0.1', '0.1');
    $opacity_sel->addOption('0.2', '0.2');
    $opacity_sel->addOption('0.3', '0.3');
    $opacity_sel->addOption('0.4', '0.4');
    $opacity_sel->addOption('0.5', '0.5');
    $opacity_sel->addOption('0.6', '0.6');
    $opacity_sel->addOption('0.7', '0.7');
    $opacity_sel->addOption('0.8', '0.8');
    $opacity_sel->addOption('0.9', '0.9');
    $opacity_sel->addOption('1.0', '1.0');
    $form .= _MB_WGSITENOTICE_COOKIE_REG_OPACITY . ': ' . $opacity_sel->render() . '<br />';
    
    $bg_from_sel = new XoopsFormColorPicker("", 'options[5]', $options[5]);
    $bg_to_sel = new XoopsFormColorPicker("", 'options[6]', $options[6]);
    $form .= _MB_WGSITENOTICE_COOKIE_REG_BACKGROUND . ': ' . $bg_from_sel->render() . ' ' . $bg_to_sel->render() . '<br />';
    
    $color_sel = new XoopsFormColorPicker("", 'options[7]', $options[7]);
    $form .= _MB_WGSITENOTICE_COOKIE_REG_COLOR . ': ' . $color_sel->render() . '<br />';
    
    $height_sel = new XoopsFormText('', 'options[8]', 20, 255, $options[8]);
    $form .= _MB_WGSITENOTICE_COOKIE_REG_HEIGHT . ': ' . $height_sel->render() . '<br />';

    array_shift($options);
	array_shift($options);
	array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    
	return $form;
}	
