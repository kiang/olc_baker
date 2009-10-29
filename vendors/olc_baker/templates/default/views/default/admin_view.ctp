<div id="<{$controllerName}>AdminView">
<h3>檢視<{$formLabel}></h3><hr />
<div class="span-12">
<{if isset($relationships.belongsTo)}>
<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
        <div class="span-2"><{$models[$rOption.className].label}></div>
        <div class="span-9">&nbsp;<?php
        if(empty($this->data['<{$rOption.className}>']['id'])) {
            echo '--';
        } else {
            echo $html->link($this->data['<{$rOption.className}>']['id'],array(
                'controller' => '<{$models[$rOption.className].table_name}>',
                'action' => 'view',
                $this->data['<{$rOption.className}>']['id']
            ));
        }
        ?></div>
<{/foreach}>
<{/if}>

<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=item}>
        <div class="span-2"><{$item.label}></div>
        <div class="span-9">&nbsp;<?php
        if($this->data['<{$className}>']['<{$key}>']) {
<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
            echo $html->link(FULL_BASE_URL . $upload->url($this->data, '<{$className}>.<{$key}>')) . '<br />';
<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
            echo $html->link(
                $upload->image($this->data, '<{$className}>.<{$key}>', 'thumb'),
                FULL_BASE_URL . $upload->url($this->data, '<{$className}>.<{$key}>'),
                array(), false, false
            );
<{else}>
            echo $this->data['<{$className}>']['<{$key}>'];
<{/if}>
        }
        ?>&nbsp;
        </div>
<{/foreach}>
<{/foreach}>
</div>
<hr />
<div class="actions">
    <ul>
        <li><?php echo $html->link('刪除', array('action'=>'delete', $form->value('<{$modelName}>.id')), null, '確定要刪除？'); ?></li>
        <li><?php echo $html->link('<{$formLabel}>列表', array('action'=>'index')); ?> </li>
<{if isset($relationships.hasOne)}>
<{foreach from=$relationships.hasOne key=rModel item=rOption}>
        <li><?php echo $html->link('檢視相關<{$models[$rOption.className].label}>', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'view', $this->data['<{$rOption.className}>']['id']), array('class' => '<{$controllerName}>AdminViewControl')); ?></li>
<{/foreach}>
<{/if}>
<{if isset($relationships.hasMany)}>
<{foreach from=$relationships.hasMany key=rModel item=rOption}>
        <li><?php echo $html->link('檢視相關<{$models[$rOption.className].label}>', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'index', '<{$modelName}>', $this->data['<{$modelName}>']['id']), array('class' => '<{$controllerName}>AdminViewControl')); ?></li>
<{/foreach}>
<{/if}>
<{if isset($relationships.hasAndBelongsToMany)}>
<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>
        <li><?php echo $html->link('檢視相關<{$models[$rOption.className].label}>', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'index', '<{$modelName}>', $this->data['<{$modelName}>']['id']), array('class' => '<{$controllerName}>AdminViewControl')); ?></li>
        <li><?php echo $html->link('設定相關<{$models[$rOption.className].label}>', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'index', '<{$modelName}>', $this->data['<{$modelName}>']['id'], 'set'), array('class' => '<{$controllerName}>AdminViewControl')); ?></li>
<{/foreach}>
<{/if}>
    </ul>
</div>
<div id="<{$controllerName}>AdminViewPanel"></div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
    $(\'a.<{$controllerName}>AdminViewControl\').click(function() {
        $(\'#<{$controllerName}>AdminViewPanel\').load(this.href);
        return false;
    });
});
');
?>
</div>