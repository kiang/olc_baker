<?php
return array(
    'name' => __('True or false', true),
    'description' => __('True or false', true),
    'schemaType' => 'boolean',
    'validate' => array(
        'booleanFormat' => array(
            'rule' => '\'boolean\'',
            'message' => '\'Wrong format\'',
            'allowEmpty' => 'true',
        ),
    ),
);
