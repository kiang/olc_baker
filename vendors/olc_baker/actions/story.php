<?php
return array(
    'name' => '文章列表',
    'description' => '以檢視文章為基礎的列表',
    'options' => array(
		'blocks' => array(
			'title' => array(
            	'type' => 'field',
            	'label' => '主題欄位：',
            ),
            'subTitle' => array(
            	'type' => 'field',
            	'label' => '副標題欄位：',
            ),
        	'date' => array(
            	'type' => 'field',
            	'label' => '日期欄位：',
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