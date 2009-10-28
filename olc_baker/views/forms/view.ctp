<div class="forms view">
<h2>表單</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>系統名稱</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pForm['Form']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>顯示名稱</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pForm['Form']['label']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>建立時間</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pForm['Form']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>更新時間</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pForm['Form']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('編輯', array('action'=>'edit', $pForm['Form']['id'])); ?> </li>
		<li><?php echo $html->link('刪除', array('action'=>'delete', $pForm['Form']['id']), null, '確定要刪除？'); ?> </li>
		<li><?php echo $html->link('回到專案', array('controller' => 'projects', 'action'=>'view', $pForm['Form']['project_id']));?></li>
	</ul>
</div>
<div class="formFields index">
<h2>表單欄位</h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>名稱</th>
	<th>欄位類型</th>
	<th>排序</th>
	<th>必填</th>
	<th>建立時間</th>
	<th>更新時間</th>
	<th class="actions">操作</th>
</tr>
<?php
$i = 0;
foreach ($formFields as $formField):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $formField['FormField']['label']; ?>
			(<?php echo $formField['FormField']['name']; ?>)
		</td>
		<td>
			<?php echo $formField['FormField']['type']; ?>
		</td>
		<td>
			<?php echo $formField['FormField']['sort']; ?>
		</td>
		<td>
			<?php echo ($formField['FormField']['is_required'] == 0) ? '非必填' : '必填'; ?>
		</td>
		<td>
			<?php echo $formField['FormField']['created']; ?>
		</td>
		<td>
			<?php echo $formField['FormField']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link('編輯', array('controller' => 'form_fields', 'action'=>'edit', $formField['FormField']['id'])); ?>
			<?php echo $html->link('刪除', array('controller' => 'form_fields', 'action'=>'delete', $formField['FormField']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('controller' => 'form_fields', 'action'=>'add', $pForm['Form']['id'])); ?></li>
	</ul>
</div>

<div class="relationships index">
<h2>關聯</h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>對象</th>
	<th>類型</th>
	<th>建立時間</th>
	<th>更新時間</th>
	<th class="actions">操作</th>
</tr>
<?php
$i = 0;
foreach ($relationships as $relationship):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $relationship['TargetForm']['label']; ?>
			(<?php echo $relationship['TargetForm']['name']; ?>)
		</td>
		<td><?php echo $oaTool->relation_type($relationship['Relationship']['type']); ?></td>
		<td><?php echo $relationship['Relationship']['created']; ?></td>
		<td><?php echo $relationship['Relationship']['modified']; ?></td>
		<td class="actions">
			<?php echo $html->link('刪除', array('controller' => 'relationships', 'action'=>'delete', $relationship['Relationship']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('controller' => 'relationships', 'action'=>'add', $pForm['Form']['id'])); ?></li>
	</ul>
</div>

<div class="actions index">
<h2>前台介面</h2>
*保留名稱： index, view, admin_index, admin_add, admin_edit, admin_view, admin_habtm_set
<table cellpadding="0" cellspacing="0">
<tr>
	<th>名稱</th>
	<th>系統名稱</th>
	<th>引擎</th>
	<th>建立時間</th>
	<th>更新時間</th>
	<th class="actions">操作</th>
</tr>
<?php
$i = 0;
foreach ($actions as $action):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $action['Action']['name']; ?></td>
		<td><?php echo $action['Action']['action']; ?></td>
		<td><?php echo $action['Action']['engine']; ?></td>
		<td><?php echo $action['Action']['created']; ?></td>
		<td><?php echo $action['Action']['modified']; ?></td>
		<td class="actions">
			<?php echo $html->link('參數', '#', array('onClick' => '$(\'#parameters' . $action['Action']['id'] . '\').toggle(); return false;')); ?>
			<?php echo $html->link('刪除', array('controller' => 'actions', 'action'=>'delete', $action['Action']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
	<tr<?php echo $class;?> style="display:none;" id="parameters<?php echo $action['Action']['id']; ?>">
		<td colspan="6" style="text-align:left;"><pre><?php print_r(unserialize($action['Action']['parameters'])); ?></pre></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('controller' => 'actions', 'action'=>'add', $pForm['Form']['id'])); ?></li>
	</ul>
</div>