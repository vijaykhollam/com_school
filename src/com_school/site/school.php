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

// Access check.
//~ if (!JFactory::getUser()->authorise('core.manage', 'com_school'))
//~ {
	//~ throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
//~ }

// Import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('School');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
