<?php
return array(
    'name' => 'MediaWiki',
    'description' => __('Application will use the layout of MediaWiki. Tested on MediaWiki 1.14.0', true),
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
                'label' => __('Absolute path of the configuration file (LocalSettings.php)', true),
            ),
        ),
    ),
);