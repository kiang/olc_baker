<?php
if(!empty($tables)) {
    echo '<h2>選擇資料表</h2><table class="systable" cellpadding="0" cellspacing="0"><tr>';
    $count = 0;
    foreach($tables AS $table) {
        echo '<td>' . $html->link($table, array('action' => 'db', $projectId, $table)) . '</td>';
        if(++$count % 5 == 0) {
            echo '</tr><tr>';
        }
    }
    echo '</tr></table>';
} else {
    echo $form->create('Form', array('url' => array(
    	'controller' => 'projects', 'action' => 'db', $projectId, $tableName
    )));
    echo '<h2>資料表： ' . $tableName . '</h2>';
    echo $form->input('Form.label', array(
        'label' => '表單顯示名稱'
    ));
    echo '<table class="systable" cellpadding="0" cellspacing="0">
    <tr>
    	<th>欄位名稱</th>
    	<th>顯示名稱</th>
    	<th>類型</th>
    	<th>排序</th>
    	<th>必填</th>
    </tr>';
    $fieldCount = 0;
    foreach($schema AS $field => $fieldOption) {
        if($field == 'id') {
            continue;
        }
        ++$fieldCount;
        echo '<tr>';
        echo '<td>' . $field . '</td>';
        echo '<td>' . $form->text('Field.' . $field . '.label') . '</td>';
        echo '<td>' . $form->select('Field.' . $field . '.type', $types, array(
            'value' => 'text',
        )) . '</td>';
        echo '<td>' . $form->text('Field.' . $field . '.sort', array(
            'size' => 3,
            'value' => $fieldCount,
        )) . '</td>';
        echo '<td>' . $form->checkbox('Field.' . $field . '.is_required') . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo $form->end('送出');
}
echo $html->link('回到專案', array('action'=>'view', $projectId));