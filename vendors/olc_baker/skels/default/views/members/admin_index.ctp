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
	<th><?php echo $paginator->sort('建立時間', 'created');?></th>
	<th><?php echo $paginator->sort('更新時間', 'modified');?></th>
	<th class="actions">操作</th>
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
			<?php echo $html->link('檢視', array('action'=>'view', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $html->link('編輯', array('action'=>'edit', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $html->link('刪除', array('action'=>'delete', $member['Member']['id']), null, '確定要刪除？'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('新增', array('action'=>'add'), array('class' => 'MembersAdminIndexControl')); ?></li>
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