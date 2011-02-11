<?php

class FormField extends AppModel {

    var $name = 'FormField';
    var $validate = array(
        'form_id' => array('numeric'),
        'name' => array('notempty'),
        'label' => array('notempty'),
        'type' => array('notempty')
    );
    var $belongsTo = array(
        'Form' => array(
            'className' => 'Form',
            'foreignKey' => 'form_id',
        )
    );

    function getFieldTypeList() {
        $sourcePath = VENDORS . 'olc_baker' . DS . 'field_types' . DS;
        $fh = new Folder($sourcePath);
        $files = $fh->read();
        $list = array();
        foreach ($files[1] AS $fileName) {
            $pathInfo = pathinfo($fileName);
            $fileContent = include($sourcePath . $fileName);
            $list[$pathInfo['filename']] = $fileContent['name'];
        }
        return $list;
    }

    function getFieldTypeContent($typeName, $id = null) {
        $sourcePath = VENDORS . 'olc_baker' . DS . 'field_types' . DS;
        $fileContent = array();
        if (file_exists($sourcePath . $typeName . '.php')) {
            $fileContent = include($sourcePath . $typeName . '.php');
        } else {
            return '';
        }
        if (!empty($id) && !empty($fileContent['options'])) {
            $options = unserialize($this->field('options', array('FormField.id' => $id)));
            if (!empty($options)) {
                foreach ($fileContent['options'] AS $optionGroup => $optionItems) {
                    foreach ($optionItems AS $key => $formValue) {
                        if (!empty($options[$optionGroup][$key])) {
                            $fileContent['options'][$optionGroup][$key]['value'] = $options[$optionGroup][$key];
                        }
                    }
                }
            }
        }
        return $fileContent;
    }

}