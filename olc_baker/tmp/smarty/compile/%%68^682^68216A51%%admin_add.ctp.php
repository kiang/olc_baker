<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/admin_add.ctp */ ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
AdminAdd">
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
<?php echo '<?php'; ?>

$url = array();
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array('action' => 'add', $foreignModel, $foreignId);
} else {
    $url = array('action' => 'add');
    $foreignModel = '';
}
echo $form->create('<?php echo $this->_tpl_vars['modelName']; ?>
', array('type' => 'file', 'url' => $url));
<?php echo '?>'; ?>

<div class="addForm"><?php echo '<?php'; ?>
 echo $html->link(' ', array('action' => 'form', 0, $foreignModel)); <?php echo '?>'; ?>
</div>
<?php else: ?>
<?php echo '<?php'; ?>
 echo $form->create('<?php echo $this->_tpl_vars['modelName']; ?>
', array('type' => 'file')); <?php echo '?>'; ?>

<div class="addForm"><?php echo '<?php'; ?>
 echo $html->link(' ', array('action' => 'form')); <?php echo '?>'; ?>
</div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['relationships']['hasOne'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasOne']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
<div class="addForm"><?php echo '<?php'; ?>
 echo $html->link(' ', array('controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
', 'action' => 'form', 0, '<?php echo $this->_tpl_vars['modelName']; ?>
')); <?php echo '?>'; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php echo '<?php'; ?>
 echo $form->end(__('Submit', true)); <?php echo '?>'; ?>

<div class="actions">
    <ul>
        <li><?php echo '<?php'; ?>
 echo $html->link('列表', array('action'=>'index'));<?php echo '?>'; ?>
</li>
    </ul>
</div>
<?php echo '<?php'; ?>

echo $html->scriptBlock('
$(document).ready(function() {
    $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminAdd div.addForm a\').each(function() {
        $(this).parent().load(this.href);
    });
});
');
<?php echo '?>'; ?>

</div>