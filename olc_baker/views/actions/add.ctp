<div class="actions form">
<?php echo $form->create('Action', array('url' => array($formId)));?>
	<fieldset>
 		<legend>新增</legend>
	<?php
	echo $form->input('action', array('label' => '系統名稱(小寫英文)'));
	echo $form->input('name', array('label' => '顯示名稱'));
	echo $form->input('engine', array('label' => '引擎', 'type' => 'select', 'options' => $engines));
	?>
	<div id="parameterBlock"></div>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('回到表單', array('controller' => 'forms', 'action'=>'view', $formId));?></li>
	</ul>
</div>
<?php
echo $javascript->codeBlock('
$(document).ready(function() {
	$(\'#ActionEngine\').change(function() {
		$(\'#parameterBlock\').load(\'' . $html->url(array('action' => 'engine_form', $formId)) . '/\' +
			$(\'#ActionEngine option:selected\').val()
		);
	});
	$(\'#ActionEngine\').trigger(\'change\');
});
');