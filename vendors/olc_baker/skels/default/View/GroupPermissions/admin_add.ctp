<div class="groupPermissions form">
    <?php echo $this->Form->create('GroupPermission'); ?>
    <fieldset>
        <legend><?php __('Add Group Permission'); ?></legend>
        <?php
        echo '<div class="span-2 clear">Parent</div>' . $this->Form->input('parent_id', array(
            'type' => 'select',
            'empty' => array('0' => '-- no parent --'),
            'options' => $parents,
            'div' => 'span-4',
            'class' => 'span-4',
            'label' => false,
        ));
        echo '<div class="span-2 clear">Name</div>' . $this->Form->input('name', array(
            'type' => 'text',
            'div' => 'span-4',
            'class' => 'span-4',
            'label' => false,
        ));
        echo '<div class="span-2 clear">Description</div>' . $this->Form->input('description', array(
            'type' => 'text',
            'div' => 'span-12',
            'class' => 'span-12',
            'label' => false,
        ));
        echo '<div class="span-2 clear">Order</div>' . $this->Form->input('order', array(
            'type' => 'text',
            'div' => 'span-4',
            'class' => 'span-4',
            'label' => false,
            'value' => 1,
        ));
        echo '<div id="acosSection" style="display:none;">';
        echo '<div class="span-2 clear">Acos</div>' . $this->Form->input('acos', array(
            'type' => 'textarea',
            'div' => 'span-12',
            'class' => 'span-12',
            'label' => false,
        ));
        echo $this->Form->input('aco_select', array(
            'type' => 'select',
            'options' => $acos,
            'div' => 'clear prepend-3 span-4',
            'class' => 'span-4',
            'label' => false,
        ));
        echo '<div class="span-3">' . $this->Form->button('Push', array(
            'type' => 'button',
            'class' => 'span-3',
            'id' => 'acoPush',
        )) . '</div>';
        echo '<div class="span-3">' . $this->Form->button('Clear', array(
            'type' => 'button',
            'class' => 'span-3',
            'id' => 'acoClear',
        )) . '</div>';
        echo '</div>';
        ?>
    </fieldset>
    <?php
    echo $this->Form->end(__('Submit', true));
    echo $this->Html->scriptBlock('$(function() {
    $(\'#acoPush\').click(function() {
        var acoValue = $(\'#GroupPermissionAcos\').val();
        if(\'\' != acoValue) {
            acoValue += \'\\n\';
        }
        acoValue += $(\'#GroupPermissionAcoSelect\').val();
        $(\'#GroupPermissionAcos\').val(acoValue);
    });
    $(\'#acoClear\').click(function() {
        $(\'#GroupPermissionAcos\').val(\'\');
    });
    $(\'#GroupPermissionParentId\').change(function() {
        if($(this).val() == \'0\') {
            $(\'#acosSection\').hide();
            $(\'#GroupPermissionAcos\').val(\'\');
        } else {
            $(\'#acosSection\').show();
        }
    }).trigger(\'change\');
})');
    ?>
</div>