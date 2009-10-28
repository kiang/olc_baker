<div class="forms form">
<?php echo $form->create('Form', array('url' => array($projectId)));?>
	<fieldset>
 		<legend>新增</legend>
	<?php
		echo $form->input('name', array('label' => '系統名稱'));
		echo $form->input('label', array('label' => '顯示名稱'));
	?>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('回到專案', array('controller' => 'projects', 'action'=>'view', $projectId));?></li>
	</ul>
</div>