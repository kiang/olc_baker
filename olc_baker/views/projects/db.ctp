<?php
if(!empty($tables)) {
    echo '<h2>' . __('Please select a table') . '</h2><table class="systable" cellpadding="0" cellspacing="0"><tr>';
    $count = 0;
    foreach($tables AS $table) {
        echo '<td>' . $this->Html->link($table, array('action' => 'db', $projectId, $table)) . '</td>';
        if(++$count % 5 == 0) {
            echo '</tr><tr>';
        }
    }
    echo '</tr></table>';
} else {
    echo $this->Form->create('Form', array('url' => array(
    	'controller' => 'projects', 'action' => 'db', $projectId, $tableName
    )));
    echo '<h2>' . __('Table name:', true) . ' &nbsp; ' . $tableName . '</h2>';
    echo $this->Form->input('Form.label', array(
        'label' => __('Display name of the form', true)
    ));
    echo '<table class="systable" cellpadding="0" cellspacing="0">
    <tr>
    	<th>' . __('Form field', true) . '</th>
    	<th>' . __('Display name', true) . '</th>
    	<th>' . __('Type', true) . '</th>
    	<th>' . __('Sort', true) . '</th>
    	<th>' . __('Required', true) . '</th>
    </tr>';
    $fieldCount = 0;
    foreach($schema AS $field => $fieldOption) {
        if($field == 'id') {
            continue;
        }
        ++$fieldCount;
        echo '<tr>';
        echo '<td>' . $field . '</td>';
        echo '<td>' . $this->Form->text('Field.' . $field . '.label') . '</td>';
        echo '<td>' . $this->Form->select('Field.' . $field . '.type', $types, array(
            'value' => 'text',
        )) . '</td>';
        echo '<td>' . $this->Form->text('Field.' . $field . '.sort', array(
            'size' => 3,
            'value' => $fieldCount,
        )) . '</td>';
        echo '<td>' . $this->Form->checkbox('Field.' . $field . '.is_required') . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo $this->Form->end(__('Submit', true));
}
echo $this->Html->link(__('Back to the project', true), array('action'=>'view', $projectId));