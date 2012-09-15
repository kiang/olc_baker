<?php
return array(
    'name' => __('Multiple line flash chart', true),
    'description' => __('Multiple line flash chart', true),
    'options' => array(
        'blocks' => array(
            'base_field' => array(
                'type' => 'fieldWithId',
                'label' => __('Base field:', true),
            ),
            'label_field' => array(
                'type' => 'field',
                'label' => __('Display field:', true),
            ),
            'group_field' => array(
                'type' => 'fieldWithId',
                'label' => __('Group by field:', true),
            ),
            'calculate_field' => array(
                'type' => 'fieldWithId',
                'label' => __('Calculate field:', true),
            ),
        ),
        'settings' => array(
            'sql_method' => array(
                'type' => 'select',
                'label' => __('Calculate method in database query:', true),
                'options' => array(
                    'COUNT' => __('Number count', true),
                    'SUM' => __('Summary', true),
                    'AVG' => __('Average', true),
                    'MAX' => __('Maximum value', true),
                    'MIN' => __('Minimum value', true),
                ),
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
                'value' => 'multiple_line_chart',
            ),
        ),
    ),
);
