<div class="relationships form">
    <?php echo $this->Form->create('Relationship', array('url' => array($baseForm['BaseForm']['id']))); ?>
    <fieldset>
        <legend><?php echo __('Add a relationship', true); ?></legend>
        <?php
        echo $this->Form->input('form_id_target', array(
            'label' => __('Relationship target', true),
            'type' => 'select',
            'options' => $targetForms,
        ));
        echo $this->Form->input('type', array(
            'label' => __('Relationship type', true),
            'type' => 'select',
            'options' => $this->OaTool->relation_list(),
        ));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Back to the project', true), array('controller' => 'projects', 'action' => 'view', $baseForm['BaseForm']['project_id'])); ?></li>
    </ul>
</div>