<?php
return array(
    'name' => __('Name card based list', true),
    'description' => __('Name card based list', true),
    'options' => array(
		'blocks' => array(
			'title' => array(
            	'type' => 'field',
            	'label' => __('Title field:', true),
            ),
            'picture' => array(
                'type' => 'imageField',
                'label' => __('Picture field:', true),
            ),
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