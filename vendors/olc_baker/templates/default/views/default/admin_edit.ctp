<div id="<{$controllerName}>AdminEdit">
<?php echo $form->create('<{$modelName}>', array('type' => 'file')); ?>
<div class="editForm"><?php echo $html->link(' ', array('action' => 'form', $id)); ?></div>
<{if isset($relationships.hasOne)}>
<{foreach from=$relationships.hasOne key=rModel item=rOption}>
<?php if($foreignId = $form->value('<{$rOption.className}>.<{$rOption.foreignKey}>')): ?>
<div class="editForm"><?php echo $html->link(' ', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'form', $foreignId, '<{$modelName}>')); ?></div>
<?php endif; ?>
<{/foreach}>
<{/if}>
<?php echo $form->end('送出'); ?>
<div class="actions">
    <ul>
        <li><?php echo $html->link('刪除', array('action'=>'delete', $id), null, '確定要刪除？'); ?></li>
        <li><?php echo $html->link('列表', array('action'=>'index'));?></li>
    </ul>
</div>
<?php
echo $html->scriptBlock('
$(document).ready(function() {
    $(\'#<{$controllerName}>AdminEdit div.editForm a\').each(function() {
        $(this).parent().load(this.href);
    });
});
');
?>
</div>