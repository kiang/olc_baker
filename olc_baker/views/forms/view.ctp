<div class="forms view">
    <h2><?php echo __('View the form'); ?></h2>
    <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php echo __('System name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $pForm['Form']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Display name'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['label']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Created time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Modified time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pForm['Form']['id']), array('class' => 'dialogControl')); ?> </li>
        <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $pForm['Form']['id']), null, __('Delete the item, sure?')); ?> </li>
        <li><?php echo $this->Html->link(__('Back to the project'), array('controller' => 'projects', 'action' => 'view', $pForm['Form']['project_id'])); ?></li>
    </ul>
</div>
<div class="formFields index">
    <h2><?php echo __('Form fields'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Field name'); ?></th>
            <th><?php echo __('Field type'); ?></th>
            <th><?php echo __('Sort'); ?></th>
            <th><?php echo __('Required'); ?></th>
            <th><?php echo __('Created time'); ?></th>
            <th><?php echo __('Modified time'); ?></th>
            <th class="actions"><?php echo __('Action'); ?></th>
        </tr>
        <?php
                $i = 0;
                foreach ($formFields as $formField) {
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
        ?>
                    <tr<?php echo $class; ?>>
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
                <?php echo ($formField['FormField']['is_required'] == 0) ? __('Not required') : __('Required'); ?>
                </td>
                <td>
                <?php echo $formField['FormField']['created']; ?>
                </td>
                <td>
                <?php echo $formField['FormField']['modified']; ?>
                </td>
                <td class="actions">
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'form_fields', 'action' => 'edit', $formField['FormField']['id']), array('class' => 'dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'form_fields', 'action' => 'delete', $formField['FormField']['id']), null, __('Delete the item, sure?')); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add'), array('controller' => 'form_fields', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
            </ul>
        </div>

        <div class="relationships index">
            <h2><?php echo __('Form relationships'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo __('Relationship target'); ?></th>
                    <th><?php echo __('Relationship type'); ?></th>
                    <th><?php echo __('Created time'); ?></th>
                    <th><?php echo __('Modified time'); ?></th>
                    <th class="actions"><?php echo __('Action'); ?></th>
                </tr>
        <?php
                $i = 0;
                foreach ($relationships as $relationship) {
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
        ?>
                    <tr<?php echo $class; ?>>
                        <td>
                <?php echo $relationship['TargetForm']['label']; ?>
                			(<?php echo $relationship['TargetForm']['name']; ?>)
                </td>
                <td><?php echo $this->OaTool->relation_type($relationship['Relationship']['type']); ?></td>
                <td><?php echo $relationship['Relationship']['created']; ?></td>
                <td><?php echo $relationship['Relationship']['modified']; ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'relationships', 'action' => 'delete', $relationship['Relationship']['id']), null, __('Delete the item, sure?')); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add'), array('controller' => 'relationships', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
            </ul>
        </div>

        <div class="actions index">
            <h2><?php echo __('Additional methods'); ?></h2>
    <?php echo __('Reserved method names:'); ?> index, view, admin_index, admin_add, admin_edit, admin_view, admin_habtm_set
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?php echo __('Method name'); ?></th>
                        <th><?php echo __('System name'); ?></th>
                        <th><?php echo __('Method engine'); ?></th>
                        <th><?php echo __('Created time'); ?></th>
                        <th><?php echo __('Modified time'); ?></th>
                        <th class="actions"><?php echo __('Action'); ?></th>
                    </tr>
        <?php
                $i = 0;
                foreach ($actions as $action) {
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
        ?>
                    <tr<?php echo $class; ?>>
                        <td><?php echo $action['Action']['name']; ?></td>
                        <td><?php echo $action['Action']['action']; ?></td>
                        <td><?php echo $action['Action']['engine']; ?></td>
                        <td><?php echo $action['Action']['created']; ?></td>
                        <td><?php echo $action['Action']['modified']; ?></td>
                        <td class="actions">
                <?php echo $this->Html->link(__('Parameters'), '#', array('onClick' => '$(\'#parameters' . $action['Action']['id'] . '\').toggle(); return false;')); ?>
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'actions', 'action' => 'delete', $action['Action']['id']), null, __('Delete the item, sure?')); ?>
                </td>
            </tr>
            <tr<?php echo $class; ?> style="display:none;" id="parameters<?php echo $action['Action']['id']; ?>">
                <td colspan="6" style="text-align:left;"><pre><?php print_r(unserialize($action['Action']['parameters'])); ?></pre></td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add'), array('controller' => 'actions', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
    </ul>
</div>