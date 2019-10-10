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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_school');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_school'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_USER_ID'); ?></th>
			<td><?php echo $this->item->user_id_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_SURNAME'); ?></th>
			<td><?php echo $this->item->surname; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_EDUCATION'); ?></th>
			<td><?php echo $this->item->education; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_HOBBIES'); ?></th>
			<td><?php echo nl2br($this->item->hobbies); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_SCHOOL_FORM_LBL_STUDENT_ADDRESS'); ?></th>
			<td><?php echo nl2br($this->item->address); ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_school&task=student.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_SCHOOL_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_school.student.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_SCHOOL_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_SCHOOL_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_SCHOOL_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_school&task=student.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_SCHOOL_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>