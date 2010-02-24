<div class="groups form">
<?php echo $form->create('Group', array('url' => array($parentId)));?>
	<fieldset>
 		<legend><?php echo __('Add group', true); ?></legend>
	<?php
		echo $form->input('name', array('label' => __('Name', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
