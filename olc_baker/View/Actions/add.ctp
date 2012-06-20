<div class="actions form">
    <?php echo $this->Form->create('Action', array('url' => array($formId))); ?>
    <fieldset>
        <legend><?php echo __('Add a method'); ?></legend>
        <?php
        echo $this->Form->input('action', array('label' => __('System name')));
        echo $this->Form->input('name', array('label' => __('Display name')));
        echo $this->Form->input('engine', array('label' => __('Method engine'), 'type' => 'select', 'options' => $engines));
        ?>
        <div id="parameterBlock"></div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the form'), array('controller' => 'forms', 'action' => 'view', $formId)); ?></li>
    </ul>
</div>
<script type="text/javascript">
    //<![CDATA[

    $(function() {
        $('#ActionEngine').change(function() {
            $('#parameterBlock').load('<?php echo $this->Html->url(array('action' => 'engine_form', $formId)); ?>/' +
                $('#ActionEngine option:selected').val());
        });
        $('#ActionEngine').trigger('change');
    });

    //]]>
</script>