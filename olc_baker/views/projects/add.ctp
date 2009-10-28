<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend>新增</legend>
	<?php
	echo $form->input('name', array('label' => '系統名稱'));
	echo $form->input('label', array('label' => '顯示名稱'));
	echo $form->input('type', array('label' => '類型', 'type' => 'select', 'options' => $types));
	?>
	<div id="optionBlock"></div>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('列表', array('action'=>'index'));?></li>
	</ul>
</div>
<?php
echo $javascript->codeBlock('
$(document).ready(function() {
	$(\'#ProjectType\').change(function() {
		$(\'#optionBlock\').load(\'' . $html->url(array('action' => 'type_form')) . '/\' +
			$(\'#ProjectType option:selected\').val()
		);
	});
	$(\'#ProjectType\').trigger(\'change\');
});
');