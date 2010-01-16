<?php
return array(
    'name' => __('Credit card', true),
    'description' => __('Credit card', true),
    'schemaType' => 'string',
    'validate' => array(
        'ccFormat' => array(
            'rule' => '\'cc\'',
            'message' => '\'Wrong format\'',
            'allowEmpty' => 'true',
        ),
    ),
);