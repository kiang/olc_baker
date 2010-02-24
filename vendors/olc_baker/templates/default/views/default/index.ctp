<div id="<{$controllerName}>Index">
<h2><?php echo __('<{$formLabel}> List', true); ?></h2>
<p>
<?php
$url = array();
<{if isset($relationships.belongsTo)}>
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
<{/if}>
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<table cellpadding="0" cellspacing="0" id="<{$controllerName}>IndexTable">
<thead>
<tr>
<{if isset($relationships.belongsTo)}>
<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
	<?php if(empty($scope['<{$modelName}>.<{$rOption.foreignKey}>'])): ?>
    <th><?php echo $paginator->sort('<{$models[$rOption.className].label}>', '<{$modelName}>.<{$rOption.foreignKey}>', array('url' => $url));?></th>
    <?php endif; ?>
<{/foreach}>
<{/if}>

<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=item}>
    <th><?php echo $paginator->sort('<{$item.label}>', '<{$modelName}>.<{$key}>', array('url' => $url));?></th>
<{/foreach}>
<{/foreach}>
    <th class="actions"><?php echo __('Action', true); ?></th>
</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($items as $item):
    $class = null;
    if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
    }
?>
    <tr<?php echo $class;?>>
<{if isset($relationships.belongsTo)}>
<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
	<?php if(empty($scope['<{$modelName}>.<{$rOption.foreignKey}>'])): ?>
    <td><?php
    if(empty($item['<{$rOption.className}>']['id'])) {
        echo '--';
    } else {
        echo $html->link($item['<{$rOption.className}>']['id'],array(
            'controller' => '<{$models[$rOption.className].table_name}>',
            'action' => 'view',
            $item['<{$rOption.className}>']['id']
        ));
    }
    ?></td>
    <?php endif; ?>
<{/foreach}>
<{/if}>

<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=item}>
    <td><?php
if($item['<{$className}>']['<{$key}>']) {
<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
    echo $html->link(FULL_BASE_URL . $upload->url($item, '<{$className}>.<{$key}>')) . '<br />';
<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
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
<?php echo $html->link(__('View', true), array('action'=>'view', $item['<{$modelName}>']['id']), array('class' => '<{$controllerName}>IndexControl')); ?>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<{if isset($actions)}>
<div class="actions">
    <ul>
<{foreach from=$actions key=linkPath item=linkItem}>
        <li><?php echo $html->link('<{$linkItem.label}>', array('action'=>'<{$linkPath}>'), array('class' => '<{$linkItem.class}>')); ?></li>
<{/foreach}>
    </ul>
</div>
<{/if}>
<div id="<{$controllerName}>IndexPanel"></div>
<?php
$scripts = '
$(document).ready(function() {
    $(\'#<{$controllerName}>IndexTable th a, div.paging a, a.<{$controllerName}>IndexControl\').click(function() {
        $(\'#<{$controllerName}>Index\').load(this.href);
        return false;
    });
    $(\'a.<{$controllerName}>Control\').click(function() {
        var target = $(\'#<{$controllerName}>IndexPanel\');
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
?>
</div>