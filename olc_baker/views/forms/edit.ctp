<div class="forms form">
<?php echo $this->Form->create('Form');?>
	<fieldset>
 		<legend><?php __('Edit the form'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => __('System name', true)));
		echo $this->Form->input('label', array('label' => __('Display name', true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Form.id')), null, __('Delete the item, sure?', true)); ?></li>
		<li><?php echo $this->Html->link(__('Back to the project', true), array('controller' => 'projects', 'action'=>'view', $this->Form->value('Form.project_id')));?></li>
	</ul>
</div>