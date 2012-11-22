<div id="//<{$controllerName}>AdminEdit">
    <?php echo $this->Form->create('//<{$modelName}>', array('type' => 'file', 'class' => 'form-inline')); ?>
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
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#//<{$controllerName}>AdminEdit div.editForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>