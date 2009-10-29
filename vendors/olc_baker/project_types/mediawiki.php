<?php
return array(
    'name' => 'MediaWiki',
    'description' => '程式將基於 MediaWiki 延伸，使外觀一致，在 MediaWiki 1.14.0 開發。',
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
            	'label' => '設定檔案( LocalSettings.php )的位置',
            ),
        ),
    ),
);