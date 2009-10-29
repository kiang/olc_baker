<div class="<{$controllerName}> form">
    <fieldset>
         <legend><?php
         if($id > 0) {
             echo __('Edit', true);
         } else {
             echo __('Add', true);
         }
         ?><{$formLabel}></legend>
    <?php
    if($id > 0) {
        echo $form->input('<{$modelName}>.id');
    }
<{if isset($relationships.belongsTo)}>
    foreach($belongsToModels AS $key => $model) {
        echo '<div class="span-3">' . $model['label'] . '：</div>' .
        $form->input('<{$modelName}>.' . $model['foreignKey'], array(
        	'type' => 'select',
        	'label' => false,
            'options' => $$key,
        	'div' => 'span-6',
        	'class' => 'span-6',
        )) . '<hr />';
    }
<{/if}>

<{foreach from=$fields key=className item=classFields}>
<{foreach from=$classFields key=key item=group}>
<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
    if(!empty($this->data['<{$className}>']['<{$key}>'])) {
        echo $html->link(FULL_BASE_URL . $upload->url($this->data, '<{$className}>.<{$key}>')) . '<br />';
    }
<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
    if(!empty($this->data['<{$className}>']['<{$key}>'])) {
        echo $html->link(
            $upload->image($this->data, '<{$className}>.<{$key}>', 'thumb'),
            FULL_BASE_URL . $upload->url($this->data, '<{$className}>.<{$key}>'),
            array(), false, false
        );
    }
<{/if}>
<{if $fieldTypes.$className.$key.function_type eq 1}>
    echo '<div class="span-3">' . '</div>' .
    $form->input('<{$className}>.<{$key}>', array(
<{foreach from=$group key=key2 item=value}>
        '<{$key2}>' => '<{$value}>',
<{/foreach}>
        'div' => 'span-6',
        'class' => 'span-6',
    )) . '<hr />';
<{elseif $fieldTypes.$className.$key.function_type eq 2}>
    if($id > 0) {
        echo '<div><{$classFields.$key.label}>：' . $this->data['<{$className}>']['<{$key}>'] . '</div>';
    } else {
        echo $form->input('<{$className}>.<{$key}>', array(
<{foreach from=$group key=key2 item=value}>
        	'<{$key2}>' => '<{$value}>',
<{/foreach}>
        ));
    }
<{elseif $fieldTypes.$className.$key.function_type eq 3}>
    if($id > 0) {
        echo '<div><{$classFields.$key.label}>：' . $this->data['<{$className}>']['<{$key}>'] . '</div>';
    } else {
        echo $form->input('<{$className}>.<{$key}>', array('type' => 'hidden', 'value' => <{$fieldTypes.$className.$key.function_string}>));
    }
<{elseif $fieldTypes.$className.$key.function_type eq 4}>
    if($id > 0) {
        echo $form->input('<{$className}>.<{$key}>', array(
<{foreach from=$group key=key2 item=value}>
        	'<{$key2}>' => '<{$value}>',
<{/foreach}>
        ));
    } else {
        echo $form->input('<{$className}>.<{$key}>', array('type' => 'hidden', 'value' => <{$fieldTypes.$className.$key.function_string}>));
    }
<{elseif $fieldTypes.$className.$key.function_type eq 5}>
    echo $form->input('<{$className}>.<{$key}>', array('type' => 'hidden', 'value' => <{$fieldTypes.$className.$key.function_string}>));
<{/if}>
<{/foreach}>
<{/foreach}>
?>
</fieldset>
</div>