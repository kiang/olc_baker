<div class="forms form">
<?php echo $form->create('Form');?>
	<fieldset>
 		<legend><?php __('Edit the form'); ?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label' => __('System name', true)));
		echo $form->input('label', array('label' => __('Display name', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Form.id')), null, __('Delete the item, sure?', true)); ?></li>
		<li><?php echo $html->link(__('Back to the project', true), array('controller' => 'projects', 'action'=>'view', $form->value('Form.project_id')));?></li>
	</ul>
</div>