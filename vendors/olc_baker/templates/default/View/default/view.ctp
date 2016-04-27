<div id="//<{$controllerName}>View">
    <h3><?php echo __('View //<{$formLabel}>', true); ?></h3><hr />
    <div class="col-md-12">
//<{if isset($relationships.belongsTo)}>
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
        <div class="col-md-2">//<{$models[$rOption.className].label}></div>
        <div class="col-md-9"><?php
if (empty($this->data['//<{$rOption.className}>']['id'])) {
    echo '--';
} else {
    echo $this->Html->link($this->data['//<{$rOption.className}>']['id'], array(
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
        <div class="col-md-2">//<{$item.label}></div>
        <div class="col-md-9"><?php
            if ($this->data['//<{$className}>']['//<{$key}>']) {
//<{if isset($uploads.$key) && $uploads.$key eq 'file'}>

                echo $this->Html->link(FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>')) . '<br />';
//<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>

                echo $this->Html->link(
                        $upload->image($this->data, '//<{$className}>.//<{$key}>', 'thumb'), FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>'), array(), false, false
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
    <div class="btn-group">
        <?php echo $this->Html->link(__('//<{$formLabel}> List', true), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
//<{if isset($relationships.hasOne)}>
//<{foreach from=$relationships.hasOne key=rModel item=rOption}>
        <?php echo $this->Html->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'view', $this->data['//<{$rOption.className}>']['id']), array('class' => 'btn btn-default //<{$controllerName}>AdminViewControl')); ?>
//<{/foreach}>
//<{/if}>
//<{if isset($relationships.hasMany)}>
//<{foreach from=$relationships.hasMany key=rModel item=rOption}>
        <?php echo $this->Html->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'index', '//<{$modelName}>', $this->data['//<{$modelName}>']['id']), array('class' => 'btn btn-default //<{$controllerName}>AdminViewControl')); ?>
//<{/foreach}>
//<{/if}>
//<{if isset($relationships.hasAndBelongsToMany)}>
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>
        <?php echo $this->Html->link(__('View Related //<{$models[$rOption.className].label}>', true), array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'index', '//<{$modelName}>', $this->data['//<{$modelName}>']['id']), array('class' => 'btn btn-default //<{$controllerName}>AdminViewControl')); ?>
//<{/foreach}>
//<{/if}>
    </div>
    <div id="//<{$controllerName}>ViewPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.//<{$controllerName}>ViewControl').click(function() {
                $('#//<{$controllerName}>ViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>