<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/view.ctp */ ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
View">
<h3>檢視<?php echo $this->_tpl_vars['formLabel']; ?>
</h3><hr />
<div class="span-12">
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
        <div class="span-2"><?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
</div>
        <div class="span-9"><?php echo '<?php'; ?>

        if(empty($this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id'])) {
            echo '--';
        } else {
            echo $html->link($this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id'],array(
                'controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
',
                'action' => 'view',
                $this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id']
            ));
        }
        <?php echo '?>'; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['className'] => $this->_tpl_vars['classFields']):
?>
<?php $_from = $this->_tpl_vars['classFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <div class="span-2"><?php echo $this->_tpl_vars['item']['label']; ?>
</div>
        <div class="span-9"><?php echo '<?php'; ?>

        if($this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
']) {
<?php if (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'file'): ?>
            echo $html->link(FULL_BASE_URL . $upload->url($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
')) . '<br />';
<?php elseif (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'image'): ?>
            echo $html->link(
                $upload->image($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', 'thumb'),
                FULL_BASE_URL . $upload->url($this->data, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
'),
                array(), false, false
            );
<?php else: ?>
            echo $this->data['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'];
<?php endif; ?>
        }
        <?php echo '?>'; ?>
&nbsp;
        </div>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
</dl>
</div>
<div class="actions">
    <ul>
        <li><?php echo '<?php'; ?>
 echo $html->link('<?php echo $this->_tpl_vars['formLabel']; ?>
列表', array('action'=>'index')); <?php echo '?>'; ?>
 </li>
<?php if (isset ( $this->_tpl_vars['relationships']['hasOne'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasOne']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
        <li><?php echo '<?php'; ?>
 echo $html->link('檢視相關<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
', array('controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
', 'action' => 'view', $this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id']), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
ViewControl')); <?php echo '?>'; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['hasMany'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
        <li><?php echo '<?php'; ?>
 echo $html->link('檢視相關<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
', array('controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
', 'action' => 'index', '<?php echo $this->_tpl_vars['modelName']; ?>
', $this->data['<?php echo $this->_tpl_vars['modelName']; ?>
']['id']), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
ViewControl')); <?php echo '?>'; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
        <li><?php echo '<?php'; ?>
 echo $html->link('檢視相關<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
', array('controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
', 'action' => 'index', '<?php echo $this->_tpl_vars['modelName']; ?>
', $this->data['<?php echo $this->_tpl_vars['modelName']; ?>
']['id']), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
ViewControl')); <?php echo '?>'; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
    </ul>
</div>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
ViewPanel"></div>
<?php echo '<?php'; ?>

echo $html->scriptBlock('
$(document).ready(function() {
    $(\'a.<?php echo $this->_tpl_vars['controllerName']; ?>
ViewControl\').click(function() {
        $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
ViewPanel\').load(this.href);
        return false;
    });
});
');
<?php echo '?>'; ?>

</div>