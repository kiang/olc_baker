<div class="forms form">
<?php echo $form->create('Form');?>
	<fieldset>
 		<legend>編輯</legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label' => '系統名稱'));
		echo $form->input('label', array('label' => '顯示名稱'));
	?>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('刪除', array('action'=>'delete', $form->value('Form.id')), null, '確定要刪除？'); ?></li>
		<li><?php echo $html->link('回到專案', array('controller' => 'projects', 'action'=>'view', $form->value('Form.project_id')));?></li>
	</ul>
</div>