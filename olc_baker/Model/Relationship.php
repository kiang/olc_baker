<?php

class Relationship extends AppModel {

    var $name = 'Relationship';
    var $belongsTo = array(
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