<?php
$pageOption = array('url' => array($project['Project']['id']));
?>
<div class="projects view">
<h2>專案</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>系統名稱</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>顯示名稱</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['label']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>建立時間</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>更新時間</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('建立', array('action'=>'build', $project['Project']['id'])); ?></li>
		<li><?php echo $html->link('重建資料庫', array('action'=>'rebuild_db', $project['Project']['id'])); ?></li>
		<li><?php echo $html->link('匯入資料表', array('action'=>'db', $project['Project']['id'])); ?></li>
		<li><?php echo $html->link('回到列表', array('action'=>'index')); ?> </li>
	</ul>
</div>
<div class="forms index">
<h2>表單</h2>
<p>
<?php
echo $paginator->counter(array(
'format' => '第 %page% 頁 / 共 %pages% 頁（ 共 %count% 筆資料）'
));
?></p>
<table class="systable" cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('系統名稱', 'name', $pageOption);?></th>
	<th><?php echo $paginator->sort('顯示名稱', 'label', $pageOption);?></th>
	<th><?php echo $paginator->sort('建立時間', 'created', $pageOption);?></th>
	<th><?php echo $paginator->sort('更新時間', 'modified', $pageOption);?></th>
	<th class="actions">操作</th>
</tr>
<?php
$i = 0;
foreach ($forms as $form):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $form['Form']['name']; ?>
		</td>
		<td>
			<?php echo $form['Form']['label']; ?>
		</td>
		<td>
			<?php echo $form['Form']['created']; ?>
		</td>
		<td>
			<?php echo $form['Form']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link('檢視', array('controller' => 'forms', 'action'=>'view', $form['Form']['id'])); ?>
			<?php echo $html->link('編輯', array('controller' => 'forms', 'action'=>'edit', $form['Form']['id'])); ?>
			<?php echo $html->link('刪除', array('controller' => 'forms', 'action'=>'delete', $form['Form']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< 上一頁', $pageOption, null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers($pageOption);?>
	<?php echo $paginator->next('下一頁 >>', $pageOption, null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('controller' => 'forms', 'action'=>'add', $project['Project']['id'])); ?></li>
	</ul>
</div>