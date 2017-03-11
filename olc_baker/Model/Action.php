<?php

class Action extends AppModel
{
    public $name = 'Action';
    public $validate = array(
        'action' => array('numeric'),
        'name' => array('notBlank'),
    );
    public $belongsTo = array(
        'Form' => array(
            'className' => 'Form',
            'foreignKey' => 'form_id',
        )
    );

    public function getEngineList()
    {
        App::uses('Folder', 'Utility');
        $sourcePath = VENDORS . 'olc_baker' . DS . 'actions' . DS;
        $fh = new Folder($sourcePath);
        $files = $fh->find('.*\.php$');
        $list = array();
        foreach ($files AS $fileName) {
            $pathInfo = pathinfo($fileName);
            $fileContent = include($sourcePath . $fileName);
            $list[$pathInfo['filename']] = $fileContent['name'];
        }

        return $list;
    }

    public function getEngineContent($engine)
    {
        $sourcePath = VENDORS . 'olc_baker' . DS . 'actions' . DS;
        $fileContent = array();
        if (file_exists($sourcePath . $engine . '.php')) {
            $fileContent = include($sourcePath . $engine . '.php');
        } else {
            return '';
        }

        return $fileContent;
    }

}
