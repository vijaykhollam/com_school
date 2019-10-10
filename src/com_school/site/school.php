<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_School
 * @author     Manoj L <manoj_l@techjoomla.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */

defined('_JEXEC') or die;

use \Joomla\CMS\Factory;
use \Joomla\CMS\MVC\Controller\BaseController;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('School', JPATH_COMPONENT);
JLoader::register('SchoolController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = BaseController::getInstance('School');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
