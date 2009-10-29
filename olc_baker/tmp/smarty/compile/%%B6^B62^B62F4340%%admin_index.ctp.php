<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/admin_index.ctp */ ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndex">
<h2><?php echo $this->_tpl_vars['formLabel']; ?>
管理</h2><hr />
<?php echo '<?php'; ?>

if(!isset($url)) {
    $url = array();
}
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
<?php endif; ?>
<?php echo '?>'; ?>

<div class="span-6"><?php echo '<?php'; ?>

echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
<?php echo '?>'; ?>
</div>
<div class="span-18 last">
<?php echo '<?php'; ?>

echo $form->create('<?php echo $this->_tpl_vars['modelName']; ?>
', array('type' => 'get', 'url' => array_merge($url, array('action' => 'index'))));
echo $form->text('keyword', array('class' => 'span-10', 'value' => $keyword));
echo $form->submit('查詢', array('div' => false));
echo $form->end();
<?php echo '?>'; ?>

</div>
<div class="paging"><?php echo '<?php'; ?>
 echo $this->element('paginator'); <?php echo '?>'; ?>
</div>
<table cellpadding="0" cellspacing="0" id="<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexTable">
<thead>
<tr>
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
	<?php echo '<?php'; ?>

	if(!empty($op)) {
	    echo '<th>&nbsp;</th>';
	}
	<?php echo '?>'; ?>

<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
	<?php echo '<?php'; ?>
 if(empty($scope['<?php echo $this->_tpl_vars['modelName']; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
'])): <?php echo '?>'; ?>

    <th><?php echo '<?php'; ?>
 echo $paginator->sort('<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
', '<?php echo $this->_tpl_vars['modelName']; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
', array('url' => $url));<?php echo '?>'; ?>
</th>
    <?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['className'] => $this->_tpl_vars['classFields']):
?>
<?php $_from = $this->_tpl_vars['classFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
    <th><?php echo '<?php'; ?>
 echo $paginator->sort('<?php echo $this->_tpl_vars['item']['label']; ?>
', '<?php echo $this->_tpl_vars['modelName']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', array('url' => $url));<?php echo '?>'; ?>
</th>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
    <th class="actions"><?php echo '<?php'; ?>
 echo __('Action', true); <?php echo '?>'; ?>
</th>
</tr>
</thead>
<tbody>
<?php echo '<?php'; ?>

$i = 0;
foreach ($items as $item):
    $class = null;
    if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
    }
<?php echo '?>'; ?>

    <tr<?php echo '<?php'; ?>
 echo $class;<?php echo '?>'; ?>
>
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
	<?php echo '<?php'; ?>

	if(!empty($op)) {
	    echo '<td>';
	    $options = array('value' => $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id'], 'class' => 'habtmSet');
	    if($item['option'] == 1) {
	        $options['checked'] = 'checked';
	    }
	    echo $form->checkbox('Set.' . $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id'], $options);
	    echo '<div id="messageSet' . $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id'] . '"></div></td>';
	}
	<?php echo '?>'; ?>

<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
	<?php echo '<?php'; ?>
 if(empty($scope['<?php echo $this->_tpl_vars['modelName']; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
'])): <?php echo '?>'; ?>

    <td><?php echo '<?php'; ?>

    if(empty($item['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id'])) {
        echo '--';
    } else {
        echo $html->link($item['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id'],array(
            'controller' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
',
            'action' => 'view',
            $item['<?php echo $this->_tpl_vars['rOption']['className']; ?>
']['id']
        ));
    }
    <?php echo '?>'; ?>
</td>
    <?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['className'] => $this->_tpl_vars['classFields']):
?>
<?php $_from = $this->_tpl_vars['classFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
    <td><?php echo '<?php'; ?>

if($item['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
']) {
<?php if (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'file'): ?>
    echo $html->link(FULL_BASE_URL . $upload->url($item, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
')) . '<br />';
<?php elseif (isset ( $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['uploads'][$this->_tpl_vars['key']] == 'image'): ?>
    echo $html->link(
        $upload->image($item, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
', 'thumb'),
        FULL_BASE_URL . $upload->url($item, '<?php echo $this->_tpl_vars['className']; ?>
.<?php echo $this->_tpl_vars['key']; ?>
'),
        array(), false, false
    );
<?php else: ?>
    echo $item['<?php echo $this->_tpl_vars['className']; ?>
']['<?php echo $this->_tpl_vars['key']; ?>
'];
<?php endif; ?>
}
<?php echo '?>'; ?>
</td>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
    <td class="actions">
<?php echo '<?php'; ?>
 echo $html->link(__('View', true), array('action'=>'view', $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id']), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexControl')); <?php echo '?>'; ?>

<?php echo '<?php'; ?>
 echo $html->link(__('Edit', true), array('action'=>'edit', $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id']), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexControl')); <?php echo '?>'; ?>

<?php echo '<?php'; ?>
 echo $html->link(__('Delete', true), array('action'=>'delete', $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id']), null, __('Delete the item, sure?', true)); <?php echo '?>'; ?>

    </td>
</tr>
<?php echo '<?php'; ?>
 endforeach; <?php echo '?>'; ?>

</tbody>
</table>
<div class="paging"><?php echo '<?php'; ?>
 echo $this->element('paginator'); <?php echo '?>'; ?>
</div>
<div class="actions">
    <ul>
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
<?php echo '<?php'; ?>
 $url = array_merge($url, array('action' => 'add')); <?php echo '?>'; ?>

        <li><?php echo '<?php'; ?>
 echo $html->link(__('Add', true), $url, array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexControl')); <?php echo '?>'; ?>
</li>
<?php else: ?>
        <li><?php echo '<?php'; ?>
 echo $html->link(__('Add', true), array('action'=>'add'), array('class' => '<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexControl')); <?php echo '?>'; ?>
</li>
<?php endif; ?>
    </ul>
</div>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexPanel"></div>
<?php echo '<?php'; ?>

$scripts = '
$(document).ready(function() {
    $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexTable th a, #<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndex div.paging a\').click(function() {
        $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndex\').load(this.href);
        return false;
    });
    $(\'a.<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexControl\').click(function() {
        var target = $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexPanel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
';
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
if(!empty($op)) {
    $remoteUrl = $html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    $scripts .= '
    $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
AdminIndexTable input.habtmSet\').click(function() {
    	var remoteUrl = \'' . $remoteUrl . '/\' + this.value + \'/\';
    	if(this.checked == true) {
    		remoteUrl = remoteUrl + \'on\';
    	} else {
    		remoteUrl = remoteUrl + \'off\';
    	}
    	$(\'div#messageSet\' + this.value).load(remoteUrl);
	});
';
}
<?php endif; ?>
$scripts .= '});';
echo $html->scriptBlock($scripts);
<?php echo '?>'; ?>

</div>