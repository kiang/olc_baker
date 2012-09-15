<?php

class Relationship extends AppModel
{
    public $name = 'Relationship';
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
        ),
        'BaseForm' => array(
            'className' => 'Form',
            'foreignKey' => 'form_id_base',
        ),
        'TargetForm' => array(
            'className' => 'Form',
            'foreignKey' => 'form_id_target',
        ),
    );

}
