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
/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */

use XoopsModules\Wgsitenotice\Common\ {
    Configurator,
    Migrate,
    MigrateHelper
};

function xoops_module_update_wgsitenotice($module, $prev_version = null)
{

    $moduleDirName = $module->dirname();

    $configurator = new Configurator();
    $migrate = new Migrate($configurator);

    $fileSql = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/sql/mysql.sql';
    // ToDo: add function setDefinitionFile to .\class\libraries\vendor\xoops\xmf\src\Database\Migrate.php
    // Todo: once we are using setDefinitionFile this part has to be adapted
    //$fileYaml = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/sql/update_' . $moduleDirName . '_migrate.yml';
    //try {
    //$migrate->setDefinitionFile('update_' . $moduleDirName);
    //} catch (\Exception $e) {
    // as long as this is not done default file has to be created
    $mversion = $module->getInfo('version');
    $fileYaml = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . "/sql/{$moduleDirName}_{$mversion}_migrate.yml";
    //}

    $migratehelper = new MigrateHelper($fileSql, $fileYaml);
    $migratehelper->createSchemaFromSqlfile();

    $migrate->getTargetDefinitions();
    $migrate->synchronizeSchema();


    //check upload directory
    require_once __DIR__ . '/install.php';
    $ret = xoops_module_install_wgsitenotice($module);
    $errors = $module->getErrors();
    foreach ($errors as $error) {
        xoops_error($error);
    }

    return $ret;
}
