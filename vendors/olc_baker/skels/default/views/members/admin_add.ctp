<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend><?php echo __('New Member', true); ?></legend>
	<?php
		echo $form->input('group_id');
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('user_status', array('type' => 'radio', 'options' => array('Y', 'N'), 'value' => 'Y'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
