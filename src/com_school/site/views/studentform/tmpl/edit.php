<?php
/**
 * @version    SVN: <svn_id>
 * @package    Tjfields
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2015 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'studentform.cancel')
		{
			Joomla.submitform(task, document.getElementById('student-form'));
		}
		else
		{
			if (task != 'studentform.cancel' && document.formvalidator.isValid(document.id('student-form')))
			{
				Joomla.submitform(task, document.getElementById('student-form'));
			}
			else
			{
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<div class="">
	<form
		action=""
		method="post" enctype="multipart/form-data" name="student-form"
		id="student-form" class="form-validate">

		<div class="form-horizontal">
			<div class="row-fluid">
				<div class="span12 form-horizontal">
					<fieldset class="adminform">

	<?php echo $this->form->renderField('user_id'); ?>

	<?php echo $this->form->renderField('name'); ?>

	<?php echo $this->form->renderField('surname'); ?>

	<?php echo $this->form->renderField('education'); ?>

	<?php echo $this->form->renderField('hobbies'); ?>

	<?php echo $this->form->renderField('address'); ?>
					</fieldset>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a type="button" class="btn btn-primary validate" onclick="Joomla.submitbutton('studentform.save');">
					<?php echo JText::_('JSUBMIT'); ?>
				</a>
					<a class="btn"
						href="<?php echo JRoute::_('index.php?option=com_school&view=students'); ?>"
						title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
				</a> <input type="hidden" name="option" value="com_school" />
				<input
						type="hidden" name="controller" value="studentform" />
									<input type="hidden" name="view" value="studentform" />

				</div>
			</div>
			<input type="hidden" name="jform[user_id]" value="<?php echo JFactory::getUser()->id; ?>"/>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
