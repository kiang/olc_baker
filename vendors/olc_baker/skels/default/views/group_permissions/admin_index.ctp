<div class="groupPermissions index" id="groupPermissionsIndex">
    <h2><?php __('Group Permissions'); ?></h2>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Group Permission', true), array(
    'action' => 'add'), array('class' => 'groupPermissionsIndexControl')); ?></li>
            <li><?php echo $this->PHtml->link(__('Members', true), array('controller' => 'members')); ?></li>
            <li><?php echo $this->PHtml->link(__('Groups', true), array('controller' => 'groups')); ?></li>
        </ul>
    </div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('parent_id'); ?></th>
            <th><?php echo $this->Paginator->sort('order'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('description'); ?></th>
            <th><?php echo $this->Paginator->sort('acos'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
                $i = 0;
                foreach ($groupPermissions as $groupPermission) {
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
        ?>
                    <tr<?php echo $class; ?>>
                        <td><?php echo $groupPermission['GroupPermission']['id']; ?>&nbsp;</td>
                        <td><?php echo $groupPermission['GroupPermission']['parent_id']; ?>&nbsp;</td>
                        <td><?php echo $groupPermission['GroupPermission']['order']; ?>&nbsp;</td>
                        <td><?php echo $groupPermission['GroupPermission']['name']; ?>&nbsp;</td>
                        <td><?php echo $groupPermission['GroupPermission']['description']; ?>&nbsp;</td>
                        <td><?php echo nl2br($groupPermission['GroupPermission']['acos']); ?>&nbsp;</td>
                        <td class="actions">
                <?php
                    echo $this->Html->link(__('Edit', true), array(
                        'action' => 'edit', $groupPermission['GroupPermission']['id']
                            ), array('class' => 'groupPermissionsIndexControl')); ?>
                <?php
                    echo $this->Html->link(__('Delete', true), array(
                        'action' => 'delete', $groupPermission['GroupPermission']['id']
                            ), null, __('Are you sure you want to delete?', true));
                ?>
                </td>
            </tr>
        <?php } ?>
            </table>
            <div class="paging"><?php echo $this->element('paginator'); ?></div>


    <?php
                $scripts = '
$(function() {
    $(\'#groupPermissionsIndex th a, #groupPermissionsIndex div.paging a\').click(function() {
        $(\'#groupPermissionsIndex\').parent().load(this.href);
        return false;
    });
    $(\'a.groupPermissionsIndexControl\').click(function() {
        dialogFull(this);
        return false;
    });
});';
                echo $this->Html->scriptBlock($scripts);
    ?>

</div>