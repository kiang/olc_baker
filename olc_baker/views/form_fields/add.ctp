<div class="formFields form">
<?php echo $form->create('FormField', array('url' => array($formId)));?>
	<fieldset>
 		<legend>新增</legend>
	<?php
	echo $form->input('name', array('label' => '系統名稱'));
	echo $form->input('label', array('label' => '顯示名稱'));
	echo $form->input('type', array('label' => '類型', 'type' => 'select', 'options' => $types));
	echo $form->input('sort', array('label' => '排序', 'value' => 0));
	echo $form->input('is_required', array('label' => '必填？'));
	echo $form->input('function_type', array('type' => 'select', 'label' => '功能類型：',
    	'options' => array(
            1 => '新增時可以輸入，編輯時可以調整',
            2 => '新增時可以輸入，編輯時僅供顯示',
            3 => '新增時自動產生，編輯時僅供顯示',
            4 => '新增時自動產生，編輯時可以調整',
            5 => '新增時自動產生，編輯時自動產生',
        ),
    ));
    echo '<div id="functionBlock">';
    echo $form->input('function_string', array('type' => 'text', 'label' => '自動產生使用函式：'));
    echo $form->input('x.functionSet', array('type' => 'select', 'label' => '使用函式快選項目：',
    	'options' => array(
            '' => '--',
            'date(\'Y-m-d H:i:s\')' => '日期 + 時間',
            'date(\'Y-m-d\')' => '日期',
            'date(\'H:i:s\')' => '時間',
            'mktime()' => 'Unix 時間',
            '$_SERVER[\'REMOTE_HOST\']' => '存取者 IP',
        )
    ));
    echo '</div>';
	?>
	<div id="optionBlock"></div>
	</fieldset>
<?php echo $form->end('送出');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('回到表單', array('controller' => 'forms', 'action'=>'view', $formId));?></li>
	</ul>
</div>
<?php
echo $javascript->codeBlock('
function switchFunctionBlock() {
	if($(\'#FormFieldFunctionType\').val() > 2) {
		$(\'#functionBlock\').show();
	} else {
		$(\'#functionBlock\').hide();
	}
}
$(document).ready(function() {
	$(\'#FormFieldType\').change(function() {
		$(\'#optionBlock\').load(\'' . $html->url(array('action' => 'type_form')) . '/\' +
			$(\'#FormFieldType option:selected\').val()
		);
	});
	$(\'#FormFieldType\').trigger(\'change\');
	$(\'#FormFieldFunctionType\').change(function() {
		switchFunctionBlock();
	});
	$(\'#xFunctionSet\').change(function() {
		$(\'#FormFieldFunctionString\').attr(\'value\', this.value);
	});
	switchFunctionBlock();
});
');