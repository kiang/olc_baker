<div id="//<{$controllerName}>AdminEdit">
    <?php echo $this->Form->create('//<{$modelName}>', array('type' => 'file')); ?>
    <div class="//<{$controllerName}> form">
        <fieldset>
            <legend><?php
                echo __('Edit //<{$formLabel}>', true);
                ?></legend>
            <?php
            echo $this->Form->input('//<{$modelName}>.id');
//<{if isset($relationships.belongsTo)}>
            foreach ($belongsToModels AS $key => $model) {
                echo $this->Form->input('//<{$modelName}>.' . $model['foreignKey'], array(
                    'type' => 'select',
                    'label' => $model['label'],
                    'options' => $$key,
                    'div' => 'form-group',
                    'class' => 'form-control',
                ));
            }
//<{/if}>
//<{foreach from=$fields key=className item=classFields}>
//<{foreach from=$classFields key=key item=group}>
//<{if isset($uploads.$key) && $uploads.$key eq 'file'}>
            if (!empty($this->data['//<{$className}>']['//<{$key}>'])) {
                echo $this->Html->link(FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>')) . '<br />';
            }
//<{elseif isset($uploads.$key) && $uploads.$key eq 'image'}>
            if (!empty($this->data['//<{$className}>']['//<{$key}>'])) {
                echo $this->Html->link(
                        $upload->image($this->data, '//<{$className}>.//<{$key}>', 'thumb'), FULL_BASE_URL . $upload->url($this->data, '//<{$className}>.//<{$key}>'), array(), false, false
                );
            }
//<{/if}>
//<{if $fieldTypes.$className.$key.function_type eq 1}>
            echo $this->Form->input('//<{$className}>.//<{$key}>', array(
//<{foreach from=$group key=key2 item=value}>
                '//<{$key2}>' => '//<{$value}>',
//<{/foreach}>
                'div' => 'form-group',
                'class' => 'form-control',
            ));
//<{elseif $fieldTypes.$className.$key.function_type eq 2}>

            echo '<div>//<{$classFields.$key.label}>：' . $this->data['//<{$className}>']['//<{$key}>'] . '</div>';
//<{elseif $fieldTypes.$className.$key.function_type eq 3}>
            echo '<div>//<{$classFields.$key.label}>：' . $this->data['//<{$className}>']['//<{$key}>'] . '</div>';
//<{elseif $fieldTypes.$className.$key.function_type eq 4}>
            echo $this->Form->input('//<{$className}>.//<{$key}>', array(
//<{foreach from=$group key=key2 item=value}>
                '//<{$key2}>' => '//<{$value}>',
//<{/foreach}>
            ));
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