<div id="<{$controllerName}>AdminIndex">
<h2><{$formLabel}>管理</h2><hr />
<?php
if(!isset($url)) {
    $url = array();
}
<{if isset($relationships.belongsTo)}>
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
<{/if}>
?>
<div class="span-6"><?php
echo $paginator->counter(array('format' => '第 %page% 頁 / 共 %pages% 頁（ 共 %count% 筆資料）'));
?></div>
<div class="span-18 last">
<?php
echo $form->create('<{$modelName}>', array('type' => 'get', 'url' => array_merge($url, array('action' => 'index'))));
echo $form->text('keyword', array('class' => 'span-10', 'value' => $keyword));
echo $form->submit('查詢', array('div' => false));
echo $form->end();
?>
</div>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<table cellpadding="0" cellspacing="0" id="<{$controllerName}>AdminIndexTable">
<thead>
<tr>
<{if isset($relationships.hasAndBelongsToMany)}>
	<?php
	if(!empty($op)) {
	    echo '<th>&nbsp;</th>';
	}
	?>
<{/if}>
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
    <th class="actions">操作</th>
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
<{if isset($relationships.hasAndBelongsToMany)}>
	<?php
	if(!empty($op)) {
	    echo '<td>';
	    $options = array('value' => $item['<{$modelName}>']['id'], 'class' => 'habtmSet');
	    if($item['option'] == 1) {
	        $options['checked'] = 'checked';
	    }
	    echo $form->checkbox('Set.' . $item['<{$modelName}>']['id'], $options);
	    echo '<div id="messageSet' . $item['<{$modelName}>']['id'] . '"></div></td>';
	}
	?>
<{/if}>
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
<?php echo $html->link('檢視', array('action'=>'view', $item['<{$modelName}>']['id']), array('class' => '<{$controllerName}>AdminIndexControl')); ?>
<?php echo $html->link('編輯', array('action'=>'edit', $item['<{$modelName}>']['id']), array('class' => '<{$controllerName}>AdminIndexControl')); ?>
<?php echo $html->link('刪除', array('action'=>'delete', $item['<{$modelName}>']['id']), null, '確定要刪除？'); ?>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="paging"><?php echo $this->element('paginator'); ?></div>
<div class="actions">
    <ul>
<{if isset($relationships.belongsTo)}>
<?php $url = array_merge($url, array('action' => 'add')); ?>
        <li><?php echo $html->link('新增', $url, array('class' => '<{$controllerName}>AdminIndexControl')); ?></li>
<{else}>
        <li><?php echo $html->link('新增', array('action'=>'add'), array('class' => '<{$controllerName}>AdminIndexControl')); ?></li>
<{/if}>
    </ul>
</div>
<div id="<{$controllerName}>AdminIndexPanel"></div>
<?php
$scripts = '
$(document).ready(function() {
    $(\'#<{$controllerName}>AdminIndexTable th a, #<{$controllerName}>AdminIndex div.paging a\').click(function() {
        $(\'#<{$controllerName}>AdminIndex\').load(this.href);
        return false;
    });
    $(\'a.<{$controllerName}>AdminIndexControl\').click(function() {
        var target = $(\'#<{$controllerName}>AdminIndexPanel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
';
<{if isset($relationships.hasAndBelongsToMany)}>
if(!empty($op)) {
    $remoteUrl = $html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    $scripts .= '
    $(\'#<{$controllerName}>AdminIndexTable input.habtmSet\').click(function() {
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
<{/if}>
$scripts .= '});';
echo $javascript->codeBlock($scripts);
?>
</div>