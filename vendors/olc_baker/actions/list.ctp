<div id="<{$controllerName}>_control_page">
<h2><{$actionLabel}></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => '第 %page% 頁 / 共 %pages% 頁（ 共 %count% 筆資料）'
));
?></p>
<table cellpadding="0" cellspacing="0" id="<{$controllerName}>_list_table">
<tr>
<{foreach from=$blocks.body key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
    <th><?php echo $paginator->sort('<{$label}>', '<{$className}>.<{$key}>');?></th>
<{/foreach}>
<{/foreach}>
    <th class="actions">操作</th>
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
    echo $html->link(FULL_BASE_URL . $upload->url($item, '<{$className}>.<{$key}>')) . '<br />';
<{elseif isset($models.$className.uploads.$key) && $models.$className.uploads.$key eq 'image'}>
    echo $html->link(
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
<?php echo $html->link('檢視', array('action'=>'<{$parameters.links.view}>', $item['<{$modelName}>']['id']), array('class' => 'control')); ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
<div class="paging">
<?php echo $paginator->prev('<< 上一頁', array(), null, array('class'=>'disabled'));?>
 | <?php echo $paginator->numbers();?>
<?php echo $paginator->next('下一頁 >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link('回到一般列表', array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<div id="<{$controllerName}>_control_panel"></div>
<?php
$scripts = '
$(document).ready(function() {
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
echo $javascript->codeBlock($scripts);
?>
</div>