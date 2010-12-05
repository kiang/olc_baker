<div id="GroupsAdminIndex">
    <h2><?php __('Group management', true); ?></h2>
    <p>
        <?php
        echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
        ?>
    </p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table cellpadding="0" cellspacing="0" id="GroupsAdminIndexTable">
        <tr>
            <th><?php echo $paginator->sort(__('Id', true), 'id'); ?></th>
            <th><?php echo $paginator->sort(__('Name', true), 'name'); ?></th>
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
                <?php echo $this->PHtml->link(__('Edit', true), array('action' => 'edit', $group['Group']['id']), array('class' => 'GroupsAdminIndexControl')); ?>
                <?php echo $this->PHtml->link(__('Delete', true), array('action' => 'delete', $group['Group']['id']), null, __('Delete the item, sure?', true)); ?>
                <?php echo $this->PHtml->link(__('Sub group', true), array('action' => 'index', $group['Group']['id'])); ?>
                <?php echo $this->PHtml->link(__('Permission', true), array('action' => 'acos', $group['Group']['id'])); ?>
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
                    <li><?php echo $this->PHtml->link(__('New', true), array('action' => 'add', $parentId), array('class' => 'GroupsAdminIndexControl')); ?></li>
                    <li><?php echo $this->PHtml->link(__('Members', true), array('controller' => 'members')); ?></li>
                </ul>
            </div>
            <div id="GroupsAdminIndexPanel"></div>
    <?php
                    echo $this->Html->scriptBlock('
$(document).ready(function() {
    $(\'#GroupsAdminIndexTable th a, #GroupsAdminIndex div.paging a\').click(function() {
        $(\'#GroupsAdminIndex\').load(this.href);
        return false;
    });
    $(\'a.GroupsAdminIndexControl\').click(function() {
        dialogFull(this);
        return false;
    });
});
');
    ?>
</div>