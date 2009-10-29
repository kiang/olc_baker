<?php
return array(
    'name' => '名片列表',
    'description' => '以檢視名片為基礎的列表',
    'options' => array(
		'blocks' => array(
			'title' => array(
            	'type' => 'field',
            	'label' => '標題欄位：',
            ),
            'picture' => array(
                'type' => 'imageField',
                'label' => '圖片欄位：',
            ),
            'body' => array(
            	'type' => 'fields',
            	'label' => '內容欄位：',
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