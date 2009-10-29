<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend>編輯使用者</legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
		echo $form->input('group_id');
		echo $form->input('password', array('value' => ''));
		echo $form->input('user_status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('刪除', array('action'=>'delete', $form->value('Member.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Member.id'))); ?></li>
		<li><?php echo $html->link('列表', array('action'=>'index'));?></li>
	</ul>
</div>
