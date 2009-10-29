<?php
return array(
    'name' => __('Manual', true),
    'description' => __('An independent application', true),
    'options' => array(
		'settings' => array(
			'rewrite_base' => array(
            	'type' => 'text',
            	'label' => __('Relative path to the root of url. For example, fill in /~kiang/demo/ when the url is http://localhost/~kiang/demo/', true),
            ),
        	'app_path' => array(
            	'type' => 'text',
            	'label' => __('Absolute path to the application:', true),
            ),
            'db_host' => array(
            	'type' => 'text',
            	'label' => __('Location of database:', true),
            ),
            'db_login' => array(
            	'type' => 'text',
            	'label' => __('Username of database:', true),
            ),
            'db_password' => array(
            	'type' => 'password',
            	'label' => __('Password of database:', true),
            ),
            'db_name' => array(
            	'type' => 'text',
            	'label' => __('Name of the database:', true),
            ),
        ),
    ),
);