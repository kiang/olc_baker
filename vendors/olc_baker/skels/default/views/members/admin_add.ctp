<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend>新增使用者</legend>
	<?php
		echo $form->input('group_id');
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('user_status', array('type' => 'radio', 'options' => array('Y', 'N'), 'value' => 'Y'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('列表', array('action'=>'index'));?></li>
	</ul>
</div>
