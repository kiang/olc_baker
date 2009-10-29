<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/admin_form.ctp */ ?>
<div class="<?php echo $this->_tpl_vars['controllerName']; ?>
 form">
    <fieldset>
         <legend><?php echo '<?php'; ?>

         if($id > 0) {
             echo __('Edit', true);
         } else {
             echo __('Add', true);
         }
         <?php echo '?>'; ?>
<?php echo $this->_tpl_vars['formLabel']; ?>
</legend>
    <?php echo '<?php'; ?>

    if($id > 0) {
        echo $form->input('<?php echo $this->_tpl_vars['modelName']; ?>
.id');
    }
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
    foreach($belongsToModels AS $key => $model) {
        echo '<div class="span-3">' . $model['label'] . '：</div>' .
        $form->input('<?php echo $this->_tpl_vars['modelName']; ?>
.' . $model['foreignKey'], array(
        	'type' => 'select',
        	'label' => false,
            'options' => $$key,
        	'div' => 'span-6',
        	'class' => 'span-6',
        )) . '<hr />';
    }
<?php endif; ?>

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['className'] => $this->_tpl_vars['classFields']):
?>
<?php $_from = $this->_tpl_vars['classFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['group']):
?>
<?php if (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'file'): ?>
    if(!empty($this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'])) {
        echo $html->link(FULL_BASE_URL . $upload->url($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
')) . '<br />';
    }
<?php elseif (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'image'): ?>
    if(!empty($this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'])) {
        echo $html->link(
            $upload->image($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', 'thumb'),
            FULL_BASE_URL . $upload->url($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
'),
            array(), false, false
        );
    }
<?php endif; ?>
<?php if ($this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_type'] == 1): ?>
    echo '<div class="span-3">' . '</div>' .
    $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array(
<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value']):
?>
        '<?php echo $this->_tpl_vars['key2']; ?>
' => '<?php echo $this->_tpl_vars['value']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        'div' => 'span-6',
        'class' => 'span-6',
    )) . '<hr />';
<?php elseif ($this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_type'] == 2): ?>
    if($id > 0) {
        echo '<div><?php echo $this->_tpl_vars['classFields'][$this->_tpl_vars['key']]['label']; ?>
：' . $this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'] . '</div>';
    } else {
        echo $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array(
<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value']):
?>
        	'<?php echo $this->_tpl_vars['key2']; ?>
' => '<?php echo $this->_tpl_vars['value']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        ));
    }
<?php elseif ($this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_type'] == 3): ?>
    if($id > 0) {
        echo '<div><?php echo $this->_tpl_vars['classFields'][$this->_tpl_vars['key']]['label']; ?>
：' . $this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'] . '</div>';
    } else {
        echo $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array('type' => 'hidden', 'value' => <?php echo $this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_string']; ?>
));
    }
<?php elseif ($this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_type'] == 4): ?>
    if($id > 0) {
        echo $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array(
<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value']):
?>
        	'<?php echo $this->_tpl_vars['key2']; ?>
' => '<?php echo $this->_tpl_vars['value']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        ));
    } else {
        echo $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array('type' => 'hidden', 'value' => <?php echo $this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_string']; ?>
));
    }
<?php elseif ($this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_type'] == 5): ?>
    echo $form->input('<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array('type' => 'hidden', 'value' => <?php echo $this->_tpl_vars['fieldTypes'][$this->_tpl_vars['className']][$this->_tpl_vars['key']]['function_string']; ?>
));
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php echo '?>'; ?>

</fieldset>
</div>