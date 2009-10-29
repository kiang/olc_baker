<?php
return array(
    'name' => 'dotProject',
    'description' => '程式將基於 dotProject 延伸，使外觀一致，在 dotProject 2.1.2 開發。',
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
            	'label' => '設定檔案( config.php )的位置',
            ),
            'url_path' => array(
                'type' => 'text',
                'label' => 'dotProject 的首頁網址，例如 http://localhost/~kiang/dotproject/',
            ),
        ),
    ),
);