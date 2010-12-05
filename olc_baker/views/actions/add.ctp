<div class="actions form">
<?php echo $this->Form->create('Action', array('url' => array($formId)));?>
	<fieldset>
 		<legend><?php echo __('Add a method', true); ?></legend>
	<?php
	echo $this->Form->input('action', array('label' => __('System name', true)));
	echo $this->Form->input('name', array('label' => __('Display name', true)));
	echo $this->Form->input('engine', array('label' => __('Method engine', true), 'type' => 'select', 'options' => $engines));
	?>
	<div id="parameterBlock"></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to the form', true), array('controller' => 'forms', 'action'=>'view', $formId));?></li>
	</ul>
</div>
<?php
echo $this->Html->scriptBlock('
$(function() {
	$(\'#ActionEngine\').change(function() {
		$(\'#parameterBlock\').load(\'' . $this->Html->url(array('action' => 'engine_form', $formId)) . '/\' +
			$(\'#ActionEngine option:selected\').val()
		);
	});
	$(\'#ActionEngine\').trigger(\'change\');
});
');