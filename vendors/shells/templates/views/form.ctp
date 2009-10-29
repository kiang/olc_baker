<div class="<?php echo $pluralVar;?> form">
<?php echo "<?php echo \$form->create('{$modelClass}');?>\n";?>
	<fieldset>
 		<legend><?php echo "<?php __('".Inflector::humanize($action)."');?>";?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if ($action == 'add' && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$form->input('{$field}');\n";
			}
		}
		if(!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$form->end(__('Submit', true));?>\n";
?>
</div>
<div class="actions">
	<ul>
<?php if ($action != 'add'):?>
		<li><?php echo "<?php echo \$html->link(__('Delete', true), array('action'=>'delete', \$form->value('{$modelClass}.{$primaryKey}')), null, __('Delete the item, sure?', true)); ?>";?></li>
<?php endif;?>
		<li><?php echo "<?php echo \$html->link('列表', array('action'=>'index'));?>";?></li>
	</ul>
</div>