<?php
return array(
    'name' => __('IP address', true),
    'description' => __('IP address', true),
    'schemaType' => 'string',
    'validate' => array(
        'ipFormat' => array(
            'rule' => '\'ip\'',
            'message' => '\'Wrong format\'',
            'allowEmpty' => 'true',
        ),
    ),
);