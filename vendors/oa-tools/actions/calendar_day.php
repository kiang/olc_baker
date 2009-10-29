<?php
return array(
    'name' => '日行事曆',
    'description' => '以日行事曆為基礎的列表',
    'options' => array(
		'blocks' => array(
			'datetime' => array(
            	'type' => 'dateTimeField',
            	'label' => '時間基礎欄位：',
            ),
            'title' => array(
            	'type' => 'field',
            	'label' => '標題欄位：',
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
                'value' => 'calendar_day',
            ),
        ),
    ),
);