<div class="forms form">
    <?php echo $this->Form->create('Form', array('url' => array($projectId))); ?>
    <fieldset>
        <legend><?php echo __('Add a form'); ?></legend>
        <?php
        echo $this->Form->input('name', array('label' => __('System name')));
        echo $this->Form->input('label', array('label' => __('Display name')));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Back to the project'), array('controller' => 'projects', 'action' => 'view', $projectId)); ?></li>
    </ul>
</div>