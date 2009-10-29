<?php
return array(
    'name' => '圖表',
    'description' => '檢視各種類型的圖表',
    'options' => array(
		'blocks' => array(
			'group_field' => array(
            	'type' => 'fieldWithId',
            	'label' => '集合欄位：',
            ),
            'calculate_field' => array(
            	'type' => 'fieldWithId',
            	'label' => '計算欄位：',
            ),
            'label_field' => array(
            	'type' => 'field',
            	'label' => '顯示名稱欄位：',
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
            'chart_type' => array(
                'type' => 'select',
                'label' => '圖表類型：',
                'options' => array(
                    'pie' => '圓餅圖',
                    'line' => '曲線圖',
                    'line_hollow' => '空心點曲線圖',
                    'area_line' => '曲線面積圖',
                    'bar' => '長條圖',
                    'bar_3d' => '3D 長條圖',
                    'bar_glass' => '半透明長條圖',
                    'bar_cylinder' => '圓柱長條圖',
                    'bar_round' => '橢圓長條圖',
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
                'value' => 'chart',
            ),
        ),
    ),
);