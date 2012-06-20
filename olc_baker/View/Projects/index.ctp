<div class="projects index">
    <h2><?php echo __('Projects'); ?></h2>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
        ));
        ?></p>
    <table class="systable" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort(__('System name'), 'name'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Display name'), 'label'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Created time'), 'created'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Modified time'), 'modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($projects as $project) {
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $project['Project']['name']; ?></td>
                <td><?php echo $project['Project']['label']; ?></td>
                <td><?php echo $project['Project']['created']; ?></td>
                <td><?php echo $project['Project']['modified']; ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
                <?php echo $this->Html->link(__('Build project'), array('action' => 'build', $project['Project']['id'])); ?>
                <?php echo $this->Html->link(__('Build database'), array('action' => 'rebuild_db', $project['Project']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id']), array('class' => 'dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $project['Project']['id']), null, __('Delete the item, sure?')); ?>
            </td>
        </tr>
        <?php } ?>
        </table>
    </div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Add'), array('action' => 'add'), array('class' => 'dialogControl')); ?></li>
    </ul>
</div>