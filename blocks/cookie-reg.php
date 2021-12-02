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
 * @author          Goffy (wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

use XoopsModules\Wgsitenotice\Helper;

include_once \XOOPS_ROOT_PATH.'/modules/wgsitenotice/include/common.php';

// Function show block
function b_wgsitenotice_cookie_reg_show($options)
{

    $block = [];

    $unique_id = $options[0];
    $block['unique_id'] = $unique_id;
    $dataprotect_id = $options[1];
    $cookie_reg_id = $options[2];
    $display_type = $options[3];
    $block['opacity'] = $options[4];
    $block['bg_from'] = $options[5];
    $block['bg_to'] = $options[6];
    $block['color'] = $options[7];
    $block['height'] = $options[8];
    $position = $options[9];
    $type_tpl_id = $options[10];

    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    //get relevant data
    $helper = Helper::getInstance();
    $versionsHandler = $helper->getHandler('versions');

    $block['infotext'] = \_MB_WGSITENOTICE_COOKIE_REG_INFO;

    if ($display_type == "smarty") {
        if ('top' == $position) {
            $block['position'] = 'top:0px;position:fixed;left:0px;';
            $block['prependToBody'] = '1';
        } else {
            $block['position'] = 'bottom:0px;position:fixed;left:0px;';
            $block['prependToBody'] = '1';
        }
    } else {
        $block['position'] = '';
    }

    if ( $dataprotect_id > 0 || $cookie_reg_id > 0 ) {
        $dataprotect_obj = $versionsHandler->get($dataprotect_id);
        if (\is_object($dataprotect_obj)) {
            $block['dataprotect_id'] = $dataprotect_id;
            $block['dataprotect_text'] = $dataprotect_obj->getVar('version_name');
        }
        $cookie_reg_obj = $versionsHandler->get($cookie_reg_id);
        if (\is_object($cookie_reg_obj)) {
            $block['cookie_reg_id'] = $cookie_reg_id;
            $block['cookie_reg_text'] = $cookie_reg_obj->getVar('version_name');
        }
        $block['seperator'] = "";
        if ( $dataprotect_id > 0 && $cookie_reg_id > 0 ) {
            $block['seperator'] = "|";
        }
    }
    $tplSource = \XOOPS_ROOT_PATH.'/modules/wgsitenotice/templates/blocks/wgsitenotice_block_cookie_reg.tpl';

    if ($display_type == "smarty") {
        //hide block and show in theme.html defined position
        $blockTpl = new \XoopsTpl();
        $blockTpl->assign('block', $block);

        $GLOBALS['xoopsTpl']->assign( $type_tpl_id, $blockTpl->fetch($tplSource) );
        $block = false;
    }
    return $block;
}

// Function edit block
function b_wgsitenotice_cookie_reg_edit($options)
{

    $helper = Helper::getInstance();
    $versionsHandler = $helper->getHandler('versions');

    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('version_current', 1));
    $criteria->setSort('version_weight');
    $criteria->setOrder('ASC');
    $versionsAll = $versionsHandler->getAll($criteria);
    unset($criteria);

    $cookie = $options[0];
    //remove existing cookie in order to see results
    \setcookie($cookie,"0");

    $unique_id = new \XoopsFormText('', 'options[0]', 100, 255, $cookie);
    $form = \_MB_WGSITENOTICE_COOKIE_REG_NAME . ': ' . $unique_id->render() . '<br><br>';

    $data_sel = new \XoopsFormSelect("", 'options[1]', $options[1]);
    $data_sel->addOption('no-data', \_MB_WGSITENOTICE_COOKIE_REG_NONE);
    foreach (\array_keys($versionsAll) as $i) {
        $data_sel->addOption($versionsAll[$i]->getVar('version_id'), $versionsAll[$i]->getVar('version_name'));
    }
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_DATA . ': ' . $data_sel->render() . '<br>';

    $cookie_reg_sel = new \XoopsFormSelect("", 'options[2]', $options[2]);
    $cookie_reg_sel->addOption('no-cookiereg', \_MB_WGSITENOTICE_COOKIE_REG_NONE);
    foreach (\array_keys($versionsAll) as $i) {
        $cookie_reg_sel->addOption($versionsAll[$i]->getVar('version_id'), $versionsAll[$i]->getVar('version_name'));
    }
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_BASE . ': ' . $cookie_reg_sel->render() . '<br>';

    $display_sel = new \XoopsFormSelect("", 'options[3]', $options[3]);
    $display_sel->addOption('block', \_MB_WGSITENOTICE_COOKIE_REG_DISPLAY_BLOCK);
    $display_sel->addOption('smarty', \_MB_WGSITENOTICE_COOKIE_REG_DISPLAY_SMARTY);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_DISPLAY . ': ' . $display_sel->render() . '<br>';

    $form .= '<br>' . \_MB_WGSITENOTICE_COOKIE_REG_OPT_STYLE . ':<br>';
    $form .= \str_repeat( '-' , \strlen(\_MB_WGSITENOTICE_COOKIE_REG_OPT_STYLE) + 5 ) . '<br>';

    $opacity_sel = new \XoopsFormSelect("", 'options[4]', $options[4]);
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
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_OPACITY . ': ' . $opacity_sel->render() . '<br><br>';

    $bg_from_sel = new \XoopsFormColorPicker("", 'options[5]', $options[5]);
    $bg_to_sel = new \XoopsFormColorPicker("", 'options[6]', $options[6]);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_BACKGROUND . ': ' . $bg_from_sel->render() . ' ' . $bg_to_sel->render() . '<br>';

    $color_sel = new \XoopsFormColorPicker("", 'options[7]', $options[7]);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_COLOR . ': ' . $color_sel->render() . '<br><br>';

    $height_sel = new \XoopsFormText('', 'options[8]', 20, 255, $options[8]);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_HEIGHT . ': ' . $height_sel->render() . '<br><br>';

    $form .= '<br>' . \_MB_WGSITENOTICE_COOKIE_REG_OPT_SMARTY . ':<br>';
    $form .= \str_repeat( '-' , \strlen(\_MB_WGSITENOTICE_COOKIE_REG_OPT_SMARTY) + 5 ) . '<br>';

    $position_sel = new \XoopsFormSelect("", 'options[9]', $options[9]);
    $position_sel->addOption('top', \_MB_WGSITENOTICE_COOKIE_REG_POSITION_TOP);
    $position_sel->addOption('bottom', \_MB_WGSITENOTICE_COOKIE_REG_POSITION_BOTTOM);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_POSITION . ': ' . $position_sel->render() . '<br>';

    $smarty_id = new \XoopsFormText('', 'options[10]', 60, 255, $options[10]);
    $form .= \_MB_WGSITENOTICE_COOKIE_REG_DISPLAY_SMARTY_DESC . ':<br><{$' . $smarty_id->render() . '}><br><br>';

    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    return $form;
}
