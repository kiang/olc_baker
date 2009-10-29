<div class="groups form">
<?php echo $form->create('Group', array('url' => array($parentId)));?>
	<fieldset>
 		<legend>新增群組</legend>
	<?php
		echo $form->input('name', array('label' => '名稱：'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
