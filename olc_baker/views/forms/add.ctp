<div class="forms form">
    <?php echo $this->Form->create('Form', array('url' => array($projectId))); ?>
    <fieldset>
        <legend><?php __('Add a form', true); ?></legend>
        <?php
        echo $this->Form->input('name', array('label' => __('System name', true)));
        echo $this->Form->input('label', array('label' => __('Display name', true)));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Back to the project', true), array('controller' => 'projects', 'action' => 'view', $projectId)); ?></li>
    </ul>
</div>