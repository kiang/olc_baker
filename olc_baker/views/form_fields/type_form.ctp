<?php
if(!empty($content)) {
    echo $content['description'];
    if(!empty($content['options'])) {
        foreach($content['options'] AS $optionGroup => $optionItems) {
            foreach($optionItems AS $key => $formOptions) {
                echo $form->input(implode('.', array('FormField', 'option', $optionGroup, $key)), $formOptions);
            }
        }
    }
}