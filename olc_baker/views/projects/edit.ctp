<div class="projects form">
<?php echo $this->Form->create('Project');?>
	<fieldset>
 		<legend><?php echo __('Add', true); ?></legend>
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('label' => __('System name', true)));
	echo $this->Form->input('label', array('label' => __('Display name', true)));
	echo $this->Form->input('rewrite_base', array('label' => __('Relative path to the root of url. For example, fill in /~kiang/demo/ when the url is http://localhost/~kiang/demo/', true)));
	echo $this->Form->input('app_path', array('label' => __('Absolute path to the application:', true)));
	echo $this->Form->input('db_host', array('label' => __('Location of database:', true)));
	echo $this->Form->input('db_login', array('label' => __('Username of database:', true)));
	echo $this->Form->input('db_password', array(
		'type' => 'password',
		'label' => __('Username of database:', true)
	));
	echo $this->Form->input('db_name', array('label' => __('Name of the database:', true)));
	?>
	<div id="optionBlock"></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Project.id')), null, __('Delete the item, sure?', true)); ?></li>
		<li><?php echo $this->Html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>