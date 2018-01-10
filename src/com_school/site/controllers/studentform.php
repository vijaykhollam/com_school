<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die();

require_once JPATH_COMPONENT . '/controller.php';

/**
 * The article controller
 *
 * @since  1.6
 */
class SchoolControllerStudentform extends SchoolController
{
	/**
	 * Method to save a user's profile data.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public function save($key = null, $urlVar = null)
	{
		// Check for request forgeries.
		$this->checkToken();

		$app = JFactory::getApplication();
		$model = $this->getModel('studentform');

		// Get the user data.
		$requestData = $app->input->post->get('jform', array(), 'array');

		// Validate the posted data.
		$form = $model->getForm();

		if (! $form)
		{
			JError::raiseError(500, $model->getError());

			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $requestData);

		// Check for errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i ++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				}
				else
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_school.edit.student.data', $requestData);

			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_school.edit.student.id');
			$this->setRedirect(JRoute::_('index.php?option=com_school&view=studentform&layout=edit&id=' . $userId, false));

			return false;
		}

		// Attempt to save the data.
		$return = $model->save($data);

		// Check for errors.
		if ($return === false)
		{
			// Save the data in the session.
			$app->setUserState('com_school.edit.student.data', $data);

			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_school.edit.student.id');
			$this->setMessage(JText::sprintf('COM_SCHOOL_STUDENT_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_school&view=studentform&layout=edit&id=' . $userId, false));

			return false;
		}
		else
		{
			$this->setMessage(JText::_('COM_SCHOOL_STUDENT_SAVE_SUCCESS'), 'success');
			$this->setRedirect(JRoute::_('index.php?option=com_school&view=students', false));
		}

		// Flush the data from the session.
		$app->setUserState('com_school.edit.student.data', null);
	}
}
