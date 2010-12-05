<div id="<{$controllerName}>_control_page">
<h2><{$actionLabel}></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<?php __('Sort'); ?>
<div class="actions">
    <ul>
<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=item}>
        <li><?php echo $paginator->sort('<{$item.label}>', '<{$className}>.<{$key}>', array('class' => 'pageControl'));?></li>
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
		<td><?php echo $item['<{$className}>']['<{$key}>']; ?></td>
	</tr>
<{/foreach}>
<{/foreach}>
<{foreach from=$blocks.subTitle key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
	<tr>
		<td><?php echo $item['<{$className}>']['<{$key}>']; ?></td>
	</tr>
<{/foreach}>
<{/foreach}>
<{foreach from=$blocks.date key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
	<tr>
		<td align="right"><?php echo $item['<{$className}>']['<{$key}>']; ?></td>
	</tr>
<{/foreach}>
<{/foreach}>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
	<tr>
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
    $(\'div.paging a, a.pageControl\').click(function() {
        $(\'#<{$controllerName}>_control_page\').parent().load(this.href);
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