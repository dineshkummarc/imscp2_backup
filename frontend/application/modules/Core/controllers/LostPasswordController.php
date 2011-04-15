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
 * @package     iMSCP_Core
 * @subpackage  Controllers
 * @copyright   2010 - 2011 by i-MSCP | http://i-mscp.net
 * @author      Laurent Declercq <laurent.declercq@i-mscp.net>
 * @version     SVN: $Id: LostPasswordController.php 4260 2011-01-06 15:24:11Z nuxwin $
 * @link        http://www.i-mscp.net i-MSCP Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

/**
 * Lost Password controller
 *
 * @category    iMSCP
 * @package     iMSCP_Core
 * @subpackage  Controllers
 * @author      Laurent Declercq <laurent.declercq@i-mscp.net>
 * @copyright   2010 - 2011 by i-MSCP | http://i-mscp.net
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 * @since       1.0.0
 * @version     1.0.0
 * @todo To be finished
 */
class LostPasswordController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('simple');
    }

    public function indexAction()
    {
	    $request = $this->getRequest();

	    if($request->isPost()) {
		    $captchaInputData = $request->getParam('captcha');

			if($this->isValidCaptcha($captchaInputData)) {
				// do - sendrequest
			} else {
				// flash notice
			}
	    }

		$this->view->captchaCode =  $this->generateCaptcha();
    }

	/**
	 * Generate a captcha
	 *
	 * @return string Unique captcha identifier
	 */
	protected function generateCaptcha() {

		$captcha = new Zend_Captcha_Image(
			array(
				'Timeout' => 60,
				'Wordlen' => 8,
				'Height' => 50,
				'Font' => ROOT_PATH . DS . 'data' . DS . 'fonts' . DS . 'Arial.ttf',
				'Width' => 190,
				'FontSize' => 25,
				'ImgDir' => PUBLIC_PATH . '/captcha',
				'ImgUrl' => '/captcha',
				'ImgAlt' => 'Captcha code',
				'Expiration' => 80
			)
		);

		// Generate captcha
		$this->view->captchaId = $captcha->generate();

		// Return captcha identifier
		return $captcha->render($this->view);
	}

	/**
	 * Validate captcha
	 *
	 * @param  $captcha
	 * @return bool TRUE on success, FALSE otherwise
	 */
	protected function isValidCaptcha($captcha) {

		$captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha['id']);
		$captchaIterator = $captchaSession->getIterator();
		$captchaWord = $captchaIterator['word'];

		return ($captchaWord && $captcha['input'] == $captchaWord);
	}
}
