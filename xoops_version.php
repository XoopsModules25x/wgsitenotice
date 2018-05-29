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
defined('XOOPS_ROOT_PATH') || exit('Restricted access');
//
$dirname = basename(__DIR__) ;
// ------------------- Informations ------------------- //
$modversion = array(
    'name' => _MI_WGSITENOTICE_NAME,
    'version' => '1.30',
    'description' => _MI_WGSITENOTICE_DESC,
    'author' => 'Goffy (xoops.wedega.com)',
    'author_mail' => 'webmaster@wedega.com',
    'author_website_url' => 'https://xoops.wedega.com',
    'author_website_name' => 'WEDEGA Webdesign Gabor',
    'credits' => 'Goffy / xoops.wedega.com / XOOPS Development Team',
    'license' => 'GPL 2.0 or later',
    'help' => 'page=help',
    'license_url' => 'www.gnu.org/licenses/gpl-2.0.html/',
    //
    'release_info' => 'release_info',
    'release_file' => XOOPS_URL."/modules/{$dirname}/docs/release_info file",
    'release_date' => '2017/02/13',
    //
    'manual' => 'link to manual file',
    'manual_file' => XOOPS_URL."/modules/{$dirname}/docs/install.txt",
    'min_php' => '5.3',
    'min_xoops' => '2.5.7',
    'min_admin' => '1.1',
    'min_db' => array('mysql' => '5.0.7', 'mysqli' => '5.0.7'),
    'image' => 'assets/images/wgsitenotice_logo.png',
    'dirname' => "{$dirname}",
    //Frameworks
    'dirmoduleadmin' => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16' => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32' => '../../Frameworks/moduleclasses/icons/32',
    // Local path icons
    'modicons16' => 'assets/images/icons/16',
    'modicons32' => 'assets/images/icons/32',
    //About
    'demo_site_url' => 'https://xoops.wedega.com',
    'demo_site_name' => 'Wedega Demo Site',
    'support_url' => 'http://',
    'support_name' => 'Support Forum',
    'module_website_url' => 'xoops.wedega.com',
    'module_website_name' => 'WEDEGA Webdesign Gabor (powered by XOOPS Project)',
    'release' => '2018/05/29',
    'module_status' => 'Final',
    // Admin system menu
    'system_menu' => 1,
    // Admin things
    'hasAdmin' => 1,
    'adminindex' => 'admin/index.php',
    'adminmenu' => 'admin/menu.php',
    // Main things
    'hasMain' => 1,
    // Install/Update
    'onInstall' => 'include/install.php',
    'onUpdate' => 'include/update.php'
);
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_about.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_header.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_index.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_versions.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_contents.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_checkonline.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgsitenotice_admin_footer.tpl', 'description' => '', 'type' => 'admin');
// User
$modversion['templates'][] = array('file' => 'wgsitenotice_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgsitenotice_footer.tpl', 'description' => '');

//if you create a new template in wgsitenotice/templates/user/ then add here the folder name and modversion['templates']
$arr_templates = array('default' => 'default', 'table' => 'table-style', 'block' => 'block-style', 'xbootstrap' => 'xbootstrap');
$modversion['config'][] = array(
    'name' => 'wgsitenotice_template',
    'title' => '_MI_WGSITENOTICE_TEMPLATE',
    'description' => '_MI_WGSITENOTICE_TEMPLATE_DESC',
    'formtype' => 'select',
    'valuetype' => 'text',
    'options' => array_flip($arr_templates),
    'default' => 'default'
);
$modversion['templates'][] = array('file' => 'user/default/wgsitenotice_index_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'user/table/wgsitenotice_index_table.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'user/block/wgsitenotice_index_block.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'user/xbootstrap/wgsitenotice_index_xbootstrap.tpl', 'description' => '');

// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][1] = 'wgsitenotice_versions';
$modversion['tables'][2] = 'wgsitenotice_contents';

$b = 1;
// Blocks
$modversion['blocks'][$b]['file']        = 'versions.php';
$modversion['blocks'][$b]['name']        = _MI_WGSITENOTICE_NAME;
$modversion['blocks'][$b]['description'] = _MI_WGSITENOTICE_B_ALL_VERSIONS;
$modversion['blocks'][$b]['show_func']   = 'b_wgsitenotice_versions_show';
$modversion['blocks'][$b]['edit_func']   = 'b_wgsitenotice_versions_edit';
$modversion['blocks'][$b]['options']     = '5|0';
$modversion['blocks'][$b]['template']    = "{$dirname}_block_versions.tpl";
$b++;
$modversion['blocks'][$b]['file']        = 'cookie-reg.php';
$modversion['blocks'][$b]['name']        = _MI_WGSITENOTICE_COOKIE_REG;
$modversion['blocks'][$b]['description'] = _MI_WGSITENOTICE_COOKIE_REG_DESC;
$modversion['blocks'][$b]['show_func']   = 'b_wgsitenotice_cookie_reg_show';
$modversion['blocks'][$b]['edit_func']   = 'b_wgsitenotice_cookie_reg_edit';
$modversion['blocks'][$b]['options']     = 'cookiesregmarker_' . md5(mt_rand()) . '|no-data|no-cookiereg|smarty|0.9|#d6e0eb|#f2f6f9|#000000|30|top|cookiesregsmarty_' . md5(mt_rand());
$modversion['blocks'][$b]['template']    = "{$dirname}_block_cookie_reg.tpl";
unset ($b);
// ------------------- Config ------------------- //
// Editor
xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = array(
    'name' => 'wgsitenotice_editor',
    'title' => '_MI_WGSITENOTICE_EDITOR',
    'description' => '_MI_WGSITENOTICE_EDITOR_DESC',
    'formtype' => 'select',
    'valuetype' => 'text',
    'options' => array_flip($editorHandler->getList()),
    'default' => 'dhtmltextarea'
);

$modversion['config'][] = array(
    'name' => 'wgsitenotice_oc_server',
    'title' => '_MI_WGSITENOTICE_OC_SERVER',
    'description' => '_MI_WGSITENOTICE_OC_SERVER_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'https://xoops.wedega.com/modules/wgsitenotice/'
);

$modversion['config'][] = array(
    'name' => 'wgsitenotice_oc_allowed',
    'title' => '_MI_WGSITENOTICE_OC_ALLOWED',
    'description' => '_MI_WGSITENOTICE_OC_ALLOWED_DESC',
    'formtype' => 'yesno',
    'valuetype' => 'int',
    'default' => 0);

$modversion['config'][] = array(
    'name' => 'keywords',
    'title' => '_MI_WGSITENOTICE_KEYWORDS',
    'description' => '_MI_WGSITENOTICE_KEYWORDS_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'wgsitenotice, versions, contents, checkonline'
);

$modversion['config'][] = array(
    'name' => 'adminpager',
    'title' => '_MI_WGSITENOTICE_ADMINPAGER',
    'description' => '_MI_WGSITENOTICE_ADMINPAGER_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => 10);

$currdirname = isset($GLOBALS['xoopsModule'])&& is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($dirname == $currdirname) {
    $subcount = 1 ;
    $pathname = XOOPS_ROOT_PATH. '/modules/'.$dirname;
    include_once $pathname . '/include/common.php';
    // Get instance of module
    $wgsitenotice = WgsitenoticeHelper::getInstance();
    // versions
    $versionsHandler = $wgsitenotice->getHandler('versions');
    $version_crit = new CriteriaCompo();
    $version_crit->setSort('version_weight');
    $version_crit->setOrder('ASC');
    $version_crit->add(new Criteria('version_current', '1'));
    $versions_rows = $versionsHandler->getCount($version_crit);
    $versions_arr = $versionsHandler->getAll($version_crit);

    if ($versions_rows > 0) {
        foreach (array_keys($versions_arr) as $i)
        {
            $modversion['sub'][$subcount]['name'] = $versions_arr[$i]->getVar('version_name');
            $modversion['sub'][$subcount++]['url'] = 'index.php?version_id=' . $versions_arr[$i]->getVar('version_id') ;
        }
    }
}
