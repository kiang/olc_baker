<?php

class Form extends AppModel
{
    public $name = 'Form';
    public $validate = array(
        'project_id' => array('numeric'),
        'name' => array('notBlank'),
        'label' => array('notBlank')
    );
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
        )
    );
    public $hasMany = array(
        'FormField' => array(
            'className' => 'FormField',
            'foreignKey' => 'form_id',
        ),
        'Relationship' => array(
            'className' => 'Relationship',
            'foreignKey' => 'form_id_base',
        ),
        'Action' => array(
            'className' => 'Action',
            'foreignKey' => 'form_id',
        ),
    );

    public function generateModel()
    {
    }

}
