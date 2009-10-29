<?php
return array(
    'name' => '電子信箱',
    'description' => '電子信箱',
    'schemaType' => 'string',
    'validate' => array(
        'emailFormat' => array(
            'rule' => '\'email\'',
            'message' => '\'信箱格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);