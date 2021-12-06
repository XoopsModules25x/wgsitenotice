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

use XoopsModules\Wgsitenotice\Helper;

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Contents
 */
class Contents extends \XoopsObject
{

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('cont_id', \XOBJ_DTYPE_INT);
        $this->initVar('cont_version_id', \XOBJ_DTYPE_INT);
        $this->initVar('cont_header', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cont_text', \XOBJ_DTYPE_TXTAREA);
        $this->initVar('cont_weight', \XOBJ_DTYPE_INT);
        $this->initVar('cont_date', \XOBJ_DTYPE_INT);
        $this->initVar('dohtml', \XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @static function &getInstance
     * @param null
     * @return Contents
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
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_WGSITENOTICE_CONTENT_ADD) : \sprintf(\_AM_WGSITENOTICE_CONTENT_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Contents handler
        //$contentsHandler = $helper->getHandler('contents');
        // Form Topic Contents
        $Handler = $helper->getHandler('versions');
        $_select = new \XoopsFormSelect(\_AM_WGSITENOTICE_CONT_VERSION_ID, 'cont_version_id', $this->getVar('cont_version_id'));
        $_select->addOptionArray($Handler->getList());
        $form->addElement( $_select );
        // Form cont_header
        $form->addElement( new \XoopsFormText(\_AM_WGSITENOTICE_CONT_HEADER, 'cont_header', 50, 255, $this->getVar('cont_header')), true );
        // Form cont_text
        $editor_configs = array();
        $editor_configs['name'] = 'cont_text';
        $editor_configs['value'] = $this->getVar('cont_text', 'e');
        $editor_configs['rows'] = 5;
        $editor_configs['cols'] = 40;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('wgsitenotice_editor');
        $form->addElement( new \XoopsFormEditor(\_AM_WGSITENOTICE_CONT_TEXT, 'cont_text', $editor_configs) );
        // Form Text cont_weight
        $cont_weight = $this->isNew() ? 1 : $this->getVar('cont_weight');
        $form->addElement( new \XoopsFormText(\_AM_WGSITENOTICE_CONT_WEIGHT, 'cont_weight', 50, 255, $cont_weight), true );
        // Form Text Date Select
        //$form->addElement( new \XoopsFormTextDateSelect(\_AM_WGSITENOTICE_CONT_DATE, 'cont_date', '', $this->getVar('cont_date')), true );
        // Send
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }
}
