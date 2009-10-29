<?php
return array(
    'name' => __('Alphabetic and numeric format characters', true),
    'description' => __('Alphabetic and numeric format characters', true),
    'schemaType' => 'string',
    'validate' => array(
        'alphaNumericFormat' => array(
            'rule' => '\'alphaNumeric\'',
            'message' => '__(\'Wrong format\', true)',
            'allowEmpty' => 'true',
        ),
    ),
);