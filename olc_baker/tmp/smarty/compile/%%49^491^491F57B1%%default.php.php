<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/models/default.php */ ?>
<?php echo '<?php'; ?>

class <?php echo $this->_tpl_vars['modelName']; ?>
 extends AppModel {

    var $name = '<?php echo $this->_tpl_vars['modelName']; ?>
';
<?php if ($this->_tpl_vars['models'][$this->_tpl_vars['modelName']]['validate']): ?>
    var $validate = array(
<?php $_from = $this->_tpl_vars['models'][$this->_tpl_vars['modelName']]['validate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['options']):
?>
        '<?php echo $this->_tpl_vars['field']; ?>
' => array(
<?php $_from = $this->_tpl_vars['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option'] => $this->_tpl_vars['items']):
?>
            '<?php echo $this->_tpl_vars['option']; ?>
' => array(
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ikey'] => $this->_tpl_vars['item']):
?>
                '<?php echo $this->_tpl_vars['ikey']; ?>
' => <?php echo $this->_tpl_vars['item']; ?>
,
<?php endforeach; endif; unset($_from); ?>
            ),
<?php endforeach; endif; unset($_from); ?>
        ),
<?php endforeach; endif; unset($_from); ?>
    );
<?php endif; ?>

    var $actsAs = array(
<?php if ($this->_tpl_vars['uploads']): ?>
        'Upload' => array(
<?php $_from = $this->_tpl_vars['uploads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['value']):
?>
            '<?php echo $this->_tpl_vars['field']; ?>
' => array(
<?php if ($this->_tpl_vars['value'] == 'image'): ?>
                'styles' => array('thumb' => '150x150'),
<?php endif; ?>
            ),
<?php endforeach; endif; unset($_from); ?>
        ),
<?php endif; ?>
    );

<?php if (isset ( $this->_tpl_vars['relationships'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type'] => $this->_tpl_vars['value']):
?>
    var $<?php echo $this->_tpl_vars['type']; ?>
 = array(
<?php $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mKey'] => $this->_tpl_vars['mItem']):
?>
        '<?php echo $this->_tpl_vars['mKey']; ?>
' => array(
<?php $_from = $this->_tpl_vars['mItem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rKey'] => $this->_tpl_vars['rItem']):
?>
<?php if ($this->_tpl_vars['rItem'] == 'true' || $this->_tpl_vars['rItem'] == 'false'): ?>
            '<?php echo $this->_tpl_vars['rKey']; ?>
' => <?php echo $this->_tpl_vars['rItem']; ?>
,
<?php else: ?>
            '<?php echo $this->_tpl_vars['rKey']; ?>
' => '<?php echo $this->_tpl_vars['rItem']; ?>
',
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
        ),
<?php endforeach; endif; unset($_from); ?>
    );
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

    function afterSave($created) {
<?php if (isset ( $this->_tpl_vars['relationships']['hasOne'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['hasOne']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
        if(!empty($this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
'])) {
            if($created) {
                $this-><?php echo $this->_tpl_vars['rOption']['className']; ?>
->create();
            }
            $this->data['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
'] = $this->id;
            $this-><?php echo $this->_tpl_vars['rOption']['className']; ?>
->save($this->data);
        }
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
	}

}