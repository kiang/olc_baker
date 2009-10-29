<div class="projects index">
<h2><?php echo __('Projects', true); ?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table class="systable" cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort(__('System name', true), 'name');?></th>
	<th><?php echo $paginator->sort(__('Display name', true), 'label');?></th>
	<th><?php echo $paginator->sort(__('Project type', true), 'type');?></th>
	<th><?php echo $paginator->sort(__('Created time', true), 'created');?></th>
	<th><?php echo $paginator->sort(__('Modified time', true), 'modified');?></th>
	<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php
$i = 0;
foreach ($projects as $project):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $project['Project']['name']; ?></td>
		<td><?php echo $project['Project']['label']; ?></td>
		<td><?php echo $project['Project']['type']; ?></td>
		<td><?php echo $project['Project']['created']; ?></td>
		<td><?php echo $project['Project']['modified']; ?></td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Build project', true), array('action'=>'build', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Build database', true), array('action'=>'rebuild_db', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $project['Project']['id']), null, __('Delete the item, sure?', true)); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true) . ' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add', true), array('action'=>'add')); ?></li>
	</ul>
</div>