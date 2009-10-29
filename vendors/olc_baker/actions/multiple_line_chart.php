<?php
return array(
    'name' => '多重折線圖',
    'description' => '多重折線圖',
    'options' => array(
		'blocks' => array(
            'base_field' => array(
                'type' => 'fieldWithId',
                'label' => '基礎欄位',
            ),
            'label_field' => array(
            	'type' => 'field',
            	'label' => '顯示名稱欄位：',
            ),
            'group_field' => array(
            	'type' => 'fieldWithId',
            	'label' => '集合欄位：',
            ),
            'calculate_field' => array(
            	'type' => 'fieldWithId',
            	'label' => '計算欄位：',
            ),
        ),
        'settings' => array(
            'sql_method' => array(
                'type' => 'select',
                'label' => '計算方式：',
                'options' => array(
                    'COUNT' => '數量',
                    'SUM' => '加總',
                    'AVG' => '平均',
                    'MAX' => '最大',
                    'MIN' => '最小',
                ),
            ),
        ),
        'links' => array(
            'view' => array(
                'type' => 'text',
                'label' => '檢視操作介面名稱：',
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