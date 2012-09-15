<div class="forms form">
    <?php echo $this->Form->create('Form'); ?>
    <fieldset>
        <legend><?php echo __('Edit the form'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name', array('label' => __('System name')));
        echo $this->Form->input('label', array('label' => __('Display name')));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Form.id')), null, __('Delete the item, sure?')); ?></li>
            <li><?php echo $this->Html->link(__('Back to the project'), array('controller' => 'projects', 'action' => 'view', $this->Form->value('Form.project_id'))); ?></li>
    </ul>
</div>
