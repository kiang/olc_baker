<div class="forms form">
<?php echo $form->create('Form', array('url' => array($projectId)));?>
	<fieldset>
 		<legend><?php __('Add a form', true); ?></legend>
	<?php
		echo $form->input('name', array('label' => __('System name', true)));
		echo $form->input('label', array('label' => __('Display name', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Back to the project', true), array('controller' => 'projects', 'action'=>'view', $projectId));?></li>
	</ul>
</div>