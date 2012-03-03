<div id="//<{$controllerName}>AdminView">
    <h3><?php echo __('View //<{$formLabel}>', true); ?></h3><hr />
    <div class="span-12">
        //<{if isset($relationships.belongsTo)}>
        //<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
        <div class="span-2">//<{$models[$rOption.className].label}></div>
        <div class="span-9">&nbsp;<?php
if (empty($this->data['//<{$rOption.className}>']['id'])) {
    echo '--';
} else {
    echo $this->PHtml->link($this->data['//<{$rOption.className}>']['id'], array(
        'controller' => '//<{$models[$rOption.className].table_name}>',
        'action' => 'view',
        $this->data['//<{$rOption.className}>']['id']
    ));
}
?></div>
        //<{/foreach}>
        //<{/if}>

        //<{foreach from=$fields key=className item=classFields}>
        //<{foreach from=$classFields key=key item=item}>
        <div class="span-2">//<{$item.label}></div>
        <div class="span-9">&nbsp;<?php
            if ($this->data['//<{$className}>']['//<{$key}>']) {
//<{if isset($uploads.$key) && $uploads.$key eq 'file'}>

                echo $this->Html->link(FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>')) . '<br />';
//<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>

                echo $this->Html->link(
                        $upload->image($this->data, '//<{$className}>.//<{$key}>', 'thumb'),
                        FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>'),
                        array(), false, false
                );
//<{else}>

                echo $this->data['//<{$className}>']['//<{$key}>'];
//<{/if}>

            }
?>&nbsp;
        </div>
        //<{/foreach}>
        //<{/foreach}>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->PHtml->link(__('Delete', true), array('action' => 'delete', $this->Form->value('//<{$modelName}>.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->PHtml->link(__('//<{$formLabel}> List', true), array('action' => 'index')); ?> </li>
            //<{if isset($relationships.hasOne)}>
            //<{foreach from=$relationships.hasOne key=rModel item=rOption}>
            <li><?php echo $this->PHtml->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'view', $this->data['//<{$rOption.className}>']['id']), array('class' => '//<{$controllerName}>AdminViewControl')); ?></li>
            //<{/foreach}>
            //<{/if}>
            //<{if isset($relationships.hasMany)}>
            //<{foreach from=$relationships.hasMany key=rModel item=rOption}>
            <li><?php echo $this->PHtml->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'index', '//<{$modelName}>', $this->data['//<{$modelName}>']['id']), array('class' => '//<{$controllerName}>AdminViewControl')); ?></li>
            //<{/foreach}>
            //<{/if}>
            //<{if isset($relationships.hasAndBelongsToMany)}>
            //<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>
            <li><?php echo $this->PHtml->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'index', '//<{$modelName}>', $this->data['//<{$modelName}>']['id']), array('class' => '//<{$controllerName}>AdminViewControl')); ?></li>
            <li><?php echo $this->PHtml->link(__('Set Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'index', '//<{$modelName}>', $this->data['//<{$modelName}>']['id'], 'set'), array('class' => '//<{$controllerName}>AdminViewControl')); ?></li>
            //<{/foreach}>
            //<{/if}>
        </ul>
    </div>
    <div id="//<{$controllerName}>AdminViewPanel"></div>
<?php
            echo $this->Html->scriptBlock('
$(function() {
    $(\'a.//<{$controllerName}>AdminViewControl\').click(function() {
        $(\'#//<{$controllerName}>AdminViewPanel\').parent().load(this.href);
        return false;
    });
});
');
?>
</div>