<div id="<{$controllerName}>Page">
<h2><{$actionLabel}></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0" id="<{$controllerName}>Table">
<tr>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
    <th><?php echo $this->Paginator->sort('<{$label}>', '<{$className}>.<{$key}>');?></th>
<{/foreach}>
<{/foreach}>
    <th class="actions"><?php echo __('Action', true); ?></th>
</tr>
<?php
$i = 0;
foreach ($items as $item):
    $class = null;
    if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
    }
?>
    <tr<?php echo $class;?>>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
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
<{/foreach}>
<{/foreach}>
    <td class="actions">
<?php echo $this->Html->link(__('View', true), array('action'=>'<{$parameters.links.view}>', $item['<{$modelName}>']['id']), array('class' => 'control')); ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
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
    $(\'#<{$controllerName}>Page #<{$controllerName}>Table th a, #<{$controllerName}>Page div.paging a, #<{$controllerName}>Page a.pageControl\').click(function() {
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