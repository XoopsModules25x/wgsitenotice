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

/*
 * Class Object Versions
 */
class Versions extends \XoopsObject
{
    /*
    * @var mixed
    */
    private $helper = null;
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('version_id', \XOBJ_DTYPE_INT);
        $this->initVar('version_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('version_lang', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('version_descr', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('version_author', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('version_weight', \XOBJ_DTYPE_INT);
        $this->initVar('version_current', \XOBJ_DTYPE_INT);
        $this->initVar('version_online', \XOBJ_DTYPE_INT);
        $this->initVar('version_date', \XOBJ_DTYPE_INT);
    }
    /*
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
    /*
     * Get form
     *
     * @param mixed $action
     */
    public function getForm($action = false)
    {
        $helper = Helper::getInstance();

        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_WGSITENOTICE_VERSION_ADD) : \sprintf(\_AM_WGSITENOTICE_VERSION_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Versions handler
        //$versionsHandler = $helper->getHandler('versions');
        // Form Text version_name
        $form->addElement( new \XoopsFormText(\_AM_WGSITENOTICE_VERSION_NAME, 'version_name', 50, 255, $this->getVar('version_name')), true );
        // Form Text version_lang
        $form->addElement( new \XoopsFormText(\_AM_WGSITENOTICE_VERSION_LANG, 'version_lang', 50, 255, $this->getVar('version_lang')) );
        // Form Text Area
        // Form Dhtml Text Area
        $editor_configs = array();
        $editor_configs['name'] = 'version_descr';
        $editor_configs['value'] = $this->getVar('version_descr', 'e');
        $editor_configs['rows'] = 5;
        $editor_configs['cols'] = 40;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('wgsitenotice_editor');
        $form->addElement( new \XoopsFormEditor(\_AM_WGSITENOTICE_VERSION_DESCR, 'version_descr', $editor_configs) );
        // Form Text version_author
        $version_author = $this->isNew() ? $GLOBALS['xoopsUser']->getVar('uname') : $this->getVar('version_author');
        $form->addElement( new \XoopsFormText(\_AM_WGSITENOTICE_VERSION_AUTHOR, 'version_author', 50, 255, $version_author) );
        // Form Text version_weight
        $form->addElement( new \XoopsFormHidden('version_weight', $this->getVar('version_weight')) );
        // Form Radio Yes/No version_current
        $version_current = $this->isNew() ? 0 : $this->getVar('version_current');
        $form->addElement( new \XoopsFormRadioYN(\_AM_WGSITENOTICE_VERSION_CURRENT, 'version_current', $version_current), true );
        // Form Radio Yes/No
        $version_online = $this->isNew() ? 0 : $this->getVar('version_online');
        $form->addElement( new \XoopsFormRadioYN(\_AM_WGSITENOTICE_VERSION_ONLINE, 'version_online', $version_online), true );
        // Form Text Date Select
        //$form->addElement( new \XoopsFormTextDateSelect(\_AM_WGSITENOTICE_VERSION_DATE, 'version_date', '', $this->getVar('version_date')), true );
        // Send
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        return $form;
    }
}
