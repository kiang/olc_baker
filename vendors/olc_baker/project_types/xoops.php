<?php
return array(
    'name' => 'XOOPS',
    'description' => __('Application will use the layout of XOOPS. Tested on XOOPS 2.3.3', true),
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
                'label' => __('Absolute path of the configuration file (mainfile.php)', true),
            ),
        ),
    ),
);