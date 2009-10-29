<?php
return array(
    'name' => __('Url', true),
    'description' => __('Url', true),
    'schemaType' => 'string',
    'validate' => array(
        'urlFormat' => array(
            'rule' => '\'url\'',
            'message' => '__(\'Wrong format\', true)',
            'allowEmpty' => 'true',
        ),
    ),
);