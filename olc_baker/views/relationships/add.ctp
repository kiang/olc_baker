<div class="relationships form">
<?php echo $form->create('Relationship', array('url' => array($baseForm['BaseForm']['id'])));?>
	<fieldset>
 		<legend><?php echo __('Add a relationship', true); ?></legend>
	<?php
	echo $form->input('form_id_target', array(
	    'label' => __('Relationship target', true),
	    'type' => 'select',
	    'options' => $targetForms,
	));
	echo $form->input('type', array(
	    'label' => __('Relationship type', true),
	    'type' => 'select',
	    'options' => $oaTool->relation_list(),
	));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Back to the project', true), array('controller' => 'projects', 'action'=>'view', $baseForm['BaseForm']['project_id']));?></li>
	</ul>
</div>