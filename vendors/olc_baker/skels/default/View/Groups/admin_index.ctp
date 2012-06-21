<div id="GroupsAdminIndex">
    <h2><?php __('Group management', true); ?></h2>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table cellpadding="0" cellspacing="0" id="GroupsAdminIndexTable">
        <tr>
            <th><?php echo $this->Paginator->sort(__('Id', true), 'id'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Name', true), 'name'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($groups as $group):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class; ?>>
                <td>
                    <?php echo $group['Group']['id']; ?>
                </td>
                <td>
                    <?php echo $group['Group']['name']; ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $group['Group']['id']), array('class' => 'dialogControl')); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $group['Group']['id']), null, __('Delete the item, sure?', true)); ?>
                    <?php echo $this->Html->link(__('Sub group', true), array('action' => 'index', $group['Group']['id'])); ?>
                    <?php
                    if ($group['Group']['id'] != 1) {
                        echo $this->Html->link(__('Permission', true), array('controller' => 'group_permissions', 'action' => 'group', $group['Group']['id']));
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div class="actions">
        <ul>
            <?php if ($parentId > 0): ?>
                <li><?php echo $this->Html->link(__('Upper level', true), array('action' => 'index', $upperLevelId)); ?></li>
            <?php endif; ?>
            <li><?php echo $this->Html->link(__('New', true), array('action' => 'add', $parentId), array('class' => 'dialogControl')); ?></li>
            <li><?php echo $this->Html->link(__('Members', true), array('controller' => 'members')); ?></li>
            <li><?php echo $this->Html->link(__('Group Permissions', true), array('controller' => 'group_permissions')); ?></li>
        </ul>
    </div>
    <div id="GroupsAdminIndexPanel"></div>
    <?php
    echo $this->Html->scriptBlock('
$(function() {
    $(\'#GroupsAdminIndexTable th a, #GroupsAdminIndex div.paging a\').click(function() {
        $(\'#GroupsAdminIndex\').parent().load(this.href);
        return false;
    });
});
');
    ?>
</div>