<div class="formFields form">
<?php echo $form->create('FormField');?>
	<fieldset>
 		<legend><?php echo __('Edit the form field', true); ?></legend>
	<?php
	echo $form->input('id');
	echo $form->input('name', array('label' => __('System name', true)));
	echo $form->input('label', array('label' => __('Display name', true)));
	echo $form->input('type', array('label' => __('Field type', true), 'type' => 'select', 'options' => $types));
	echo $form->input('sort', array('label' => __('Sort', true), 'value' => 0));
	echo $form->input('is_required', array('label' => __('Required?')));
	echo $form->input('function_type', array('type' => 'select', 'label' => __('Field function type', true),
    	'options' => array(
            1 => __('Display the form field both when adding and editing', true),
            2 => __('Display the form field when adding, display the value when editing', true),
            3 => __('Generate the value when adding, display the value when editing', true),
            4 => __('Generate the value when adding, display the form field when editing', true),
            5 => __('Generate the value both when adding and editing', true),
        ),
    ));
    echo '<div id="functionBlock">';
    echo $form->input('function_string', array('type' => 'text', 'label' => __('Field function snippet', true)));
    echo $form->input('x.functionSet', array('type' => 'select', 'label' => __('Quick select for function snippet', true),
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
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('FormField.id')), null, __('Delete the item, sure?', true)); ?></li>
		<li><?php echo $html->link(__('Back to the form', true), array('controller' => 'forms', 'action'=>'view', $form->value('FormField.form_id')));?></li>
	</ul>
</div>
<?php
echo $html->scriptBlock('
function switchFunctionBlock() {
	if($(\'#FormFieldFunctionType\').val() > 2) {
		$(\'#functionBlock\').show();
	} else {
		$(\'#functionBlock\').hide();
	}
}
$(document).ready(function() {
	$(\'#FormFieldType\').change(function() {
		$(\'#optionBlock\').load(\'' . $html->url(array('action' => 'type_form')) . '/\' +
			$(\'#FormFieldType option:selected\').val() + \'/' . $form->value('FormField.id') . '\'
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