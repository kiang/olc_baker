<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php echo __('Add', true); ?></legend>
	<?php
	echo $form->input('id');
	echo $form->input('name', array('label' => __('System name', true)));
	echo $form->input('label', array('label' => __('Display name', true)));
	echo $form->input('rewrite_base', array('label' => __('Relative path to the root of url. For example, fill in /~kiang/demo/ when the url is http://localhost/~kiang/demo/', true)));
	echo $form->input('app_path', array('label' => __('Absolute path to the application:', true)));
	echo $form->input('db_host', array('label' => __('Location of database:', true)));
	echo $form->input('db_login', array('label' => __('Username of database:', true)));
	echo $form->input('db_password', array(
		'type' => 'password',
		'label' => __('Username of database:', true)
	));
	echo $form->input('db_name', array('label' => __('Name of the database:', true)));
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