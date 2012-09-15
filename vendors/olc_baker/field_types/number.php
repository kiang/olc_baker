<?php
return array(
    'name' => __('Number', true),
    'description' => __('Number', true),
    'schemaType' => 'integer',
    'validate' => array(
        'numberFormat' => array(
            'rule' => '\'numeric\'',
            'message' => '\'Wrong format\'',
            'allowEmpty' => 'true',
        ),
    ),
);
