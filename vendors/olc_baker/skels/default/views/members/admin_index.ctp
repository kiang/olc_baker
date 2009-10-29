<div id="MembersAdminIndex">
<h2>會員管理</h2>
<p>
<?php echo $paginator->counter(array('format' => '第 %page% 頁 / 共 %pages% 頁')); ?>
</p>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<table cellpadding="0" cellspacing="0" id="MembersAdminIndexTable">
<tr>
	<th><?php echo $paginator->sort('編號', 'id');?></th>
	<th><?php echo $paginator->sort('帳號', 'username');?></th>
	<th><?php echo $paginator->sort('狀態', 'user_status');?></th>
	<th><?php echo $paginator->sort(__('Created time', true), 'created');?></th>
	<th><?php echo $paginator->sort(__('Modified time', true), 'modified');?></th>
	<th class="actions"><?php echo __('Action', true); ?></th>
</tr>
<?php
$i = 0;
foreach ($members as $member):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $member['Member']['id']; ?>
		</td>
		<td>
			<?php echo $member['Member']['username']; ?>
		</td>
		<td>
			<?php echo $member['Member']['user_status']; ?>
		</td>
		<td>
			<?php echo $member['Member']['created']; ?>
		</td>
		<td>
			<?php echo $member['Member']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $member['Member']['id']), null, __('Delete the item, sure?', true)); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add', true), array('action'=>'add'), array('class' => 'MembersAdminIndexControl')); ?></li>
        <li><?php echo $html->link('群組', array('controller'=>'groups')); ?></li>
		<li><?php echo $html->link('產生測試資料', array('action'=>'test')); ?></li>
        <li><?php echo $html->link('產生ACOs', array('action'=>'acos')); ?></li>
	</ul>
</div>
<div id="MembersAdminIndexPanel"></div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
    $(\'#MembersAdminIndexTable th a, #MembersAdminIndex div.paging a\').click(function() {
        $(\'#MembersAdminIndex\').load(this.href);
        return false;
    });
    $(\'a.MembersAdminIndexControl\').click(function() {
        var target = $(\'#MembersAdminIndexPanel\');
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