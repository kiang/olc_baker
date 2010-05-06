<div id="MembersAdminIndex">
<h2><?php echo __('Member management', true); ?></h2>
<p>
<?php
echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
?>
</p>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<table cellpadding="0" cellspacing="0" id="MembersAdminIndexTable">
<tr>
	<th><?php echo $paginator->sort(__('Id', true), 'id');?></th>
	<th><?php echo $paginator->sort(__('Account', true), 'username');?></th>
	<th><?php echo $paginator->sort(__('Status', true), 'user_status');?></th>
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
			<?php echo $this->Html->link(__('View', true), array('action'=>'view', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $member['Member']['id']), array('class' => 'MembersAdminIndexControl')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $member['Member']['id']), null, __('Delete the item, sure?', true)); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Add', true), array('action'=>'add'), array('class' => 'MembersAdminIndexControl')); ?></li>
        <li><?php echo $this->Html->link(__('Groups', true), array('controller'=>'groups')); ?></li>
		<li><?php echo $this->Html->link(__('Generate testing members', true), array('action'=>'test')); ?></li>
        <li><?php echo $this->Html->link(__('Generate ACOs', true), array('action'=>'acos')); ?></li>
	</ul>
</div>
<div id="MembersAdminIndexPanel"></div>
<?php
echo $this->Html->scriptBlock('
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