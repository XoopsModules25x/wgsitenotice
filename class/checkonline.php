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
 * @version         $Id: 1.0 checkonline.php 1 Fri 2015/02/20 12:43:29Z Goffy / wedega.com / XOOPS Development Team $
 */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');
/**
 * Class Object WgsitenoticeCheckonline
 */
class WgsitenoticeCheckonline extends XoopsObject
{ 
	/**
	* @var mixed
	*/
	private $wgsitenotice = null;
	/**
	 * Constructor
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->wgsitenotice = WgsitenoticeHelper::getInstance();
		$this->initVar('oc_server', XOBJ_DTYPE_TXTBOX);
	}
	/**
	*  @static function &getInstance
	*  @param null
	*/
	public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }
	/**
	 * Get form
	 *
	 * @param mixed $action
	 */
	public function getForm($action = false)
	{	
		if ($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = sprintf(_AM_WGSITENOTICE_OC_FORM);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Checkonline handler
		$checkonlineHandler = $this->wgsitenotice->getHandler('checkonline');
        $oc_server = $this->wgsitenotice->getConfig('wgsitenotice_oc_server').'checkonline.php';
		// Form Text oc_server
		$form->addElement( new XoopsFormText(_MI_WGSITENOTICE_OC_SERVER, 'oc_server', 50, 255, $oc_server), true );
		// Send
		$form->addElement(new XoopsFormHidden('op', 'checkonline'));
		$form->addElement(new XoopsFormButton('', 'submit', _AM_WGSITENOTICE_OC_START, 'submit'));
		return $form;
	}
}

/**
 * Class Object Handler WgsitenoticeCheckonline
 */
class WgsitenoticeCheckonlineHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor
	 *
	 * @param string $db
	 */
	public function __construct($db)
	{
		parent::__construct($db, 'mod_wgsitenotice_checkonline', 'wgsitenoticecheckonline', 'onl_id', 'onl_text1');
	}
    
    /**
	 * request data from given website
	 *
	 * @param $oc_server
	 * @return result of http post
	 */
    public function getData($oc_server) {
        
        $postdata = http_build_query(
            array(
                'ptype' => 'get-data'
            )
        );

        if (function_exists('curl_init')) {   
            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $oc_server);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
            curl_setopt($ch, CURLOPT_TIMEOUT, 25);
            curl_setopt($ch, CURLOPT_VERBOSE, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

            //execute post
            $result = curl_exec($ch);
            // print_r(curl_getinfo($ch));
            if ($result == FALSE)  {
                echo '<br>unexpected curl_error:' . curl_error($ch) . '<br>';
            } 
            
            curl_close($ch);
        } else {
            $opts = array('http' =>
                        array(
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $postdata
                        )
                    );
        
            $context  = stream_context_create($opts);
            $result = file_get_contents($oc_server, false, $context);
        }       
        return $result;
    }
    
    /**
	 * read the given xml string (by getData) and create and array
	 *
	 * @param string $xml_string
	 * @return $xml_arr
	 */
    public function readXML($xml_string){
        // creating temporary string for avoiding entitiy errors
        $xml_string = str_replace('&', '[[avoid_entity_error]]', $xml_string);
        $search = array('<', '>', '"', '&');
        $replace  = array('&lt;', '&gt;', '&quot;', '&amp;');
        //$xml_string = str_replace($search, $replace, (string)$xml_string);
        $xml_arr = simplexml_load_string($xml_string);
        if (!$xml_arr) {
            //error when loading xml
            $xml = explode("\n", $xml_text);  
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                echo $this->display_xml_error($error, $xml);
            }
            libxml_clear_errors();
        }
        return $xml_arr;
    }
    
    /**
	 * convert xml content to html text
	 *
	 * @param string $xml
	 * @return xml as array
	 */
    public function xml2str($xml){
        // replace temporary string for avoiding entitiy errors
        $str = str_replace('[[avoid_entity_error]]', '&', (string)$xml);
        // rebuild html tags
        $search  = array('&lt;', '&gt;', '&quot;', '&amp;');
        $replace = array('<', '>', '"', '&');
        $str = str_replace($search, $replace, (string)$str);
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
        $return .= str_repeat('-', $error->column) . "^\n";

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

        $return .= trim($error->message) .
                   "\n  Line: $error->line" .
                   "\n  Column: $error->column";

        if ($error->file) {
            $return .= "\n  File: $error->file";
        }

        return "$return\n\n--------------------------------------------\n\n";
    }
}
