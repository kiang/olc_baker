<div id="<{$controllerName}>AdminAdd">
<{if isset($relationships.belongsTo)}>
<?php
$url = array();
if(!empty($foreignId) && !empty($foreignModel)) {
    $url = array('action' => 'add', $foreignModel, $foreignId);
} else {
    $url = array('action' => 'add');
    $foreignModel = '';
}
echo $this->Form->create('<{$modelName}>', array('type' => 'file', 'url' => $url));
?>
<div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form', 0, $foreignModel)); ?></div>
<{else}>
<?php echo $this->Form->create('<{$modelName}>', array('type' => 'file')); ?>
<div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form')); ?></div>
<{/if}>

<{if isset($relationships.hasOne)}>
<{foreach from=$relationships.hasOne key=rModel item=rOption}>
<div class="addForm"><?php echo $this->Html->link(' ', array('controller' => '<{$models[$rOption.className].table_name}>', 'action' => 'form', 0, '<{$modelName}>')); ?></div>
<{/foreach}>
<{/if}>
<?php echo $this->Form->end(__('Submit', true)); ?>
<div class="actions">
    <ul>
        <li><?php echo $this->PHtml->link(__('List', true), array('action'=>'index'));?></li>
    </ul>
</div>
<?php
echo $this->Html->scriptBlock('
$(document).ready(function() {
    $(\'#<{$controllerName}>AdminAdd div.addForm a\').each(function() {
        $(this).parent().load(this.href);
    });
});
');
?>
</div>