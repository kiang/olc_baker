<div id="GroupsAdminIndex">
<h2>群組管理</h2>
<p>
<?php echo $paginator->counter(array('format' => '第 %page% 頁 / 共 %pages% 頁')); ?>
</p>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<table cellpadding="0" cellspacing="0" id="GroupsAdminIndexTable">
<tr>
	<th><?php echo $paginator->sort('編號', 'id');?></th>
	<th><?php echo $paginator->sort('名稱', 'name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($groups as $group):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $group['Group']['id']; ?>
		</td>
		<td>
			<?php echo $group['Group']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $group['Group']['id']), array('class' => 'GroupsAdminIndexControl')); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $group['Group']['id']), null, __('Delete the item, sure?', true)); ?>
			<?php echo $html->link('子群組', array('action'=>'index', $group['Group']['id'])); ?>
			<?php echo $html->link('設定權限', array('action'=>'acos', $group['Group']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<div class="actions">
	<ul>
		<?php if($parentId > 0): ?>
		<li><?php echo $html->link('上一層', array('action'=>'index', $upperLevelId)); ?></li>
		<?php endif; ?>
		<li><?php echo $html->link(__('New', true), array('action'=>'add', $parentId), array('class' => 'GroupsAdminIndexControl')); ?></li>
        <li><?php echo $html->link('會員', array('controller'=>'members')); ?></li>
	</ul>
</div>
<div id="GroupsAdminIndexPanel"></div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
    $(\'#GroupsAdminIndexTable th a, #GroupsAdminIndex div.paging a\').click(function() {
        $(\'#GroupsAdminIndex\').load(this.href);
        return false;
    });
    $(\'a.GroupsAdminIndexControl\').click(function() {
        var target = $(\'#GroupsAdminIndexPanel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
});
');
?>
</div>