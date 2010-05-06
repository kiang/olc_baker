<?php
if(!empty($content)) {
    echo $content['description'];
    $dateTimeFieldOptions = $imageFields = $fileFields = array();
    foreach($fieldTypes AS $key => $fieldType) {
        switch($fieldType) {
            case 'datetime':
                $dateTimeFieldOptions[$key] = $fields[$key];
                break;
            case 'file_image':
                $imageFields[$key] = $fields[$key];
                break;
            case 'file':
                $fileFields[$key] = $fields[$key];
                break;
        }
    }
    if(!empty($content['options'])) {
        foreach($content['options'] AS $optionGroup => $optionItems) {
            foreach($optionItems AS $key => $formOptions) {
                switch($formOptions['type']) {
                    case 'field':
                        echo $form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $fields,
                        ));
                        break;
                    case 'fieldWithId':
                        $fieldWithIds = array();
                        foreach($fields AS $idx => $label) {
                            $modelName = substr($idx, 0, strpos($idx, '.'));
                            if(!array_key_exists($modelName . '.id', $fieldWithIds)) {
                                $labelName = substr($label, 0, strpos($label, '-'));
                                $fieldWithIds[$modelName . '.id'] = $labelName . '-&gt;ID';
                            }
                        }
                        $fieldWithIds = array_merge($fieldWithIds, $fields);
                        echo $form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $fieldWithIds,
                        ));
                        break;
                    case 'dateTimeField':
                        if(empty($dateTimeFieldOptions)) {
                            echo '<div>*' . __('This method will need a datetime field', true) . '</div>';
                            continue;
                        }
                        echo $form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $dateTimeFieldOptions,
                        ));
                        break;
                    case 'imageField':
                        if(empty($imageFields)) {
                            echo '<div>*' . __('This method will need a file_image field', true) . '</div>';
                            continue;
                        }
                        echo $form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $imageFields,
                        ));
                        break;
                    case 'fileField':
                        if(empty($fileFields)) {
                            echo '<div>*' . __('This method will need a file field', true) . '</div>';
                            continue;
                        }
                        echo $form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $fileFields,
                        ));
                        break;
                    case 'fields':
                        $key = implode('.', array('Action', 'parameter', $optionGroup, $key));
                        $domId = $form->domId($key);
                        echo $form->input($key, array(
                            'type' => 'select',
                            'label' => $formOptions['label'],
                            'options' => $fields,
                            'div' => false,
                        ));
                        echo '<br />' . $this->Html->link(__('Add a field', true), '#', array('id' => 'duplicate' . $domId));
                        echo $this->Html->scriptBlock('
$(\'#' . $domId . '\').attr(\'name\', $(\'#' . $domId . '\').attr(\'name\') + \'[]\');
$(\'#duplicate' . $domId . '\').click(function() {
	var target = $(\'#' . $domId . '\').clone();
	var domId = new Date().getTime();
	target.attr(\'id\', domId);
	target.insertBefore(this);
	$(\'#\' + domId).after(\'<a href="#" onClick="$(\\\'#\' + domId + \'\\\').remove(); $(this).remove(); return false;">--<br /></a>\');
	return false;
});
                        ');
                        break;
                    default:
                        echo $this->Form->input(implode('.', array('Action', 'parameter', $optionGroup, $key)), $formOptions);
                        break;
                }
            }
        }
    }
}