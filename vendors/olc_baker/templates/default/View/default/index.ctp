<div id="//<{$controllerName}>Index">
    <h2><?php echo __('//<{$formLabel}>', true); ?></h2>
//<{if isset($actions)}>
    <div class="btn-group">
//<{foreach from=$actions key=linkPath item=linkItem}>
        <?php echo $this->Html->link('//<{$linkItem.label}>', array('action' => '//<{$linkPath}>'), array('class' => 'btn btn-default //<{$linkItem.class}>')); ?>
//<{/foreach}>
    </div>
//<{/if}>
    <p>
        <?php
        $url = array();
//<{if isset($relationships.belongsTo)}>

        if (!empty($foreignId) && !empty($foreignModel)) {
            $url = array($foreignModel, $foreignId);
        }
//<{/if}>

        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="//<{$controllerName}>IndexTable">
        <thead>
            <tr>
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
                    <td>
                        <div class="btn-group">
                            <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['//<{$modelName}>']['id']), array('class' => 'btn btn-default //<{$controllerName}>IndexControl')); ?>
                        </div>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="//<{$controllerName}>IndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#//<{$controllerName}>IndexTable th a, div.paging a, a.//<{$controllerName}>IndexControl').click(function() {
                $('#//<{$controllerName}>Index').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>