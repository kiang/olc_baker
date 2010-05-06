<div class="formFields form">
<?php echo $this->Form->create('FormField', array('url' => array($formId)));?>
	<fieldset>
 		<legend><?php echo __('Add a form field', true); ?></legend>
	<?php
	echo $this->Form->input('name', array('label' => __('System name', true)));
	echo $this->Form->input('label', array('label' => __('Display name', true)));
	echo $this->Form->input('type', array('label' => __('Field type', true), 'type' => 'select', 'options' => $types));
	echo $this->Form->input('sort', array('label' => __('Sort', true), 'value' => 0));
	echo $this->Form->input('is_required', array('label' => __('Required?')));
	echo $this->Form->input('function_type', array('type' => 'select', 'label' => __('Field function type', true),
    	'options' => array(
            1 => __('Display the form field both when adding and editing', true),
            2 => __('Display the form field when adding, display the value when editing', true),
            3 => __('Generate the value when adding, display the value when editing', true),
            4 => __('Generate the value when adding, display the form field when editing', true),
            5 => __('Generate the value both when adding and editing', true),
        ),
    ));
    echo '<div id="functionBlock">';
    echo $this->Form->input('function_string', array('type' => 'text', 'label' => __('Field function snippet', true)));
    echo $this->Form->input('x.functionSet', array('type' => 'select', 'label' => __('Quick select for function snippet', true),
    	'options' => array(
            '' => '--',
            'date(\'Y-m-d H:i:s\')' => __('Date + time', true),
            'date(\'Y-m-d\')' => __('Date', true),
            'date(\'H:i:s\')' => __('Time', true),
            'mktime()' => __('Unix time', true),
            '$_SERVER[\'REMOTE_HOST\']' => __('IP Address of the user', true),
        )
    ));
    echo '</div>';
	?>
	<div id="optionBlock"></div>
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
function switchFunctionBlock() {
	if($(\'#FormFieldFunctionType\').val() > 2) {
		$(\'#functionBlock\').show();
	} else {
		$(\'#functionBlock\').hide();
	}
}
$(document).ready(function() {
	$(\'#FormFieldType\').change(function() {
		$(\'#optionBlock\').load(\'' . $this->Html->url(array('action' => 'type_form')) . '/\' +
			$(\'#FormFieldType option:selected\').val()
		);
	});
	$(\'#FormFieldType\').trigger(\'change\');
	$(\'#FormFieldFunctionType\').change(function() {
		switchFunctionBlock();
	});
	$(\'#xFunctionSet\').change(function() {
		$(\'#FormFieldFunctionString\').attr(\'value\', this.value);
	});
	switchFunctionBlock();
});
');