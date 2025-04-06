<?php

namespace XoopsModules\Wgsitenotice;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author       Goffy - XOOPS Development Team
 */
//\defined('\XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Modulemenu
 */
class Modulemenu
{

    /** function to create an array for XOOPS main menu
     *
     * @return array
     */
    public function getMenuitemsDefault()
    {

        $moduleDirName = \basename(\dirname(__DIR__));
        $subcount      = 1;
        $pathname      = \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/';
        $urlModule     = \XOOPS_URL . '/modules/' . $moduleDirName . '/';

        require_once $pathname . 'include/common.php';
        $helper = \XoopsModules\Wgsitenotice\Helper::getInstance();

        // start creation of link list as array
        $items = [];
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
                $items[] = [
                    'name' => $versions_arr[$i]->getVar('version_name'),
                    'url'  =>  $urlModule . 'index.php?version_id=' . $versions_arr[$i]->getVar('version_id'),
                ];
            }
        }
        // end creation of link list as array

        return $items;
    }

    /** function to create a list of nested sublinks
     *
     * @return array
     */
    public function getMenuitemsSbadmin5()
    {
        return $this->getMenuitemsDefault();
    }


}
