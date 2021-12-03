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
//It recovered the value of argument op in URL$
$op = Request::getString('op', 'default');

$oc_server = Request::getString('oc_server', 'default');
if ('default' === $oc_server) {
  $oc_server = $helper->getConfig('wgsitenotice_oc_server').'checkonline.php';
}

$template_main = 'wgsitenotice_admin_checkonline.tpl';
$GLOBALS['xoopsTpl']->assign('disclaimer', \_AM_WGSITENOTICE_OC_DISCLAIMER);
$GLOBALS['xoopsTpl']->assign('disclaimer_desc', \_AM_WGSITENOTICE_OC_DISCLAIMER_DESCR);
$GLOBALS['xoopsTpl']->assign('onlinecheck_server', \_MI_WGSITENOTICE_OC_SERVER);
$GLOBALS['xoopsTpl']->assign('oc_server', $oc_server);
$GLOBALS['xoopsTpl']->assign('start_search', \_AM_WGSITENOTICE_OC_START);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);

// Switch options
switch ($op)
{
    case 'download':
        // Request version_id
        $version_id = Request::getInt('version_id');
        if (0 == $version_id) {
            $GLOBALS['xoopsTpl']->assign('error',\_AM_WGSITENOTICE_OC_ERR_INVALID_PARAM);
            break;
        }
        //$xml_text = \file_get_contents($oc_server.'?version_id='.$version_id);
        $xml_text = $checkonlineHandler->getData($oc_server . '?version_id='.$version_id);
        // echo $xml_text;
        $xml_arr = $checkonlineHandler->readXML($xml_text);
        // var_dump($xml_arr);
        if (!$xml_arr) {
            //error when loading xml
            $GLOBALS['xoopsTpl']->assign('error',\str_replace('%s', $oc_server, \_AM_WGSITENOTICE_OC_ERR_READ_XML));
        } else {
            echo $oc_server.'?version_id='.$version_id;
            echo $xml_arr->status_access;

            if ('allowed' == $xml_arr->status_access) {
                //download is allowed by the owner of the named server and save in table mod_wgsitenotice_versions
                foreach ($xml_arr->versions->version as $onlineversion) {
                    //first create version
                    $versionsObj = $versionsHandler->create();
                    // Set Vars
                    $versionsObj->setVar('version_name', $checkonlineHandler->xml2str($onlineversion->version_name));
                    $versionsObj->setVar('version_lang', $checkonlineHandler->xml2str($onlineversion->version_lang));
                    $versionsObj->setVar('version_descr', $checkonlineHandler->xml2str($onlineversion->version_descr));
                    $versionsObj->setVar('version_author', $checkonlineHandler->xml2str($onlineversion->version_author));
                    $versionsObj->setVar('version_date', $onlineversion->version_date);
                    // Insert Data
                    if ($versionsHandler->insert($versionsObj)) {
                        //than create content
                        $cont_errors = 0;
                        foreach ($xml_arr->versions->version->contents->content as $onlinecontent) {
                            $contentsObj = $contentsHandler->create();
                            // Set Vars
                            $contentsObj->setVar('cont_version_id', $versionsObj->getVar('version_id'));
                            $contentsObj->setVar('cont_header', $checkonlineHandler->xml2str($onlinecontent->cont_header));
                            /* echo "<br/>----------------------------------------------<br/>".$checkonlineHandler->xml2str($onlinecontent->cont_text);die; */
                            $contentsObj->setVar('cont_text', $checkonlineHandler->xml2str($onlinecontent->cont_text));
                            $contentsObj->setVar('cont_weight', $onlinecontent->cont_weight);
                            $contentsObj->setVar('cont_date', $onlinecontent->cont_date);
                            // Insert Data
                            if (!$contentsHandler->insert($contentsObj)) {
                               $cont_errors++;
                            }
                        }
                        if ($cont_errors > 0) {
                            \redirect_header('versions.php?op=list', 4, \str_replace('%e', $cont_errors, \_AM_WGSITENOTICE_OC_ERR_ADDCONT));
                        } else {
                            \redirect_header('versions.php?op=list', 2, \_AM_WGSITENOTICE_FORMOK);
                        }
                    }
                }
            } else if ('forbidden' == $xml_arr->status_access) {
                $GLOBALS['xoopsTpl']->assign('error',\_AM_WGSITENOTICE_OC_ERR_FORBIDDEN);
            } else {
                $GLOBALS['xoopsTpl']->assign('error',\str_replace('%s', $oc_server, \_AM_WGSITENOTICE_OC_ERR_CONNECT));
            }
        }
        break;

    case 'checkonline':
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_url', WGSITENOTICE_URL);
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_upload_url', WGSITENOTICE_UPLOAD_URL);

        // $xml_text = \file_get_contents($oc_server);
        $xml_text = $checkonlineHandler->getData($oc_server);
        $xml_arr = $checkonlineHandler->readXML($xml_text);
        // echo "xml_text:<br/>".$xml_text;
        // echo "<br/><br/>var_dump xml_arr:<br/>".var_dump($xml_arr);

        if (!$xml_arr) {
            $GLOBALS['xoopsTpl']->assign('error',\str_replace('%s', $oc_server, \_AM_WGSITENOTICE_OC_ERR_READ_XML));
        } else {
            // echo "<br/>status_access:".$xml_arr->status_access;
            if ('allowed' == $xml_arr->status_access) {
                if ($xml_arr->versions_rows > 0) {
                    //download is allowed by the owner of the named server
                    foreach ($xml_arr->versions->version as $onlineversion) {
                        $version['id'] = $onlineversion->version_id;
                        $version['name'] = $checkonlineHandler->xml2str($onlineversion->version_name);
                        $version['lang'] = $checkonlineHandler->xml2str($onlineversion->version_lang);
                        $version['descr'] = $checkonlineHandler->xml2str($onlineversion->version_descr);
                        $version['author'] = $checkonlineHandler->xml2str($onlineversion->version_author);
                        $version['date'] = \formatTimestamp($onlineversion->version_date);
                        $GLOBALS['xoopsTpl']->append('versions_list', $version);
                    }
                } else {
                    $GLOBALS['xoopsTpl']->assign('error',\_AM_WGSITENOTICE_OC_ERR_NO_VERSIONS);
                }
            } else if ('forbidden' == $xml_arr->status_access) {
                $GLOBALS['xoopsTpl']->assign('error',\_AM_WGSITENOTICE_OC_ERR_FORBIDDEN);
            } else {
                $GLOBALS['xoopsTpl']->assign('error',\str_replace('%s', $oc_server, \_AM_WGSITENOTICE_OC_ERR_CONNECT));
            }
        }
        unset($version);
        break;
    case 'default':
    default:
        $template_main = 'wgsitenotice_admin_checkonline.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation(\basename(__FILE__)));
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_url', WGSITENOTICE_URL);
        $GLOBALS['xoopsTpl']->assign('wgsitenotice_upload_url', WGSITENOTICE_UPLOAD_URL);
        // Get Form
        $checkonlineObj = $checkonlineHandler->create();
        $form = $checkonlineObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
}
include_once __DIR__ . '/footer.php';
