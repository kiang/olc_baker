<?php
return array(
    'name' => '手動設定',
    'description' => '獨立的程式，不依賴其他應用。',
    'options' => array(
		'settings' => array(
			'rewrite_base' => array(
            	'type' => 'text',
            	'label' => '網址相對於根目錄路徑，例如 http://localhost/~kiang/demo/ 時輸入 /~kiang/demo/',
            ),
        	'app_path' => array(
            	'type' => 'text',
            	'label' => '應用程式路徑：',
            ),
            'db_host' => array(
            	'type' => 'text',
            	'label' => '資料庫主機位置：',
            ),
            'db_login' => array(
            	'type' => 'text',
            	'label' => '資料庫帳號：',
            ),
            'db_password' => array(
            	'type' => 'password',
            	'label' => '資料庫密碼：',
            ),
            'db_name' => array(
            	'type' => 'text',
            	'label' => '資料庫名稱：',
            ),
        ),
    ),
);