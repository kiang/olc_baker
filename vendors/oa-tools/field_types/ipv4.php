<?php
return array(
    'name' => 'IP(v4)',
    'description' => 'IP(v4)',
    'schemaType' => 'string',
    'validate' => array(
        'ipFormat' => array(
            'rule' => '\'ip\'',
            'message' => '\'格式有誤\'',
            'allowEmpty' => 'true',
        ),
    ),
);