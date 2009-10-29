<?php
return array(
    'name' => '網址',
    'description' => '網址',
    'schemaType' => 'string',
    'validate' => array(
        'urlFormat' => array(
            'rule' => '\'url\'',
            'message' => '\'網址格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);