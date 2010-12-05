<div id="<{$controllerName}>_control_page">
<h2><{$actionLabel}></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0" id="<{$controllerName}>_list_table">
<tr>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
    <th><?php echo $paginator->sort('<{$label}>', '<{$className}>.<{$key}>');?></th>
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
<?php echo $paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | <?php echo $paginator->numbers();?>
<?php echo $paginator->next(__('next', true) . ' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the list', true), array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<div id="<{$controllerName}>_control_panel"></div>
<?php
$scripts = '
$(function() {
    $(\'#<{$controllerName}>_list_table th a, div.paging a, a.pageControl\').click(function() {
        $(\'#<{$controllerName}>_control_page\').load(this.href);
        return false;
    });
    $(\'a.control\').click(function() {
        var target = $(\'#<{$controllerName}>_control_panel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
});';
echo $this->Html->scriptBlock($scripts);
?>
</div>