<div id="<{$controllerName}>Page">
<h2><{$actionLabel}></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<?php __('Sort', true); ?>
<div class="actions">
    <ul>
<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=item}>
        <li><?php echo $this->Paginator->sort('<{$item.label}>', '<{$className}>.<{$key}>', array('class' => 'pageControl'));?></li>
<{/foreach}>
<{/foreach}>
    </ul>
</div>
<?php
$i = 0;
foreach ($items as $item):
    $class = null;
    if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
    }
?>
<table cellpadding="0" cellspacing="0"<?php echo $class;?>>
<{foreach from=$blocks.title key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
	<tr>
		<td colspan="2"><?php echo $item['<{$className}>']['<{$key}>']; ?></td>
	</tr>
<{/foreach}>
<{/foreach}>
    <tr>
<{foreach from=$blocks.picture key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
<{if isset($models.$className.uploads.$key) && $models.$className.uploads.$key eq 'image'}>
    	<td><?php
    	echo $this->Html->link(
    	$upload->image($item, '<{$className}>.<{$key}>', 'thumb'),
    	FULL_BASE_URL . $upload->url($item, '<{$className}>.<{$key}>'),
    	array(), false, false
    	);
    	?></td>
<{/if}>
<{/foreach}>
<{/foreach}>
    	<td><table>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
    	<tr>
    		<td><{$label}>：</td>
    		<td><?php
if($item['<{$className}>']['<{$key}>']) {
<{if isset($models.$className.uploads.$key) && $models.$className.uploads.$key eq 'file'}>
    echo $this->Html->link(FULL_BASE_URL . $upload->url($item, '<{$className}>.<{$key}>')) . '<br />';
<{elseif isset($models.$className.uploads.$key) && $models.$className.uploads.$key eq 'image'}>
    echo $this->Html->link(
        $upload->image($item, '<{$className}>.<{$key}>', 'thumb'),
        FULL_BASE_URL . $upload->url($item, '<{$className}>.<{$key}>'),
        array(), false, false
    );
<{else}>
    echo $item['<{$className}>']['<{$key}>'];
<{/if}>
}
?></td>
		</tr>
<{/foreach}>
<{/foreach}>
		</table>
		<div class="actions">
		<?php echo $this->Html->link(__('View', true), array('action'=>'<{$parameters.links.view}>', $item['<{$modelName}>']['id']), array('class' => 'control')); ?>
		</div>
		</td>
	</tr>
</table>
<?php endforeach; ?>
<div class="paging">
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | <?php echo $this->Paginator->numbers();?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the list', true), array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<?php
$scripts = '
$(function() {
    $(\'#<{$controllerName}>Page div.paging a, #<{$controllerName}>Page a.pageControl\').click(function() {
        $(\'#<{$controllerName}>Page\').parent().load(this.href);
        return false;
    });
    $(\'#<{$controllerName}>Page a.control\').click(function() {
        dialogFull(this);
        return false;
    });
});';
echo $this->Html->scriptBlock($scripts);
?>
</div>
