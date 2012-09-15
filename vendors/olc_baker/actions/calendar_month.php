<?php
return array(
    'name' => __('Calendar(month)', true),
    'description' => __('A calendar', true),
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
                'value' => 'calendar_month',
            ),
        ),
    ),
);
