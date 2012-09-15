<?php
return array(
    'name' => __('Calendar(day)', true),
    'description' => __('A day by day calendar', true),
    'options' => array(
        'blocks' => array(
            'datetime' => array(
                'type' => 'dateTimeField',
                'label' => __('Time field:', true),
            ),
            'title' => array(
                'type' => 'field',
                'label' => __('Title field:', true),
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
                'value' => 'calendar_day',
            ),
        ),
    ),
);
