<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php echo __('Add', true); ?></legend>
	<?php
	echo $form->input('id');
	echo $form->input('name', array('label' => __('System name', true)));
	echo $form->input('label', array('label' => __('Display name', true)));
	echo $form->input('type', array('label' => __('Project type', true), 'type' => 'select', 'options' => $types));
	?>
	<div id="optionBlock"></div>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Project.id')), null, __('Delete the item, sure?', true)); ?></li>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
	$(\'#ProjectType\').change(function() {
		$(\'#optionBlock\').load(\'' . $html->url(array('action' => 'type_form')) . '/\' +
			$(\'#ProjectType option:selected\').val() + \'/' . $form->value('Project.id') . '\'
		);
	});
	$(\'#ProjectType\').trigger(\'change\');
});
');