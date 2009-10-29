<?php
return array(
    'name' => 'dotProject',
    'description' => __('Application will use the layout of dotProject. Tested on dotProject 2.1.2', true),
    'options' => array(
		'settings' => array(
			'config_file' => array(
            	'type' => 'text',
            	'label' => __('Absolute path of the configuration file (config.php)', true),
            ),
            'url_path' => array(
                'type' => 'text',
                'label' => __('Url of the dotProject index page, like http://localhost/~kiang/dotproject/', true),
            ),
        ),
    ),
);