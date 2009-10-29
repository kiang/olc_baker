<?php
return array(
    'name' => __('Normal list', true),
    'description' => __('A table based list page', true),
    'options' => array(
		'blocks' => array(
			'body' => array(
            	'type' => 'fields',
            	'label' => __('Display fields:', true),
            ),
        ),
        'links' => array(
            'view' => array(
                'type' => 'text',
                'label' => __('Method name:', true),
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