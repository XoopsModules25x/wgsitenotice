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
\defined('XOOPS_ROOT_PATH') || exit('Restricted access');

use XoopsModules\Wgsitenotice\Helper;

//
$dirname = \basename(__DIR__);
// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_WGSITENOTICE_NAME,
    'version'             => '1.4.2',
    'module_status'       => 'RC1',
    'description'         => \_MI_WGSITENOTICE_DESC,
    'author'              => 'Goffy (xoops.wedega.com)',
    'author_mail'         => 'webmaster@wedega.com',
    'author_website_url'  => 'https://xoops.wedega.com',
    'author_website_name' => 'WEDEGA Webdesign Gabor',
    'credits'             => 'Goffy / xoops.wedega.com / XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'help'                => 'page=help',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'release_info'        => '',
    'release_file'        => \XOOPS_URL."/modules/{$dirname}/docs/release_info file",
    'release_date'        => '2023/04/08', // format: yyyy/mm/dd
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL."/modules/{$dirname}/docs/install.txt",
    'min_php'             => '7.4',
    'min_xoops'           => '2.5.11 Stable',
    'min_admin'           => '1.1',
    'min_db'              => ['mysql' => '5.0.7', 'mysqli' => '5.0.7'],
    'image'               => 'assets/images/wgsitenotice_logo.png',
    'dirname'             => "{$dirname}",
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.wedega.com',
    'demo_site_name'      => 'Wedega Demo Site',
    'support_url'         => 'http://',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'xoops.wedega.com',
    'module_website_name' => 'WEDEGA Webdesign Gabor (powered by XOOPS Project)',
    'release'             => '2023/04/08',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'hasMain'             => 1,
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php'
];
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_about.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_header.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_index.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_versions.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_contents.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_checkonline.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wgsitenotice_admin_footer.tpl', 'description' => '', 'type' => 'admin'];
// User
$modversion['templates'][] = ['file' => 'wgsitenotice_header.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wgsitenotice_footer.tpl', 'description' => ''];

//if you create a new template in wgsitenotice/templates/user/ then add here the folder name and modversion['templates']
$arr_templates = ['default' => 'default', 'table' => 'table-style', 'block' => 'block-style', 'xbootstrap' => 'xbootstrap'];
$modversion['config'][] = [
    'name' => 'wgsitenotice_template',
    'title' => '_MI_WGSITENOTICE_TEMPLATE',
    'description' => '_MI_WGSITENOTICE_TEMPLATE_DESC',
    'formtype' => 'select',
    'valuetype' => 'text',
    'options' => \array_flip($arr_templates),
    'default' => 'default'
];
$modversion['templates'][] = ['file' => 'user/default/wgsitenotice_index_default.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'user/table/wgsitenotice_index_table.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'user/block/wgsitenotice_index_block.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'user/xbootstrap/wgsitenotice_index_xbootstrap.tpl', 'description' => ''];

// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][1] = 'wgsitenotice_versions';
$modversion['tables'][2] = 'wgsitenotice_contents';

// Blocks
$modversion['blocks'][] = [
    'file'        => 'versions.php',
    'name'        => \_MI_WGSITENOTICE_NAME,
    'description' => \_MI_WGSITENOTICE_B_ALL_VERSIONS,
    'show_func'   => 'b_wgsitenotice_versions_show',
    'edit_func'   => 'b_wgsitenotice_versions_edit',
    'template'    => "{$dirname}_block_versions.tpl",
    'options'     => '5|0',
];
$modversion['blocks'][] = [
    'file'        => 'cookie-reg.php',
    'name'        => \_MI_WGSITENOTICE_COOKIE_REG,
    'description' => \_MI_WGSITENOTICE_COOKIE_REG_DESC,
    'show_func'   => 'b_wgsitenotice_cookie_reg_show',
    'edit_func'   => 'b_wgsitenotice_cookie_reg_edit',
    'template'    => "{$dirname}_block_cookie_reg.tpl",
    'options'     => 'cookiesregmarker_' . \md5(\mt_rand()) . '|no-data|no-cookiereg|smarty|0.9|#d6e0eb|#f2f6f9|#000000|30|top|cookiesregsmarty_' . \md5(\mt_rand()),
];
// ------------------- Config ------------------- //
// Editor
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name' => 'wgsitenotice_editor',
    'title' => '_MI_WGSITENOTICE_EDITOR',
    'description' => '_MI_WGSITENOTICE_EDITOR_DESC',
    'formtype' => 'select',
    'valuetype' => 'text',
    'options' => \array_flip($editorHandler->getList()),
    'default' => 'dhtmltextarea'
];

$modversion['config'][] = [
    'name' => 'wgsitenotice_oc_server',
    'title' => '_MI_WGSITENOTICE_OC_SERVER',
    'description' => '_MI_WGSITENOTICE_OC_SERVER_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'https://xoops.wedega.com/modules/wgsitenotice/'
];

$modversion['config'][] = [
    'name' => 'wgsitenotice_oc_allowed',
    'title' => '_MI_WGSITENOTICE_OC_ALLOWED',
    'description' => '_MI_WGSITENOTICE_OC_ALLOWED_DESC',
    'formtype' => 'yesno',
    'valuetype' => 'int',
    'default' => 0
];

$modversion['config'][] = [
    'name' => 'keywords',
    'title' => '_MI_WGSITENOTICE_KEYWORDS',
    'description' => '_MI_WGSITENOTICE_KEYWORDS_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'wgsitenotice, versions, contents, checkonline'
];

$modversion['config'][] = [
    'name' => 'adminpager',
    'title' => '_MI_WGSITENOTICE_ADMINPAGER',
    'description' => '_MI_WGSITENOTICE_ADMINPAGER_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => 10
];

// Show copyright
$modversion['config'][] = [
    'name'        => 'show_copyright',
    'title'       => '_MI_WGSITENOTICE_SHOWCOPYRIGHT',
    'description' => '_MI_WGSITENOTICE_SHOWCOPYRIGHT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

$currdirname = isset($GLOBALS['xoopsModule'])&& \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($dirname == $currdirname) {
    $subcount = 1 ;
    $pathname = \XOOPS_ROOT_PATH. '/modules/'.$dirname;
    include_once $pathname . '/include/common.php';
    // Get instance of module
    $helper = Helper::getInstance();
    // versions
    $versionsHandler = $helper->getHandler('Versions');
    $version_crit = new \CriteriaCompo();
    $version_crit->setSort('version_weight');
    $version_crit->setOrder('ASC');
    $version_crit->add(new \Criteria('version_current', '1'));
    $versions_rows = $versionsHandler->getCount($version_crit);
    $versions_arr = $versionsHandler->getAll($version_crit);

    if ($versions_rows > 0) {
        foreach (\array_keys($versions_arr) as $i)
        {
            $modversion['sub'][$subcount]['name'] = $versions_arr[$i]->getVar('version_name');
            $modversion['sub'][$subcount++]['url'] = 'index.php?version_id=' . $versions_arr[$i]->getVar('version_id') ;
        }
    }
}
