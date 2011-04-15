<?php
/**
 * i-MSCP - internet Multi Server Control Panel
 * Copyright (C) 2010 - 2011 by internet Multi Server Control Panel
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category    iMSCP
 * @package     iMSCP_Bootstap
 * @subpackage  Resource
 * @copyright   2010 - 2011 by i-MSCP | http://i-mscp.net
 * @author      Laurent Declercq <laurent.declercq@i-mscp.net>
 * @version     SVN: $Id: Db.php 4346 2011-02-15 06:26:31Z nuxwin $
 * @link        http://www.i-mscp.net i-MSCP Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

/**
 * Db plugin resource that initialize Zend_Db with decrypted password
 *
 * @category    iMSCP
 * @package     iMSCP_Bootstrap
 * @subpackage  Resource
 * @author      Laurent Declercq <laurent.declercq@i-mscp.net>
 * @copyright   2010 - 2011 by i-MSCP | http://i-mscp.net
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 * @since       1.0.0
 * @version     1.0.0
 */
class iMSCP_Bootstrap_Resource_Db extends Zend_Application_Resource_Db {

	/**
	 * Set the adapter params
	 *
	 * @param  string $adapter
	 * @return Zend_Application_Resource_Db
	 */
	public function setParams(array $params)
	{
		// Password decryption is done in the main bootstrap
		$config = Zend_Registry::get('config');
		$params = $config->resources->db->params->toArray();

		parent::setParams($params);
		return $this;
	}
}
