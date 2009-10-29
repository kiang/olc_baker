<?php
return array(
    'name' => '金錢',
    'description' => '金錢',
    'schemaType' => 'float',
    'validate' => array(
        'moneyFormat' => array(
            'rule' => '\'money\'',
            'message' => '\'格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);