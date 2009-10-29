<?php
return array(
    'name' => __('Credit card', true),
    'description' => __('Credit card', true),
    'schemaType' => 'string',
    'validate' => array(
        'ccFormat' => array(
            'rule' => '\'cc\'',
            'message' => '__(\'Wrong format\', true)',
            'allowEmpty' => 'true',
        ),
    ),
);