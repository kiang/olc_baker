<?php
return array(
    'name' => __('Flash charts', true),
    'description' => __('Several types of flash charts', true),
    'options' => array(
        'blocks' => array(
            'group_field' => array(
                'type' => 'fieldWithId',
                'label' => __('Group by field:', true),
            ),
            'calculate_field' => array(
                'type' => 'fieldWithId',
                'label' => __('Calculate field:', true),
            ),
            'label_field' => array(
                'type' => 'field',
                'label' => __('Chart label field:', true),
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
            'chart_type' => array(
                'type' => 'select',
                'label' => __('Chart type', true),
                'options' => array(
                    'pie' => __('Pie chart', true),
                    'line' => __('Line chart', true),
                    'line_hollow' => __('Hollow point line chart', true),
                    'area_line' => __('Area line chart', true),
                    'bar' => __('Bar chart', true),
                    'bar_3d' => __('3D bar chart', true),
                    'bar_glass' => __('Glass bar chart', true),
                    'bar_cylinder' => __('Cylinder bar chart', true),
                    'bar_round' => __('Round bar chart', true),
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
                'value' => 'chart',
            ),
        ),
    ),
);
