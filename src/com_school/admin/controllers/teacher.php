<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_School
 * @author     Manoj L <manoj_l@techjoomla.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Teacher controller class.
 *
 * @since  1.6
 */
class SchoolControllerTeacher extends \Joomla\CMS\MVC\Controller\FormController
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'teachers';
		parent::__construct();
	}
}
