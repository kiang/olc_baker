<?php
return array(
    'name' => __('Money', true),
    'description' => __('Money', true),
    'schemaType' => 'float',
    'validate' => array(
        'moneyFormat' => array(
            'rule' => '\'money\'',
            'message' => '__(\'Wrong format\', true)',
            'allowEmpty' => 'true',
        ),
    ),
);