<?php
return array(
    'name' => '信用卡',
    'description' => '信用卡',
    'schemaType' => 'string',
    'validate' => array(
        'ccFormat' => array(
            'rule' => '\'cc\'',
            'message' => '\'格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);