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
/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */
function xoops_module_update_wgsitenotice(&$module, $prev_version = null)
{
    $ret = null;
    if ($prev_version < 120) {
        $ret = update_wgsitenotice_v120($module);
    }
    if ($prev_version < 128) {
        $ret = update_wgsitenotice_v128($module);
    }
    $errors = $module->getErrors();
    foreach ($errors as $error) {
        xoops_error($error);
    }

    return $ret;
}
/**
 * @param $module
 *
 * @return bool
 */
function update_wgsitenotice_v120(&$module)
{
    // add fields 'version_online' to table 'mod_wgsitenotice_versions'
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('mod_wgsitenotice_versions') . '`';
    $sql .= " ADD COLUMN `version_online` int(1) NOT NULL default '0' AFTER `version_current`;";
    if (!$GLOBALS['xoopsDB']->queryF($sql)) {
        $module->setErrors(_MI_WGSITENOTICE_UPGRADEFAILED . '<br />Error: ' . $GLOBALS['xoopsDB']->error() . '<br />SQL command: ' . $sql);
        return false;
    }
    return true;
}

/**
 * @param $module
 *
 * @return bool
 */
function update_wgsitenotice_v128(&$module)
{
    // remove 'mod_' from tablename 'mod_wgsitenotice_...'
    $errors = 0;
    if (tableExists($GLOBALS['xoopsDB']->prefix('mod_wgsitenotice_versions'))) {
        $sql    = sprintf('ALTER TABLE '.$GLOBALS['xoopsDB']->prefix('mod_wgsitenotice_versions').' RENAME '.$GLOBALS['xoopsDB']->prefix('wgsitenotice_versions'));
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_MI_WGSITENOTICE_UPGRADEFAILED . '<br />Error: ' . $GLOBALS['xoopsDB']->error() . '<br />Rename table mod_wgsitenotice_versions to wgsitenotice_versions failed<br />SQL command: ' . $sql);
            $errors++;
        }
    }
    if (tableExists($GLOBALS['xoopsDB']->prefix('mod_wgsitenotice_contents'))) {
        $sql    = sprintf('ALTER TABLE '.$GLOBALS['xoopsDB']->prefix('mod_wgsitenotice_contents').' RENAME '.$GLOBALS['xoopsDB']->prefix('wgsitenotice_contents'));
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_MI_WGSITENOTICE_UPGRADEFAILED . '<br />Error: ' . $GLOBALS['xoopsDB']->error() . '<br />Rename table mod_wgsitenotice_contents to wgsitenotice_contents failed<br />SQL command: ' . $sql);
            $errors++;
        }
    }

    return ($errors == 0);
}

function tableExists($tablename)
{
    global $xoopsDB;
    $result=$xoopsDB->queryF("SHOW TABLES LIKE '$tablename'");
    return($xoopsDB->getRowsNum($result) > 0);
}
