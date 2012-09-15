<?php
return array(
    'name' => __('Multiple line Text', true),
    'description' => __('Multiple line Text', true),
    'options' => array(
        'form' => array(
            'rows' => array(
                'type' => 'text',
                'label' => __('Rows', true),
            ),
            'cols' => array(
                'type' => 'text',
                'label' => __('Columns', true),
            ),
        ),
    ),
    'schemaType' => 'text',
);
