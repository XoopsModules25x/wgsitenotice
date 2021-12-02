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
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GPL 2.0 or later
 * @package         wgsitenotice
 * @since           1.0
 * @min_xoops       2.5.7
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

use XoopsModules\Wgsitenotice\Helper;

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Checkonline
 */
class Checkonline extends \XoopsObject
{

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('oc_server', \XOBJ_DTYPE_TXTBOX);
    }

    /**
     * @static function &getInstance
     * @param null
     * @return Checkonline
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
     * @return \XoopsThemeForm
     */
    public function getForm($action = false)
    {
        $helper = Helper::getInstance();
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = \sprintf(\_AM_WGSITENOTICE_OC_FORM);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $oc_server = $helper->getConfig('wgsitenotice_oc_server').'checkonline.php';
        // Form Text oc_server
        $form->addElement( new \XoopsFormText(\_MI_WGSITENOTICE_OC_SERVER, 'oc_server', 50, 255, $oc_server), true );
        // Send
        $form->addElement(new \XoopsFormHidden('op', 'checkonline'));
        $form->addElement(new \XoopsFormButton('', 'submit', \_AM_WGSITENOTICE_OC_START, 'submit'));
        return $form;
    }
}
