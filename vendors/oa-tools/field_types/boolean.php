<?php
return array(
    'name' => '是/否',
    'description' => '是/否',
    'schemaType' => 'boolean',
    'validate' => array(
        'booleanFormat' => array(
            'rule' => '\'boolean\'',
            'message' => '\'資料有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);