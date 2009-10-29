<div class="actions form">
<?php echo $form->create('Action', array('url' => array($formId)));?>
	<fieldset>
 		<legend><?php echo __('Add a method', true); ?></legend>
	<?php
	echo $form->input('action', array('label' => __('System name', true)));
	echo $form->input('name', array('label' => __('Display name', true)));
	echo $form->input('engine', array('label' => __('Method engine', true), 'type' => 'select', 'options' => $engines));
	?>
	<div id="parameterBlock"></div>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Back to the form', true), array('controller' => 'forms', 'action'=>'view', $formId));?></li>
	</ul>
</div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
	$(\'#ActionEngine\').change(function() {
		$(\'#parameterBlock\').load(\'' . $html->url(array('action' => 'engine_form', $formId)) . '/\' +
			$(\'#ActionEngine option:selected\').val()
		);
	});
	$(\'#ActionEngine\').trigger(\'change\');
});
');