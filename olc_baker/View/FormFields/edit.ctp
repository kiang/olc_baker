<div class="formFields form">
    <?php echo $this->Form->create('FormField'); ?>
    <fieldset>
        <legend><?php echo __('Edit the form field'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name', array('label' => __('System name')));
        echo $this->Form->input('label', array('label' => __('Display name')));
        echo $this->Form->input('type', array('label' => __('Field type'), 'type' => 'select', 'options' => $types));
        echo $this->Form->input('sort', array('label' => __('Sort'),
            'value' => (isset($this->data['FormField']['sort'])) ? $this->data['FormField']['sort'] : 0));
        echo $this->Form->input('is_required', array('label' => __('Required?')));
        echo $this->Form->input('function_type', array('type' => 'select', 'label' => __('Field function type'),
            'options' => array(
                1 => __('Display the form field both when adding and editing'),
                2 => __('Display the form field when adding, display the value when editing'),
                3 => __('Generate the value when adding, display the value when editing'),
                4 => __('Generate the value when adding, display the form field when editing'),
                5 => __('Generate the value both when adding and editing'),
            ),
        ));
        echo '<div id="functionBlock">';
        echo $this->Form->input('function_string', array('type' => 'text', 'label' => __('Field function snippet')));
        echo $this->Form->input('x.functionSet', array('type' => 'select', 'label' => __('Quick select for function snippet'),
            'options' => array(
                '' => '--',
                'date(\'Y-m-d H:i:s\')' => __('Date + time'),
                'date(\'Y-m-d\')' => __('Date'),
                'date(\'H:i:s\')' => __('Time'),
                'mktime()' => __('Unix time'),
                '$_SERVER[\'REMOTE_HOST\']' => __('IP Address of the user'),
            )
        ));
        echo '</div>';
        ?>
        <div id="optionBlock"></div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('FormField.id')), null, __('Delete the item, sure?')); ?></li>
            <li><?php echo $this->Html->link(__('Back to the form'), array('controller' => 'forms', 'action' => 'view', $this->Form->value('FormField.form_id'))); ?></li>
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
$(function() {
	$(\'#FormFieldType\').change(function() {
		$(\'#optionBlock\').load(\'' . $this->Html->url(array('action' => 'type_form')) . '/\' +
			$(\'#FormFieldType option:selected\').val() + \'/' . $this->Form->value('FormField.id') . '\'
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
