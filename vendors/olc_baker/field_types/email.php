<?php
return array(
    'name' => __('Email', true),
    'description' => __('Email', true),
    'schemaType' => 'string',
    'validate' => array(
        'emailFormat' => array(
            'rule' => '\'email\'',
            'message' => '__(\'Wrong format\', true)',
            'allowEmpty' => 'true',
        ),
    ),
);