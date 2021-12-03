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

use Xmf\Request;
use XoopsModules\Wgsitenotice\Helper;

$helper = Helper::getInstance();
echo "<?xml version='1.0' encoding='utf-8'?>\n";

/* <?xml version="1.0" encoding="utf-8"?> */
echo "<document>\n";
echo "<status_connect>successful</status_connect>\n";
include \dirname(__DIR__, 2) . '/mainfile.php';
$dirname = \basename(__DIR__);

\defined('\XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

require_once \XOOPS_ROOT_PATH . '/modules/' . $dirname . '/header.php';

$version_id = Request::getInt('version_id');
echo '<version_id>' . $version_id . "</version_id>\n";

$oc_allowed = $helper->getConfig('wgsitenotice_oc_allowed');

if ($oc_allowed == 1) {
    //download of my version is allowed
    echo "<status_access>allowed</status_access>\n";
    $version_crit = new \CriteriaCompo();
    $version_crit->setSort('version_id ASC, version_name');
    $version_crit->setOrder('ASC');
    if ($version_id > 0) $version_crit->add(new \Criteria('version_id', $version_id));
    $version_crit->add(new \Criteria('version_online', '1'));
    $versions_rows = $versionsHandler->getCount($version_crit);
    echo '<versions_rows>' . $versions_rows . "</versions_rows>\n";
    $versions_arr = $versionsHandler->getAll($version_crit);
    unset($version_crit);
    if ($versions_rows > 0)
    {
        echo "<versions>\n";
        foreach (\array_keys($versions_arr) as $i) {
            echo "\t<version>\n";
            echo "\t<version_id>".$versions_arr[$i]->getVar('version_id')."</version_id>\n";
            echo "\t<version_name>".$versions_arr[$i]->getVar('version_name')."</version_name>\n";
            echo "\t<version_lang>".$versions_arr[$i]->getVar('version_lang')."</version_lang>\n";
            echo "\t<version_descr>".$versions_arr[$i]->getVar('version_descr')."</version_descr>\n";
            echo "\t<version_author>".$versions_arr[$i]->getVar('version_author')."</version_author>\n";
            echo "\t<version_date>".$versions_arr[$i]->getVar('version_date')."</version_date>\n";

            if ($version_id > 0) {
                echo "\t\t<contents>\n";
                $cont_crit = new \CriteriaCompo();
                $cont_crit->setSort('cont_weight');
                $cont_crit->setOrder('ASC');
                $cont_crit->add(new \Criteria('cont_version_id', $version_id));
                $contents_rows = $contentsHandler->getCount($cont_crit);
                $contents_arr = $contentsHandler->getAll($cont_crit);
                unset($cont_crit);
                if ($contents_rows > 0) {
                    foreach (\array_keys($contents_arr) as $j) {
                        echo "\t\t\t<content>\n";
                        echo "\t\t\t\t<cont_id>".$contents_arr[$j]->getVar('cont_id')."</cont_id>\n";
                        echo "\t\t\t\t<cont_version_id>".$contents_arr[$j]->getVar('cont_version_id')."</cont_version_id>\n";
                        $xml = $contents_arr[$j]->getVar('cont_header');
                        echo "\t\t\t\t<cont_header>".text2xml($xml)."</cont_header>\n";
                        $xml = $contents_arr[$j]->getVar('cont_text', 'n');
                        echo "\t\t\t\t<cont_text>".text2xml($xml)."</cont_text>\n";
                        echo "\t\t\t\t<cont_weight>".$contents_arr[$j]->getVar('cont_weight')."</cont_weight>\n";
                        echo "\t\t\t\t<cont_date>".$contents_arr[$j]->getVar('cont_date')."</cont_date>\n";
                        echo "\t\t\t</content>\n";
                    }
                }
                echo "\t\t</contents>\n";
            }
            echo "\t</version>\n";
        }
        echo "</versions>\n";
    }
} else {
    echo "<status_access>forbidden</status_access>\n";
}
echo "</document>\n";

function text2xml ($xml) {
    // replace html tags e.g. in case of links in the text
    $search = array('<', '>', '"');
    $replace  = array('&lt;', '&gt;', '&quot;');
    $str = \str_replace($search, $replace, (string)$xml);
    return $str;
}
