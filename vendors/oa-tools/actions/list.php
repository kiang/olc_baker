<?php
return array(
    'name' => '一般列表',
    'description' => '以條列方式呈現資料列表',
    'options' => array(
		'blocks' => array(
			'body' => array(
            	'type' => 'fields',
            	'label' => '要顯示欄位：',
            ),
        ),
        'links' => array(
            'view' => array(
                'type' => 'text',
                'label' => '檢視操作介面名稱：',
                'value' => 'view',
            ),
        ),
        'methods' => array(
            'method' => array(
                'type' => 'hidden',
                'value' => 'index',
            ),
        ),
    ),
);