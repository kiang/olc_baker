<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend><?php echo __('Edit Member', true); ?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
		echo $form->input('group_id');
		echo $form->input('password', array('value' => ''));
		echo $form->input('user_status');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Member.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Member.id'))); ?></li>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
