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
include_once __DIR__ . '/header.php';
//It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request cont_id
$cont_id = XoopsRequest::getInt('cont_id');
// Switch options
switch ($op) 
{
    case 'list': 
    default:  
        $start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgsitenotice->getConfig('adminpager'));		
		$template_main = 'wgsitenotice_admin_contents.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(basename(__FILE__)));
		$adminMenu->addItemButton(_AM_WGSITENOTICE_CONTENT_ADD, 'contents.php?op=new', 'add');		
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		$cont_crit = new CriteriaCompo();
		$cont_crit->setSort('cont_version_id ASC, cont_weight ASC, cont_id');
		$cont_crit->setOrder('ASC');
        $contents_rows = $contentsHandler->getCount($cont_crit);
        $cont_crit->setStart($start);
        $cont_crit->setLimit($limit);
		$contents_arr = $contentsHandler->getAll($cont_crit);
		unset($cont_crit);
		$GLOBALS['xoopsTpl']->assign('wgsitenotice_url', WGSITENOTICE_URL);
		$GLOBALS['xoopsTpl']->assign('wgsitenotice_upload_url', WGSITENOTICE_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_icons_url', WGSITENOTICE_ICONS_URL);
		// Table view
		if ($contents_rows > 0) 
		{						
            foreach (array_keys($contents_arr) as $i)
			{
                // Get Var cont_id
                $cont['id'] = $contents_arr[$i]->getVar('cont_id');
                // Get Var cont_version_id
                $versions_obj = $versionsHandler->get($contents_arr[$i]->getVar('cont_version_id'));
                if (is_object($versions_obj)) {
                    $version_name = $versions_obj->getVar('version_name') . ' (' . _AM_WGSITENOTICE_VERSION_ID . ' ' . $contents_arr[$i]->getVar('cont_version_id') . ')';
                } else {
                    $version_name = '- (' . _AM_WGSITENOTICE_VERSION_ID . ' ' . $contents_arr[$i]->getVar('cont_version_id') . ') ';
                }
                $cont['version_id'] = $version_name;
                // Get Var cont_header
                $cont['header'] = $contents_arr[$i]->getVar('cont_header');
                // Get Var cont_weight
                $cont['weight'] = $contents_arr[$i]->getVar('cont_weight');
                // Get Var cont_date
                $cont['date'] = formatTimestamp($contents_arr[$i]->getVar('cont_date'));
                $GLOBALS['xoopsTpl']->append('contents_list', $cont);
                unset($cont);
			}
			if ( $contents_rows > $limit ) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new XoopsPageNav($contents_rows, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
        } else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_WGSITENOTICE_THEREARENT_CONTENTS);
		}	
    break;
	case 'new':		
		$template_main = 'wgsitenotice_admin_contents.tpl';
        $adminMenu->addItemButton(_AM_WGSITENOTICE_CONTENTS_LIST, 'contents.php', 'list');
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(basename(__FILE__)));
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());	
		// Get Form		
        $contentsObj = $contentsHandler->create();
        $form = $contentsObj->getForm();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
	case 'save':
		if ( !$GLOBALS['xoopsSecurity']->check() ) {
           redirect_header('contents.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($cont_id)) {
           $contentsObj = $contentsHandler->get($cont_id);
        } else {
           $contentsObj = $contentsHandler->create();
        }
		// Set Vars
		// Set Var cont_version_id
		$contentsObj->setVar('cont_version_id', XoopsRequest::getInt('cont_version_id'));
		// Set Var cont_header
		$contentsObj->setVar('cont_header', XoopsRequest::getString('cont_header', ''));
		// Set Var cont_text
		$contentsObj->setVar('cont_text', XoopsRequest::getString('cont_text', ''));
		// Set Var cont_weight
		$contentsObj->setVar('cont_weight', XoopsRequest::getInt('cont_weight'));
		// Set Var cont_date
		$contentsObj->setVar('cont_date', time());
		// Insert Data
		if ($contentsHandler->insert($contentsObj)) {
           redirect_header('contents.php?op=list', 2, _AM_WGSITENOTICE_FORMOK);
        }
		// Get Form
        $GLOBALS['xoopsTpl']->assign('error', $contentsObj->getHtmlErrors());
        $form = $contentsObj->getForm();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
	break;
	case 'edit':	    
		$template_main = 'wgsitenotice_admin_contents.tpl';
        $adminMenu->addItemButton(_AM_WGSITENOTICE_CONTENT_ADD, 'contents.php?op=new', 'add');
		$adminMenu->addItemButton(_AM_WGSITENOTICE_CONTENTS_LIST, 'contents.php', 'list');
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(basename(__FILE__)));
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());	
		// Get Form
		$contentsObj = $contentsHandler->get($cont_id);
		$form = $contentsObj->getForm();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
	break;
	case 'delete':
		$contentsObj = $contentsHandler->get($cont_id);
		if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
			if ( !$GLOBALS['xoopsSecurity']->check() ) {
				redirect_header('contents.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($contentsHandler->delete($contentsObj)) {
				redirect_header('contents.php', 3, _AM_WGSITENOTICE_FORMDELOK);
			} else {
				echo $contentsObj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, 'cont_id' => $cont_id, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_WGSITENOTICE_FORMSUREDEL, $contentsObj->getVar('cont_header', 'n') . ' (' . $contentsObj->getVar('cont_weight') . ')'));
		}
	break;
        
    case 'order':
        $corder = XoopsRequest::getArray('corder', array());
        for ($i = 0, $iMax = count($corder); $i < $iMax; $i++){
            $contentsObj = $contentsHandler->get($corder[$i]);
            $contentsObj->setVar('cont_weight',$i+1);
            $contentsHandler->insert($contentsObj);
        }
        break;
}
include_once __DIR__ . '/footer.php';
