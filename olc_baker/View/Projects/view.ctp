<?php
$pageOption = array('url' => array($project['Project']['id']));
?>
<div class="projects view">
    <h2><?php echo __('Project detail'); ?></h2>
    <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php echo __('System name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $project['Project']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Display name'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['label']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Created time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php echo __('Modified time'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                    echo $class; ?>>
                <?php echo $project['Project']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Build project'), array('action' => 'build', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Build database'), array('action' => 'rebuild_db', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Import the table'), array('action' => 'db', $project['Project']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Project list'), array('action' => 'index')); ?> </li>
    </ul>
</div>
<div class="forms index">
    <h2><?php echo __('Project forms'); ?></h2>
    <p>
        <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
                ));
        ?></p>
            <table class="systable" cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo $this->Paginator->sort(__('System name'), 'name', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Display name'), 'label', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Created time'), 'created', $pageOption); ?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified time'), 'modified', $pageOption); ?></th>
                    <th class="actions"><?php echo __('Action'); ?></th>
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
                <?php echo $this->Html->link(__('View'), array('controller' => 'forms', 'action' => 'view', $form['Form']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'forms', 'action' => 'edit', $form['Form']['id']), array('class' => 'dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'forms', 'action' => 'delete', $form['Form']['id']), null, __('Delete the item, sure?')); ?>
                </td>
            </tr>
        <?php } ?>
            </table>
        </div>
        <div class="paging"><?php echo $this->element('paginator'); ?></div>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add'), array('controller' => 'forms', 'action' => 'add', $project['Project']['id']), array('class' => 'dialogControl')); ?></li>
    </ul>
</div>
