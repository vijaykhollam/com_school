<?php
/**
 * @version    SVN: <svn_id>
 * @package    School
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2017 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla view library
jimport('joomla.application.component.view');

/**
 * Teachers view class
 *
 * @since  1.6
 */
class SchoolViewTeachers extends JViewLegacy
{
	/**
	 * Overwriting JView display method
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		// Assign data to the view
		$this->data = array(
			'a' => 11,
			'b' => 22,
			'c' => 33
		);

		echo json_encode($this->data);
	}
}
