<?php

namespace XoopsModules\Wgsitenotice;

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

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Handler Checkonline
 */
class CheckonlineHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param string $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'mod_wgsitenotice_checkonline', Checkonline::class, 'onl_id', 'onl_text1');
    }

    /**
     * request data from given website
     *
     * @param $oc_server
     * @return string result of http post
     */
    public function getData($oc_server) {

        $postdata = \http_build_query(
            array(
                'ptype' => 'get-data'
            )
        );

        if (\function_exists('curl_init')) {
            //open connection
            $ch = \curl_init();

            //set the url, number of POST vars, POST data
            \curl_setopt($ch, CURLOPT_URL, $oc_server);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
            \curl_setopt($ch, CURLOPT_TIMEOUT, 25);
            \curl_setopt($ch, CURLOPT_VERBOSE, false);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            \curl_setopt($ch, CURLOPT_POST, 1);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

            //execute post
            $result = \curl_exec($ch);
            // print_r(\curl_getinfo($ch));
            if (false == $result)  {
                //echo '<br>unexpected curl_error:' . \curl_error($ch) . '<br>';
                $GLOBALS['xoopsTpl']->assign('error',\curl_error($ch));
            }

            \curl_close($ch);
        } else {
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context  = \stream_context_create($opts);
            $result = \file_get_contents($oc_server, false, $context);
        }
        return $result;
    }

    /**
     * read the given xml string (by getData) and create an array
     *
     * @param string $xml_string
     * @return array
     */
    public function readXML($xml_string){
        // creating temporary string for avoiding entitiy errors
        $xml_string = \str_replace('&', '[[avoid_entity_error]]', $xml_string);
        //$search = array('<', '>', '"', '&');
        //$replace  = array('&lt;', '&gt;', '&quot;', '&amp;');
        //$xml_string = \str_replace($search, $replace, (string)$xml_string);
        $xml_arr = \simplexml_load_string($xml_string);
        if (!$xml_arr) {
            //error when loading xml
            $xml = \explode("\n", $xml_string);
            $errors = \libxml_get_errors();
            foreach ($errors as $error) {
                //echo $this->display_xml_error($error, $xml);
                $GLOBALS['xoopsTpl']->assign('error',$this->display_xml_error($error, $xml));
            }
            \libxml_clear_errors();
        }

        return $xml_arr;
    }

    /**
     * convert xml content to html text
     *
     * @param string $xml
     * @return string
     */
    public function xml2str($xml){
        // replace temporary string for avoiding entitiy errors
        $str = \str_replace('[[avoid_entity_error]]', '&', (string)$xml);
        // rebuild html tags
        $search  = ['&lt;', '&gt;', '&quot;', '&amp;'];
        $replace = ['<', '>', '"', '&'];
        $str = \str_replace($search, $replace, (string)$str);
        return $str;
    }

    /**
     * @param $error
     * @param $xml
     * @return string
     */
    public function display_xml_error($error, $xml)
    {
        $return  = $xml[$error->line - 1] . "\n";
        $return .= \str_repeat('-', $error->column) . "^\n";

        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "Warning $error->code: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "Error $error->code: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "Fatal Error $error->code: ";
                break;
        }

        $return .= \trim($error->message) .
            "\n  Line: $error->line" .
            "\n  Column: $error->column";

        if ($error->file) {
            $return .= "\n  File: $error->file";
        }

        return "$return\n\n--------------------------------------------\n\n";
    }
}
