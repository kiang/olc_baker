<?php
$pageOption = array('url' => array($project['Project']['id']));
?>
<div class="projects view">
    <h2><?php echo __('Project detail', true); ?></h2>
    <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php echo __('System name', true); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $project['Project']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Display name', true); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['label']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Created time', true); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Modified time', true); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Build project', true), array('action' => 'build', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Build database', true), array('action' => 'rebuild_db', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Import the table', true), array('action' => 'db', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Project list', true), array('action' => 'index')); ?> </li>
    </ul>
</div>
<div class="forms index">
    <h2><?php echo __('Project forms', true); ?></h2>
    <p>
        <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
                ));
        ?></p>
            <table class="systable" cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo $this->Paginator->sort(__('System name', true), 'name', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Display name', true), 'label', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Created time', true), 'created', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified time', true), 'modified', $pageOption); ?></th>
                    <th class="actions"><?php echo __('Action', true); ?></th>
                </tr>
        <?php
                $i = 0;
                foreach ($forms as $form) {
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
        ?>
                    <tr<?php echo $class; ?>>
                        <td>
                <?php echo $form['Form']['name']; ?>
                </td>
                <td>
                <?php echo $form['Form']['label']; ?>
                </td>
                <td>
                <?php echo $form['Form']['created']; ?>
                </td>
                <td>
                <?php echo $form['Form']['modified']; ?>
                </td>
                <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'forms', 'action' => 'view', $form['Form']['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'forms', 'action' => 'edit', $form['Form']['id']), array('class' => 'dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'forms', 'action' => 'delete', $form['Form']['id']), null, __('Delete the item, sure?', true)); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="paging"><?php echo $this->element('paginator'); ?></div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add', true), array('controller' => 'forms', 'action' => 'add', $project['Project']['id']), array('class' => 'dialogControl')); ?></li>
    </ul>
</div>