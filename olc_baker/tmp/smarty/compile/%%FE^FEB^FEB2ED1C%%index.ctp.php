<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/default/index.ctp */ ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
Index">
<h2><?php echo $this->_tpl_vars['formLabel']; ?>
列表</h2>
<p>
<?php echo '<?php'; ?>

$url = array();
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
<?php endif; ?>
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
<?php echo '?>'; ?>
</p>
<div class="paging"><?php echo '<?php'; ?>
 echo $this->element('paginator'); <?php echo '?>'; ?>
</div>
<table cellpadding="0" cellspacing="0" id="<?php echo $this->_tpl_vars['controllerName']; ?>
IndexTable">
<thead>
<tr>
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
IndexControl')); <?php echo '?>'; ?>

    </td>
</tr>
<?php echo '<?php'; ?>
 endforeach; <?php echo '?>'; ?>

</tbody>
</table>
<div class="paging"><?php echo '<?php'; ?>
 echo $this->element('paginator'); <?php echo '?>'; ?>
</div>
<?php if (isset ( $this->_tpl_vars['actions'] )): ?>
<div class="actions">
    <ul>
<?php $_from = $this->_tpl_vars['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['linkPath'] => $this->_tpl_vars['linkItem']):
?>
        <li><?php echo '<?php'; ?>
 echo $html->link('<?php echo $this->_tpl_vars['linkItem']['label']; ?>
', array('action'=>'<?php echo $this->_tpl_vars['linkPath']; ?>
'), array('class' => '<?php echo $this->_tpl_vars['linkItem']['class']; ?>
')); <?php echo '?>'; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<?php endif; ?>
<div id="<?php echo $this->_tpl_vars['controllerName']; ?>
IndexPanel"></div>
<?php echo '<?php'; ?>

$scripts = '
$(document).ready(function() {
    $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
IndexTable th a, div.paging a, a.<?php echo $this->_tpl_vars['controllerName']; ?>
IndexControl\').click(function() {
        $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
Index\').load(this.href);
        return false;
    });
    $(\'a.<?php echo $this->_tpl_vars['controllerName']; ?>
Control\').click(function() {
        var target = $(\'#<?php echo $this->_tpl_vars['controllerName']; ?>
IndexPanel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
});';
echo $html->scriptBlock($scripts);
<?php echo '?>'; ?>

</div>