<div class="groups form">
<?php echo $form->create('Group');?>
	<fieldset>
 		<legend>編輯群組</legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label' => '名稱：'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Group.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Group.id'))); ?></li>
		<li><?php echo $html->link(__('List', true), array('action'=>'index', $form->value('Group.parent_id')));?></li>
	</ul>
</div>
