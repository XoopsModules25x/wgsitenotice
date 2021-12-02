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

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/*
 * Class Object Handler Versions
 */
class VersionsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param string $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'wgsitenotice_versions', Versions::class, 'version_id', 'version_name');
    }
}
