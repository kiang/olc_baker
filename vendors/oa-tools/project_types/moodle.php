<?php
return array(
    'name' => 'Moodle',
    'description' => '程式將基於 Moodle 延伸，使外觀一致，在 Moodle 1.9.4 開發。<br />
    	使用時調整 Moodle 主程式：<ul>
    	<li>moodle/lib/setuplib.php 找到 class object {}; ，需改為 if(!class_exists(\'object\')) { class object {}; }</li>
    	</ul>',
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
            	'label' => '設定檔案( config.php )的位置',
            ),
        ),
    ),
);