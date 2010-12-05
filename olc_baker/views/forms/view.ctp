<div class="forms view">
    <h2><?php __('View the form'); ?></h2>
    <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('System name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $pForm['Form']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Display name'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['label']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Created time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Modified time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $pForm['Form']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pForm['Form']['id']), array('class' => 'dialogControl')); ?> </li>
        <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pForm['Form']['id']), null, __('Delete the item, sure?', true)); ?> </li>
        <li><?php echo $this->Html->link(__('Back to the project', true), array('controller' => 'projects', 'action' => 'view', $pForm['Form']['project_id'])); ?></li>
    </ul>
</div>
<div class="formFields index">
    <h2><?php __('Form fields'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php __('Field name'); ?></th>
            <th><?php __('Field type'); ?></th>
            <th><?php __('Sort'); ?></th>
            <th><?php __('Required'); ?></th>
            <th><?php __('Created time'); ?></th>
            <th><?php __('Modified time'); ?></th>
            <th class="actions"><?php echo __('Action', true); ?></th>
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
                <?php echo ($formField['FormField']['is_required'] == 0) ? __('Not required', true) : __('Required', true); ?>
                </td>
                <td>
                <?php echo $formField['FormField']['created']; ?>
                </td>
                <td>
                <?php echo $formField['FormField']['modified']; ?>
                </td>
                <td class="actions">
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'form_fields', 'action' => 'edit', $formField['FormField']['id']), array('class' => 'dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'form_fields', 'action' => 'delete', $formField['FormField']['id']), null, __('Delete the item, sure?', true)); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add', true), array('controller' => 'form_fields', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
            </ul>
        </div>

        <div class="relationships index">
            <h2><?php __('Form relationships'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php __('Relationship target'); ?></th>
                    <th><?php __('Relationship type'); ?></th>
                    <th><?php __('Created time'); ?></th>
                    <th><?php __('Modified time'); ?></th>
                    <th class="actions"><?php echo __('Action', true); ?></th>
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
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'relationships', 'action' => 'delete', $relationship['Relationship']['id']), null, __('Delete the item, sure?', true)); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add', true), array('controller' => 'relationships', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
            </ul>
        </div>

        <div class="actions index">
            <h2><?php __('Additional methods'); ?></h2>
    <?php __('Reserved method names:'); ?> index, view, admin_index, admin_add, admin_edit, admin_view, admin_habtm_set
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th><?php __('Method name'); ?></th>
                        <th><?php __('System name'); ?></th>
                        <th><?php __('Method engine'); ?></th>
                        <th><?php __('Created time'); ?></th>
                        <th><?php __('Modified time'); ?></th>
                        <th class="actions"><?php echo __('Action', true); ?></th>
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
                <?php echo $this->Html->link(__('Parameters', true), '#', array('onClick' => '$(\'#parameters' . $action['Action']['id'] . '\').toggle(); return false;')); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'actions', 'action' => 'delete', $action['Action']['id']), null, __('Delete the item, sure?', true)); ?>
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
                <li><?php echo $this->Html->link(__('Add', true), array('controller' => 'actions', 'action' => 'add', $pForm['Form']['id']), array('class' => 'dialogControl')); ?></li>
    </ul>
</div>