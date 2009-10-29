<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/admin_edit.ctp */ ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
AdminEdit">
<?php echo '<?php'; ?>
 echo $form->create('<?php echo $this->_tpl_vars['modelName']; ?>
', array('type' => 'file')); <?php echo '?>'; ?>

<div class="editForm"><?php echo '<?php'; ?>
 echo $html->link(' ', array('action' => 'form', $id)); <?php echo '?>'; ?>
</div>
<?php if (isset ( $this->_tpl_vars['relationships']['hasOne'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasOne']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
<?php echo '<?php'; ?>
 if($foreignId = $form->value('<?php echo $this->_tpl_vars['rOption']['className']; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
')): <?php echo '?>'; ?>

<div class="editForm"><?php echo '<?php'; ?>
 echo $html->link(' ', array('controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
', 'action' => 'form', $foreignId, '<?php echo $this->_tpl_vars['modelName']; ?>
')); <?php echo '?>'; ?>
</div>
<?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php echo '<?php'; ?>
 echo $form->end(__('Submit', true)); <?php echo '?>'; ?>

<div class="actions">
    <ul>
        <li><?php echo '<?php'; ?>
 echo $html->link(__('Delete', true), array('action'=>'delete', $id), null, __('Delete the item, sure?', true)); <?php echo '?>'; ?>
</li>
        <li><?php echo '<?php'; ?>
 echo $html->link('列表', array('action'=>'index'));<?php echo '?>'; ?>
</li>
    </ul>
</div>
<?php echo '<?php'; ?>

echo $html->scriptBlock('
$(document).ready(function() {
    $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminEdit div.editForm a\').each(function() {
        $(this).parent().load(this.href);
    });
});
');
<?php echo '?>'; ?>

</div>