<?php
return array(
    'name' => __('Story based list', true),
    'description' => __('Story based list', true),
    'options' => array(
        'blocks' => array(
            'title' => array(
                'type' => 'field',
                'label' => __('Title field:', true),
            ),
            'subTitle' => array(
                'type' => 'field',
                'label' => __('Sub title field:', true),
            ),
            'date' => array(
                'type' => 'field',
                'label' => __('Date field:', true),
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
