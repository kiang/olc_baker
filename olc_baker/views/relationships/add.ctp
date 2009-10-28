<div class="relationships form">
<?php echo $form->create('Relationship', array('url' => array($baseForm['BaseForm']['id'])));?>
	<fieldset>
 		<legend>新增</legend>
	<?php
	echo $form->input('form_id_target', array(
	    'label' => '關聯對象',
	    'type' => 'select',
	    'options' => $targetForms,
	));
	echo $form->input('type', array(
	    'label' => '關聯類型',
	    'type' => 'select',
	    'options' => $oaTool->relation_list(),
	));
	?>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('回到專案', array('controller' => 'projects', 'action'=>'view', $baseForm['BaseForm']['project_id']));?></li>
	</ul>
</div>