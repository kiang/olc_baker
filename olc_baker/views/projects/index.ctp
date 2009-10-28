<div class="projects index">
<h2>專案管理</h2>
<p>
<?php
echo $paginator->counter(array(
'format' => '第 %page% 頁 / 共 %pages% 頁（ 共 %count% 筆資料）'
));
?></p>
<table class="systable" cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('系統名稱', 'name');?></th>
	<th><?php echo $paginator->sort('顯示名稱', 'label');?></th>
	<th><?php echo $paginator->sort('類型', 'type');?></th>
	<th><?php echo $paginator->sort('建立時間', 'created');?></th>
	<th><?php echo $paginator->sort('更新時間', 'modified');?></th>
	<th class="actions">操作</th>
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
			<?php echo $html->link('檢視', array('action'=>'view', $project['Project']['id'])); ?>
			<?php echo $html->link('建立', array('action'=>'build', $project['Project']['id'])); ?>
			<?php echo $html->link('重建資料庫', array('action'=>'rebuild_db', $project['Project']['id'])); ?>
			<?php echo $html->link('編輯', array('action'=>'edit', $project['Project']['id'])); ?>
			<?php echo $html->link('刪除', array('action'=>'delete', $project['Project']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< 上一頁', array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next('下一頁 >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('action'=>'add')); ?></li>
	</ul>
</div>