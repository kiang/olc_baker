<div id="//<{$controllerName}>AdminEdit">
    <?php echo $this->Form->create('//<{$modelName}>', array('type' => 'file', 'class' => 'form-inline')); ?>
    <div class="//<{$controllerName}> form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit //<{$formLabel}>', true);
         } else {
             echo __('Add //<{$formLabel}>', true);
         }
         ?></legend>
    <?php
    if($id > 0) {
        echo $this->Form->input('//<{$modelName}>.id');
    }
//<{if isset($relationships.belongsTo)}>
    foreach($belongsToModels AS $key => $model) {
        echo $this->Form->input('//<{$modelName}>.' . $model['foreignKey'], array(
        	'type' => 'select',
        	'label' => $model['label'],
            'options' => $$key,
        	'div' => 'control-group',
        	'class' => 'controls',
        ));
    }
//<{/if}>


//<{foreach from=$fields key=className item=classFields}>

//<{foreach from=$classFields key=key item=group}>

//<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
    if(!empty($this->data['//<{$className}>']['//<{$key}>'])) {
        echo $this->Html->link(FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>')) . '<br />';
    }
//<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
    if(!empty($this->data['//<{$className}>']['//<{$key}>'])) {
        echo $this->Html->link(
            $upload->image($this->data, '//<{$className}>.//<{$key}>', 'thumb'),
            FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>'),
            array(), false, false
        );
    }
//<{/if}>

//<{if $fieldTypes.$className.$key.function_type eq 1}>
    echo $this->Form->input('//<{$className}>.//<{$key}>', array(
//<{foreach from=$group key=key2 item=value}>
        '//<{$key2}>' => '//<{$value}>',
//<{/foreach}>
        'div' => 'control-group',
        'class' => 'controls',
    ));
//<{elseif $fieldTypes.$className.$key.function_type eq 2}>

    if($id > 0) {
        echo '<div>//<{$classFields.$key.label}>：' . $this->data['//<{$className}>']['//<{$key}>'] . '</div>';
    } else {
        echo $this->Form->input('//<{$className}>.//<{$key}>', array(
//<{foreach from=$group key=key2 item=value}>
            '//<{$key2}>' => '//<{$value}>',
//<{/foreach}>
            ));
    }
//<{elseif $fieldTypes.$className.$key.function_type eq 3}>
    if($id > 0) {
        echo '<div>//<{$classFields.$key.label}>：' . $this->data['//<{$className}>']['//<{$key}>'] . '</div>';
    } else {
        echo $this->Form->input('//<{$className}>.//<{$key}>', array('type' => 'hidden', 'value' => //<{$fieldTypes.$className.$key.function_string}>));
    }
//<{elseif $fieldTypes.$className.$key.function_type eq 4}>
    if($id > 0) {
        echo $this->Form->input('//<{$className}>.//<{$key}>', array(
//<{foreach from=$group key=key2 item=value}>
            '//<{$key2}>' => '//<{$value}>',
//<{/foreach}>
            ));
    } else {
        echo $this->Form->input('//<{$className}>.//<{$key}>', array('type' => 'hidden', 'value' => //<{$fieldTypes.$className.$key.function_string}>));
    }
//<{elseif $fieldTypes.$className.$key.function_type eq 5}>
    echo $this->Form->input('//<{$className}>.//<{$key}>', array('type' => 'hidden', 'value' => //<{$fieldTypes.$className.$key.function_string}>));
//<{/if}>

//<{/foreach}>

//<{/foreach}>

?>
</fieldset>
</div>
    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
</div>