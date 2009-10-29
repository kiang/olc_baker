<?php
return array(
    'name' => '英文/數字',
    'description' => '英文/數字',
    'schemaType' => 'string',
    'validate' => array(
        'alphaNumericFormat' => array(
            'rule' => '\'alphaNumeric\'',
            'message' => '\'格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);