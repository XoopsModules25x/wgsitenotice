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

include_once __DIR__ . '/header.php';

// the value of arguments in URL$
$op         = Request::getString('op', 'list');
$version_id = Request::getInt('version_id');
$start      = Request::getInt('start');

$img_yes = "<img src='../".$modPathIcon16."/on.png' >";
$img_no  = "<img src='../".$modPathIcon16."/off.png' >";
// Switch options
switch ($op)
{
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript(\WGSITENOTICE_URL . '/assets/js/sortable-versions.js');
        $GLOBALS['xoopsTpl']->assign('start', $start);
        $limit = XoopsRequest::getInt('limit', $helper->getConfig('adminpager'));
        $template_main = 'wgsitenotice_admin_versions.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(\basename(__FILE__)));
        $adminMenu->addItemButton(\_AM_WGSITENOTICE_VERSION_ADD, 'versions.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        $version_crit = new \CriteriaCompo();
        $version_crit->setSort('version_weight ASC, version_id');
        $version_crit->setOrder('ASC');
        $versions_rows = $versionsHandler->getCount($version_crit);
        $version_crit->setStart($start);
        $version_crit->setLimit($limit);
        $versions_arr = $versionsHandler->getAll($version_crit);
        unset($version_crit);
        // Table view
        if ($versions_rows > 0)
        {
            foreach (\array_keys($versions_arr) as $i)
            {
                // Get Var version_id
                $version['id'] = $versions_arr[$i]->getVar('version_id');
                // Get Var version_name
                $version['name'] = $versions_arr[$i]->getVar('version_name');
                // Get Var version_lang
                $version['lang'] = $versions_arr[$i]->getVar('version_lang');
                // Get Var version_descr
                $version['descr'] = $versions_arr[$i]->getVar('version_descr', 'n');
                // Get Var version_author
                $version['author'] = $versions_arr[$i]->getVar('version_author');
                // Get Var version_weight
                $version['weight'] = $versions_arr[$i]->getVar('version_weight');
                // Get Var version_current
                $version['current'] = (1 == $versions_arr[$i]->getVar('version_current')) ? $img_yes : $img_no;
                // Get Var version_online
                $version['online'] = (1 == $versions_arr[$i]->getVar('version_online')) ? $img_yes : $img_no;
                // Get Var version_date
                $version['date'] = \formatTimestamp($versions_arr[$i]->getVar('version_date'));
                $GLOBALS['xoopsTpl']->append('versions_list', $version);
                unset($version);
            }
            if ( $versions_rows > $limit ) {
                include_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($versions_rows, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGSITENOTICE_THEREARENT_VERSIONS);
        }
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_url', \WGSITENOTICE_URL);
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_upload_url', \WGSITENOTICE_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_icons_url', \WGSITENOTICE_ICONS_URL);
    break;
    case 'new':
        $template_main = 'wgsitenotice_admin_versions.tpl';
        $adminMenu->addItemButton(\_AM_WGSITENOTICE_VERSIONS_LIST, 'versions.php', 'list');
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(\basename(__FILE__)));
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        // Get Form
        $versionsObj = $versionsHandler->create();
        $form = $versionsObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'save':
        if ( !$GLOBALS['xoopsSecurity']->check() ) {
           \redirect_header('versions.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($version_id)) {
           $versionsObj = $versionsHandler->get($version_id);
        } else {
           $versionsObj = $versionsHandler->create();
        }
        // Set Vars
        // Set Var version_name
        $versionsObj->setVar('version_name', Request::getString('version_name'));
        // Set Var version_lang
        $versionsObj->setVar('version_lang', Request::getString('version_lang'));
        // Set Var version_descr
        $versionsObj->setVar('version_descr', Request::getString('version_descr'));
        // Set Var version_author
        $versionsObj->setVar('version_author', Request::getString('version_author'));
        // Set Var version_weight
        $versionsObj->setVar('version_weight', Request::getInt('version_weight'));
        // Set Var version_current
        $versionsObj->setVar('version_current', Request::getInt('version_current'));
        // Set Var version_online
        $versionsObj->setVar('version_online', Request::getInt('version_online'));
        // Set Var version_date
        $versionsObj->setVar('version_date', \time());
        // Insert Data
        if ($versionsHandler->insert($versionsObj)) {
            \redirect_header('versions.php?op=list', 2, \_AM_WGSITENOTICE_FORMOK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $versionsObj->getHtmlErrors());
        $form = $versionsObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'change_current':
        if (isset($version_id)) {
            $versionsObj = $versionsHandler->get($version_id);
            // get Vars
            $version_current = (1 == $versionsObj->getVar('version_current')) ? '0' : '1';
            // Set Var version_current
            $versionsObj->setVar('version_current', $version_current);
            // Insert Data
            if ($versionsHandler->insert($versionsObj)) {
               \redirect_header('versions.php?op=list&start='.$start, 2, \_AM_WGSITENOTICE_FORMOK);
            }
        }
    break;
    case 'change_online':
        if (isset($version_id)) {
            $versionsObj = $versionsHandler->get($version_id);
            // get Vars
            $version_online = (1 == $versionsObj->getVar('version_online')) ? '0' : '1';
            // Set Var version_online
            $versionsObj->setVar('version_online', $version_online);
            // Insert Data
            if ($versionsHandler->insert($versionsObj)) {
               \redirect_header('versions.php?op=list&start='.$start, 2, \_AM_WGSITENOTICE_FORMOK);
            }
        }
    break;
    case 'edit':
        $template_main = 'wgsitenotice_admin_versions.tpl';
        $adminMenu->addItemButton(\_AM_WGSITENOTICE_VERSION_ADD, 'versions.php?op=new');
        $adminMenu->addItemButton(\_AM_WGSITENOTICE_VERSIONS_LIST, 'versions.php', 'list');
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(\basename(__FILE__)));
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        // Get Form
        $versionsObj = $versionsHandler->get($version_id);
        $form = $versionsObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'delete':
        $versionsObj = $versionsHandler->get($version_id);
        if (isset($_REQUEST['ok']) && 1 == (int)$_REQUEST['ok']) {
            if ( !$GLOBALS['xoopsSecurity']->check() ) {
                \redirect_header('versions.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }

            //delete items in mod_wdsitenotice_contents
            $content_crit = new \CriteriaCompo();
            $content_crit->add(new \Criteria('cont_version_id', $version_id));
            $contentsHandler->deleteAll($content_crit);

            //delete item in mod_wdsitenotice_versions
            if ($versionsHandler->delete($versionsObj)) {
                \redirect_header('versions.php', 3, \_AM_WGSITENOTICE_FORMDELOK);
            } else {
                echo $versionsObj->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'version_id' => $version_id, 'op' => 'delete'], $_SERVER['REQUEST_URI'], \sprintf(\_AM_WGSITENOTICE_FORMSUREDEL, $versionsObj->getVar('version_name')));
        }
    break;

    case 'order':
        $vorder = Request::getArray('vorder');
        for ($i = 0, $iMax = \count($vorder); $i < $iMax; $i++){
            $versionsObj = $versionsHandler->get($vorder[$i]);
            $versionsObj->setVar('version_weight',$i+1);
            $versionsHandler->insert($versionsObj);
        }
        break;
}
include_once __DIR__ . '/footer.php';
