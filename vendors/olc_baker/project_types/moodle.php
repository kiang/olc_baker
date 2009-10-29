<?php
return array(
    'name' => 'Moodle',
	'description' => __('Application will use the layout of Moodle. Tested on Moodle 1.9.4.', true) .
    __('Before using this application with moodle, you must modify part of moodle.<ul>
    <li>Open the file moodle/lib/setuplib.php and find the string<br /><b>class object {};</b><br />Replace it with<br /><b>if(!class_exists(\'object\')) { class object {}; }</b></li>
    </ul>', true),
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
                'label' => __('Absolute path of the configuration file (config.php)', true),
            ),
        ),
    ),
);