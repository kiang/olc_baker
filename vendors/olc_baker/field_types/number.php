<?php
return array(
    'name' => '數字',
    'description' => '數字',
    'schemaType' => 'integer',
    'validate' => array(
        'numberFormat' => array(
            'rule' => '\'numeric\'',
            'message' => '\'數字格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);