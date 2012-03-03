<div id="//<{$controllerName}>AdminEdit">
    <div class="clear actions">
        <ul>
            <li><?php echo $this->PHtml->link(__('Delete', true), array('action' => 'delete', $id), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->PHtml->link(__('List', true), array('action' => 'index')); ?></li>
        </ul>
    </div>

    <?php echo $this->Form->create('//<{$modelName}>', array('type' => 'file')); ?>
    <div class="editForm"><?php echo $this->Html->link(' ', array('action' => 'form', $id)); ?></div>
    //<{if isset($relationships.hasOne)}>
    //<{foreach from=$relationships.hasOne key=rModel item=rOption}>
    <?php if ($foreignId = $this->Form->value('//<{$rOption.className}>.//<{$rOption.foreignKey}>')): ?>
        <div class="editForm"><?php echo $this->Html->link(' ', array('controller' => '//<{$models[$rOption.className].table_name}>', 'action' => 'form', $foreignId, '//<{$modelName}>')); ?></div>
    <?php endif; ?>
        //<{/foreach}>
        //<{/if}>
    <?php
        echo $this->Form->end(__('Submit', true));
        echo $this->Html->scriptBlock('
$(function() {
    $(\'#//<{$controllerName}>AdminEdit div.editForm a\').each(function() {
        $(this).parent().load(this.href);
    });
});
');
    ?>
</div>