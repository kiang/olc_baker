<?php
if (!isset($url)) {
    $url = array();
}
//<{if isset($relationships.belongsTo)}>

if (!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
//<{/if}>
?>
<div id="//<{$controllerName}>AdminIndex">
    <h2><?php echo __('//<{$formLabel}>', true); ?></h2>
    <div class="btn-group">
//<{if isset($relationships.belongsTo)}>
        <?php echo $this->Html->link(__('Add', true), array_merge($url, array('action' => 'add')), array('class' => 'btn dialogControl')); ?>
//<{else}>
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
//<{/if}>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="//<{$controllerName}>AdminIndexTable">
        <thead>
            <tr>
//<{if isset($relationships.hasAndBelongsToMany)}>
                <?php
                if (!empty($op)) {
                    echo '<th>&nbsp;</th>';
                }
                ?>
//<{/if}>
//<{if isset($relationships.belongsTo)}>
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
                <?php if (empty($scope['//<{$modelName}>.//<{$rOption.foreignKey}>'])): ?>
                    <th><?php echo $this->Paginator->sort('//<{$modelName}>.//<{$rOption.foreignKey}>', '//<{$models[$rOption.className].label}>', array('url' => $url)); ?></th>
                <?php endif; ?>
//<{/foreach}>
//<{/if}>

//<{foreach from=$fields key=className item=classFields}>
//<{foreach from=$classFields key=key item=item}>
                <th><?php echo $this->Paginator->sort('//<{$modelName}>.//<{$key}>', '//<{$item.label}>', array('url' => $url)); ?></th>
//<{/foreach}>
//<{/foreach}>
                <th class="actions"><?php echo __('Action', true); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($items as $item) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
//<{if isset($relationships.hasAndBelongsToMany)}>
                    <?php
                    if (!empty($op)) {
                        echo '<td>';
                        $options = array('value' => $item['//<{$modelName}>']['id'], 'class' => 'habtmSet');
                        if ($item['option'] == 1) {
                            $options['checked'] = 'checked';
                        }
                        echo $this->Form->checkbox('Set.' . $item['//<{$modelName}>']['id'], $options);
                        echo '<div id="messageSet' . $item['//<{$modelName}>']['id'] . '"></div></td>';
                    }
                    ?>
//<{/if}>
//<{if isset($relationships.belongsTo)}>
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
                    <?php if (empty($scope['//<{$modelName}>.//<{$rOption.foreignKey}>'])): ?>
                        <td><?php
                if (empty($item['//<{$rOption.className}>']['id'])) {
                    echo '--';
                } else {
                    echo $this->Html->link($item['//<{$rOption.className}>']['id'], array(
                        'controller' => '//<{$models[$rOption.className].table_name}>',
                        'action' => 'view',
                        $item['//<{$rOption.className}>']['id']
                    ));
                }
                        ?></td>
                    <?php endif; ?>
//<{/foreach}>
//<{/if}>

//<{foreach from=$fields key=className item=classFields}>
//<{foreach from=$classFields key=key item=item}>
                    <td><?php
//<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
                    echo $this->Html->link(FULL_BASE_URL . $upload->url($item, '//<{$className}>.//<{$key}>')) . '<br />';
//<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
                    echo $this->Html->link(
                            $upload->image($item, '//<{$className}>.//<{$key}>', 'thumb'), FULL_BASE_URL . $upload->url($item, '//<{$className}>.//<{$key}>'), array(), false, false
                    );
//<{else}>
                    echo $item['//<{$className}>']['//<{$key}>'];
//<{/if}>
                    ?></td>
//<{/foreach}>
//<{/foreach}>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['//<{$modelName}>']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['//<{$modelName}>']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['//<{$modelName}>']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="//<{$controllerName}>AdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#//<{$controllerName}>AdminIndexTable th a, #//<{$controllerName}>AdminIndex div.paging a').click(function() {
                $('#//<{$controllerName}>AdminIndex').parent().load(this.href);
                return false;
            });
//<{if isset($relationships.hasAndBelongsToMany)}>
<?php
if (!empty($op)) {
    $remoteUrl = $this->Html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    ?>
                $('#//<{$controllerName}>AdminIndexTable input.habtmSet').click(function() {
                    var remoteUrl = '<?php echo $remoteUrl; ?>/' + this.value + '/';
                    if (this.checked == true) {
                        remoteUrl = remoteUrl + 'on';
                    } else {
                        remoteUrl = remoteUrl + 'off';
                    }
                    $('div#messageSet' + this.value) . load(remoteUrl);
                });
    <?php
}
?>
//<{/if}>
    });
    //]]>
    </script>
</div>