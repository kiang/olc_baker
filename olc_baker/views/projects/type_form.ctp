<?php
if(!empty($content)) {
    echo $content['description'];
    if(!empty($content['options'])) {
        foreach($content['options'] AS $optionGroup => $optionItems) {
            foreach($optionItems AS $key => $this->FormOptions) {
                echo $this->Form->input(implode('.', array('Project', 'option', $optionGroup, $key)), $this->FormOptions);
            }
        }
    }
}